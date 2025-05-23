<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="17">
                        </span>
                    </a>

                    <a href="index" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="17">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <!-- App Search-->
                <form class="app-search d-none d-md-block">
                    <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Search..." autocomplete="off" id="search-options" value="">
                        <span class="mdi mdi-magnify search-widget-icon"></span>
                        <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none" id="search-close-options"></span>
                    </div>
                    <div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
                        <div data-simplebar style="max-height: 320px;">
                            <!-- item-->
                            <div class="dropdown-header">
                                <h6 class="text-overflow text-muted mb-0 text-uppercase">Recent Searches</h6>
                            </div>

                            <div class="dropdown-item bg-transparent text-wrap">
                                <a href="index" class="btn btn-soft-secondary btn-sm rounded-pill">how to get started <i class="mdi mdi-magnify ms-1"></i></a>
                                <a href="index" class="btn btn-soft-secondary btn-sm rounded-pill">businesses <i class="mdi mdi-magnify ms-1"></i></a>
                            </div>
                            <!-- item-->
                            <div class="dropdown-header mt-2">
                                <h6 class="text-overflow text-muted mb-1 text-uppercase">Pages</h6>
                            </div>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ri-bubble-chart-line align-middle fs-18 text-muted me-2"></i>
                                <span>Analytics Dashboard</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ri-lifebuoy-line align-middle fs-18 text-muted me-2"></i>
                                <span>Help Center</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ri-user-settings-line align-middle fs-18 text-muted me-2"></i>
                                <span>My account settings</span>
                            </a>

                            <!-- item-->
                            <div class="dropdown-header mt-2">
                                <h6 class="text-overflow text-muted mb-2 text-uppercase">Members</h6>
                            </div>

                            <div class="notification-list">
                                <!-- item -->
                                <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                    <div class="d-flex">
                                        <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                        <div class="flex-grow-1">
                                            <h6 class="m-0">Chloe Williams</h6>
                                            <span class="fs-11 mb-0 text-muted">Manager</span>
                                        </div>
                                    </div>
                                </a>
                                <!-- item -->
                                <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                    <div class="d-flex">
                                        <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                        <div class="flex-grow-1">
                                            <h6 class="m-0">Cooper Harris</h6>
                                            <span class="fs-11 mb-0 text-muted">Web Designer</span>
                                        </div>
                                    </div>
                                </a>
                                <!-- item -->
                                <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                    <div class="d-flex">
                                        <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                        <div class="flex-grow-1">
                                            <h6 class="m-0">Harrison Wright</h6>
                                            <span class="fs-11 mb-0 text-muted">React Developer</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="text-center pt-3 pb-1">
                            <a href="pages-search-results" class="btn btn-primary btn-sm">View All Results <i class="ri-arrow-right-line ms-1"></i></a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="d-flex align-items-center">

                {{-- <div class="ms-1 header-item d-none d-sm-flex" id="eggCounterBox">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" title="Easter Eggs">
                        <img src="/images/egg-gold.png" alt="Egg Icon" style="width: 22px;">
                        <span id="eggCounter" class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-warning">0</span>
                    </button>
                </div> --}}

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="confettiTriggerBtn" title="Celebrate!">
                        <i class="ri-sparkling-2-line fs-22"></i>
                    </button>
                </div>

                <div class="dropdown d-md-none topbar-head-dropdown header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-search fs-22"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                @include('notifications::partials.topbar')

                @push('module-scripts')
                <script src="{{ asset('js/modules/users/settings.js') }}"></script>
                <script src="{{ asset('js/modules/notifications/settings.js') }}"></script>
                <script>
                    window.connectionsAcceptUrl = "{{ url('connections/accept') }}";
                    window.connectionsDenyUrl = "{{ url('connections/deny') }}";
                </script>

            @endpush

            

                <div class="dropdown topbar-head-dropdown ms-1 header-item">

                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-cart-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                        <i class='bx bx-shopping-bag fs-22'></i>
                        <span class="position-absolute topbar-badge cartitem-badge fs-10 translate-middle badge rounded-pill bg-info">5</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end p-0 dropdown-menu-cart" aria-labelledby="page-header-cart-dropdown">
                        <div class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0 fs-16 fw-semibold"> My Cart</h6>
                                </div>
                                <div class="col-auto">
                                    <span class="badge bg-warning-subtle text-warning fs-13"><span class="cartitem-badge">7</span>
                                        items</span>
                                </div>
                            </div>
                        </div>
                        <div data-simplebar style="max-height: 300px;">
                            <div class="p-2">
                                <div class="text-center empty-cart" id="empty-cart">
                                    <div class="avatar-md mx-auto my-3">
                                        <div class="avatar-title bg-info-subtle text-info fs-36 rounded-circle">
                                            <i class='bx bx-cart'></i>
                                        </div>
                                    </div>
                                    <h5 class="mb-3">Your Cart is Empty!</h5>
                                    <a href="#" class="btn btn-success w-md mb-3">Shop Now</a>
                                </div>
                                <div class="d-block dropdown-item dropdown-item-cart text-wrap px-3 py-2">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ URL::asset('build/images/products/img-1.png') }}" class="me-3 rounded-circle avatar-sm p-2 bg-light" alt="user-pic">
                                        <div class="flex-grow-1">
                                            <h6 class="mt-0 mb-1 fs-14">
                                                <a href="apps-ecommerce-product-details" class="text-reset">Hammock & Vine Lace Shirt</a>
                                            </h6>
                                            <p class="mb-0 fs-12 text-muted">
                                                Quantity: <span>1 x $169.95</span>
                                            </p>
                                        </div>
                                        <div class="px-2">
                                            <h5 class="m-0 fw-normal">$<span class="cart-item-price">169.95</span></h5>
                                        </div>
                                        <div class="ps-2">
                                            <button type="button" class="btn btn-icon btn-sm btn-ghost-secondary remove-item-btn"><i class="ri-close-fill fs-16"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-block dropdown-item dropdown-item-cart text-wrap px-3 py-2">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ URL::asset('build/images/products/img-2.png') }}" class="me-3 rounded-circle avatar-sm p-2 bg-light" alt="user-pic">
                                        <div class="flex-grow-1">
                                            <h6 class="mt-0 mb-1 fs-14">
                                                <a href="apps-ecommerce-product-details" class="text-reset">Wrangler Womens L/S Shirt</a>
                                            </h6>
                                            <p class="mb-0 fs-12 text-muted">
                                                Quantity: <span>1 x $99.95</span>
                                            </p>
                                        </div>
                                        <div class="px-2">
                                            <h5 class="m-0 fw-normal">$<span class="cart-item-price">99.95</span></h5>
                                        </div>
                                        <div class="ps-2">
                                            <button type="button" class="btn btn-icon btn-sm btn-ghost-secondary remove-item-btn"><i class="ri-close-fill fs-16"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-block dropdown-item dropdown-item-cart text-wrap px-3 py-2">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ URL::asset('build/images/products/img-3.png') }}" class="me-3 rounded-circle avatar-sm p-2 bg-light" alt="user-pic">
                                        <div class="flex-grow-1">
                                            <h6 class="mt-0 mb-1 fs-14">
                                                <a href="apps-ecommerce-product-details" class="text-reset">
                                                    Wrangler Mens L/S Shirt</a>
                                            </h6>
                                            <p class="mb-0 fs-12 text-muted">
                                                Quantity: <span>1 x $129.95</span>
                                            </p>
                                        </div>
                                        <div class="px-2">
                                            <h5 class="m-0 fw-normal">$<span class="cart-item-price">129.95</span></h5>
                                        </div>
                                        <div class="ps-2">
                                            <button type="button" class="btn btn-icon btn-sm btn-ghost-secondary remove-item-btn"><i class="ri-close-fill fs-16"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-block dropdown-item dropdown-item-cart text-wrap px-3 py-2">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ URL::asset('build/images/products/img-6.png') }}" class="me-3 rounded-circle avatar-sm p-2 bg-light" alt="user-pic">
                                        <div class="flex-grow-1">
                                            <h6 class="mt-0 mb-1 fs-14">
                                                <a href="apps-ecommerce-product-details" class="text-reset">Wrangler Mens Belt</a>
                                            </h6>
                                            <p class="mb-0 fs-12 text-muted">
                                                Quantity: <span>1 x $99.95</span>
                                            </p>
                                        </div>
                                        <div class="px-2">
                                            <h5 class="m-0 fw-normal">$ <span class="cart-item-price">99.95</span></h5>
                                        </div>
                                        <div class="ps-2">
                                            <button type="button" class="btn btn-icon btn-sm btn-ghost-secondary remove-item-btn"><i class="ri-close-fill fs-16"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-block dropdown-item dropdown-item-cart text-wrap px-3 py-2">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ URL::asset('build/images/products/img-5.png') }}" class="me-3 rounded-circle avatar-sm p-2 bg-light" alt="user-pic">
                                        <div class="flex-grow-1">
                                            <h6 class="mt-0 mb-1 fs-14">
                                                <a href="apps-ecommerce-product-details" class="text-reset">Wonderland Wide Leg Pant</a>
                                            </h6>
                                            <p class="mb-0 fs-12 text-muted">
                                                Quantity: <span>1 x $119.95</span>
                                            </p>
                                        </div>
                                        <div class="px-2">
                                            <h5 class="m-0 fw-normal">$<span class="cart-item-price">119.95</span></h5>
                                        </div>
                                        <div class="ps-2">
                                            <button type="button" class="btn btn-icon btn-sm btn-ghost-secondary remove-item-btn"><i class="ri-close-fill fs-16"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 border-bottom-0 border-start-0 border-end-0 border-dashed border" id="checkout-elem">
                            <div class="d-flex justify-content-between align-items-center pb-3">
                                <h5 class="m-0 text-muted">Total:</h5>
                                <div class="px-2">
                                    <h5 class="m-0" id="cart-item-total">$619.75</h5>
                                </div>
                            </div>

                            <a href="apps-ecommerce-checkout" class="btn btn-success text-center w-100">
                                Checkout
                            </a>
                        </div>
                    </div>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

                

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user"
                                 src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('build/images/users/avatar-1.jpg') }}"
                                 alt="User Avatar">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">
                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                </span>
                                <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">
                                    {{ ucfirst(Auth::user()->getRoleNames()->first() ?? 'User') }}
                                </span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <h6 class="dropdown-header">Welcome {{ Auth::user()->first_name }}!</h6>
                        <a class="dropdown-item" href="{{ route('profile.view') }}">
                        <i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                            <span class="align-middle">Profile</span>
                        </a>                        <a class="dropdown-item" href="profile/settings"><i class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Settings</span></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bx bx-power-off font-size-16 align-middle me-1"></i> <span>@lang('translation.logout')</span></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
</header>

<!-- removeNotificationModal -->
<div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Are you sure ?</h4>
                        <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

<script>
    function fireRandomConfetti() {
        const effects = [
    // 💥 1. Wide top burst (downward)
    () => confetti({
        particleCount: 250,
        spread: 160,
        startVelocity: 35,
        angle: 90,
        origin: { y: 0.8 }
    }),

    // 💨 2. Left corner blast (wider, stronger)
    () => confetti({
        particleCount: 200,
        angle: 70,
        spread: 100,
        startVelocity: 45,
        origin: { x: 0, y: 0.7 }
    }),

    // 💨 3. Right corner blast (wider, stronger)
    () => confetti({
        particleCount: 200,
        angle: 110,
        spread: 100,
        startVelocity: 45,
        origin: { x: 1, y: 0.7 }
    }),

    // 🌪 4. Full screen chaos (big, random)
    () => confetti({
        particleCount: 400,
        spread: 360,
        startVelocity: 50,
        ticks: 90,
        origin: { x: Math.random(), y: 0.4 + Math.random() * 0.2 }
    }),

    // 🌈 5. Rainbow pop burst
    () => confetti({
        particleCount: 300,
        spread: 160,
        scalar: 1.2,
        colors: ['#ff0', '#f0f', '#0ff', '#0f0', '#f00', '#00f'],
        origin: { y: 0.4 },
        startVelocity: 35
    }),

    // 🚀 6. Upstream rocket burst (from bottom center)
    () => confetti({
        particleCount: 220,
        angle: 90,
        spread: 50,
        startVelocity: 60,
        origin: { y: 1 }
    }),

    // 💫 7. Center explosion outward
    () => confetti({
        particleCount: 300,
        spread: 240,
        startVelocity: 50,
        origin: { x: 0.5, y: 0.5 }
    }),

    // 🎯 8. Dual blast from sides
    () => {
        confetti({
            particleCount: 150,
            angle: 60,
            spread: 80,
            startVelocity: 40,
            origin: { x: 0, y: 0.6 }
        });
        confetti({
            particleCount: 150,
            angle: 120,
            spread: 80,
            startVelocity: 40,
            origin: { x: 1, y: 0.6 }
        });
    },

    // 🔮 9. Floaty gravity shower
    () => confetti({
        particleCount: 200,
        spread: 180,
        gravity: 0.3,
        scalar: 1.5,
        origin: { y: 0.6 }
    }),

    // 🔥 10. Bottom-center precision cannon upward
    () => confetti({
        particleCount: 100,
        angle: 90,
        spread: 40,
        startVelocity: 80,
        origin: { x: 0.5, y: 0.95 }
    }),
];
        const randomEffect = effects[Math.floor(Math.random() * effects.length)];
        randomEffect();
    }

    let holdTimer;
let chaosInterval;
let isConfettiChaosRunning = false;

const confettiBtn = document.getElementById('confettiTriggerBtn');



function shootElectricArcAnimated(chaos = false) {
    const canvas = document.getElementById('electricityCanvas');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    const startX = Math.random() * canvas.width;
    const startY = Math.random() * canvas.height;
    const endX = Math.random() * canvas.width;
    const endY = Math.random() * canvas.height;

    const glowColors = ['#00f0ff', '#9a00ff', '#cc66ff', '#00ff99', '#ffffff'];
    const glowColor = glowColors[Math.floor(Math.random() * glowColors.length)];

    const segments = chaos ? 14 : 10;       // ✨ Fewer points
    const maxOffset = chaos ? 60 : 40;
    const maxFrames = chaos ? 16 : 10;
    let frame = 0;

    function drawLightningBranch(sx, sy, ex, ey, thickness = 4, depth = 0) {
        const pointCount = segments - depth * 2; // Fewer points for child branches
        let points = [{ x: sx, y: sy }];
        for (let i = 1; i < pointCount; i++) {
            const t = i / pointCount;
            const x = sx + (ex - sx) * t + (Math.random() - 0.5) * maxOffset;
            const y = sy + (ey - sy) * t + (Math.random() - 0.5) * maxOffset;
            points.push({ x, y });

            // ⚡ Branch every few points with spacing
            if (chaos && depth < 2 && i % 4 === 0 && Math.random() < 0.6) {
                const branchEndX = x + (Math.random() - 0.5) * 200;
                const branchEndY = y + (Math.random() - 0.5) * 200;
                drawLightningBranch(x, y, branchEndX, branchEndY, thickness * 0.6, depth + 1);
            }
        }
        points.push({ x: ex, y: ey });

        ctx.strokeStyle = glowColor;
        ctx.lineWidth = thickness;
        ctx.shadowBlur = 30;
        ctx.shadowColor = glowColor;

        ctx.beginPath();
        ctx.moveTo(points[0].x, points[0].y);
        points.forEach(p => ctx.lineTo(p.x, p.y));
        ctx.stroke();
    }

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        drawLightningBranch(startX, startY, endX, endY);
        frame++;
        if (frame < maxFrames) {
            requestAnimationFrame(animate);
        } else {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        }
    }

    animate();
}


let fireballParticles = [];
let fireballRainActive = false;

function startFireballRain() {
    const canvas = document.getElementById('fireballCanvas');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    fireballRainActive = true;

    function spawnFireball() {
        fireballParticles.push({
            x: Math.random() * canvas.width,
            y: -20,
            vx: (Math.random() - 0.5) * 0.5,
            vy: 2 + Math.random() * 2,
            radius: 6 + Math.random() * 4,
            trail: [],
            maxTrail: 10,
            color: '#ff6600'
        });
    }

    let frameCount = 0;

    function animateFireballs() {
        if (!fireballRainActive) return;

        ctx.clearRect(0, 0, canvas.width, canvas.height);

        // Spawn new fireballs periodically
        if (frameCount % 4 === 0 && fireballParticles.length < 50) {
            spawnFireball();
        }

        // Update and draw each fireball
        for (let i = fireballParticles.length - 1; i >= 0; i--) {
            const fb = fireballParticles[i];
            fb.x += fb.vx;
            fb.y += fb.vy;

            // Trail logic
            fb.trail.unshift({ x: fb.x, y: fb.y, r: fb.radius });
            if (fb.trail.length > fb.maxTrail) fb.trail.pop();

            // Draw trail
            for (let j = 0; j < fb.trail.length; j++) {
                const t = fb.trail[j];
                ctx.beginPath();
                ctx.arc(t.x, t.y, t.r * (1 - j / fb.maxTrail), 0, Math.PI * 2);
                ctx.fillStyle = `rgba(255, ${100 + j * 10}, 0, ${0.2 + (1 - j / fb.maxTrail) * 0.5})`;
                ctx.fill();
            }

            // Draw core
            const gradient = ctx.createRadialGradient(fb.x, fb.y, 0, fb.x, fb.y, fb.radius);
            gradient.addColorStop(0, '#fff');
            gradient.addColorStop(1, fb.color);
            ctx.fillStyle = gradient;
            ctx.beginPath();
            ctx.arc(fb.x, fb.y, fb.radius, 0, Math.PI * 2);
            ctx.fill();

            // Remove offscreen fireballs
            if (fb.y > canvas.height + 30) {
                fireballParticles.splice(i, 1);
            }
        }

        frameCount++;
        requestAnimationFrame(animateFireballs);
    }

    animateFireballs();
}


function startConfettiChaos() {
    if (isConfettiChaosRunning) return;

    isConfettiChaosRunning = true;

    startFireballRain();

    const chaosStart = Date.now();

    chaosInterval = setInterval(() => {
        const elapsed = Date.now() - chaosStart;

        // 🎉 Confetti burst
        confetti({
            particleCount: Math.floor(Math.random() * 200) + 500,
            spread: Math.floor(Math.random() * 180) + 180,
            startVelocity: 50 + Math.random() * 50,
            gravity: 0.3 + Math.random() * 0.4,
            scalar: 1 + Math.random() * 0.8,
            ticks: 90 + Math.random() * 30,
            origin: {
                x: Math.random() * 0.6 + 0.2,
                y: Math.random() * 0.5 + 0.1
            },
            colors: ['#00f0ff', '#9a00ff', '#cc66ff', '#00ff99', '#ff00f7', '#ffffff'].sort(() => 0.5 - Math.random()).slice(0, 4)
        });

        // ⚡ Electric arc blast
        for (let i = 0; i < 2; i++) {
            shootElectricArcAnimated(true); // true = full chaos mode
        }

        if (elapsed > 5000) {
            clearInterval(chaosInterval);
            stopFireballRain();
            isConfettiChaosRunning = false;

            tryRewardEasterEgg('confetti_hold_5s');
        }
    }, 300);
}

function stopFireballRain() {
    fireballRainActive = false;

    // Clear canvas and remove particles
    fireballParticles = [];

    const canvas = document.getElementById('fireballCanvas');
    if (canvas) {
        const ctx = canvas.getContext('2d');
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }
}


function tryRewardEasterEgg(eggKey) {
    if (!window.csrfToken) {
        console.error('Missing CSRF token.');
        return;
    }

    fetch('/api/easter-eggs/found', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': window.csrfToken
        },
        body: JSON.stringify({ egg_key: eggKey })
    })
    .then(async res => {
        const text = await res.text(); // grab raw response body

        try {
            const json = JSON.parse(text); // attempt to parse as JSON
            if (res.ok && json.success) {
                rewardEasterEgg(eggKey); // 🎉 run the animation
            } else {
                console.warn('Server responded, but no reward:', json);
            }
        } catch (e) {
            console.error('⚠️ Response was not valid JSON:', text);
        }
    })
    .catch(err => {
        console.error('🐛 Egg reward fetch failed:', err);
    });
}


function rewardEasterEgg(foundEggId) {
    const egg = document.getElementById('easterEggReward');
    egg.style.transition = 'none';
    egg.style.transform = 'translate(-50%, -50%) scale(0)';
    egg.style.opacity = '1';
    egg.style.display = 'block';

    // Animate to topbar
    egg.style.animation = 'eggPopAndFly 2s ease forwards';

    // After animation completes
    setTimeout(() => {
        egg.style.display = 'none';
        incrementEggCounterUI();
        saveEggToDatabase(foundEggId);
    }, 2000);
}

function incrementEggCounterUI() {
    const counter = document.getElementById('eggCounter');
    const current = parseInt(counter.textContent) || 0;
    counter.textContent = current + 1;
}

function saveEggToDatabase(eggKey) {
    fetch('/api/easter-eggs/found', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': window.csrfToken
        },
        body: JSON.stringify({ egg_key: eggKey })
    });
}

// Mouse/Touch Hold Detection
confettiBtn?.addEventListener('mousedown', () => {
    holdTimer = setTimeout(() => {
        startConfettiChaos();
    }, 5000);
});
confettiBtn?.addEventListener('mouseup', () => clearTimeout(holdTimer));
confettiBtn?.addEventListener('mouseleave', () => clearTimeout(holdTimer));
confettiBtn?.addEventListener('touchstart', () => {
    holdTimer = setTimeout(() => {
        startConfettiChaos();
    }, 5000);
});
confettiBtn?.addEventListener('touchend', () => clearTimeout(holdTimer));

    document.getElementById('confettiTriggerBtn')?.addEventListener('click', fireRandomConfetti);
</script>