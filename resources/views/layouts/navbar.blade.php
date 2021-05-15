<nav class="navbar header-navbar pcoded-header" header-theme="theme4">
    <div class="navbar-wrapper">
        <div class="navbar-logo">
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <i class="ti-menu"></i>
            </a>
            <a class="mobile-search morphsearch-search" href="#">
                <i class="ti-search"></i>
            </a>
            <a href="index-2.html">
                <h5 class="m-0 font-weight-bold">PLATINUM RENT CAR</h5>
                {{-- <img class="img-fluid" src="{{ asset('template-dashboard/default') }}/assets/images/logo.png" alt="Theme-Logo" /> --}}
            </a>
            <a class="mobile-options">
                <i class="ti-more"></i>
            </a>
        </div>
        <div class="navbar-container container-fluid">
            <div>
                <ul class="nav-left">
                    <li>
                        <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                    </li>
                    <li>
                        <a href="#!" onclick="javascript:toggleFullScreen()">
                            <i class="ti-fullscreen"></i>
                        </a>
                    </li>
                </ul>
                <ul class="nav-right">
                    <li class="user-profile header-notification">
                        <a href="#!">
                            <img src="{{ asset('template-dashboard/default') }}/assets/images/user.png" alt="User-Profile-Image">
                            <span>Master</span>
                            <i class="ti-angle-down"></i>
                        </a>
                        <ul class="show-notification profile-notification">
                            <li>
                                <a href="user-profile.html">
                                    <i class="ti-user"></i> Profil
                                </a>
                            </li>
                            <li>
                                <a href="#!">
                                    <i class="ti-layout-sidebar-left"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
