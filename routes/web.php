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
    Route::get('/{language}/products', 'ProductsController@index')->name('products.index');
    Route::get('/{language}/products/show/{product}', 'ProductsController@show')->name('products.show');
    Route::get('/{language}/cart', 'CartController@index')->name('cart.index');
    Route::get('/{language}/checkout', 'CheckoutController@index')->name('checkout.index');
    Route::get('/{language}/wishlist', 'WishListController@index')->name('wishlist.index');
    Route::get('/{language}/orders', 'OrdersController@index')->name('orders.index');
    Route::get('/{language}/orders/show/{order}', 'OrdersController@show')->name('orders.show');

    Route::post('/{language}/checkout', 'CheckoutController@order');
    Route::post('/{language}/checkout/update', 'CheckoutController@update')->name('checkout.update');
    Route::post('/{language}/cart/coupon', 'CartController@applyCoupon')->name('coupon');
    Route::post('/{language}/cart/update/{product}', 'CartController@update')->name('cart.update');
    Route::post('/{language}/products/show/{product}', 'ProductsController@review');
    Route::post('/{language}/contact', 'ContactController@send');
    Route::post('/{language}/wishlist/product/add', 'WishListController@ajaxAddProduct')->name('wishlist.ajax.add.product');
    Route::post('/{language}/wishlist/product/remove', 'WishListController@ajaxRemoveProduct')->name('wishlist.ajax.remove.product');
    Route::post('/{language}/cart/product/add', 'CartController@ajaxAddProduct')->name('cart.ajax.add.product');
    Route::post('/{language}/cart/product/remove', 'CartController@ajaxRemoveProduct')->name('cart.ajax.remove.product');
    Route::post('/{language}/cart/products/remove', 'CartController@ajaxRemoveProducts')->name('cart.ajax.remove.products');

    Route::put('/{language}/wishlist/product/add/{product}', 'WishListController@addProduct')->name('wishlist.add.product');
    Route::put('/{language}/cart/product/add/{product}', 'CartController@addProduct')->name('cart.add.product');
    Route::put('/{language}/order/order/{order}', 'OrdersController@order')->name('order.order');

    Route::delete('/{language}/wishlist/product/remove/{product}', 'WishListController@removeProduct')->name('wishlist.remove.product');
    Route::delete('/{language}/cart/product/remove/{product}', 'CartController@removeProduct')->name('cart.remove.product');
    Route::delete('/{language}/cart/products/remove', 'CartController@removeProducts')->name('cart.remove.products');
    Route::delete('/{language}/order/cancel/{order}', 'OrdersController@cancel')->name('order.cancel');

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


Route::prefix('admin')->group(function() {
    Route::group(['namespace' => 'Admin', 'middleware' => 'coming.soon'], function() {
        //--Admin routes...
        Route::get('/', function () { return redirect(route('admin.dashboard')); });
        Route::get('/dashboard', 'DashboardController')->name('admin.dashboard');
        Route::get('/profile', 'ProfileController@index')->name('admin.profile.index');
        Route::get('/profile/edit', 'ProfileController@edit')->name('admin.profile.edit');
        Route::post('/profile/update', 'ProfileController@update')->name('admin.profile.update');
        Route::post('/orders/progress/{order}', 'OrdersController@progress')->name('admin.orders.progress');
        Route::post('/orders/sold/{order}', 'OrdersController@sold')->name('admin.orders.sold');
        Route::post('/settings/apply/{setting}', 'SettingsController@apply')->name('admin.settings.apply');
        Route::resource('/settings', 'SettingsController', ['names' => [
            'index' => 'admin.settings.index', 'create' => 'admin.settings.create',
            'store' => 'admin.settings.store', 'show' => 'admin.settings.show',
            'edit' => 'admin.settings.edit', 'update' => 'admin.settings.update',
            'destroy' => 'admin.settings.destroy'
        ]]);
        Route::post('/users/disable/{user}', 'UsersController@disable')->name('admin.users.disable');
        Route::put('/users/enable/{user}', 'UsersController@enable')->name('admin.users.enable');
        Route::post('/users/down/{user}', 'UsersController@down')->name('admin.users.down');
        Route::put('/users/up/{user}', 'UsersController@up')->name('admin.users.up');
        Route::resource('/users', 'UsersController', ['names' => [
            'index' => 'admin.users.index', 'create' => 'admin.users.create',
            'store' => 'admin.users.store', 'show' => 'admin.users.show',
            'destroy' => 'admin.users.destroy'
        ]])->except(['update', 'edit']);
        Route::resource('/orders', 'OrdersController', ['names' => [
            'index' => 'admin.orders.index',
            'show' => 'admin.orders.show'
        ]])->only(['index', 'show']);
        Route::resource('/products', 'ProductsController', ['names' => [
            'index' => 'admin.products.index', 'create' => 'admin.products.create',
            'store' => 'admin.products.store', 'show' => 'admin.products.show',
            'edit' => 'admin.products.edit', 'update' => 'admin.products.update',
            'destroy' => 'admin.products.destroy'
        ]]);
        Route::resource('/categories', 'CategoriesController', ['names' => [
            'index' => 'admin.categories.index', 'create' => 'admin.categories.create',
            'store' => 'admin.categories.store', 'show' => 'admin.categories.show',
            'edit' => 'admin.categories.edit', 'update' => 'admin.categories.update',
            'destroy' => 'admin.categories.destroy'
        ]]);
        Route::resource('/tags', 'TagsController', ['names' => [
            'index' => 'admin.tags.index', 'create' => 'admin.tags.create',
            'store' => 'admin.tags.store', 'show' => 'admin.tags.show',
            'edit' => 'admin.tags.edit', 'update' => 'admin.tags.update',
            'destroy' => 'admin.tags.destroy'
        ]]);
        Route::resource('/coupons', 'CouponsController', ['names' => [
            'index' => 'admin.coupons.index', 'create' => 'admin.coupons.create',
            'store' => 'admin.coupons.store', 'show' => 'admin.coupons.show',
            'edit' => 'admin.coupons.edit', 'update' => 'admin.coupons.update',
            'destroy' => 'admin.coupons.destroy'
        ]]);
        Route::resource('/teams', 'TeamController', ['names' => [
            'index' => 'admin.teams.index', 'create' => 'admin.teams.create',
            'store' => 'admin.teams.store', 'show' => 'admin.teams.show',
            'edit' => 'admin.teams.edit', 'update' => 'admin.teams.update',
            'destroy' => 'admin.teams.destroy'
        ]]);
        Route::resource('/testimonials', 'TestimonialsController', ['names' => [
            'index' => 'admin.testimonials.index', 'create' => 'admin.testimonials.create',
            'store' => 'admin.testimonials.store', 'show' => 'admin.testimonials.show',
            'edit' => 'admin.testimonials.edit', 'update' => 'admin.testimonials.update',
            'destroy' => 'admin.testimonials.destroy'
        ]]);
        Route::post('/customers/disable/{user}', 'CustomersController@disable')->name('admin.customers.disable');
        Route::put('/customers/enable/{user}', 'CustomersController@enable')->name('admin.customers.enable');
        Route::resource('/customers', 'CustomersController', ['names' => [
            'index' => 'admin.customers.index', 'create' => 'admin.customers.create',
            'store' => 'admin.customers.store', 'show' => 'admin.customers.show'
        ]])->parameters(['customers' => 'user'])->except(['edit', 'update', 'destroy']);
        Route::resource('/contacts', 'ContactsController', ['names' => [
            'index' => 'admin.contacts.index', 'show' => 'admin.contacts.show',
            'destroy' => 'admin.contacts.destroy'
        ]])->only(['index', 'show', 'destroy']);

        //--Auth routes...
        Route::group(['namespace' => 'Auth'], function() {
            //--Admin login routes...
            Route::get('/login', 'LoginController@showLoginForm')->name('admin.login');
            Route::post('/login', 'LoginController@login');
            Route::post('/logout', 'LoginController@logout')->name('admin.logout');

            //--Admin password reset routes...
            Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
            Route::post('/password/reset', 'ForgotPasswordController@sendResetLinkEmail');
        });
    });
});