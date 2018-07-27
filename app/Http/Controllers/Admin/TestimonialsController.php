<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Traits\PaginationTrait;
use App\Traits\ImageManageTrait;
use App\Http\Controllers\Controller;
use App\Traits\ErrorFlashMessagesTrait;
use App\Http\Requests\TestimonialRequest;

class TestimonialsController extends Controller
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
        $table_label = 'Témoignages';
        $testimonials = null;

        try
        {
            $testimonials = Testimonial::all()->sortByDesc('updated_at');
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        $this->paginate($request, $testimonials, 10, 3);
        $paginationTools = $this->paginationTools;

        return view('admin.testimonials.index', compact(
            'paginationTools', 'table_label'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * @param TestimonialRequest $request
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(TestimonialRequest $request)
    {
        $image = $this->storeImage($request, 'testimonials');

        try
        {
            $testimonial = Testimonial::create([
                'name' => $request->input('name'),
                'fr_description' => $request->input('fr_description'),
                'en_description' => $request->input('en_description'),
                'image' => $image->name,
                'extension' => $image->extension
            ]);

            flash_message(
                trans('auth.success'), 'Témoignage de ' . $request->input('name') . ' ajouté avec succèss',
                font('check')
            );

            return redirect(route('admin.testimonials.show', [$testimonial]));
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    /**
     * @param Request $request
     * @param Testimonial $testimonial
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, Testimonial $testimonial)
    {
        return view('admin.testimonials.show', compact('testimonial'));
    }

    /**
     * @param Request $request
     * @param Testimonial $testimonial
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * @param TestimonialRequest $request
     * @param Testimonial $testimonial
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(TestimonialRequest $request, Testimonial $testimonial)
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

            flash_message(
                trans('auth.success'), 'Le témoignage de ' . $request->input('name') . ' à été mis(e) à jour avec succèss',
                font('check')
            );

            return redirect(route('admin.testimonials.show', [$testimonial]));
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    /**
     * @param Request $request
     * @param Testimonial $testimonial
     * @return Router
     */
    public function destroy(Request $request, Testimonial $testimonial)
    {
        try
        {
            $this->deleteImage($testimonial, 'testimonials');
            $testimonial->delete();
            flash_message(
                trans('auth.info'), 'Le témoignage de ' . $testimonial->format_name . '  supprimé avec succèss',
                font('info-circle'), 'info'
            );
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
        return redirect(route('admin.testimonials.index'));
    }
}
