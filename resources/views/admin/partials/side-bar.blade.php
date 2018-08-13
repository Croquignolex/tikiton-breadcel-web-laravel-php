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
        <li class="side-bar-item nav-item {{ active_page(admin_dashboard_pages()) }}">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="menu-icon {{ font('pie-chart') }}"></i>
                <span class="menu-title">Tableau de bord</span>
            </a>
        </li>
        <li class="side-bar-item nav-item {{ active_page(admin_personalisation_pages()) }}">
            <a class="nav-link" data-toggle="collapse" href="#personalisation" aria-controls="personalisation"
               aria-expanded="{{ active_page(admin_personalisation_pages(), 'expend') === 'show' ? 'true' : 'false' }}">
                <i class="menu-icon {{ font('edit') }}"></i>
                <span class="menu-title">Personalisations</span>
                <i class="menu-arrow {{ font('angle-down') }}"></i>
            </a>
            <div class="collapse {{ active_page(admin_personalisation_pages(), 'expend') }}" id="personalisation">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link {{ active_page(admin_home_pages()) }}"
                           href="{{ route('admin.home.index') }}">
                            <i class="menu-icon {{ font('home') }}"></i>
                            Page d'accueil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ active_page(admin_users_pages()) }}"
                           href="{{ route('admin.about.index') }}">
                            <i class="menu-icon {{ font('info-circle') }}"></i>
                            Page à propos de nous
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="side-bar-item nav-item {{ active_page(admin_options_pages()) }}">
            <a class="nav-link" data-toggle="collapse" href="#options" aria-controls="options"
               aria-expanded="{{ active_page(admin_options_pages(), 'expend') === 'show' ? 'true' : 'false' }}">
                <i class="menu-icon {{ font('toggle-on') }}"></i>
                <span class="menu-title">Options</span>
                <i class="menu-arrow {{ font('angle-down') }}"></i>
            </a>
            <div class="collapse {{ active_page(admin_options_pages(), 'expend') }}" id="options">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link {{ active_page(admin_profile_pages()) }}"
                           href="{{ route('admin.profile.index') }}">
                            <i class="menu-icon {{ font('user') }}"></i>
                            Gérer mon profil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ active_page(admin_users_pages()) }}"
                           href="{{ route('admin.users.index') }}">
                            <i class="menu-icon {{ font('users') }}"></i>
                            Gérer les utilisateurs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ active_page(admin_settings_pages()) }}"
                           href="{{ route('admin.settings.index') }}">
                            <i class="menu-icon {{ font('cogs') }}"></i>
                            Parametres
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript: void(0);"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="menu-icon {{ font('power-off') }}"></i>
                            Deconnexion
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="side-bar-item nav-item {{ active_page(admin_orders_pages()) }}">
            <a class="nav-link" href="{{ route('admin.orders.index') }}">
                <i class="menu-icon {{ font('copy') }}"></i>
                <span class="menu-title">Commandes</span>
            </a>
        </li>
        <li class="side-bar-item nav-item {{ active_page(admin_customers_pages()) }}">
            <a class="nav-link" href="{{ route('admin.customers.index') }}">
                <i class="menu-icon {{ font('cubes') }}"></i>
                <span class="menu-title">Clients</span>
            </a>
        </li>
        <li class="side-bar-item nav-item {{ active_page(admin_categories_pages()) }}">
            <a class="nav-link" href="{{ route('admin.categories.index') }}">
                <i class="menu-icon {{ font('balance-scale') }}"></i>
                <span class="menu-title">Catégories de produits</span>
            </a>
        </li>
        <li class="side-bar-item nav-item {{ active_page(admin_products_pages()) }}">
            <a class="nav-link" href="{{ route('admin.products.index') }}">
                <i class="menu-icon {{ font('database') }}"></i>
                <span class="menu-title">Produits</span>
            </a>
        </li>
        <li class="side-bar-item nav-item {{ active_page(admin_tags_pages()) }}">
            <a class="nav-link" href="{{ route('admin.tags.index') }}">
                <i class="menu-icon {{ font('tags') }}"></i>
                <span class="menu-title">Etiquettes</span>
            </a>
        </li>
        <li class="side-bar-item nav-item {{ active_page(admin_coupons_pages()) }}">
            <a class="nav-link" href="{{ route('admin.coupons.index') }}">
                <i class="menu-icon {{ font('barcode') }}"></i>
                <span class="menu-title">Coupons</span>
            </a>
        </li>
        <li class="side-bar-item nav-item {{ active_page(admin_testimonials_pages()) }}">
            <a class="nav-link" href="{{ route('admin.testimonials.index') }}">
                <i class="menu-icon {{ font('globe') }}"></i>
                <span class="menu-title">Témoignages</span>
            </a>
        </li>
        <li class="side-bar-item nav-item {{ active_page(admin_teams_pages()) }}">
            <a class="nav-link" href="{{ route('admin.teams.index') }}">
                <i class="menu-icon {{ font('user-secret') }}"></i>
                <span class="menu-title">Equipe</span>
            </a>
        </li>
        <li class="side-bar-item nav-item {{ active_page(admin_contacts_pages()) }}">
            <a class="nav-link" href="{{ route('admin.contacts.index') }}">
                <i class="menu-icon {{ font('envelope') }}"></i>
                <span class="menu-title">Messages</span>
            </a>
        </li>
    </ul>
</nav>