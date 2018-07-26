<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Tag;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\PaginationTrait;
use App\Traits\ImageManageTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Traits\ErrorFlashMessagesTrait;
use Illuminate\Validation\ValidationException;

class ProductsController extends Controller
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
        $products = null;
        $filter = intval($request->query('type'));
        if($filter === Product::IS_BEST_SELLER) $table_label = 'Meilleurs vente de produits';
        elseif($filter === Product::IS_FEATURED) $table_label = 'Produits En vedettes';
        elseif($filter === Product::IS_NEW) $table_label = 'Nouveaux produits';
        elseif($filter === Product::IS_OUT_OF_STOCK) $table_label = 'Produits en rupture de stock';
        elseif($filter === Product::ALL) $table_label = 'Produits (tous)';
        else $table_label = 'Filtre inconnu';

        try
        {
            if($filter === Product::ALL) $products = Product::all()->sortByDesc('updated_at');
            elseif($filter === Product::IS_BEST_SELLER)
                $products = Product::where('is_most_sold', true)->get()->sortByDesc('updated_at');
            elseif($filter === Product::IS_FEATURED)
            {
                $products = Product::all()->filter(function (Product $product) {
                    return ($product->ranking === 10) || $product->is_featured;
                })->sortByDesc('updated_at');
            }
            elseif($filter === Product::IS_NEW)
                $products = Product::where('created_at', '>=', now()->addDay(-7))
                    ->orWhere('is_new', true)->get()->sortByDesc('updated_at');
            elseif($filter === Product::IS_OUT_OF_STOCK)
                $products = Product::where('stock', 0)->get()->sortByDesc('updated_at');
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        $this->paginate($request, $products, 10, 3);
        $paginationTools = $this->paginationTools;

        return view('admin.products.index', compact(
            'paginationTools', 'table_label'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * @param ProductRequest $request
     * @return Router
     */
    public function store(ProductRequest $request)
    {
        $productTagIds = $request->input('tags');
        $this->productExist($request->input('en_name'));
        $image = $this->storeImage($request, 'products');

        try
        {
            $product = Product::create([
                'fr_name' => $request->input('fr_name'),
                'en_name' => $request->input('en_name'),
                'fr_description' => $request->input('fr_description'),
                'en_description' => $request->input('en_description'),
                'price' => $request->input('price'),
                'discount' => $request->input('discount'),
                'stock' => $request->input('stock'),
                'image' => $image->name,
                'extension' => $image->extension,
                'product_category_id' => $request->input('category'),
                'is_featured' => is_null($request->input('featured')) ? false : true,
                'is_most_sold' => is_null($request->input('best_sale')) ? false : true,
            ]);

            if(!is_null($productTagIds))
            {
                foreach ($productTagIds as $tagId)
                    $product->tags()->save(Tag::find(intval($tagId)));
            }
            flash_message(
                trans('auth.success'), $request->input('fr_name') . ' ajouté(e) avec succèss',
                font('check')
            );

            return redirect(route('admin.products.show', [$product]));
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Product $product)
    {
        $tabTagIds = [];
        foreach ($product->tags as $tag) $tabTagIds[] = $tag->id;
        return view('admin.products.edit', compact('product', 'tabTagIds'));
    }

    /**
     * @param ProductRequest $request
     * @param Product $product
     * @return Router
     */
    public function update(ProductRequest $request, Product $product)
    {
        $productTagIds = $request->input('tags');
        $this->productExist($request->input('en_name'), $product->id);
        $image = $this->storeImage($request, 'products', $product);

        try
        {
            $product->update([
                'fr_name' => $request->input('fr_name'),
                'en_name' => $request->input('en_name'),
                'fr_description' => $request->input('fr_description'),
                'en_description' => $request->input('en_description'),
                'price' => $request->input('price'),
                'discount' => $request->input('discount'),
                'stock' => $request->input('stock'),
                'image' => $image->name,
                'extension' => $image->extension,
                'product_category_id' => $request->input('category'),
                'is_featured' => is_null($request->input('featured')) ? false : true,
                'is_most_sold' => is_null($request->input('best_sale')) ? false : true,
                'is_new' => is_null($request->input('new')) ? false : true
            ]);

            //Remove all products tags first
            foreach ($product->product_tags as $product_tag)
                $product_tag->delete();
             //Add new product tags
            if(!is_null($productTagIds))
            {
                foreach ($productTagIds as $tagId)
                    $product->tags()->save(Tag::find(intval($tagId)));
            }

            flash_message(
                trans('auth.success'), $product->format_name . ' à été mis(e) à jour avec succèss',
                font('check')
            );

            return redirect(route('admin.products.show', [$product]));
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return Router
     */
    public function destroy(Request $request, Product $product)
    {
        try
        {
            if(!$product->orders->isEmpty())
            {
                flash_message(
                    trans('auth.info'),
                    'Impossible de supprimer ce produit car il est present dans une ou plusieurs commandes',
                    font('info-circle'), 'info'
                );
            }
            else
            {
                $this->deleteImage($product, 'products');
                $product->delete();
                flash_message(
                    trans('auth.info'), $product->format_name . ' supprimé(e) avec succèss', font('info-circle'),
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
     * @param int $product_id
     */
    private function productExist($name, $product_id = 0)
    {
        if(Product::where('slug', str_slug($name))->where('id', '<>', $product_id)->count() > 0)
        {
            throw ValidationException::withMessages([
                'en_name' => 'Un produit exite deja avec ce nom. Choisissez un autre nom pour l\'anglais',
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
        return redirect(route('admin.products.index'));
    }
}
