<?php

namespace App\Traits;

use Exception;
use App\Utils\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

trait ImageManageTrait
{
    private $img_path = 'assets/img/';

    /**
     * @param Request $request
     * @param $storage_path
     * @param Model|null $model
     * @return Image
     */
    private function storeImage(Request $request, $storage_path, Model $model = null)
    {
        $returnedImage =  is_null($model) ? new Image('default', 'jpg')
            : new Image($model->image, $model->extension);
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $allowed_extensions = collect(['jpg', 'JPG', 'jpeg', 'JPEG',
                'png', 'PNG', 'gif', 'GIF', 'svg', 'SVG']);
            if($allowed_extensions->contains($image->getClientOriginalExtension()))
            {
                try
                {
                    $returnedImage->name = md5($image->getClientOriginalName() . time());
                    $returnedImage->extension = $image->getClientOriginalExtension();
                    $image->move(public_path($this->img_path . $storage_path . '/'), $returnedImage->name . '.' . $returnedImage->extension);
                    if(!is_null($model)) $this->deleteImage($model, $storage_path);
                }
                catch (Exception $exception)
                {
                    $this->imageError($exception);
                }
            }
            else
            {
                danger_flash_message(trans('auth.error'), 'Erreur sur l\'extension de l\'image');

                throw ValidationException::withMessages([
                    'image' => 'L\'extension ne correspond pas, l\'extension doit être dans cette liste (jpg, JPG, jpeg, JPEG, png, PNG, gif, GIF, svg, SVG)',
                ])->status(423);
            }
        }
        return $returnedImage;
    }

    /**
     * @param Model $model
     * @param $storage_path
     */
    private function deleteImage(Model $model, $storage_path)
    {
        try
        {
            if($model->image !== 'default')
            {
                $file = public_path($this->img_path . $storage_path . '/') . $model->image . '.' . $model->extension;
                if(File::exists($file)) File::delete($file);
            }
        }
        catch (Exception $exception)
        {
            $this->imageError($exception);
        }
    }
}