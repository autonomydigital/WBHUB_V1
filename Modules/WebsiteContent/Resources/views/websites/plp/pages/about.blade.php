@extends('websitecontent::websites.plp.layouts.app')

@section('content')

{{-- Page Hero --}}
<div class="section hero-section hero-section_sin">
    <div class="hero-section-wrap">
        <div class="hero-section-wrap-item">
            <div class="container">
                <div class="hero-section-container">
                    <div class="hero-section-title">
                        <h2>About Our Company</h2>
                        <h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec tincidunt arcu, sit amet fermentum sem.</h5>
                    </div>
                </div>
            </div>
            <div class="bg-wrap bg-hero bg-parallax-wrap-gradien fs-wrapper" data-scrollax-parent="true">
                <div class="bg" data-bg="{{ asset('business-sites/plp/images/bg/1.jpg') }}" data-scrollax="properties: { translateY: '30%' }"></div>
            </div>
        </div>
    </div>
</div>

@include('websitecontent::websites.plp.partials.breadcrumbs', [
    'breadcrumbs' => [
        ['label' => 'Who are we']  // Only final item needs label
    ]
])

{{-- About Us Section --}}
<div class="main-content ms_vir_height"> 
    <div class="container">
        <div class="boxed-container">
            <div class="boxed-content">
                <div class="about-wrap boxed-content-item">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="about-title ab-hero ab-hero2">
                                <h2>Our Awesome Story</h2>
                                <h4>Check video presentation to find out more about us.</h4>
                            </div>
                            <p>Ut euismod ultricies sollicitudin...</p>
                            <p>Curabitur convallis fringilla diam...</p>
                            <a href="{{ route('website.page', ['business' => $business->subdomain, 'slug' => 'contact']) }}" class="commentssubmit" style="margin-top: 30px">Get In Touch With Us</a>
                        </div>
                        <div class="col-lg-6">
                            <div class="about-img ab_i2">
                                <img src="{{ asset('business-sites/plp/images/all/1.jpg') }}" class="respimg" alt="">
                                {{-- Optional: Add video popup feature later --}}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Stats --}}
                <div class="row">
                    {{-- @include('websitecontent::websites.plp.partials.inline-stats') --}}
                </div>
            </div>
        </div>
    </div>


    {{-- Testimonials --}}
    @include('websitecontent::websites.plp.partials.testimonials')

    {{-- Call To Action --}}
    @include('websitecontent::websites.plp.partials.call-to-action')
</div>

@endsection