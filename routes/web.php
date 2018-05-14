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
    Route::get('/contact', 'ContactController');
    Route::get('/blog', 'BlogController@index');
    Route::get('/services', 'ServiceController@index');
    Route::resource('/products', 'ProductController');

    Route::get('/cart', 'CartController@index');
    Route::get('/checkout', 'CheckoutController@index');
    Route::post('/search', 'SearchController');

    //--Localized client routes...
    Route::get('/{language?}', 'HomeController')->name('home');
    Route::get('/{language?}/terms', 'TermController')->name('terms');
    Route::get('/{language?}/policy', 'PolicyController')->name('policy');
    Route::get('/{language?}/about', 'AboutController')->name('about');
    Route::get('/{language?}/contact', 'ContactController')->name('contact');
    Route::get('/{language?}/blog', 'BlogController@index')->name('blog.index');
    Route::get('/{language?}/services', 'ServiceController@index')->name('services.index');
    Route::resource('{language?}/products', 'ProductController');

    Route::get('/{language}/cart', 'CartController@index')->name('cart');
    Route::get('/{language}/checkout', 'CheckoutController@index')->name('checkout');
    Route::post('/{language}/search', 'SearchController')->name('search');
});

//--Auth routes...
Auth::routes();

//--Localized auth routes...
Route::group(['namespace' => 'Auth'], function() {

    //--Localized login routes...
    Route::get('/{language}/login', 'LoginController@showLoginForm')->name('login.show');
    Route::post('/{language}/logout', 'LoginController@logout')->name('login.logout');
    Route::post('/{language}/login', 'LoginController@login');

    //--Localized registration routes...
    Route::get('/{language}/register', 'RegisterController@showRegistrationForm')->name('register.show');
    Route::post('/{language}/register', 'RegisterController@register');

    //--Localized password reset routes...
    Route::get('/{language}/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('forgot.password.show');
    Route::get('/{language}/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('reset.password.show');
    Route::post('/{language}/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('forgot.password.email');
    Route::post('/{language}/password/reset/{token}', 'ResetPasswordController@reset');
});

//--App routes...
/*Route::group(['namespace' => 'App'], function() {
    //--Account routes...
    Route::get('/wallet/confirmed/{email}/{token}/', 'WalletController@confirmed');
    //--Localized wallet routes...
    Route::get('/{language}/wallet/confirmed/{email}/{token}/', 'WalletController@confirmed')->name('wallet.confirmed');
});*/