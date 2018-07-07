<?php

namespace App\Http\Controllers\App;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Traits\ErrorFlashMessagesTrait;
use App\Traits\CartAndWishlistToggleTrait;
use App\Http\Controllers\App\Auth\AccountController;

class WishListController extends Controller
{
    use ErrorFlashMessagesTrait, CartAndWishlistToggleTrait;

    /**
     * AccountController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('ajax')->only('ajaxWishListAdd',
            'ajaxWishListRemove');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $wished_products = Auth::user()->wished_products;
        return view('wishlist', compact('wished_products'));
    }

    /**
     * @param Request $request
     * @param $language
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function removeProduct(Request $request, $language, Product $product)
    {
        return $this->flashSessionResponse($this->cartAndWishlistManage(
            $product->id, AccountController::REMOVE_PRODUCT_FROM_WISH_LIST));
    }

    /**
     * @param Request $request
     * @param $language
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addProduct(Request $request, $language, Product $product)
    {
        return $this->flashSessionResponse($this->cartAndWishlistManage(
            $product->id, AccountController::ADD_PRODUCT_TO_WISH_LIST));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxAddProduct(Request $request)
    {
        return $this->jsonResponse($this->cartAndWishlistManage(
            $request->input('product_id'), AccountController::ADD_PRODUCT_TO_WISH_LIST));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxRemoveProduct(Request $request)
    {
        return $this->jsonResponse($this->cartAndWishlistManage(
            $request->input('product_id'), AccountController::REMOVE_PRODUCT_FROM_WISH_LIST));
    }
}
