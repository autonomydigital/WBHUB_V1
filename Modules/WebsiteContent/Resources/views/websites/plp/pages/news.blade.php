@extends('websitecontent::websites.plp.layouts.app')

@section('content')
    {{-- Hero Banner --}}
    <div class="section hero-section hero-section_sin">
        <div class="hero-section-wrap">
            <div class="hero-section-wrap-item">
                <div class="container">
                    <div class="hero-section-container">
                        <div class="hero-section-title">
                            <h2>Our Last News</h2>
                            <h5>Stay updated with the latest happenings</h5>
                        </div>
                    </div>
                </div>
                <div class="hs-scroll-down-wrap">
                    <div class="scroll-down-item">
                        <div class="mousey"><div class="scroller"></div></div>
                        <span>Scroll Down To Discover</span>
                    </div>
                </div>
                <div class="bg-wrap bg-hero bg-parallax-wrap-gradien fs-wrapper" data-scrollax-parent="true">
                    <div class="bg" data-bg="{{ asset('images/bg/1.jpg') }}" data-scrollax="properties: { translateY: '30%' }"></div>
                </div>
            </div>
        </div>
    </div>

    @include('websitecontent::websites.plp.partials.breadcrumbs', [
        'breadcrumbs' => [
            ['label' => 'News']  // Only final item needs label
        ]
    ])

    {{-- Main Content --}}
    <div class="main-content ms_vir_height"> 

    <div class="container">
        <div class="row">
            {{-- Left: Posts --}}
            <div class="col-lg-8">
                <div class="post-container">
                    <div class="post-items">
                        @foreach($newsPosts as $post)
                            @include('websitecontent::websites.plp.partials.news-card', ['post' => $post])
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="pagination-wrap">
                        <div class="pagination float-pagination">
                            {{ $newsPosts->links('vendor.pagination.default') }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right: Sidebar --}}
            <div class="col-lg-4">
                @include('websitecontent::websites.plp.partials.news-sidebar')
            </div>
        </div>
    </div>
    {{-- Call To Action --}}
    @include('websitecontent::websites.plp.partials.call-to-action')
</div>
@endsection