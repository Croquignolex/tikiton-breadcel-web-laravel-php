<!--Start Main Menu Area-->
<div class="menu-area">
    <div class="container">
        <div class="row">
            <div class="clo-md-12">
                <div class="main-menu hidden-sm hidden-xs">
                    <nav>
                        <ul>
                            <li>
                                <a href="{{ locale_route('home') }}" class="{{ active_page(home_pages()) }}">
                                    @lang('general.home')
                                </a>
                            </li>
                            <li>
                                <a href="{{ locale_route('about') }}" class="{{ active_page(about_pages()) }}">
                                    @lang('general.about_us')
                                </a>
                            </li>
                            <li>
                                <a href="{{ locale_route('products.index') }}" class="{{ active_page(products_pages()) }}">
                                    @lang('general.our_products')
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ locale_route('products.index') }}" class="{{ active_page(product2_pages()) }}">@lang('general.our_products') 1</a></li>
                                    <li><a href="{{ locale_route('products.index') }}" class="{{ active_page(product1_pages()) }}">@lang('general.our_products') 2</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ locale_route('services.index') }}" class="{{ active_page(services_pages()) }}">
                                    @lang('general.our_services')
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ locale_route('services.index') }}" class="{{ active_page(service1_pages()) }}">@lang('general.our_services') 1</a></li>
                                    <li><a href="{{ locale_route('services.index') }}" class="{{ active_page(service2_pages()) }}">@lang('general.our_services') 2</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ locale_route('blog.index') }}" class="{{ active_page(blog_pages()) }}">
                                    @lang('general.blog')
                                </a>
                            </li>
                            <li>
                                <a href="{{ locale_route('contact') }}" class="{{ active_page(contact_pages()) }}">
                                    @lang('general.contact_us')
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="mobile-menu hidden-md hidden-lg">
                    <nav>
                        <ul>
                            <li>
                                <a href="{{ locale_route('home') }}" class="{{ active_page(home_pages()) }}">
                                    @lang('general.home')
                                </a>
                            </li>
                            <li>
                                <a href="{{ locale_route('about') }}" class="{{ active_page(about_pages()) }}">
                                    @lang('general.about_us')
                                </a>
                            </li>
                            <li>
                                <a href="{{ locale_route('products.index') }}" class="{{ active_page(products_pages()) }}">
                                    @lang('general.our_products')
                                </a>
                                <ul>
                                    <li><a href="{{ locale_route('products.index') }}" class="{{ active_page(product2_pages()) }}">@lang('general.our_products') 1</a></li>
                                    <li><a href="{{ locale_route('products.index') }}" class="{{ active_page(product1_pages()) }}">@lang('general.our_products') 2</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ locale_route('services.index') }}" class="{{ active_page(services_pages()) }}">
                                    @lang('general.our_services')
                                </a>
                                <ul>
                                    <li><a href="{{ locale_route('services.index') }}" class="{{ active_page(service2_pages()) }}">@lang('general.our_services') 1</a></li>
                                    <li><a href="{{ locale_route('services.index') }}" class="{{ active_page(service1_pages()) }}">@lang('general.our_services') 2</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ locale_route('blog.index') }}" class="{{ active_page(blog_pages()) }}">
                                    @lang('general.blog')
                                </a>
                            </li>
                            <li>
                                <a href="{{ locale_route('contact') }}" class="{{ active_page(contact_pages()) }}">
                                    @lang('general.contact_us')
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Main Menu Area-->