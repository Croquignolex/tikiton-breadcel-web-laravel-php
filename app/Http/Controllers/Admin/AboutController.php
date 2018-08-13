<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use Exception;
use Illuminate\Http\Request;
use App\Traits\PaginationTrait;
use App\Traits\ImageManageTrait;
use App\Http\Controllers\Controller;
use App\Traits\ErrorFlashMessagesTrait;
use App\Http\Requests\TestimonialRequest;

class AboutController extends Controller
{
    use ErrorFlashMessagesTrait, PaginationTrait, ImageManageTrait;

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
        $about = $this->getAbout();
        return view('admin.about.index', compact('about'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $about = $this->getAbout();
        return view('admin.about.edit', compact('about'));
    }

    /**
     * @param TestimonialRequest $request
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(TestimonialRequest $request)
    {
        $image = $this->storeImage($request, 'testimonials', $testimonial);

        try
        {
            $testimonial->update([
                'name' => $request->input('name'),
                'fr_description' => $request->input('fr_description'),
                'en_description' => $request->input('en_description'),
                'image' => $image->name,
                'extension' => $image->extension
            ]);

            success_flash_message(trans('auth.success'), 'Le témoignage de ' . $request->input('name') . ' à été mis(e) à jour avec succèss');
            return redirect(route('admin.testimonials.show', [$testimonial]));
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
        return redirect(route('admin.about.index'));
    }

    /**
     * @return null
     */
    private function getAbout()
    {
        try
        {
            return About::first();
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return null;
    }
}
