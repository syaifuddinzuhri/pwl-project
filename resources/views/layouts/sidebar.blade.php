<nav class="pcoded-navbar" pcoded-header-position="relative">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        <div class="">
            <div class="main-menu-header">
                <img class="img-40" src="{{asset('template-dashboard/default')}}/assets/images/user.png" alt="User-Profile-Image">
                <div class="user-details">
                    <span>Master</span>
                    <span id="more-details">Administrator<i class="ti-angle-down"></i></span>
                </div>
            </div>
            <div class="main-menu-content">
                <ul>
                    <li class="more-details">
                        <a href="user-profile.html"><i class="ti-user"></i>Profil</a>
                        <a href="#!"><i class="ti-layout-sidebar-left"></i>Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation" menu-title-theme="theme5">Dashboard</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="active">
                <a href="{{ route('dashboard.index')}}" data-i18n="nav.widget.main">
                    <span class="pcoded-micon"><i class="ti-home"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation" menu-title-theme="theme5">Administrator</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-user"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Manajemen User</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li>
                        <a href="index-2.html">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">Data User</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li>
                        <a href="index-2.html">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">Data Role</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li>
                        <a href="index-2.html">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">Data Permission</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('dashboard.index')}}" data-i18n="nav.widget.main">
                    <span class="pcoded-micon"><i class="ti-car"></i></span>
                    <span class="pcoded-mtext">Manajemen Mobil</span>
                </a>
            </li>
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-shopping-cart-full"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Manajemen Penyewaan</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li>
                        <a href="index-2.html">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">Penyewaan Baru</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li>
                        <a href="index-2.html">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">Pembayaran</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li>
                        <a href="index-2.html">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">Penyewaan Aktif</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{ route('dashboard.index')}}" data-i18n="nav.widget.main">
                    <span class="pcoded-micon"><i class="ti-printer"></i></span>
                    <span class="pcoded-mtext">Laporan</span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation" menu-title-theme="theme5">User</div>
        <ul class="pcoded-item pcoded-left-item">
            <li>
                <a href="{{ route('dashboard.index')}}" data-i18n="nav.widget.main">
                    <span class="pcoded-micon"><i class="ti-car"></i></span>
                    <span class="pcoded-mtext">Mobil</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.index')}}" data-i18n="nav.widget.main">
                    <span class="pcoded-micon"><i class="ti-shopping-cart"></i></span>
                    <span class="pcoded-mtext">Penyewaan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.index')}}" data-i18n="nav.widget.main">
                    <span class="pcoded-micon"><i class="ti-shopping-cart-full"></i></span>
                    <span class="pcoded-mtext">Riwayat Penyewaan</span>
                </a>
            </li>
        </ul>

    </div>
</nav>
