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

Route::group(['namespace' => 'App'], function() {
    //--Client routes...
    Route::get('/terms', function () { return redirect(locale_route('terms')); });
    Route::get('/policy', function () { return redirect(locale_route('policy')); });
    Route::get('/about', function () { return redirect(locale_route('about')); });
    Route::get('/services', function () { return redirect(locale_route('services')); });
    Route::get('/contact', function () { return redirect(locale_route('contact')); });
    Route::get('/products', function () { return redirect(locale_route('products.index')); });
    Route::get('/products/{product}', function ($product) { return redirect(locale_route('products.show', [$product])); });
    Route::get('/cart', function () { return redirect(locale_route('cart')); });
    Route::get('/checkout', function () { return redirect(locale_route('checkout')); });
    Route::get('/cart/products', 'CartController@ajaxProducts');

    //--Localized client routes...
    Route::get('/{language?}', 'HomeController')->name('home');
    Route::get('/{language}/terms', 'TermsController')->name('terms');
    Route::get('/{language}/policy', 'PolicyController')->name('policy');
    Route::get('/{language}/about', 'AboutController')->name('about');
    Route::get('/{language}/services', 'ServicesController')->name('services');
    Route::get('/{language}/contact', 'ContactController@index')->name('contact');
    Route::post('/{language}/contact', 'ContactController@send');
    Route::get('/{language}/products', 'ProductController@index')->name('products.index');
    Route::get('/{language}/products/{product}', 'ProductController@show')->name('products.show');
    Route::post('/{language}/products/{product}', 'ProductController@review');
    Route::get('/{language}/cart', 'CartController@index')->name('cart');
    Route::get('/{language}/checkout', 'CheckoutController@index')->name('checkout');
    Route::post('/{language}/search', 'SearchController')->name('search');

    //--Localized auth routes...
    Route::group(['namespace' => 'Auth'], function() {
        //--Login nad register routes...
        Route::get('/login', function () { return redirect(locale_route('login')); });
        Route::get('/register', function () { return redirect(locale_route('register')); });

        //--Account routes...
        Route::get('/account/validation/{email}/{token}', function ($email, $token) { return redirect(locale_route('account.validation', compact('email', 'token'))); });
        Route::get('/account', function () { return redirect(locale_route('account.index')); });
        Route::get('/account/wishlist', function () { return redirect(locale_route('account.wishlist')); });

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
        Route::get('/{language}/account/wishlist', 'AccountController@wishlist')->name('account.wishlist');
        Route::put('/{language}/account/cart/add/{product}', 'AccountController@addProductToCart')->name('account.add.product.cart');
        Route::delete('/{language}/account/cart/remove/{product}', 'AccountController@removeProductFromCart')->name('account.remove.product.cart');
        Route::delete('/{language}/account/wishlist/remove/{product}', 'AccountController@removeProductFromWishlist')->name('account.remove.product.wishlist');
        Route::post('/{language}/account/wishlist/toggle', 'AccountController@ajaxWishlistToggle')->name('account.ajax.wishlist.toggle');
        Route::post('/{language}/account/cart/toggle', 'AccountController@ajaxCartToggle')->name('account.ajax.cart.toggle');
        Route::post('/account/cart/remove', 'AccountController@ajaxCartRemove');

        //--Localized password reset routes...
        Route::get('/{language}/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/{language}/password/reset', 'ForgotPasswordController@sendResetLinkEmail');
        Route::get('/{language}/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/{language}/password/reset/{token}', 'ResetPasswordController@reset');
    });
});