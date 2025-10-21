<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <nav class="pcoded-navbar">
            <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
            <div class="pcoded-inner-navbar main-menu">
                <div class="">
                    <div class="main-menu-header">
                        {{-- <img class="img-80 img-radius" src="{{Auth::user()->photo ? asset('storage/image/user/' . Auth::user()->photo) : asset('storage/image/user/noprofile.png') }}" alt="User-Profile">
                        <div class="user-details">
                            <span id="more-details">{{ Auth::user()->name }}<i class="fa fa-caret-down"></i></span>
                        </div> --}}
                    </div>

                    {{-- <div class="main-menu-content">
                        <ul>
                            <li class="more-details">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="ti-layout-sidebar-left"></i> {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div> --}}
                </div>
                <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Layout</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                        <a href="{{ url('dashboard') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ Request::is('dashboard/income') ? 'active' : '' }}">
                        <a href="{{ url('dashboard/income') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-money"></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Laporan Pendapatan</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ Request::is('dashboard/settings') ? 'active' : '' }}">
                        <a href="{{ url('dashboard/settings') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-time"></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Pengaturan Jam Buka</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
                <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Shop Management Table</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="{{ Request::is('dashboard/categories') ? 'active' : '' }}">
                        <a href="{{ url('dashboard/categories') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-menu-alt"></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Table Kategori</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ Request::is('dashboard/menus') ? 'active' : '' }}">
                        <a href="{{ url('dashboard/menus') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-briefcase"></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Tabel Menu</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ Request::is('dashboard/tables') ? 'active' : '' }}">
                        <a href="{{ url('dashboard/tables') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-direction"></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Tabel Meja</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>

                <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Chart &amp; Maps</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="{{ Request::is('dashboard/orders') ? 'active' : '' }}">
                        <a href="{{ url('dashboard/orders') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-shopping-cart-full"></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Tabel Order</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ Request::is('dashboard/users') ? 'active' : '' }}">
                        <a href="{{ url('dashboard/users') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-user"></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Tabel Pengguna</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Kelola</div>
                    <li class="pcoded-hasmenu {{ Request::is('dashboard/hero-sections') || Request::is('dashboard/home-abouts') || Request::is('dashboard/home-why-us') || Request::is('dashboard/home-specials') ? 'active pcoded-trigger' : '' }}">
                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.main">HomePage </span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="{{ Request::is('dashboard/hero-sections') ? 'active' : '' }}">
                                <a href="{{ url('dashboard/hero-sections') }}" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Halaman Utama</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="{{ Request::is('dashboard/home-abouts') ? 'active' : '' }}">
                                <a href="{{ url('dashboard/home-abouts') }}" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Halaman About</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="{{ Request::is('dashboard/home-why-us') ? 'active' : '' }} ">
                                <a href="{{ url('dashboard/home-why-us') }}" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Halaman Why Us</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="{{ Request::is('dashboard/home-specials') ? 'active' : '' }} ">
                                <a href="{{ url('dashboard/home-specials') }}" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Halaman Menu Spesial</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
