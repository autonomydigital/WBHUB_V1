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

@php
    Log::info('🔍 Layout hit', [
        'user' => auth()->id(),
        'has_business' => auth()->user()?->businesses->count() ?? null
    ]);
@endphp
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

                    @stack('module-scripts')
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

<!-- ⚡ Electricity canvas (zaps) -->
<canvas id="electricityCanvas" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; pointer-events: none; z-index: 9999;"></canvas>

<!-- 🔥 Fireball rain canvas -->
<canvas id="fireballCanvas" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; pointer-events: none; z-index: 9998;"></canvas>

<div id="easterEggReward" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%) scale(0); z-index: 10000; pointer-events: none;">
    <img src="/images/egg-gold.png" alt="Easter Egg" style="width: 80px; animation: spin 2s linear infinite;">
</div>

{{-- Chat popup dock (holds all active chat windows) --}}
<div id="chatPopupDock" class="position-fixed bottom-0 end-0 m-4" style="z-index: 1060;"></div>

{{-- Chat toggle logo stack --}}
<div id="chatToggleStack"
     class="position-fixed bottom-0 end-0 d-flex flex-column-reverse align-items-center gap-2 mb-4 me-2"
     style="z-index: 1061; width: 60px;">
</div>

<x-chat-popup />

<script>
const chatState = {};
let lastActiveChatId = null;

function openChat(business) {
    const chatId = `chat-${business.id}`;

    // Create chat window if it doesn't exist
    if (!chatState[chatId]) {
        const chatBox = document.createElement('div');
        chatBox.className = 'card shadow position-fixed bottom-0';
chatBox.style.right = '80px';
chatBox.style.marginBottom = '1.5rem';
chatBox.style.width = '320px';
chatBox.style.zIndex = 1060;
chatBox.style.borderRadius = '12px';
chatBox.id = chatId;

chatBox.innerHTML = `
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <img src="${business.logo}" style="width: 32px; height: 32px; object-fit: contain; background: #fff; border-radius: 6px;">
            <strong>${business.name}</strong>
        </div>
        <button class="btn-close btn-close-white btn-sm" onclick="closeChat('${chatId}')"></button>
    </div>
    <div class="card-body small p-3 bg-white text-dark" style="height: 200px; overflow-y: auto;">
        <div class="text-muted small">Chat with ${business.name}</div>
    </div>
    <div class="card-footer p-2 d-flex bg-light">
        <input type="text" class="form-control form-control-sm me-2" placeholder="Message...">
        <button class="btn btn-sm btn-primary">Send</button>
    </div>
`;

        document.getElementById('chatPopupDock').appendChild(chatBox);

        const icon = document.createElement('img');
        icon.src = business.logo;
        icon.className = 'rounded-circle shadow chat-toggle-icon';
        icon.style.width = '42px';
        icon.style.height = '42px';
        icon.style.cursor = 'pointer';
        icon.dataset.chatId = chatId;
        icon.onclick = () => showOnlyChat(chatId);
        icon.id = `toggle-${chatId}`;

        document.getElementById('chatToggleStack').appendChild(icon);

        chatState[chatId] = { visible: true };

        // ✅ Force all other chats to hide
        for (const id in chatState) {
            if (id !== chatId) {
                const otherBox = document.getElementById(id);
                const otherIcon = document.getElementById(`toggle-${id}`);
                if (otherBox) otherBox.style.display = 'none';
                if (otherIcon) otherIcon.classList.add('opacity-50');
                chatState[id].visible = false;
            }
        }
}
}

function showOnlyChat(chatId) {
    const box = document.getElementById(chatId);

    // Toggle off if already visible
    if (chatState[chatId]?.visible) {
        box.style.display = 'none';
        document.getElementById(`toggle-${chatId}`).classList.add('opacity-50');
        chatState[chatId].visible = false;
        return;
    }

    // Hide all other chats
    for (const id in chatState) {
        const otherBox = document.getElementById(id);
        const otherIcon = document.getElementById(`toggle-${id}`);
        if (otherBox) otherBox.style.display = 'none';
        if (otherIcon) otherIcon.classList.add('opacity-50');
        chatState[id].visible = false;
    }

    // Show the selected chat
    box.style.display = 'block';
    document.getElementById(`toggle-${chatId}`).classList.remove('opacity-50');
    chatState[chatId].visible = true;
}

function closeChat(chatId) {
    const box = document.getElementById(chatId);
    const icon = document.getElementById(`toggle-${chatId}`);

    if (box) box.remove();
    if (icon) icon.remove();

    delete chatState[chatId];

    // ✅ After closing, open the next available chat if one exists
    const openIds = Object.keys(chatState);
    if (openIds.length > 0) {
        showOnlyChat(openIds[0]); // just pick the first tracked chat
    }
}
</script>

</body>

</html>
