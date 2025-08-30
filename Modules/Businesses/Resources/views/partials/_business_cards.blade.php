@forelse ($businesses as $business)
@php
    $isOwner = $business->created_by === auth()->id();
    $isNew = $business->created_at->gt(now()->subDays(7));
    $visitorCount = rand(20, 100); // Replace with real metric later

    $rotationInterval = rand(3000, 4000); // milliseconds


    $rotatingPosts = [
        ['text' => "🎉 Summer Sale On Now!", 'img' => 'post1.jpg'],
        ['text' => "📦 New shipping option available!", 'img' => 'post2.jpg'],
        ['text' => "🌴 Visit our new Airlie Beach store!", 'img' => 'post3.jpg'],
        ['text' => "🔥 Limited-time bundle offer!", 'img' => 'post4.jpg'],
    ];
@endphp

<div class="col-xl-4 col-lg-6 col-md-6 mb-4">
    <div class="card business-card border-0 shadow-sm position-relative overflow-hidden"
     data-rotation="{{ $rotationInterval }}"
         style="transition: transform 0.2s ease, box-shadow 0.2s ease;"
         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.1)';"
         onmouseout="this.style.transform=''; this.style.boxShadow='';"
         data-business-id="{{ $business->id }}">
         

         {{-- Online tag (top-left corner) --}}
        <div class="position-absolute top-0 start-0 m-2 px-3 py-1 rounded-pill bg-success text-white small shadow-sm"
        style="font-size: 12px; font-weight: 500; backdrop-filter: blur(4px);">
        <i class="ri-flashlight-line me-1"></i> Online
        </div>

        {{-- Cover --}}
        <div style="height: 140px; overflow: hidden;">
            <img src="{{ $business->cover_photo ? asset('storage/' . $business->cover_photo) : asset('build/images/profile-bg.jpg') }}"
                 class="img-fluid w-100"
                 style="object-fit: cover; object-position: center;">
        </div>

        {{-- Logo --}}
        <div class="d-flex justify-content-center" style="margin-top: -45px;">
            <img src="{{ $business->logo ? asset('storage/' . $business->logo) : asset('build/images/users/avatar-1.jpg') }}"
                 alt="Logo"
                 style="max-width: 160px; max-height: 90px; object-fit: contain; background: transparent;
                        ">
        </div>

        {{-- Content --}}
        <div class="card-body text-center pt-4">
            <h5 class="fw-bold text-white mb-1">{{ $business->name }}</h5>

            {{-- Location --}}
            @if ($business->suburb || $business->state)
                <p class="text-muted small mb-1">
                    <i class="ri-map-pin-line me-1"></i>
                    {{ $business->suburb }}, {{ $business->state }}
                </p>
            @endif

            {{-- Badges --}}
            {{-- Business Info Strip --}}
            <div class="d-flex justify-content-center flex-wrap gap-2 mt-2 mb-3">

                {{-- Visitor stat --}}
                <div class="d-inline-flex align-items-center gap-1 px-3 py-1 rounded-pill shadow-sm" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(6px); font-size: 13px;">
                    <i class="ri-eye-line text-primary"></i>
                    <span class="text-white">{{ $visitorCount }} visits</span>
                </div>

                {{-- Your business --}}
                @if ($isOwner)
                <div class="d-inline-flex align-items-center gap-1 px-3 py-1 rounded-pill shadow-sm" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(6px); font-size: 13px;">
                    <i class="ri-user-star-line text-warning"></i>
                    <span class="text-white">Owned by you</span>
                </div>
                @endif

                {{-- Verified --}}
                @if ($business->is_verified)
                <div class="d-inline-flex align-items-center gap-1 px-3 py-1 rounded-pill shadow-sm" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(6px); font-size: 13px;">
                    <i class="ri-shield-check-line text-info"></i>
                    <span class="text-white">Verified</span>
                </div>
                @endif

                {{-- New --}}
                @if ($isNew)
                <div class="d-inline-flex align-items-center gap-1 px-3 py-1 rounded-pill shadow-sm" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(6px); font-size: 13px;">
                    <i class="ri-sparkling-line text-danger"></i>
                    <span class="text-white">Just added</span>
                </div>
                @endif
            </div>

            {{-- Description --}}
            <p class="text-muted small mb-3">
                {{ Str::limit($business->description ?? 'No description provided.', 100) }}
            </p>

            <div class="business-rotator-spit mt-3 position-relative overflow-hidden"
            data-rotation="{{ $rotationInterval }}"
            style="height: 60px; perspective: 800px;">
                            @foreach ($rotatingPosts as $index => $post)
                <div class="spit-slide-x position-absolute w-100 h-100 d-flex align-items-start px-3 py-2 gap-3 transition-rotate-x"
                style="border: 1px solid rgba(255,255,255,0.2); border-radius: 10px;
                       backface-visibility: hidden; transform: rotateX({{ $index * 90 }}deg);
                       transform-origin: center center;
                       opacity: {{ $index === 0 ? 1 : 0 }};
                       background-color: rgba(255,255,255,0.04);">
           
               {{-- Thumbnail --}}
               <img src="{{ asset('storage/posts/' . $post['img']) }}"
                    alt=""
                    class="rounded"
                    style="width: 36px; height: 36px; object-fit: cover; flex-shrink: 0; border: 1px solid rgba(255,255,255,0.2);">
           
               {{-- Text + Timestamp (aligned left) --}}
               <div class="d-flex flex-column text-start w-100">
                                   <span class="text-white small fw-semibold">{{ $post['text'] }}</span>
                   <span class="text-white-50 small mt-1" style="font-size: 11px;">
                       {{ \Carbon\Carbon::now()->subHours(rand(1, 72))->diffForHumans() }}
                   </span>
               </div>
           
               {{-- Spacer to push arrow right --}}
               <div class="flex-grow-1"></div>
           
               {{-- Arrow --}}
               <a href="#" class="text-muted d-flex align-items-start"
                  style="text-decoration: none; font-size: 16px;">
                   <i class="ri-arrow-right-up-line"></i>
               </a>
           </div>
                @endforeach
            </div>

            {{-- Buttons --}}
            <div class="d-flex justify-content-between align-items-center mt-3 px-2">
                {{-- Left group --}}
                <div class="d-flex gap-2">
                    <a href="{{ route('businesses.show', $business) }}" class="btn btn-sm btn-outline-primary">
                        <i class="ri-eye-line me-1"></i> View
                    </a>
                    <button class="btn btn-sm btn-outline-success">
                        <i class="ri-building-line me-1"></i> Follow
                    </button>

                </div>
            
                {{-- Right: Start Chat --}}
                <button class="btn btn-sm btn-outline-secondary"
                onclick="openChat({
                    id: {{ $business->id }},
                    name: '{{ addslashes($business->name) }}',
                    logo: '{{ asset('storage/' . $business->logo) }}'
                })">
                <i class="ri-chat-3-line me-1"></i> Start Chat
            </button>
            </div>
        </div>
    </div>
</div>
@empty
<div class="col-12">
    <div class="alert alert-warning text-center">
        No businesses found.
    </div>
</div>
@endforelse


<script>
document.addEventListener('DOMContentLoaded', function () {
    const rotators = document.querySelectorAll('.business-rotator-spit');

    rotators.forEach(rotator => {
        const slides = rotator.querySelectorAll('.spit-slide-x');
        let current = 0;
        const interval = parseInt(rotator.dataset.rotation) || 3500;

        setInterval(() => {
            slides[current].style.opacity = '0';
            slides[current].style.transform = 'rotateX(90deg)';

            current = (current + 1) % slides.length;

            slides[current].style.opacity = '1';
            slides[current].style.transform = 'rotateX(0deg)';
        }, interval);
    });
});
</script>