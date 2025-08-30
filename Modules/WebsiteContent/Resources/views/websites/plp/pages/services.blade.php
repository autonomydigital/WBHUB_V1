@extends('websitecontent::websites.plp.layouts.app')

@section('content')

{{-- Hero Section --}}
<div class="section hero-section hero-section_sin">
    <div class="hero-section-wrap">
        <div class="hero-section-wrap-item">
            <div class="container">
                <div class="hero-section-container">
                    <div class="hero-section-title">
                        <h2>What We Do</h2>
                        <h5>Expert services in real estate, property management, and more.</h5>
                    </div>
                </div>
            </div>
            <div class="bg-wrap bg-hero bg-parallax-wrap-gradien fs-wrapper" data-scrollax-parent="true">
                <div class="bg" data-bg="{{ asset('business-sites/plp/images/bg/2.jpg') }}" data-scrollax="properties: { translateY: '30%' }"></div>
            </div>
        </div>
    </div>
</div>

@include('websitecontent::websites.plp.partials.breadcrumbs', [
    'breadcrumbs' => [
        ['label' => 'What we do']  // Only final item needs label
    ]
])

{{-- Services List --}}
<div class="main-content">
    <div class="container">
        <div class="boxed-container">
            <div class="boxed-content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="box-item">
                            <h4>Property Sales</h4>
                            <p>Helping you buy or sell with confidence.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box-item">
                            <h4>Property Management</h4>
                            <p>Complete management services for landlords.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box-item">
                            <h4>Market Appraisals</h4>
                            <p>Know your property’s true value.</p>
                        </div>
                    </div>
                </div>
                {{-- Add more service boxes here if needed --}}
            </div>
        </div>
    </div>
</div>

@endsection