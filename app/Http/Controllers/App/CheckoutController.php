<?php

namespace App\Http\Controllers\App;

use Exception;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Traits\ErrorFlashMessagesTrait;
use App\Http\Requests\CheckoutUpdateRequest;

class CheckoutController extends Controller
{
    use ErrorFlashMessagesTrait;

    /**
     * CheckoutController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $carted_products = $user->carted_products;
        return view('checkout', compact('carted_products', 'user'));
    }

    /**
     * @param CheckoutUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CheckoutUpdateRequest $request)
    {
        try
        {
            Auth::User()->update($request->all());
            flash_message(
                trans('auth.success'), trans('general.info_updated')
            );
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }
        return $this->redirectTo();
    }

    public function order()
    {
        return $this->redirectTo();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    private function redirectTo()
    {
        return redirect(locale_route('checkout.index'));
    }
}
