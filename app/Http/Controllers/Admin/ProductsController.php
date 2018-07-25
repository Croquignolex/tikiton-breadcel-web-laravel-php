<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Tag;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\PaginationTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductRequest;
use App\Traits\ErrorFlashMessagesTrait;
use Illuminate\Validation\ValidationException;

class ProductsController extends Controller
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
        $image_name = 'default';
        $image_extension = 'jpg';
        $productTagIds = $request->input('tags');
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $allowed_extensions = collect(['jpg', 'JPG', 'jpeg', 'JPEG',
                'png', 'PNG', 'gif', 'GIF', 'svg', 'SVG']);
            if($allowed_extensions->contains($image->getClientOriginalExtension()))
            {
                try
                {
                    $image_name = md5($image->getClientOriginalName() . time());
                    $image_extension = $image->getClientOriginalExtension();
                    $image->move(public_path('img/products/'), $image_name . '.' . $image_extension);
                }
                catch (Exception $exception)
                {
                    $this->imageError($exception);
                }
            }
            else
            {
                flash_message(
                    trans('auth.error'), 'Erreur sur l\'extension de l\'image',
                    font('remove'), 'danger', 'bounceIn', 'bounceOut'
                );

                throw ValidationException::withMessages([
                    'image' => 'L\'extension ne correspond pas, l\'extension doit être dans cette liste (jpg, JPG, jpeg, JPEG, png, PNG, gif, GIF, svg, SVG)',
                ])->status(423);
            }
        }

        $this->productExist($request->input('en_name'));
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
                'image' => $image_name,
                'extension' => $image_extension,
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
        $flag = false;
        $image_name = ''; $image_extension = '';
        $productTagIds = $request->input('tags');
        $this->productExist($request->input('en_name'), $product->id);
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $allowed_extensions = collect(['jpg', 'JPG', 'jpeg', 'JPEG',
                'png', 'PNG', 'gif', 'GIF', 'svg', 'SVG']);
            if($allowed_extensions->contains($image->getClientOriginalExtension()))
            {
                try
                {
                    $image_name = md5($image->getClientOriginalName() . time());
                    $image_extension = $image->getClientOriginalExtension();
                    $image->move(public_path('img/products/'), $image_name . '.' . $image_extension);
                    $flag = true;
                    $this->deleteProductImage($product);
                }
                catch (Exception $exception)
                {
                    $this->imageError($exception);
                }
            }
            else
            {
                flash_message(
                    trans('auth.error'), 'Erreur sur l\'extension de l\'image',
                    font('remove'), 'danger', 'bounceIn', 'bounceOut'
                );

                throw ValidationException::withMessages([
                    'image' => 'L\'extension ne correspond pas, l\'extension doit être dans cette liste (jpg, JPG, jpeg, JPEG, png, PNG, gif, GIF, svg, SVG)',
                ])->status(423);
            }
        }

        try
        {
            if($flag)
            {
                $product->update([
                    'fr_name' => $request->input('fr_name'),
                    'en_name' => $request->input('en_name'),
                    'fr_description' => $request->input('fr_description'),
                    'en_description' => $request->input('en_description'),
                    'price' => $request->input('price'),
                    'discount' => $request->input('discount'),
                    'stock' => $request->input('stock'),
                    'image' => $image_name,
                    'extension' => $image_extension,
                    'product_category_id' => $request->input('category'),
                    'is_featured' => is_null($request->input('featured')) ? false : true,
                    'is_most_sold' => is_null($request->input('best_sale')) ? false : true,
                    'is_new' => is_null($request->input('new')) ? false : true
                ]);
            }
            else
            {
                $product->update([
                    'fr_name' => $request->input('fr_name'),
                    'en_name' => $request->input('en_name'),
                    'fr_description' => $request->input('fr_description'),
                    'en_description' => $request->input('en_description'),
                    'price' => $request->input('price'),
                    'discount' => $request->input('discount'),
                    'stock' => $request->input('stock'),
                    'product_category_id' => $request->input('category'),
                    'is_featured' => is_null($request->input('featured')) ? false : true,
                    'is_most_sold' => is_null($request->input('best_sale')) ? false : true,
                    'is_new' => is_null($request->input('new')) ? false : true
                ]);
            }

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
                $this->deleteProductImage($product);
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

    /**
     * @param Product $product
     */
    private function deleteProductImage(Product $product)
    {
        try
        {
            if($product->image !== 'default')
            {
                $file = public_path('img/products/') . $product->image . '.' . $product->extension;
                if(File::exists($file)) File::delete($file);
            }
        }
        catch (Exception $exception)
        {
            $this->imageError($exception);
        }
    }
}
