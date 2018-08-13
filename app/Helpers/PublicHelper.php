<?php

if(!function_exists('css_asset'))
{
    /**
     * @param $css_file
     * @return string
     */
    function css_asset($css_file)
    {
        return '/assets/css/' . $css_file . '.css';
    }
}

if(!function_exists('css_admin_asset'))
{
    /**
     * @param $css_file
     * @return string
     */
    function css_admin_asset($css_file)
    {
        return '/assets/css/admin/' . $css_file . '.css';
    }
}

if(!function_exists('js_asset'))
{
    /**
     * @param $js_file
     * @return string
     */
    function js_asset($js_file)
    {
        return  '/assets/js/' . $js_file . '.js';
    }
}

if(!function_exists('js_admin_asset'))
{
    /**
     * @param $js_file
     * @return string
     */
    function js_admin_asset($js_file)
    {
        return '/assets/js/admin/' . $js_file . '.js';
    }
}

if(!function_exists('img_asset'))
{
    /**
     * @param $img_file
     * @param $extension
     * @return string
     */
    function img_asset($img_file, $extension = 'png')
    {
        return '/assets/img/' . $img_file . '.' . $extension;
    }
}

if(!function_exists('banner_img_asset'))
{
    /**
     * @param $banner
     * @param string $extension
     * @return string
     */
    function banner_img_asset($banner, $extension = 'jpg')
    {
        return '/assets/img/banners/' . $banner . '.' . $extension;
    }
}

if(!function_exists('product_img_asset'))
{
    /**
     * @param $product
     * @param string $extension
     * @return string
     */
    function product_img_asset($product, $extension = 'jpg')
    {
        return '/assets/img/products/' . $product . '.' . $extension;
    }
}

if(!function_exists('testimonial_img_asset'))
{
    /**
     * @param $testimonial
     * @param string $extension
     * @return string
     */
    function testimonial_img_asset($testimonial, $extension = 'jpg')
    {
        return '/assets/img/testimonials/' . $testimonial . '.' . $extension;
    }
}

if(!function_exists('team_img_asset'))
{
    /**
     * @param $team
     * @param string $extension
     * @return string
     */
    function team_img_asset($team, $extension = 'jpg')
    {
        return '/assets/img/teams/' . $team . '.' . $extension;
    }
}

if(!function_exists('banners_img_asset'))
{
    /**
     * @param $banner
     * @param string $extension
     * @return string
     */
    function banners_img_asset($banner, $extension = 'jpg')
    {
        return '/assets/img/banners/' . $banner . '.' . $extension;
    }
}


if(!function_exists('favicon_img_asset'))
{
    /**
     * @param $favicon
     * @return string
     */
    function favicon_img_asset($favicon)
    {
        return '/assets/img/favicon/' . $favicon . '.png';
    }
}

if(!function_exists('flag_img_asset'))
{
    /**
     * @param $flag
     * @return string
     */
    function flag_img_asset($flag)
    {
        return '/assets/img/flags/' . $flag . '.png';
    }
}