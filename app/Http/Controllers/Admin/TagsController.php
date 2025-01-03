<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Tag;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\PaginationTrait;
use App\Http\Requests\TagRequest;
use App\Http\Controllers\Controller;
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
        $filter = intval($request->query('type'));
        if($filter === Tag::HAS_PRODUCTS) $table_label = 'Etiquettes qui sont ratachées à des produits';
        elseif($filter === Tag::HAS_NO_PRODUCTS) $table_label = 'Etiquettes qui ne sont pas ratachées à des produits';
        elseif($filter === Tag::ALL) $table_label = 'Etiquettes (toutes)';
        else $table_label = 'Filtre inconnu';

        try
        {
            if($filter === Tag::ALL) $tags = Tag::all()->sortByDesc('updated_at');
            elseif($filter === Tag::HAS_PRODUCTS)
            {
                $tags = Tag::all()->filter(function (Tag $tag) {
                    return !$tag->products->isEmpty();
                })->sortByDesc('updated_at');
            }
            elseif($filter === Tag::HAS_NO_PRODUCTS)
            {
                $tags = Tag::all()->filter(function (Tag $tag) {
                    return $tag->products->isEmpty();
                })->sortByDesc('updated_at');
            }
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
     * @param TagRequest $request
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(TagRequest $request)
    {
        $this->tagExist($request->input('en_name'));
        $tagProductIds = $request->input('products');
        try
        {
            $tag = Tag::create($request->all());

            if(!is_null($tagProductIds))
            {
                foreach ($tagProductIds as $productId)
                    $tag->products()->save(Product::find(intval($productId)));
            }

            success_flash_message(trans('auth.success'), $request->input('fr_name') . ' ajouté(e) avec succèss');
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
     * @param Tag $tag
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, Tag $tag)
    {
        $tabTProductIds = [];
        foreach ($tag->products as $product) $tabTProductIds[] = $product->id;
        return view('admin.tags.edit', compact('tag', 'tabTProductIds'));
    }

    /**
     * @param TagRequest $request
     * @param Tag $tag
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(TagRequest $request, Tag $tag)
    {
        $this->tagExist($request->input('en_name'), $tag->id);
        $tagProductIds = $request->input('products');
        try
        {
            $tag->update($request->all());

            //Remove all products tags first
            foreach ($tag->product_tags as $product_tag)
                $product_tag->delete();
            //Add new product tags
            if(!is_null($tagProductIds))
            {
                foreach ($tagProductIds as $productId)
                    $tag->products()->save(Product::find(intval($productId)));
            }

            success_flash_message(trans('auth.success'), $tag->format_name . ' à été mis(e) à jour avec succèss');
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
                info_flash_message(trans('auth.info'), 'Impossible de supprimer cette étiquette car un ou plusieurs produits en dépendent');
            else
            {
                $tag->delete();
                info_flash_message(trans('auth.info'), $tag->format_name . ' supprimé(e) avec succèss', font('info-circle'));
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
