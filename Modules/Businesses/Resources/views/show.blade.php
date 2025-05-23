@extends('layouts.master') {{-- or your Velzon layout --}}

@section('title', $business->name)

@section('content')
    <div class="profile-foreground position-relative mx-n4 mt-n4">
        @if ($business->cover_photo)
            <div class="profile-wid-bg">
                <img src="{{ asset('storage/' . $business->cover_photo) }}" alt="" class="profile-wid-img" />
            </div>
        @else
            <div class="profile-wid-bg bg-primary"></div>
        @endif
    </div>

    <div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
        <div class="row g-4">
            <div class="col-auto">
                <div class="avatar-lg">
                    @if ($business->logo)
                        <img src="{{ asset('storage/' . $business->logo) }}" alt="logo" class="img-thumbnail rounded-circle">
                    @else
                        <div class="avatar-title rounded-circle bg-secondary text-white fs-3">
                            {{ strtoupper(substr($business->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col">
                <div class="p-2">
                    <h3 class="mb-1">{{ $business->name }}</h3>
                    @if ($business->description)
                        <p class="text-muted mb-0">{{ $business->description }}</p>
                    @endif
                    @if ($business->street || $business->suburb || $business->state)
                        <p class="text-muted mt-2">
                            📍 {{ $business->street }}, {{ $business->suburb }}, {{ $business->state }} {{ $business->postcode }}
                        </p>
                    @endif
                </div>
            </div>
            @if ($business->created_by === auth()->id())
                <div class="col-12 col-lg-auto ms-auto text-lg-end">
                    <a href="{{ route('businesses.edit', $business) }}" class="btn btn-soft-primary">
                        <i class="ri-edit-box-line align-bottom me-1"></i> Edit Business
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection