@extends('websitecontent::websites.plp.layouts.app')

@section('content')
    {{-- Hero Section --}}
    @include('websitecontent::websites.plp.partials.hero')

    {{-- Latest Properties --}}
    @include('websitecontent::websites.plp.partials.latest-properties')

    {{-- Explore Region Carousel --}}
    @include('websitecontent::websites.plp.partials.explore-region')

    <div class="main-content ms_vir_height">
    {{-- Why Sell With Us Section --}}
    @include('websitecontent::websites.plp.partials.why-sell')

    {{-- How It Works (Process Section) --}}
    @include('websitecontent::websites.plp.partials.how-it-works')

    {{-- Testimonials --}}
    @include('websitecontent::websites.plp.partials.testimonials')

    {{-- Call To Action / API Section --}}
    @include('websitecontent::websites.plp.partials.call-to-action')

    </div>
@endsection