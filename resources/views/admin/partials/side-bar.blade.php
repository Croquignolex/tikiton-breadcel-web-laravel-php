<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="user-wrapper">
                    <div class="profile-image">
                        <img src="{{ img_asset('admin-face', 'png') }}" alt="...">
                    </div>
                    <div class="text-wrapper">
                        <p class="profile-name">
                            {{ \Illuminate\Support\Facades\Auth::user()->format_full_name }}
                        </p>
                        <div>
                            <small class="designation text-muted">
                                {{ \Illuminate\Support\Facades\Auth::user()->function }}
                            </small>
                            <span class="status-indicator online"></span>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li class="nav-item {{ active_page(admin_dashboard_pages()) }}">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="menu-icon {{ font('pie-chart') }}"></i>
                <span class="menu-title">Tableau de bord</span>
            </a>
        </li>
        <li class="nav-item {{ active_page(admin_orders_pages()) }}">
            <a class="nav-link" href="{{ route('admin.orders.index') }}">
                <i class="menu-icon {{ font('copy') }}"></i>
                <span class="menu-title">Commandes</span>
            </a>
        </li>
    </ul>
</nav>