@props(['user'])

@php
    $businesses = $user->connectedBusinesses ?? collect();
@endphp

<div class="card border shadow-sm text-white mb-4">
    <div class="card-body">
        <h5 class="card-title mb-3 text-white">Connected Businesses</h5>

        @if ($businesses->isEmpty())
            <div class="text-center">
                <div class="avatar-md mx-auto mb-3">
                    <span class="avatar-title bg-light text-muted rounded-circle fs-24">
                        <i class="ri-building-line"></i>
                    </span>
                </div>
                <p class="mb-0 text-muted fst-italic">No business connections yet.</p>
            </div>
        @else
            @foreach ($businesses as $biz)
                <div class="card border bg-dark bg-opacity-10 mb-3">
                    <div class="row g-0">
                        <div class="col-3">
                            <img src="{{ $biz->logoUrl() }}" class="img-fluid rounded-start" alt="{{ $biz->name }}">
                        </div>
                        <div class="col-9">
                            <div class="card-body p-3">
                                <h6 class="card-title mb-1 text-white">{{ $biz->name }}</h6>
                                <p class="card-text text-white-50 mb-2">{{ $biz->tagline ?? 'No description' }}</p>
                                <div class="d-flex gap-3">
                                    <a href="{{ route('businesses.show', $biz->id) }}" class="btn btn-sm btn-outline-light">
                                        <i class="ri-eye-line"></i> View
                                    </a>
                                    <a href="{{ $biz->website }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                        <i class="ri-global-line"></i> Website
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>