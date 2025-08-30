<!-- ========== App Menu (Public-Facing Sidebar) ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="/" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('build/images/logo-sm.png')); ?>" alt="" height="40">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('build/images/logo-dark.png')); ?>" alt="" height="40">
            </span>
        </a>
        <a href="/" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('build/images/logo-sm.png')); ?>" alt="" height="40">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('build/images/logo-light.png')); ?>" alt="" height="40">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>About</span></li>

                <li class="nav-item">
                    <a href="/about" class="nav-link">
                        <i class="las la-info-circle"></i> <span>What is WBHub?</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/directory" class="nav-link">
                        <i class="las la-address-book"></i> <span>Business Directory</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/events" class="nav-link">
                        <i class="las la-calendar"></i> <span>Upcoming Events</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/features" class="nav-link">
                        <i class="las la-cogs"></i> <span>Platform Features</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/contact" class="nav-link">
                        <i class="las la-envelope"></i> <span>Contact Us</span>
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <a href="/register" class="btn btn-primary w-100">Join WBHub</a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/resources/views/layouts/sidebar-public.blade.php ENDPATH**/ ?>