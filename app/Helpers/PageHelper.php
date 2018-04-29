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
        return $page === '' ? $base_name : __($page) . ' - ' .  $base_name;
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

if(!function_exists('dashboard_pages'))
{
    /**
     * @return \Illuminate\Support\Collection
     */
    function dashboard_pages()
    {
        return collect(['dashboard']);
    }
}

if(!function_exists('transactions_pages'))
{
    /**
     * @return \Illuminate\Support\Collection
     */
    function transactions_pages()
    {
        return collect([
            'transactions.index', 'transactions.create',
            'transactions.edit'
        ]);
    }
}

if(!function_exists('accounts_pages'))
{
    /**
     * @return \Illuminate\Support\Collection
     */
    function accounts_pages()
    {
        return collect([
            'accounts.index', 'accounts.create',
            'accounts.edit'
        ]);
    }
}

if(!function_exists('groups_pages'))
{
    /**
     * @return \Illuminate\Support\Collection
     */
    function groups_pages()
    {
        return collect([
            'groups.index', 'groups.create', 'groups.edit',
            'groups.categories.index', 'groups.categories.create',
            'groups.categories.edit'
        ]);
    }
}

if(!function_exists('profile_pages'))
{
    /**
     * @return \Illuminate\Support\Collection
     */
    function profile_pages()
    {
        return collect([
            'profile.edit', 'profile.edit.email',
            'profile.edit.password'
        ]);
    }
}

if(!function_exists('currencies_pages'))
{
    /**
     * @return \Illuminate\Support\Collection
     */
    function currencies_pages()
    {
        return collect([
            'currencies.index', 'currencies.create',
            'currencies.edit'
        ]);
    }
}

if(!function_exists('configurations_pages'))
{
    /**
     * @return \Illuminate\Support\Collection
     */
    function configurations_pages()
    {

        return (new \Illuminate\Support\Collection())
            ->merge(groups_pages())
            ->merge(profile_pages())
            ->merge(currencies_pages());
    }
}