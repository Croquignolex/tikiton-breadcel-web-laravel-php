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
            if(Route::is($route))
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

if(!function_exists('blog_pages'))
{
    /**
     * @return \Illuminate\Support\Collection
     */
    function blog_pages()
    {
        return collect(['blog.index']);
    }
}

if(!function_exists('product1_pages'))
{
    /**
     * @return \Illuminate\Support\Collection
     */
    function product1_pages()
    {
        return collect([
            'products.index'
        ]);
    }
}

if(!function_exists('product2_pages'))
{
    /**
     * @return \Illuminate\Support\Collection
     */
    function product2_pages()
    {
        return collect([
            'products.index'
        ]);
    }
}

if(!function_exists('service1_pages'))
{
    /**
     * @return \Illuminate\Support\Collection
     */
    function service1_pages()
    {
        return collect([
            'services.index'
        ]);
    }
}

if(!function_exists('service2_pages'))
{
    /**
     * @return \Illuminate\Support\Collection
     */
    function service2_pages()
    {
        return collect([
            'services.index'
        ]);
    }
}

if(!function_exists('services_pages'))
{
    /**
     * @return \Illuminate\Support\Collection
     */
    function services_pages()
    {
        return (new \Illuminate\Support\Collection())
            ->merge(service1_pages())
            ->merge(service2_pages());
    }
}

if(!function_exists('products_pages'))
{
    /**
     * @return \Illuminate\Support\Collection
     */
    function products_pages()
    {

        return (new \Illuminate\Support\Collection())
            ->merge(product1_pages())
            ->merge(product2_pages());
    }
}