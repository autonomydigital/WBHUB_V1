@extends('layouts.master')

@section('title', 'Alerts')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card mt-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Alerts & Notifications</h5>
                </div>

                <div class="card-body">
                    @if ($notifications->count())
                        <div class="list-group list-group-flush">
                            @foreach ($notifications as $notification)
                                <div class="list-group-item list-group-item-action py-3 d-flex align-items-start">
                                    <div class="avatar-xs me-3 flex-shrink-0">
                                        <span class="avatar-title bg-info-subtle text-info rounded-circle fs-16">
                                            <i class="{{ $notification->icon }}"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">{!! $notification->title !!}</h6>
                                        <p class="mb-0 text-muted fs-12">
                                            <i class="mdi mdi-clock-outline"></i> {{ $notification->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center p-4">
                            <i class="ri-notification-off-line display-4 text-muted mb-3"></i>
                            <h6 class="text-muted">No notifications just yet.</h6>
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </div>
</div>
@endsection