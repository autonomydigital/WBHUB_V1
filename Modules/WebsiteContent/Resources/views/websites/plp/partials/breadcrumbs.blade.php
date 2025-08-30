{{-- Breadcrumbs Partial --}}
<div class="container">
    <div class="breadcrumbs-list bl_flat">
        <a href="{{ request()->getHost() === $business->custom_domain
            ? route('website.home.custom')
            : route('website.home', ['business' => $business->subdomain]) }}">Home</a>

        @foreach($breadcrumbs as $crumb)
            @if (!$loop->last)
                <a href="{{ $crumb['url'] }}">{{ $crumb['label'] }}</a>
            @else
                <span>{{ $crumb['label'] }}</span>
            @endif
        @endforeach
    </div>
</div>