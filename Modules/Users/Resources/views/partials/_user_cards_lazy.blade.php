@foreach ($users as $user)
    <div class="col-xl-3 col-lg-4 col-sm-6 user-card-wrapper">
        @include('users::partials._user_cards', ['user' => $user])
        @php usleep(50000); @endphp {{-- 50ms per user, adjust as needed --}}
    </div>
@endforeach

<!-- Lazy load trigger -->
<div id="lazyLoadTrigger" class="text-center w-100 py-4">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>