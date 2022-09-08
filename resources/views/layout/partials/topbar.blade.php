<!-- Topbar Start -->
<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-end mb-0">
        <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown"
                href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="{{ auth()->user()->image }}" alt="user-image" class="rounded-circle">
                <span class="pro-user-name ms-1">
                    {{ auth()->user()->name }} <i class="fa fa-angle-down"></i>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                <!-- item-->
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Welcome !</h6>
                </div>

                <!-- item-->
                <a href="{{ route('profile') }}" class="dropdown-item notify-item">
                    <i class="fa fa-user"></i>
                    <span>My Account</span>
                </a>

                <div class="dropdown-divider"></div>

                <!-- item-->
                <a href="{{ route('logout') }}" class="dropdown-item notify-item">
                    <i class="fa fa-sign-out"></i>
                    <span>Logout</span>
                </a>
            </div>
        </li>
        <li class="dropdown notification-list">
            <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                <i class="fa fa-cog noti-icon"></i>
            </a>
        </li>
    </ul>

    <!-- LOGO -->
    <div class="logo-box px-sm-1 px-lg-2">
        <a href="{{ route('dashboard') }}" class="logo logo-light text-center">
            <span class="logo-sm">
                <img src="{{ asset('asset/img/logo-admin.png') }}" alt="" class="img-fluid">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('asset/img/logo-admin.png') }}" alt="" class="img-fluid">
            </span>
        </a>
        <a href="index.html" class="logo logo-dark text-center">
            <span class="logo-sm">
                <img src="{{ asset('asset/img/logo-admin.png') }}" alt="" class="img-fluid">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('asset/img/logo-admin.png') }}" alt="" class="img-fluid">
            </span>
        </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
        <li>
            <button class="button-menu-mobile disable-btn waves-effect">
                <i class="fa fa-bars"></i>
            </button>
        </li>

        {{-- <li>
            <h4 class="page-title-main">Dashboard</h4>
        </li> --}}

    </ul>

    <div class="clearfix"></div>

</div>
<!-- end Topbar -->
