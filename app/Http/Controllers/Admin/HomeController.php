<?php

namespace App\Http\Controllers\Admin;

use App\Models\Home;
use App\Utils\Image;
use Exception;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Traits\PaginationTrait;
use App\Traits\ImageManageTrait;
use App\Http\Controllers\Controller;
use App\Traits\ErrorFlashMessagesTrait;
use App\Http\Requests\TestimonialRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller
{
    use ErrorFlashMessagesTrait, PaginationTrait;

    private $required_text = 'required|string|min:2|max:510';
    private $required_string = 'required|string|min:2|max:255';
    private $banner = 'dimensions:width=1600,height=750|max:2048';
    private $portrait_offer = 'dimensions:width=450,height=420|max:2048';
    private $landscape_offer = 'dimensions:width=675,height=420|max:2048';
    private $storage_path = 'assets/img/banners/';

    /**
     * AccountController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin.auth');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $home = $this->getHome();
        return view('admin.home.index', compact('home'));
    }

    /**
     * @param Request $request
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function banner1(Request $request)
    {
        $request->validate([
            'fr_banner_1_text_1' => $this->required_string,
            'fr_banner_1_text_2' => $this->required_string,
            'en_banner_1_text_1' => $this->required_string,
            'en_banner_1_text_2' => $this->required_string,
            'banner_1' => $this->banner
        ]);

        try
        {
            $home = $this->getHome();
            $image = $this->updateImage($request, new Image($home->banner_1, $home->banner_extension_1), 'banner_1');

            $home->update([
                'fr_banner_1_text_1' => $request->input('fr_banner_1_text_1'),
                'fr_banner_1_text_2' => $request->input('fr_banner_1_text_2'),
                'en_banner_1_text_1' => $request->input('en_banner_1_text_1'),
                'en_banner_1_text_2' => $request->input('en_banner_1_text_2'),
                'banner_1' => $image->name,
                'banner_extension_1' => $image->extension,
            ]);

            success_flash_message(trans('auth.success'), 'Bannière 1 mis à jour');
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    /**
     * @param Request $request
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function banner2(Request $request)
    {
        $request->validate([
            'fr_banner_2_text_1' => $this->required_string,
            'fr_banner_2_text_2' => $this->required_string,
            'en_banner_2_text_1' => $this->required_string,
            'en_banner_2_text_2' => $this->required_string,
            'banner_2' => $this->banner
        ]);

        try
        {
            $home = $this->getHome();
            $image = $this->updateImage($request, new Image($home->banner_2, $home->banner_extension_2), 'banner_2');

            $home->update([
                'fr_banner_2_text_1' => $request->input('fr_banner_2_text_1'),
                'fr_banner_2_text_2' => $request->input('fr_banner_2_text_2'),
                'en_banner_2_text_1' => $request->input('en_banner_2_text_1'),
                'en_banner_2_text_2' => $request->input('en_banner_2_text_2'),
                'banner_2' => $image->name,
                'banner_extension_2' => $image->extension,
            ]);

            success_flash_message(trans('auth.success'), 'Bannière 2 mis à jour');
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    /**
     * @param Request $request
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function banner3(Request $request)
    {
        $request->validate([
            'fr_banner_3_text_1' => $this->required_string,
            'fr_banner_3_text_2' => $this->required_string,
            'en_banner_3_text_1' => $this->required_string,
            'en_banner_3_text_2' => $this->required_string,
            'banner_3' => $this->banner
        ]);

        try
        {
            $home = $this->getHome();
            $image = $this->updateImage($request, new Image($home->banner_3, $home->banner_extension_3), 'banner_3');

            $home->update([
                'fr_banner_3_text_1' => $request->input('fr_banner_3_text_1'),
                'fr_banner_3_text_2' => $request->input('fr_banner_3_text_2'),
                'en_banner_3_text_1' => $request->input('en_banner_3_text_1'),
                'en_banner_3_text_2' => $request->input('en_banner_3_text_2'),
                'banner_3' => $image->name,
                'banner_extension_3' => $image->extension,
            ]);

            success_flash_message(trans('auth.success'), 'Bannière 3 mis à jour');
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    /**
     * @param Request $request
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function offer1(Request $request)
    {
        $request->validate([
            'fr_offer_1_text_1' => $this->required_string,
            'fr_offer_1_text_2' => $this->required_string,
            'en_offer_1_text_1' => $this->required_string,
            'en_offer_1_text_2' => $this->required_string,
            'offer_1' => $this->landscape_offer
        ]);

        try
        {
            $home = $this->getHome();
            $image = $this->updateImage($request, new Image($home->offer_1, $home->offer_extension_1), 'offer_1');

            $home->update([
                'fr_offer_1_text_1' => $request->input('fr_offer_1_text_1'),
                'fr_offer_1_text_2' => $request->input('fr_offer_1_text_2'),
                'en_offer_1_text_1' => $request->input('en_offer_1_text_1'),
                'en_offer_1_text_2' => $request->input('en_offer_1_text_2'),
                'offer_1' => $image->name,
                'offer_extension_1' => $image->extension,
            ]);

            success_flash_message(trans('auth.success'), 'Offre 1 mis à jour');
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    /**
     * @param Request $request
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function offer2(Request $request)
    {
        $request->validate([
            'fr_offer_2_text_1' => $this->required_string,
            'fr_offer_2_text_2' => $this->required_string,
            'en_offer_2_text_1' => $this->required_string,
            'en_offer_2_text_2' => $this->required_string,
            'offer_2' => $this->portrait_offer
        ]);

        try
        {
            $home = $this->getHome();
            $image = $this->updateImage($request, new Image($home->offer_2, $home->offer_extension_2), 'offer_2');

            $home->update([
                'fr_offer_2_text_1' => $request->input('fr_offer_2_text_1'),
                'fr_offer_2_text_2' => $request->input('fr_offer_2_text_2'),
                'en_offer_2_text_1' => $request->input('en_offer_2_text_1'),
                'en_offer_2_text_2' => $request->input('en_offer_2_text_2'),
                'offer_2' => $image->name,
                'offer_extension_2' => $image->extension,
            ]);

            success_flash_message(trans('auth.success'), 'Offre 2 mis à jour');
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    /**
     * @param Request $request
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function offer3(Request $request)
    {
        $request->validate([
            'fr_offer_3_text_1' => $this->required_string,
            'fr_offer_3_text_2' => $this->required_string,
            'en_offer_3_text_1' => $this->required_string,
            'en_offer_3_text_2' => $this->required_string,
            'offer_3' => $this->landscape_offer
        ]);

        try
        {
            $home = $this->getHome();
            $image = $this->updateImage($request, new Image($home->offer_3, $home->offer_extension_3), 'offer_3');

            $home->update([
                'fr_offer_3_text_1' => $request->input('fr_offer_3_text_1'),
                'fr_offer_3_text_2' => $request->input('fr_offer_3_text_2'),
                'en_offer_3_text_1' => $request->input('en_offer_3_text_1'),
                'en_offer_3_text_2' => $request->input('en_offer_3_text_2'),
                'offer_3' => $image->name,
                'offer_extension_3' => $image->extension,
            ]);

            success_flash_message(trans('auth.success'), 'Offre 3 mis à jour');
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    /**
     * @param Request $request
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function offer4(Request $request)
    {
        $request->validate([
            'fr_offer_4_text_1' => $this->required_string,
            'fr_offer_4_text_2' => $this->required_string,
            'en_offer_4_text_1' => $this->required_string,
            'en_offer_4_text_2' => $this->required_string,
            'offer_1' => $this->portrait_offer
        ]);

        try
        {
            $home = $this->getHome();
            $image = $this->updateImage($request, new Image($home->offer_4, $home->offer_extension_4), 'offer_4');

            $home->update([
                'fr_offer_4_text_1' => $request->input('fr_offer_4_text_1'),
                'fr_offer_4_text_2' => $request->input('fr_offer_4_text_2'),
                'en_offer_4_text_1' => $request->input('en_offer_4_text_1'),
                'en_offer_4_text_2' => $request->input('en_offer_4_text_2'),
                'offer_4' => $image->name,
                'offer_extension_4' => $image->extension,
            ]);

            success_flash_message(trans('auth.success'), 'Offre 4 mis à jour');
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    /**
     * @param Request $request
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function magic(Request $request)
    {
        $request->validate([
            'fr_magic_header' => $this->required_string,
            'en_magic_header' => $this->required_string,
            'fr_magic_title' => $this->required_string,
            'en_magic_title' => $this->required_string,
            'fr_magic_description' => $this->required_text,
            'en_magic_description' => $this->required_text,
            'magic' => 'dimensions:width=790,height=300|max:2048',
        ]);

        try
        {
            $home = $this->getHome();
            $image = $this->updateImage($request, new Image($home->magic, $home->magic_extension), 'magic');

            $home->update([
                'fr_magic_header' => $request->input('fr_magic_header'),
                'en_magic_header' => $request->input('en_magic_header'),
                'fr_magic_title' => $request->input('fr_magic_title'),
                'en_magic_title' => $request->input('en_magic_title'),
                'fr_magic_description' => $request->input('fr_magic_description'),
                'en_magic_description' => $request->input('en_magic_description'),
                'magic' => $image->name,
                'magic_extension' => $image->extension,
            ]);

            success_flash_message(trans('auth.success'), 'Présentation mis à jour');
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    /**
     * Give the redirection path
     *
     * @return Router
     */
    private function redirectTo()
    {
        return redirect(route('admin.home.index'));
    }

    /**
     * @return null
     */
    private function getHome()
    {
        try
        {
            return Home::first();
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return null;
    }

    /**
     * @param Request $request
     * @param Image $image
     * @param $name
     * @return Image
     */
    private function updateImage(Request $request, Image $image, $name)
    {
        $returnImage = new Image($image->name, $image->extension);

        if($request->hasFile($name))
        {
            $requestImage = $request->file($name);
            $allowed_extensions = collect(['jpg', 'JPG', 'jpeg', 'JPEG',
                'png', 'PNG', 'gif', 'GIF', 'svg', 'SVG']);
            if($allowed_extensions->contains($requestImage->getClientOriginalExtension()))
            {
                try
                {
                    $returnImage->name = md5($requestImage->getClientOriginalName() . time());
                    $returnImage->extension = $requestImage->getClientOriginalExtension();
                    $requestImage->move(public_path($this->storage_path), $returnImage->name . '.' . $returnImage->extension);
                    $this->deleteImage($image);
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
                    $name => 'L\'extension ne correspond pas, l\'extension doit être dans cette liste (jpg, JPG, jpeg, JPEG, png, PNG, gif, GIF, svg, SVG)',
                ])->status(423);
            }
        }

        return $returnImage;
    }

    /**
     * @param Image $image
     */
    private function deleteImage(Image $image)
    {
        try
        {
            $file = public_path($this->storage_path) . $image->name . '.' . $image->extension;
            if(File::exists($file)) File::delete($file);
        }
        catch (Exception $exception)
        {
            $this->imageError($exception);
        }
    }
}
