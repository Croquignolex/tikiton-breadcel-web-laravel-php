<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\About;
use Illuminate\Http\Request;
use App\Traits\PaginationTrait;
use App\Traits\ImageManageTrait;
use App\Http\Controllers\Controller;
use App\Traits\ErrorFlashMessagesTrait;

class AboutController extends Controller
{
    use ErrorFlashMessagesTrait, PaginationTrait,
        ImageManageTrait;

    private $required_text = 'required|string|min:2|max:510';

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
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function welcomeSection(Request $request)
    {
        $request->validate([
           'fr_about_section_1_normal_zone' => $this->required_text,
            'en_about_section_1_normal_zone' => $this->required_text
        ]);

        $this->update($request, 'Section Bienvenue sur Bread\'Cel mis à jour');
        return $this->redirectTo();
    }

    /**
     * @param Request $request
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function welcomeComment(Request $request)
    {
        $request->validate([
            'fr_about_section_1_important_zone' => $this->required_text,
            'en_about_section_1_important_zone' => $this->required_text
        ]);

        $this->update($request,  'Commentaire Bienvenue sur Bread\'Cel mis à jour');
        return $this->redirectTo();
    }

    /**
     * @param Request $request
     * @return Router
     */
    public function whySection(Request $request)
    {
        $request->validate([
            'fr_about_section_2_normal_zone' => $this->required_text,
            'en_about_section_2_normal_zone' => $this->required_text
        ]);

        $this->update($request,  'Section Pourquoi nous choisir');
        return $this->redirectTo();
    }

    public function whyComment(Request $request)
    {
        $request->validate([
            'fr_about_section_2_important_zone' => $this->required_text,
            'en_about_section_2_important_zone' => $this->required_text
        ]);

        $this->update($request,  'Commentaire Pourqoui nous choisir mis à jour');
        return $this->redirectTo();
    }

    public function whyImage(Request $request)
    {
        $request->validate([
            'image' => 'dimensions:width=570,height=330|max:2048'
        ]);

        $about = $this->getAbout();
        $image = $this->storeImage($request, 'banners', $about);

        try
        {
            $about->update([
                'image' => $image->name,
                'extension' => $image->extension
            ]);
            success_flash_message(trans('auth.success'), 'Illustration Pourqoui nous choisir mis à jour');
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

    /**
     * @param Request $request
     * @param $message
     */
    private function update(Request $request, $message)
    {
        try
        {
            $about = $this->getAbout();
            $about->update($request->all());
            success_flash_message(trans('auth.success'), $message);
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }
    }
}
