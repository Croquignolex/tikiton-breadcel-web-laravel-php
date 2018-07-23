<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Traits\PaginationTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Traits\ErrorFlashMessagesTrait;
use Illuminate\Validation\ValidationException;

class TagsController extends Controller
{
    use ErrorFlashMessagesTrait, PaginationTrait;

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
        $tags = null;
        $table_label = 'Toutes le étiquettes';
        try
        {
            $tags = Tag::all()->sortByDesc('updated_at');
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        $this->paginate($request, $tags, 10, 3);
        $paginationTools = $this->paginationTools;

        return view('admin.tags.index', compact(
            'paginationTools', 'table_label'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * @param CategoryRequest $request
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CategoryRequest $request)
    {
        $this->tagExist($request->input('en_name'));
        try
        {
            $tag = Tag::create($request->all());
            flash_message(
                trans('auth.success'), $request->input('fr_name') . ' ajouté(e) avec succèss',
                font('check')
            );

            return redirect(route('admin.tags.show', [$tag]));
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    /**
     * @param Request $request
     * @param Tag $tag
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, Tag $tag)
    {
        return view('admin.tags.show', compact('tag'));
    }

    /**
     * @param Request $request
     * @param ProductCategory $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * @param CategoryRequest $request
     * @param ProductCategory $category
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CategoryRequest $request, Tag $tag)
    {
        $this->tagExist($request->input('en_name'), $tag->id);
        try
        {
            $tag->update($request->all());
            flash_message(
                trans('auth.success'), $tag->format_name . ' à été mis(e) à jour avec succèss',
                font('check')
            );

            return redirect(route('admin.tags.show', [$tag]));
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    /**
     * @param Request $request
     * @param Tag $tag
     * @return Router
     */
    public function destroy(Request $request, Tag $tag)
    {
        try
        {
            if(!$tag->products->isEmpty())
            {
                flash_message(
                    trans('auth.info'),
                    'Impossible de supprimer cette étiquette car un ou plusieurs produits en dépendent',
                    font('info-circle'), 'info'
                );
            }
            else
            {
                $tag->delete();
                flash_message(
                    trans('auth.info'), $tag->format_name . ' supprimé(e) avec succèss', font('info-circle'),
                    'info'
                );
            }
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    /**
     * @param $name
     * @param int $tag_id
     */
    private function tagExist($name, $tag_id = 0)
    {
        if(Tag::where('slug', str_slug($name))->where('id', '<>', $tag_id)->count() > 0)
        {
            throw ValidationException::withMessages([
                'en_name' => 'Une étiquette exite deja avec ce nom. Choisissez un autre nom pour l\'anglais',
            ])->status(423);
        }
    }

    /**
     * Give the redirection path
     *
     * @return Router
     */
    private function redirectTo()
    {
        return redirect(route('admin.tags.index'));
    }
}
