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
use Illuminate\Database\Eloquent\Collection;

class ProductController extends Controller
{
    use PaginationTrait, ErrorFlashMessagesTrait;

    /**
     * RegisterController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->only('review');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $products = null; $categories = null; $tags = null;
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

        $filter = [
            'tag' => $request->query('tag'),
            'category' => $request->query('category'),
            'sort_by' => $this->filter_sort_by($request->query('sort_by')),
            'min_price' => $this->filter_min_max_price($request->query('min_max_price')),
            'max_price' => $this->filter_min_max_price($request->query('min_max_price'), 'max'),
            'products_per_page' => $this->filter_item_per_page($request->query('products_per_page'))
        ];

        if($filter['min_price'] > $filter['max_price']) $filter['max_price'] = 500;

        $this->paginate($request, $this->filter_products($products, $filter),
            $filter['products_per_page'], 3);
        $paginationTools = $this->paginationTools;

        return view('products.index', compact(
            'paginationTools', 'categories', 'tags', 'filter'
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
            Auth::user()->reviewed_products()->save($product, [
                'text' => $request->input('review'),
                'ranking' =>  $request->input('ranking') * 2]);

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

    /**
     * @param $filter
     * @return mixed
     */
    private function filter_item_per_page($filter)
    {
        $product_per_page_range = ['3', '9', '15', '21'];

        if(in_array($filter, $product_per_page_range)) return $filter;
        return $product_per_page_range[1];
    }

    /**
     * @param $filter
     * @return mixed
     */
    private function filter_sort_by($filter)
    {
        $sort_by_range = [
            Product::SORT_BY_PRICE_ASC, Product::SORT_BY_NAME_DESC,
            Product::SORT_BY_NAME_ASC, Product::SORT_BY_RANKING_DESC,
            Product::SORT_BY_RANKING_ASC, Product::SORT_BY_PRICE_DESC
        ];

        if(in_array($filter, $sort_by_range)) return $filter;
        return $sort_by_range[0];
    }

    private function filter_min_max_price($filter, $type = 'min')
    {
        $min_max_range = ['min' => 0, 'max' => 500];
        $valueTab = explode('-', $filter);

        if(count($valueTab) >= 2) $value = $type === 'min' ? $valueTab[0] : $valueTab[1];
        elseif(count($valueTab) === 1) $value = $type === 'min' ? $valueTab[0] : $min_max_range[$type];
        else $value = $min_max_range[$type];

        $value = intval($value);

        if($filter >= $min_max_range['min'] && $filter <= $min_max_range['max'])
            return $value;

        return $min_max_range[$type];
    }

    private function filter_products(Collection $products, array $filter)
    {
        $filterProducts = $products;
        //Start sort By filter
        if($filter['sort_by'] === Product::SORT_BY_PRICE_ASC)
            $filterProducts = $filterProducts->sortBy('price');
        elseif($filter['sort_by'] === Product::SORT_BY_RANKING_ASC)
            $filterProducts = $filterProducts->sortBy('ranking');
        elseif($filter['sort_by'] === Product::SORT_BY_NAME_ASC)
            $filterProducts = $filterProducts->sortBy('format_name');
        elseif($filter['sort_by'] === Product::SORT_BY_PRICE_DESC)
            $filterProducts = $filterProducts->sortByDesc('price');
        elseif($filter['sort_by'] === Product::SORT_BY_RANKING_DESC)
            $filterProducts = $filterProducts->sortByDesc('ranking');
        elseif($filter['sort_by'] === Product::SORT_BY_NAME_DESC)
            $filterProducts = $filterProducts->sortByDesc('format_name');
        //End sort By filter
        //Start tag filter
        $tag = Tag::where('slug', $filter['tag'])->first();
        if(!is_null($tag))
        {
            $filterProducts = $filterProducts->filter(function ($value) use ($filter, $tag) {
                foreach ($value->product_tags as $current_product_tag)
                {
                    if($current_product_tag->tag_id === $tag->id)
                    {
                        return true;
                    }
                }
                return false;
            });
        }
        //End tag filter
        //Start category filter
        $product_category = ProductCategory::where('slug', $filter['category'])->first();
        if(!is_null($product_category))
        {
            $filterProducts = $filterProducts->where('category_id', $product_category->id);
        }
        //End category filter
        //Start price filter
        $filterProducts = $filterProducts
            ->where('price', '>=', $filter['min_price'])
            ->where('price', '<=', $filter['max_price']);
        //End price filter
        return $filterProducts;
    }
}