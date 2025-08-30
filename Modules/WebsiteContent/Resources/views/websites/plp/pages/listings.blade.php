@extends('websitecontent::websites.plp.layouts.app')

@section('content')
<div class="content">
    {{-- Hero Section --}}
    <div class="section hero-section hero-section_sin">
        <div class="hero-section-wrap">
            <div class="hero-section-wrap-item">
                <div class="container">
                    <div class="hero-section-container">
                        <div class="hero-section-title">
                            <h2>{{ ucfirst($listingType ?? 'All') }} Properties</h2>
                            <h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec tincidunt arcu, sit amet fermentum sem.</h5>
                        </div>
                    </div>
                </div>
                <div class="hs-scroll-down-wrap">
                    <div class="scroll-down-item">
                        <div class="mousey">
                            <div class="scroller"></div>
                        </div>
                        <span>Scroll Down To Discover</span>
                    </div>
                    <div class="svg-corner svg-corner_white"  style="bottom:0;right: -39px; transform: rotate( 90deg)" ></div>
                                    <div class="svg-corner svg-corner_white"  style="bottom:0;left:  -39px;"></div>
                </div>
                <div class="bg-wrap bg-hero bg-parallax-wrap-gradien fs-wrapper" data-scrollax-parent="true">
                    <div class="bg" data-bg="{{ asset('business-sites/plp/images/bg/2.jpg') }}" data-scrollax="properties: { translateY: '30%' }"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="breadcrumbs-list bl_flat">
            <a href="{{ route('website.home', ['business' => $business->subdomain]) }}">Home</a>
            <span>{{ ucfirst($listingType ?? 'All') }} Properties</span>
        </div>

        <div class="main-content">
            <div class="boxed-container">
                
                @include('websitecontent::websites.plp.partials.property-filters')

                <div class="list-main-wrap-header box-list-header">
                    <div class="list-main-wrap-title">
                        <h2>Results For: <span>{{ ucfirst($listingType ?? 'All') }}</span><strong>{{ $properties->total() }}</strong></h2>
                    </div>
                </div>

               

                <div id="property-listings">
                    @include('websitecontent::websites.plp.partials.properties-loop', [
                        'properties' => $properties,
                        'business' => $business,
                        'listingType' => $listingType ?? null
                    ])
                </div>

            </div>
        </div>
    </div>
</div>
@include('websitecontent::websites.plp.partials.call-to-action')


@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Use event delegation on the document
        document.body.addEventListener('click', function (e) {
            const link = e.target.closest('.ajax-pagination a');

            if (link) {
                e.preventDefault(); // ✅ Stop normal navigation

                fetch(link.href, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newContent = doc.querySelector('#property-listings').innerHTML;

                    // Swap in the new listings and pagination
                    document.querySelector('#property-listings').innerHTML = newContent;

                    // Optional: scroll to top of listings
                    window.scrollTo({
                        top: document.querySelector('#property-listings').offsetTop - 100,
                        behavior: 'smooth'
                    });
                })
                .catch(err => {
                    console.error('Pagination fetch failed', err);
                });
            }
        });
    });
</script>
@endpush