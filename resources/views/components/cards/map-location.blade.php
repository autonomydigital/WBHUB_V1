@props(['user'])

@php
    $suburb = $user->suburb ?? '';
    $state = $user->state ?? '';
    $locationQuery = urlencode(trim("$suburb, $state"));
    $status = $user->regionStatus();
    $label = $status === 'local' ? 'Local' : 'Visitor';
    $badgeClass = $status === 'local' ? 'bg-success' : 'bg-secondary';
    $mapsKey = $googleMapsKey ?? config('services.google.maps_key');
@endphp

<div class="card border shadow-sm text-white">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title mb-0 text-white">Home town</h5>
            <span class="badge {{ $badgeClass }} fs-12">{{ $label }}</span>
        </div>

        @if ($locationQuery !== ',')
            <div class="ratio ratio-16x9 mb-3">
                <iframe
                    class="rounded"
                    frameborder="0"
                    style="border:0; width: 100%; height: 100%;"
                    allowfullscreen
                    referrerpolicy="no-referrer-when-downgrade"
                    src="https://www.google.com/maps/embed/v1/place?key={{ $mapsKey }}&q={{ $locationQuery }}">
                </iframe>
            </div>
            <div class="text-white-50 small">
                Located in: <strong>{{ $suburb ?: '—' }}, {{ $state ?: '—' }}</strong>
            </div>
        @else
            <div class="text-muted text-center py-4">
                <i class="ri-map-pin-line fs-32 d-block mb-2"></i>
                <p class="mb-0">Location not provided.</p>
            </div>
        @endif
    </div>
</div>