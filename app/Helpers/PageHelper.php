<?php

if(!function_exists('page_title'))
{
    /**
     * @param $page
     * @return \Illuminate\Config\Repository|mixed|string
     */
    function page_title($page)
    {
        $base_name = config('app.name');
        return $page == '' ? $base_name : $page . ' - ' .  $base_name;
    }
}

if(!function_exists('active_page'))
{
    /**lightSpeedOut
     * @param \Illuminate\Support\Collection $routes
     * @param string $type
     * @return string
     */
    function active_page(\Illuminate\Support\Collection $routes, $type = '')
    {
        foreach ($routes as $route)
        {
            if(Illuminate\Support\Facades\Route::is($route))
            {
                return $type == 'expend'
                    ? 'show' : 'active';
            }
        }

        return '';
    }
}

if(!function_exists('home_pages'))
{
    /**
     * @return \Illuminate\Support\Collection
     */
    function home_pages()
    {
        return collect(['home']);
    }
}

if(!function_exists('about_pages'))
{
    /**
     * @return \Illuminate\Support\Collection
     */
    function about_pages()
    {
        return collect(['about']);
    }
}

if(!function_exists('contact_pages'))
{
    /**
     * @return \Illuminate\Support\Collection
     */
    function contact_pages()
    {
        return collect(['contact']);
    }
}

if(!function_exists('services_pages'))
{
    /**
     * @return \Illuminate\Support\Collection
     */
    function services_pages()
    {
        return collect(['services']);
    }
}

if(!function_exists('products_pages'))
{
    /**
     * @return \Illuminate\Support\Collection
     */
    function products_pages()
    {
        return collect(['products.index', 'products.show']);
    }
}

if(!function_exists('admin_dashboard_pages'))
{
    /**
     * @return \Illuminate\Support\Collection
     */
    function admin_dashboard_pages()
    {
        return collect(['admin.dashboard']);
    }
}

if(!function_exists('admin_orders_pages'))
{
    /**
     * @return \Illuminate\Support\Collection
     */
    function admin_orders_pages()
    {
        return collect(['admin.orders.index', 'admin.orders.show']);
    }
}

if(!function_exists('admin_products_pages'))
{
    /**
     * @return \Illuminate\Support\Collection
     */
    function admin_products_pages()
    {
        return collect(['admin.products.index', 'admin.products.show',
            'admin.products.edit', 'admin.products.create']);
    }
}

if(!function_exists('admin_categories_pages'))
{
    /**
     * @return \Illuminate\Support\Collection
     */
    function admin_categories_pages()
    {
        return collect(['admin.categories.index', 'admin.categories.show',
            'admin.categories.edit', 'admin.categories.create']);
    }
}

if(!function_exists('admin_tags_pages'))
{
    /**
     * @return \Illuminate\Support\Collection
     */
    function admin_tags_pages()
    {
        return collect(['admin.tags.index', 'admin.tags.show',
            'admin.tags.edit', 'admin.tags.create']);
    }
}