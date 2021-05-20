@include('layouts.header')

<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

        @include('layouts.navbar')
        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
                @include('layouts.sidebar')
                @yield('content')
            </div>
        </div>
    </div>
</div>

@yield('pageModal')

@include('layouts.footer')
