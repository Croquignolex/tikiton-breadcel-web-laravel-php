@component('components.top-header-drop-down', [
    'selected' =>  Auth::user()->format_full_name
    ])
    <li class="text-left">
        <a href="{{ locale_route('account.index') }}">
            <i class="{{ font('user') }}"></i>
            @lang('general.my_account')
        </a>
    </li>
    <li class="text-left">
        <a href="{{ locale_route('orders.index') }}">
            <i class="{{ font('copy') }}"></i>
            @lang('general.my_orders')
        </a>
    </li>
    <li class="text-left">
        <a href="{{ locale_route('wishlist.index') }}">
            <i class="{{ font('star') }}"></i>
            @lang('general.my_wish_list')
        </a>
    </li>
    <li class="text-left">
        <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="{{ font('power-off') }}"></i>
            @lang('general.log_out')
        </a>
        <form id="logout-form" action="{{ locale_route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </li>
@endcomponent