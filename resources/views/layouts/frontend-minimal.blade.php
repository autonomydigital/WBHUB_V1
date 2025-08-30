<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm-hover" data-sidebar-image="none" data-preloader="disable">
<head>
    <meta charset="utf-8" />
    <title>@yield('title') | Whitsunday Business Hub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Connecting Businesses in the Whitsundays" name="description" />
    <meta content="Whitsunday Web" name="author" />
    <link rel="shortcut icon" href="{{ URL::asset('build/images/favicon.ico')}}">
    @include('layouts.head-css')
</head>

<body>
    <div id="layout-wrapper">
        {{-- Custom minimal topbar --}}
        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header d-flex justify-content-between align-items-center px-3">
                    <a href="/" class="d-flex align-items-center gap-2 text-white text-decoration-none">
                        <img src="{{ asset('images/logo-light.png') }}" height="24" alt="Logo">
                        <span class="fs-5 fw-semibold">WBHub</span>
                    </a>

                    <div class="d-flex gap-3">
                        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-sm btn-primary">Register</a>
                    </div>
                </div>
            </div>
        </header>

        @include('layouts.sidebar-public')

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

            {{-- Optional footer --}}
            @include('layouts.footer')
        </div>
    </div>

    {{-- JS scripts from master --}}
    @include('layouts.vendor-scripts')

    {{-- Toast wrapper and extras from master --}}
    <div id="custom-toast-wrapper" class="toast-stack position-fixed bottom-0 end-0 p-3" style="z-index: 1080;"></div>
    <canvas id="electricityCanvas" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; pointer-events: none; z-index: 9999;"></canvas>
    <canvas id="fireballCanvas" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; pointer-events: none; z-index: 9998;"></canvas>
</body>
</html>