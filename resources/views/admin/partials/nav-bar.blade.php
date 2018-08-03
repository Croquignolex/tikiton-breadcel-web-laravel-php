<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a href="{{ route('admin.dashboard') }}" class="navbar-brand brand-logo">
            <img src="{{ img_asset('logo') }}" alt="..." />
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('admin.dashboard') }}">
            <strong class="text-theme">B</strong>
        </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown d-none d-sm-inline-block">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                    <span class="profile-text">
                        {{ \Illuminate\Support\Facades\Auth::user()->format_full_name }}
                    </span>
                    <img class="img-xs rounded-circle" src="{{ img_asset('admin-face', 'png') }}" alt="...">
                    <i class="{{ font('angle-down') }}"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <a class="dropdown-item mt-2 {{ active_page(admin_profile_pages()) }}"
                       href="{{ route('admin.profile.index') }}">
                        <i class="{{ font('user') }}"></i>
                        Gérer mon profil
                    </a>
                    <a class="dropdown-item {{ active_page(admin_users_pages()) }}"
                       href="{{ route('admin.users.index') }}">
                        <i class="{{ font('users') }}"></i>
                        Gérer les utilisateurs
                    </a>
                    <a class="dropdown-item {{ active_page(admin_settings_pages()) }}"
                       href="{{ route('admin.settings.index') }}">
                        <i class="{{ font('cogs') }}"></i>
                        Parametres
                    </a>
                    <a class="dropdown-item" href="javascript: void(0);"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="{{ font('power-off') }}"></i>
                        Deconnexion
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <i class="{{ font('bars') }}"></i>
        </button>
    </div>
</nav>