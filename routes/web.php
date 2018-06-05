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
    Route::get('/terms', 'TermController');
    Route::get('/policy', 'PolicyController');
    Route::get('/about', 'AboutController');
    Route::get('/blog', 'BlogController@index');
    Route::get('/services', 'ServiceController@index');
    Route::resource('/contact', 'ContactController', ['only' => ['index', 'store']]);
    Route::resource('/products', 'ProductController');
    Route::resource('/carts', 'CartController@index', ['only' => ['index']]);
    Route::resource('/checkout', 'CheckoutController@index', ['only' => ['index']]);
    Route::post('/search', 'SearchController');

    //--Localized client routes...
    Route::get('/{language?}', 'HomeController')->name('home');
    Route::get('/{language?}/terms', 'TermController')->name('terms');
    Route::get('/{language?}/policy', 'PolicyController')->name('policy');
    Route::get('/{language?}/about', 'AboutController')->name('about');
    Route::get('/{language?}/blog', 'BlogController@index')->name('blog.index');
    Route::get('/{language?}/services', 'ServiceController@index')->name('services.index');
    Route::resource('/{language?}/contact', 'ContactController', ['only' => ['index', 'store']]);
    Route::resource('/{language?}/products', 'ProductController');
    Route::resource('/{language}/cart', 'CartController@index', ['only' => ['index']]);
    Route::resource('/{language}/checkout', 'CheckoutController@index', ['only' => ['index']]);
    Route::post('/{language}/search', 'SearchController')->name('search');

    //--Localized auth routes...
    Route::group(['namespace' => 'Auth'], function() {
        //--Login routes...
        Route::get('/login', 'LoginController@showLoginForm');
        Route::post('/logout', 'LoginController@logout');
        Route::post('/login', 'LoginController@login');

        //--Registration routes...
        Route::get('/register', 'RegisterController@showRegistrationForm');
        Route::post('/register', 'RegisterController@register');

        //--Account routes...
        Route::get('/account/validation/{email}/{token}/', 'AccountController@validation_unnamed');
        Route::get('/account', 'AccountController@index');
        Route::get('/account/wishlist', 'AccountController@wishlist');

        //--Password reset routes...
        Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm');
        Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm_unnamed');
        Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail');
        Route::post('/password/reset/{token}', 'ResetPasswordController@reset_unnamed');

        //--Localized login routes...
        Route::get('/{language}/login', 'LoginController@showLoginForm')->name('login.show');
        Route::post('/{language}/logout', 'LoginController@logout')->name('login.logout');
        Route::post('/{language}/login', 'LoginController@login');

        //--Localized registration routes...
        Route::get('/{language}/register', 'RegisterController@showRegistrationForm')->name('register.show');
        Route::post('/{language}/register', 'RegisterController@register');

        //--Localized account routes...
        Route::get('/{language}/account/validation/{email}/{token}/', 'AccountController@validation')->name('account.validation');
        Route::get('/{language}/account', 'AccountController@index')->name('account.index');
        Route::get('/{language}/account/wishlist', 'AccountController@wishlist')->name('account.wish_list');

        //--Localized password reset routes...
        Route::get('/{language}/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('forgot.password.show');
        Route::get('/{language}/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('reset.password.show');
        Route::post('/{language}/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('forgot.password.email');
        Route::post('/{language}/password/reset/{token}', 'ResetPasswordController@reset')->name('reset.password');
    });
});