<header class="app-header">

    <!-- Start::main-header-container -->
    <div class="main-header-container container-fluid">

        <!-- Start::header-content-left -->
        <div class="header-content-left">

            <!-- End::header-element -->

            <!-- Start::header-element -->
            <div class="header-element">
                <!-- Start::header-link -->
                <a aria-label="Hide Sidebar" class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle" data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
                <!-- End::header-link -->
            </div>
            <!-- End::header-element -->

        </div>
        <!-- End::header-content-left -->

        <!-- Start::header-content-right -->
        <div class="header-content-right">

            <div class="header-element">
                <!-- Start::header-link|dropdown-toggle -->
                <a href="javascript:void(0);" class="header-link dropdown-toggle" id="mainHeaderProfile" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <div class="me-sm-2 me-0">
                            <img src="{{ \Illuminate\Support\Facades\Auth::user()->avatar_url['250'] }}" alt="img" width="32" height="32" class="rounded-circle">
                        </div>
                        <div class="d-sm-block d-none">
                            <p class="fw-semibold mb-0 lh-1"> Hi, {{ auth()->user()->name }}</p>
                            <span class="op-7 fw-normal d-block fs-11">Super Admin</span>
                        </div>
                    </div>
                </a>
                <!-- End::header-link|dropdown-toggle -->
                <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end" aria-labelledby="mainHeaderProfile">
                    <li><a class="dropdown-item d-flex" href="{{ route('admin.users.edit', auth()->user()->uuid) }}"><i class="ti ti-user-circle fs-18 me-2 op-7"></i>Update Profile</a></li>
                    <li><a class="dropdown-item d-flex" href="{{ route('admin.users.changePassword.index', auth()->user()->uuid) }}"><i class="ti ti-key fs-18 me-2 op-7"></i>Change Password </a></li>
                    <li><a class="dropdown-item d-flex" href="{{ route('admin.setting.create') }}"><i class="ti ti-manual-gearbox fs-18 me-2 op-7"></i>Setting </a></li>
                    <li><a class="dropdown-item d-flex border-block-end" href="{{ route('get.logout') }}"><i class="ti ti-logout fs-18 me-2 op-7"></i>Logout</a></li>
                    </ul>
            </div>

        </div>

    </div>
    <!-- End::main-header-container -->

</header>
