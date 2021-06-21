<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        <div class="">
            <div class="main-menu-header">
                <img class="img-80 img-radius" src="{{ asset('admin-templates')}}/images/user.png" alt="User-Profile-Image">
                <div class="user-details">
                    <span id="more-details">{{Auth::user()->name}}<i class="fa fa-caret-down"></i></span>
                </div>
            </div>
            <div class="main-menu-content">
                <ul>
                    <li class="more-details">
                        <a href="#" onclick="event.preventDefault();
                        document.getElementById('logout-form2').submit();"><i class="ti-layout-sidebar-left"></i> Logout

                        </a>
                        <form id="logout-form2" action="{{ route('auth.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <div class="pcoded-navigation-label">DASHBOARD</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ Request::segment(1) === null ? 'active' : null }} ">
                <a href="{{route('dashboard.index')}}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                    <span class="pcoded-mtext">Dashboard</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
        @if (Auth::check())
        @if (Auth::user()->role == "adm")
        <div class="pcoded-navigation-label">ADMINISTRATOR</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu {{ Request::segment(1) === 'user' || Request::segment(1) === 'role' || Request::segment(1) === 'permission' ? 'active pcoded-trigger' : null }}">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-user"></i><b>BC</b></span>
                    <span class="pcoded-mtext">Manajemen User</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ Request::segment(1) === 'user' ? 'active' : null }}">
                        <a href="{{ route('user.index')}}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext">Data User</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="pcoded-hasmenu {{ Request::segment(1) === 'car' || Request::segment(1) === 'car-type' ? 'active pcoded-trigger' : null }}">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-car"></i><b>BC</b></span>
                    <span class="pcoded-mtext">Manajemen Mobil</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ Request::segment(1) === 'car-type' ? 'active' : null }}">
                        <a href="{{ route('car-type.index')}}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext">Data Merek Mobil</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ Request::segment(1) === 'car' ? 'active' : null }}">
                        <a href="{{ route('car.index')}}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext">Data Mobil</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="pcoded-hasmenu {{ Request::segment(1) === 'transaction' ? 'active pcoded-trigger' : null }}">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-shopping-cart-full"></i><b>BC</b></span>
                    <span class="pcoded-mtext">Manajemen Sewa</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ Request::segment(1) === 'transaction' ? 'active' : null }}">
                        <a href="{{route('transaction.index')}}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext">Penyewaan</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        @else
        <div class="pcoded-navigation-label">CUSTOMER</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ Request::segment(1) === 'customer' && Request::segment(2) === 'car'  ? 'active' : null }}">
                <a href="{{route('customer.car.index')}}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-car"></i><b>D</b></span>
                    <span class="pcoded-mtext">Mobil</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ Request::segment(1) === 'customer' && Request::segment(2) === 'transaction'  ? 'active' : null }}">
                <a href="{{route('customer.transaction.index')}}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-shopping-cart"></i><b>D</b></span>
                    <span class="pcoded-mtext">Penyewaan</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
        @endif
        @endif

    </div>
</nav>
