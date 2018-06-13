<?php

namespace App\Http\Controllers\App;

use Exception;
use App\Models\Tag;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\PaginationTrait;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Traits\ErrorFlashMessagesTrait;
use App\Http\Requests\ProductReviewRequest;

class ProductController extends Controller
{
    use PaginationTrait, ErrorFlashMessagesTrait;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $products = null;
        $categories = null;
        $tags = null;

        try
        {
            $products = Product::all();
            $categories = ProductCategory::all();
            $tags = Tag::all();
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        $this->parginate($request, $products, 9, 3);
        $paginationTools = $this->paginationTools;

        return view('products.index', compact(
            'paginationTools', 'categories', 'tags'
        ));
    }

    /**
     * @param Request $request
     * @param $language
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, $language, Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * @param ProductReviewRequest $request
     * @param $language
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function review(ProductReviewRequest $request, $language, Product $product)
    {
        try
        {
            Auth::user()->product_reviews()->create([
                'product_id' => $product->id,
                'text' => $request->review,
                'ranking' =>  $request->ranking * 2
            ]);

            flash_message(
                trans('auth.success'), trans('general.review_send'),
                font('check')
            );
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return redirect(locale_route('products.show', [$product]));
    }
}