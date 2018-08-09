<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Traits\PaginationTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Traits\ErrorFlashMessagesTrait;
use Illuminate\Validation\ValidationException;

class CategoriesController extends Controller
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
        $categories = null;
        $filter = intval($request->query('type'));
        if($filter === ProductCategory::HAS_PRODUCTS) $table_label = 'Catégories qui ont des produits';
        elseif($filter === ProductCategory::HAS_NO_PRODUCTS) $table_label = 'Catégories qui n\'ont pas de produits';
        elseif($filter === ProductCategory::ALL) $table_label = 'Catégories (toutes)';
        else $table_label = 'Filtre inconnu';

        try
        {
            if($filter === ProductCategory::ALL) $categories = ProductCategory::all()->sortByDesc('updated_at');
            elseif($filter === ProductCategory::HAS_PRODUCTS)
            {
                $categories = ProductCategory::all()->filter(function (ProductCategory $category) {
                    return !$category->products->isEmpty();
                })->sortByDesc('updated_at');
            }
            elseif($filter === ProductCategory::HAS_NO_PRODUCTS)
            {
                $categories = ProductCategory::all()->filter(function (ProductCategory $category) {
                    return $category->products->isEmpty();
                })->sortByDesc('updated_at');
            }
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        $this->paginate($request, $categories, 10, 3);
        $paginationTools = $this->paginationTools;

        return view('admin.categories.index', compact(
            'paginationTools', 'table_label'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * @param CategoryRequest $request
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CategoryRequest $request)
    {
        $this->categoryExist($request->input('en_name'));
        try
        {
            $category = ProductCategory::create($request->all());
            success_flash_message( trans('auth.success'), $request->input('fr_name') . ' ajouté(e) avec succèss');
            return redirect(route('admin.categories.show', [$category]));
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    /**
     * @param Request $request
     * @param ProductCategory $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, ProductCategory $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * @param Request $request
     * @param ProductCategory $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, ProductCategory $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * @param CategoryRequest $request
     * @param ProductCategory $category
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CategoryRequest $request, ProductCategory $category)
    {
        $this->categoryExist($request->input('en_name'), $category->id);
        try
        {
            $category->update($request->all());
            success_flash_message(trans('auth.success'), $category->format_name . ' à été mis(e) à jour avec succèss');
            return redirect(route('admin.categories.show', [$category]));
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    /**
     * @param Request $request
     * @param ProductCategory $category
     * @return Router
     */
    public function destroy(Request $request, ProductCategory $category)
    {
        try
        {
            if(!$category->products->isEmpty())
                danger_flash_message(trans('auth.error'), 'Impossible de supprimer cette catégorie car un ou plusieurs produits en dépendent');
            else
            {
                $category->delete();
                info_flash_message(trans('auth.info'), $category->format_name . ' supprimé(e) avec succèss', font('info-circle'));
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
     * @param int $category_id
     */
    private function categoryExist($name, $category_id = 0)
    {
        if(ProductCategory::where('slug', str_slug($name))->where('id', '<>', $category_id)->count() > 0)
        {
            throw ValidationException::withMessages([
                'en_name' => 'Une catégorie exite deja avec ce nom. Choisissez un autre nom pour l\'anglais',
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
        return redirect(route('admin.categories.index'));
    }
}
