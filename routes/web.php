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

//--Home routes...
Route::get('/terms', 'HomeController@terms');
Route::get('/policy', 'HomeController@policy');
Route::get('/about', 'HomeController@about');
//--Localized home routes...
Route::get('/{language?}', 'HomeController@index')->name('home.index');
Route::get('/{language}/terms', 'HomeController@terms')->name('home.terms');
Route::get('/{language}/policy', 'HomeController@policy')->name('home.policy');
Route::get('/{language}/about', 'HomeController@about')->name('home.about');

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