<div class="leftside-menu"
    style="
  background: #ffffff;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;">

    <!-- LOGO -->
    <a href="" class="logo text-center logo-light">
        <span class="logo-lg" style=
        "background:#fff;">
            <img src="https://www.flight.wagnistrip.com/assets/images/logo.png" alt="" height="60px"
                width="100px">
        </span>
        <span class="logo-sm" style=
        "background:#fff;">
            <img src="https://www.flight.wagnistrip.com/assets/images/logo.png" alt="" height="60px"
                width="100px">
        </span>
    </a>
    <style>
        .side-nav-item.active .side-nav-link {
            color: #fff !important;
            background: #403ad7;
        }
    </style>
    <!-- LOGO -->


    <div class="h-100" id="leftside-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="side-nav" style="margin-top: 12px;">
            @can('Dashboard')
                <li class="side-nav-item {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="side-nav-link">
                        <i class="dripicons-view-thumb"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
            @endcan


            <li class="side-nav-item {{ request()->routeIs('blog.*') ? 'active' : '' }}">
                <a href="{{ route('blog.dashboard') }}" class="side-nav-link">
                    <i class="fas fa-pencil-alt"></i>
                    <span> Blogs </span>
                </a>
            </li>

            <li class="side-nav-item {{ request()->routeIs('category.*') ? 'active' : '' }}">
                <a href="{{ route('category.index') }}" class="side-nav-link">
                    <i class="fa fa-map"></i>
                    <span> Category </span>
                </a>
            </li>



                <li
                    class="side-nav-item {{ request()->routeIs('accounts.*') || request()->routeIs('accounts.*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#sidebarSettings" aria-expanded="false"
                        aria-controls="sidebarSettings {{ request()->routeIs('accounts.*') || request()->routeIs('accounts.*') ? 'active' : '' }}"
                        class="side-nav-link">
                        <i class="dripicons-gear"></i>
                        <span> Settings </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('accounts.*') || request()->routeIs('accounts.*') ? 'show' : '' }}"
                        id="sidebarSettings">
                        <ul class="side-nav-second-level">

                                <li style="margin-top: 3px; class="{{ request()->routeIs('accounts.*') ? 'active' : '' }}">
                                    <a href="{{ route('accounts.index') }}">My Account</a>
                                </li>


                                <li class="{{ request()->routeIs('change-password.*') ? 'active' : '' }}">
                                    <a href="{{ route('changePassword.form') }}">Change-Password</a>
                                </li>


                        </ul>
                    </div>
                </li>




        </ul>

        <div class="clearfix"></div>
    </div>
</div>
