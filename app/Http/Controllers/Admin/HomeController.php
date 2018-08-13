<?php

namespace App\Http\Controllers\Admin;

use App\Models\Home;
use Exception;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Traits\PaginationTrait;
use App\Traits\ImageManageTrait;
use App\Http\Controllers\Controller;
use App\Traits\ErrorFlashMessagesTrait;
use App\Http\Requests\TestimonialRequest;

class HomeController extends Controller
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
        $home = $this->getHome();
        return view('admin.home.index', compact('home'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function banners(Request $request)
    {
        $home = $this->getHome();
        return view('admin.home.banners', compact('home'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function offers(Request $request)
    {
        $home = $this->getHome();
        return view('admin.home.offers', compact('home'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function magic(Request $request)
    {
        $home = $this->getHome();
        return view('admin.home.magic', compact('home'));
    }

    /**
     * @param TestimonialRequest $request
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function upateBanners(TestimonialRequest $request)
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
     * @param TestimonialRequest $request
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateOffers(TestimonialRequest $request)
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
     * @param TestimonialRequest $request
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateMagic(TestimonialRequest $request)
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
}
