<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

<!-- ============================================================== -->
<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->
<header class="topbar" data-navbarbg="skin6">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin6">
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand ms-4" href="index.html">
                <!-- Logo icon -->
                <b class="logo-icon">
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img src="../assets/images/logo-light-icon.png" alt="homepage" class="dark-logo" />

                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span class="logo-text">
                    <!-- dark Logo text -->
                    <img src="../assets/images/logo-light-text.png" alt="homepage" class="dark-logo" />

                </span>
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <a class="nav-toggler waves-effect waves-light text-white d-block d-md-none"
                href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
            <ul class="navbar-nav d-lg-none d-md-block ">
                <li class="nav-item">
                    <a class="nav-toggler nav-link waves-effect waves-light text-white "
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </li>
            </ul>
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav me-auto mt-md-0 ">
                <!-- ============================================================== -->
                <!-- Search -->
                <!-- ============================================================== -->

                <li class="nav-item search-box">
                    <a class="nav-link text-muted" href="javascript:void(0)"><i class="ti-search"></i></a>
                    <form class="app-search" style="display: none;">
                        <input type="text" class="form-control" placeholder="Search &amp; enter"> <a
                            class="srh-btn"><i class="ti-close"></i></a> </form>
                </li>
            </ul>

            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav">
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <a href="{{ route('logout') }}">Logout</a>
            </ul>
        </div>
    </nav>
</header>
<!-- ============================================================== -->
<!-- End Topbar header -->
<!-- ============================================================== -->