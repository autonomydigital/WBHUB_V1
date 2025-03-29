<!doctype html >
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm-hover" data-sidebar-image="none" data-preloader="disable">
 
<head>
    <meta charset="utf-8" />
    <title>@yield('title') | Whitsunday Business Hub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Connecting Businesses in the Whitsundays" name="description" />
    <meta content="Whitsunday Web" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('build/images/favicon.ico')}}">
    @include('layouts.head-css')
</head>

@section('body')
    @include('layouts.body')
@show
    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.topbar')
        @include('layouts.sidebar')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            @include('layouts.footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    {{-- @include('layouts.customizer') --}}

    <!-- JAVASCRIPT -->
    @include('layouts.vendor-scripts')
    <!-- AOS CSS -->
<link rel="stylesheet" href="{{ asset('build/libs/aos/aos.css') }}" />

<!-- AOS JS -->
<script src="{{ asset('build/libs/aos/aos.js') }}"></script>

    <script>

function showToast(message, type = 'success') {
    const wrapper = document.getElementById('custom-toast-wrapper');
    if (!wrapper) return;

    const icons = {
        success: 'ri-checkbox-circle-line',
        error: 'ri-close-circle-line',
        info: 'ri-information-line',
        warning: 'ri-error-warning-line'
    };

    const aosAttributes = {
        'data-aos': 'fade-left'
    };

    const toast = document.createElement('div');
    toast.className = `custom-toast toast-${type} d-flex align-items-center mb-2 shadow p-3 rounded bg-white text-dark border-start border-${type}`;

    for (const [key, value] of Object.entries(aosAttributes)) {
        toast.setAttribute(key, value);
    }

    toast.innerHTML = `
        <i class="toast-icon ${icons[type] || 'ri-information-line'} me-2 fs-1 text-${type}"></i>
        <span class="message flex-grow-1">${message}</span>
        <span class="fs-18 text-muted" onclick="removeToast(this)">
    <i class="ri-close-line"></i>
</span>
    `;

    wrapper.appendChild(toast);

    AOS.init();

    setTimeout(() => {
        toast.style.animation = 'slideOut 0.5s ease forwards';
        toast.addEventListener('animationend', () => toast.remove());
    }, 4000);
}

function removeToast(button) {
    const toast = button.closest('.custom-toast');
    if (toast) {
        toast.style.animation = 'slideOut 0.5s ease forwards';
        toast.addEventListener('animationend', () => toast.remove());
    }
}

    </script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Toast stack container -->
<!-- Toast stack container -->
{{-- <div aria-live="polite" aria-atomic="true" 
     class="position-fixed bottom-0 end-0 p-3"
     style="z-index: 1080; min-width: 300px;">
    <div id="toast-container"></div>
</div> --}}

<div id="custom-toast-wrapper" class="toast-stack position-fixed bottom-0 end-0 p-3" style="z-index: 1080;"></div>

@yield('script')
</body>

</html>
