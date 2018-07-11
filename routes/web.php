<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/coming', function () {
    return view('coming');
});
Route::post('/coming', function (\Illuminate\Http\Request $request) {
    if(config('app.coming') === $request->input('code'))
    {
        session(['coming.soon' => 'ok']);
        return redirect('/');
    }
    else
    {
        flash_message(
            'Erreur', 'Le code est incorrect, vous ne pouvez pas avoir un avant goût, veillez nous contacter au ' . config('company.phone_1') . ' pour plus d\'infos.',
            font('remove'), 'danger', 'bounceIn', 'bounceOut'
        );
    }
    return redirect('/coming');
});

Route::group(['namespace' => 'App', 'middleware' => 'coming.soon'], function() {
    //--Client routes...
    Route::get('/terms', function () { return redirect(locale_route('terms')); });
    Route::get('/policy', function () { return redirect(locale_route('policy')); });
    Route::get('/about', function () { return redirect(locale_route('about')); });
    Route::get('/services', function () { return redirect(locale_route('services')); });
    Route::get('/contact', function () { return redirect(locale_route('contact')); });
    Route::get('/products', function () { return redirect(locale_route('products.index')); });
    Route::get('/products/show/{product}', function (\App\Models\Product $product) { return redirect(locale_route('products.show', [$product])); });
    Route::get('/cart', function () { return redirect(locale_route('cart.index')); });
    Route::get('/checkout', function () { return redirect(locale_route('checkout.index')); });
    Route::get('/wishlist', function () { return redirect(locale_route('wishlist.index')); });
    Route::get('/orders', function () { return redirect(locale_route('orders.index')); });
    Route::get('/orders/show/{order}', function (\App\Models\Order $order) { return redirect(locale_route('orders.show', [$order])); });
    Route::get('/cart/products', 'CartController@ajaxProducts');

    //--Localized client routes...
    Route::get('/{language?}', 'HomeController')->name('home');
    Route::get('/{language}/terms', 'TermsController')->name('terms');
    Route::get('/{language}/policy', 'PolicyController')->name('policy');
    Route::get('/{language}/about', 'AboutController')->name('about');
    Route::get('/{language}/services', 'ServicesController')->name('services');
    Route::get('/{language}/contact', 'ContactController@index')->name('contact');
    Route::get('/{language}/products', 'ProductController@index')->name('products.index');
    Route::get('/{language}/products/show/{product}', 'ProductController@show')->name('products.show');
    Route::get('/{language}/cart', 'CartController@index')->name('cart.index');
    Route::get('/{language}/checkout', 'CheckoutController@index')->name('checkout.index');
    Route::get('/{language}/wishlist', 'WishListController@index')->name('wishlist.index');
    Route::get('/{language}/orders', 'OrderController@index')->name('orders.index');
    Route::get('/{language}/orders/show/{order}', 'OrderController@show')->name('orders.show');

    Route::post('/{language}/checkout', 'CheckoutController@order');
    Route::post('/{language}/checkout/update', 'CheckoutController@update')->name('checkout.update');
    Route::post('/{language}/cart/coupon', 'CartController@applyCoupon')->name('coupon');
    Route::post('/{language}/cart/update/{product}', 'CartController@update')->name('cart.update');
    Route::post('/{language}/search', 'SearchController')->name('search');
    Route::post('/{language}/products/{product}', 'ProductController@review');
    Route::post('/{language}/contact', 'ContactController@send');
    Route::post('/{language}/wishlist/product/add', 'WishListController@ajaxAddProduct')->name('wishlist.ajax.add.product');
    Route::post('/{language}/wishlist/product/remove', 'WishListController@ajaxRemoveProduct')->name('wishlist.ajax.remove.product');
    Route::post('/{language}/cart/product/add', 'CartController@ajaxAddProduct')->name('cart.ajax.add.product');
    Route::post('/{language}/cart/product/remove', 'CartController@ajaxRemoveProduct')->name('cart.ajax.remove.product');
    Route::post('/{language}/cart/products/remove', 'CartController@ajaxRemoveProducts')->name('cart.ajax.remove.products');

    Route::put('/{language}/wishlist/product/add/{product}', 'WishListController@addProduct')->name('wishlist.add.product');
    Route::put('/{language}/cart/product/add/{product}', 'CartController@addProduct')->name('cart.add.product');
    Route::put('/{language}/order/order/{order}', 'OrderController@order')->name('order.order');

    Route::delete('/{language}/wishlist/product/remove/{product}', 'WishListController@removeProduct')->name('wishlist.remove.product');
    Route::delete('/{language}/cart/product/remove/{product}', 'CartController@removeProduct')->name('cart.remove.product');
    Route::delete('/{language}/cart/products/remove', 'CartController@removeProducts')->name('cart.remove.products');
    Route::delete('/{language}/order/cancel/{order}', 'OrderController@cancel')->name('order.cancel');

    //--Localized auth routes...
    Route::group(['namespace' => 'Auth'], function() {
        //--Login nad register routes...
        Route::get('/login', function () { return redirect(locale_route('login')); });
        Route::get('/register', function () { return redirect(locale_route('register')); });

        //--Account routes...
        Route::get('/account/validation/{email}/{token}', function ($email, $token) { return redirect(locale_route('account.validation', compact('email', 'token'))); });
        Route::get('/account', function () { return redirect(locale_route('account.index')); });
        Route::get('/account/email', function () { return redirect(locale_route('account.email')); });

        //--Password reset routes...
        Route::get('/password/reset', function () { return redirect(locale_route('password.request')); });
        Route::get('/password/reset/{token}', function ($token) { return redirect(locale_route('password.reset', [$token])); });

        //--Localized login routes...
        Route::get('/{language}/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/{language}/login', 'LoginController@login');
        Route::post('/{language}/logout', 'LoginController@logout')->name('logout');

        //--Localized registration routes...
        Route::get('/{language}/register', 'RegisterController@showRegistrationForm')->name('register');
        Route::post('/{language}/register', 'RegisterController@register');

        //--Localized account routes...
        Route::get('/{language}/account/validation/{email}/{token}', 'AccountController@validation')->name('account.validation');
        Route::get('/{language}/account', 'AccountController@index')->name('account.index');
        Route::get('/{language}/account/email', 'AccountController@email')->name('account.email');
        Route::get('/{language}/account/password', 'AccountController@password')->name('account.password');
        Route::post('/{language}/account/password', 'AccountController@changePassword');
        Route::post('/{language}/account', 'AccountController@update');
        Route::post('/{language}/account/email', 'AccountController@sendLink');

        //--Localized password reset routes...
        Route::get('/{language}/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/{language}/password/reset', 'ForgotPasswordController@sendResetLinkEmail');
        Route::get('/{language}/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/{language}/password/reset/{token}', 'ResetPasswordController@reset');
    });
});