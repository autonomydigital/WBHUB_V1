@extends('layouts.master')
@section('title')
    @lang('translation.profile')
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}">
@endsection
@section('content')
<div class="profile-foreground position-relative mx-n4 mt-n4">
    <div class="profile-wid-bg">
        <img src="@if($user->cover_photo) {{ asset('storage/' . $user->cover_photo) }} @else {{ asset('build/images/profile-bg.jpg') }} @endif"
             alt="Cover Photo" class="profile-wid-img" />
    </div>
</div>

<div class="pt-4 mb-4 mb-lg-3 pb-lg-4 profile-wrapper">
    <div class="row g-4">
        <!-- Avatar -->
        <div class="col-auto">
            <div class="avatar-lg">
                <img src="@if ($user->avatar) {{ asset('storage/' . $user->avatar) }} @else {{ asset('build/images/users/avatar-1.jpg') }} @endif"
                    alt="user-img" class="img-thumbnail rounded-circle object-fit-cover" style="height:100px; width:100px;" />
            </div>
        </div>

        <!-- User Info -->
        <div class="col">
            <div class="p-2">
                <h3 class="text-white mb-1">{{ $user->first_name }} {{ $user->last_name }}</h3>
                <p class="text-white text-opacity-75">{{ $user->role ?? 'Member' }}</p>
                <div class="hstack text-white-50 gap-1">
                    <div class="me-2">
                        <i class="ri-map-pin-user-line me-1 text-white text-opacity-75 fs-16 align-middle"></i>
                        {{ $user->suburb ?? 'Location Unknown' }}
                    </div>
                    <div>
                        <i class="ri-building-line me-1 text-white text-opacity-75 fs-16 align-middle"></i>
                        {{ $user->company ?? 'WB Hub' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="col-12 col-lg-auto order-last order-lg-0">
            <div class="row text text-white-50 text-center">
                <div class="col-lg-6 col-4">
                    <div class="p-2">
                        <h4 class="text-white mb-1">{{ $user->followers->count() }}</h4>
                        <p class="fs-14 mb-0">Followers</p>
                    </div>
                </div>
                <div class="col-lg-6 col-4">
                    <div class="p-2">
                        <h4 class="text-white mb-1">{{ $user->following->count() }}</h4>
                                 <p class="fs-14 mb-0">Following</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="d-flex profile-wrapper">
            <!-- Nav tabs -->
            <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                <li class="nav-item">
                    <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab" role="tab">
                        <i class="ri-airplay-fill d-inline-block d-md-none"></i> 
                        <span class="d-none d-md-inline-block">Overview</span>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link fs-14" data-bs-toggle="tab" href="#activities" role="tab">
                        <i class="ri-list-unordered d-inline-block d-md-none"></i> 
                        <span class="d-none d-md-inline-block">Activities</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-14" data-bs-toggle="tab" href="#projects" role="tab">
                        <i class="ri-price-tag-line d-inline-block d-md-none"></i> 
                        <span class="d-none d-md-inline-block">Projects</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-14" data-bs-toggle="tab" href="#documents" role="tab">
                        <i class="ri-folder-4-line d-inline-block d-md-none"></i> 
                        <span class="d-none d-md-inline-block">Documents</span>
                    </a>
                </li> --}}
            </ul>
            @php
            $authUser = auth()->user();
            $isOwnProfile = $authUser && $authUser->id === $user->id;
            $isSuperadmin = $authUser && $authUser->hasRole('superadmin');
        
            $isFollowing = $authUser->isFollowing($user);
            $isConnected = $authUser->isConnectedWith($user);
            $hasPendingSent = $authUser->hasPendingConnectionWith($user);
            $hasPendingReceived = $authUser->receivedConnections()
                ->where('user_id', $user->id)
                ->where('status', 'pending')
                ->first();
        @endphp
        
        <div class="d-flex flex-column align-items-end gap-2">
        
            <div class="d-flex gap-2 flex-wrap justify-content-end">
                @if ($isOwnProfile || $isSuperadmin)
                    <div class="flex-shrink-0">
                        <a href="{{ route('profile.settings') }}" class="btn btn-primary">
                            <i class="ri-edit-box-line align-bottom"></i> Edit Profile
                        </a>
                    </div>
                @endif
        
                @if (!$isOwnProfile || $isSuperadmin)
                    {{-- FOLLOW BUTTON --}}
                    <div class="flex-shrink-0">
                        <button type="button"
                            class="btn btn-{{ $isFollowing ? 'success following-btn' : 'outline-success follow-btn' }}"
                            data-id="{{ $user->id }}"
                            style="min-width: 109px;">
                            {!! $isFollowing
                                ? '<i class="ri-user-follow-line align-bottom"></i> Following'
                                : '<i class="ri-user-follow-line align-bottom"></i> Follow' !!}
                        </button>
                    </div>
        
                    {{-- CONNECTION BUTTONS --}}
                    <div class="flex-shrink-0">
                        @if ($isConnected)
                            <button class="btn btn-secondary" disabled>
                                <i class="ri-user-shared-line align-bottom"></i> Connected
                            </button>
                        @elseif ($hasPendingSent)
                            <button class="btn btn-outline-warning pending-connection-btn" disabled data-id="{{ $user->id }}"
                                style="min-width: 130px;">
                                <i class="ri-time-line align-bottom me-1"></i>
                                <span class="pending-text">Connection</span>
                            </button>
                            @elseif ($hasPendingReceived)
                            <div class="d-flex align-items-stretch connection-banner-row" style="min-width: 300px;">
                                <div class="btn btn-outline-secondary d-flex align-items-center fw-semibold rounded-0 rounded-start px-3">
                                    {{ $user->first_name }} wants to connect
                                </div>
                        
                                <button class="btn btn-success accept-connection-btn rounded-0"
                                        data-id="{{ $hasPendingReceived->id }}">
                                    <i class="ri-check-line align-bottom"></i>
                                </button>
                        
                                <button class="btn btn-danger deny-connection-btn rounded-0 rounded-end"
                                        data-id="{{ $hasPendingReceived->id }}">
                                    <i class="ri-close-line align-bottom"></i>
                                </button>
                            </div>
                            <div class="connection-button-container"></div>
                        @else
                            <button class="btn btn-outline-info connect-btn" data-id="{{ $user->id }}">
                                <i class="ri-user-add-line align-bottom"></i> Connect
                            </button>
                        @endif
                    </div>
                @endif
            </div>
        </div>
        </div>
    </div>
</div>
                <!-- Tab panes -->
                <div class="tab-content pt-4 text-muted">
                    <div class="tab-pane active" id="overview-tab" role="tabpanel">
                        <div class="row">
                            <div class="col-xxl-3">
                                @if (auth()->id() === $user->id)
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Complete Your Profile</h5>
                                        <div class="progress animated-progress custom-progress progress-label">
                                            <div class="progress-bar bg-success" role="progressbar" 
                                                style="width: {{ $user->profileCompletionPercent() }}%" 
                                                aria-valuenow="{{ $user->profileCompletionPercent() }}" 
                                                aria-valuemin="0" aria-valuemax="100">
                                                <div class="label">{{ $user->profileCompletionPercent() }}%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                                <div class="card text-white">
                                    <div class="card-body pb-0">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="card-title mb-0 text-white">Profile Information</h5>
                                            <span class="badge bg-secondary fs-12">
                                                Joined {{ $user->created_at->format('M Y') }}
                                            </span>
                                        </div>
                                
                                        <ul class="list-group list-group-flush border-top pt-3">
                                            <li class="list-group-item text-white border-0 px-0 d-flex justify-content-between align-items-center">
                                                <span class="fw-semibold text-white-50">Name</span>
                                                <span>{{ $user->first_name }} {{ $user->last_name }}</span>
                                            </li>
                                            <li class="list-group-item text-white border-0 px-0 d-flex justify-content-between align-items-center">
                                                <span class="fw-semibold text-white-50">Email</span>
                                                <span>{{ $user->email }}</span>
                                            </li>
                                            @php
                                            $status = $user->regionStatus();
                                        @endphp
                             
                                        </ul>
                                    </div>
                                </div>

                                <x-cards.map-location :user="$user" />

                                <x-cards.user-socials :user="$user" />

                                <x-cards.user-connections :user="$user" />

                              
                            </div>
                            <!--end col-->
                            <div class="col-xxl-9">
                                <div class="card border shadow-sm text-white">
                                    <div class="card-body position-relative">
                                        <div class="d-flex align-items-center mb-3">
                                            <h5 class="card-title mb-0 text-white">
                                                <i class="ri-user-voice-line me-2 text-primary"></i> About
                                            </h5>
                                            <span class="badge bg-dark-subtle text-white-50 ms-auto">Profile Bio</span>
                                        </div>
                                
                                        @if (!empty($user->bio))
                                            <blockquote class="blockquote custom-quote p-3 rounded bg-dark bg-opacity-10 text-white-50 mb-0">
                                                <p class="mb-0 fst-italic">“{{ $user->bio }}”</p>
                                            </blockquote>
                                        @else
                                            <div class="text-center py-4">
                                                <div class="avatar-md mx-auto mb-3">
                                                    <span class="avatar-title bg-light text-muted rounded-circle fs-24">
                                                        <i class="ri-user-line"></i>
                                                    </span>
                                                </div>
                                                <p class="mb-0 text-muted fst-italic">No bio provided yet.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <x-cards.user-businesses :user="$user" />
                                <x-cards.user-posts :user="$user" />
                               

                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    {{-- <div class="tab-pane fade" id="activities" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Activities</h5>
                                <div class="acitivity-timeline">
                                    <div class="acitivity-item d-flex">
                                        <div class="flex-shrink-0">
                                            <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt=""
                                                class="avatar-xs rounded-circle acitivity-avatar" />
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">Oliver Phillips <span
                                                    class="badge bg-primary-subtle text-primary align-middle">New</span>
                                            </h6>
                                            <p class="text-muted mb-2">We talked about a project on
                                                linkedin.</p>
                                            <small class="mb-0 text-muted">Today</small>
                                        </div>
                                    </div>
                                    <div class="acitivity-item py-3 d-flex">
                                        <div class="flex-shrink-0 avatar-xs acitivity-avatar">
                                            <div class="avatar-title bg-success-subtle text-success rounded-circle">
                                                N
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">Nancy Martino <span
                                                    class="badge bg-secondary-subtle text-secondary align-middle">In
                                                    Progress</span></h6>
                                            <p class="text-muted mb-2"><i class="ri-file-text-line align-middle ms-2"></i>
                                                Create new project Buildng product</p>
                                            <div class="avatar-group mb-2">
                                                <a href="javascript: void(0);" class="avatar-group-item"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Christi">
                                                    <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}"
                                                        alt="" class="rounded-circle avatar-xs" />
                                                </a>
                                                <a href="javascript: void(0);" class="avatar-group-item"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Frank Hook">
                                                    <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}"
                                                        alt="" class="rounded-circle avatar-xs" />
                                                </a>
                                                <a href="javascript: void(0);" class="avatar-group-item"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title=" Ruby">
                                                    <div class="avatar-xs">
                                                        <div class="avatar-title rounded-circle bg-light text-primary">
                                                            R
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="javascript: void(0);" class="avatar-group-item"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="more">
                                                    <div class="avatar-xs">
                                                        <div class="avatar-title rounded-circle">
                                                            2+
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <small class="mb-0 text-muted">Yesterday</small>
                                        </div>
                                    </div>
                                    <div class="acitivity-item py-3 d-flex">
                                        <div class="flex-shrink-0">
                                            <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt=""
                                                class="avatar-xs rounded-circle acitivity-avatar" />
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">Natasha Carey <span
                                                    class="badge bg-success-subtle text-success align-middle">Completed</span>
                                            </h6>
                                            <p class="text-muted mb-2">Adding a new event with
                                                attachments</p>
                                            <div class="row">
                                                <div class="col-xxl-4">
                                                    <div class="row border border-dashed gx-2 p-2 mb-2">
                                                        <div class="col-4">
                                                            <img src="{{ URL::asset('build/images/small/img-2.jpg') }}"
                                                                alt="" class="img-fluid rounded" />
                                                        </div>
                                                        <!--end col-->
                                                        <div class="col-4">
                                                            <img src="{{ URL::asset('build/images/small/img-3.jpg') }}"
                                                                alt="" class="img-fluid rounded" />
                                                        </div>
                                                        <!--end col-->
                                                        <div class="col-4">
                                                            <img src="{{ URL::asset('build/images/small/img-4.jpg') }}"
                                                                alt="" class="img-fluid rounded" />
                                                        </div>
                                                        <!--end col-->
                                                    </div>
                                                    <!--end row-->
                                                </div>
                                            </div>
                                            <small class="mb-0 text-muted">25 Nov</small>
                                        </div>
                                    </div>
                                    <div class="acitivity-item py-3 d-flex">
                                        <div class="flex-shrink-0">
                                            <img src="{{ URL::asset('build/images/users/avatar-6.jpg') }}" alt=""
                                                class="avatar-xs rounded-circle acitivity-avatar" />
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">Bethany Johnson</h6>
                                            <p class="text-muted mb-2">added a new member to velzon
                                                dashboard</p>
                                            <small class="mb-0 text-muted">19 Nov</small>
                                        </div>
                                    </div>
                                    <div class="acitivity-item py-3 d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-xs acitivity-avatar">
                                                <div class="avatar-title rounded-circle bg-danger-subtle text-danger">
                                                    <i class="ri-shopping-bag-line"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">Your order is placed <span
                                                    class="badge bg-danger-subtle text-danger align-middle ms-1">Out
                                                    of Delivery</span></h6>
                                            <p class="text-muted mb-2">These customers can rest assured
                                                their order has been placed.</p>
                                            <small class="mb-0 text-muted">16 Nov</small>
                                        </div>
                                    </div>
                                    <div class="acitivity-item py-3 d-flex">
                                        <div class="flex-shrink-0">
                                            <img src="{{ URL::asset('build/images/users/avatar-7.jpg') }}" alt=""
                                                class="avatar-xs rounded-circle acitivity-avatar" />
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">Lewis Pratt</h6>
                                            <p class="text-muted mb-2">They all have something to say
                                                beyond the words on the page. They can come across as
                                                casual or neutral, exotic or graphic. </p>
                                            <small class="mb-0 text-muted">22 Oct</small>
                                        </div>
                                    </div>
                                    <div class="acitivity-item py-3 d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-xs acitivity-avatar">
                                                <div class="avatar-title rounded-circle bg-info-subtle text-info">
                                                    <i class="ri-line-chart-line"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">Monthly sales report</h6>
                                            <p class="text-muted mb-2"><span class="text-danger">2 days
                                                    left</span> notification to submit the monthly sales
                                                report. <a href="javascript:void(0);"
                                                    class="link-warning text-decoration-underline">Reports
                                                    Builder</a></p>
                                            <small class="mb-0 text-muted">15 Oct</small>
                                        </div>
                                    </div>
                                    <div class="acitivity-item d-flex">
                                        <div class="flex-shrink-0">
                                            <img src="{{ URL::asset('build/images/users/avatar-8.jpg') }}" alt=""
                                                class="avatar-xs rounded-circle acitivity-avatar" />
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">New ticket received <span
                                                    class="badge bg-success-subtle text-success align-middle">Completed</span>
                                            </h6>
                                            <p class="text-muted mb-2">User <span class="text-secondary">Erica245</span>
                                                submitted a
                                                ticket.</p>
                                            <small class="mb-0 text-muted">26 Aug</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    <!--end tab-pane-->
                    <div class="tab-pane fade" id="projects" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xxl-3 col-sm-6">
                                        <div class="card profile-project-card shadow-none profile-project-warning">
                                            <div class="card-body p-4">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1 text-muted overflow-hidden">
                                                        <h5 class="fs-15 text-truncate"><a href="#"
                                                                class="text-body">Chat App Update</a>
                                                        </h5>
                                                        <p class="text-muted text-truncate mb-0">Last
                                                            Update : <span class="fw-semibold text-body">2 year
                                                                Ago</span></p>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-2">
                                                        <div class="badge bg-warning-subtle text-warning fs-11">
                                                            Inprogress</div>
                                                    </div>
                                                </div>

                                                <div class="d-flex mt-4">
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div>
                                                                <h5 class="fs-13 text-muted mb-0">
                                                                    Members :</h5>
                                                            </div>
                                                            <div class="avatar-group">
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}"
                                                                            alt="" class="rounded-circle img-fluid" />
                                                                    </div>
                                                                </div>
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}"
                                                                            alt="" class="rounded-circle img-fluid" />
                                                                    </div>
                                                                </div>
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <div
                                                                            class="avatar-title rounded-circle bg-light text-primary">
                                                                            J
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-3 col-sm-6">
                                        <div class="card profile-project-card shadow-none profile-project-success">
                                            <div class="card-body p-4">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1 text-muted overflow-hidden">
                                                        <h5 class="fs-15 text-truncate"><a href="#"
                                                                class="text-body">ABC Project
                                                                Customization</a></h5>
                                                        <p class="text-muted text-truncate mb-0">Last
                                                            Update : <span class="fw-semibold text-body">2 month
                                                                Ago</span></p>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-2">
                                                        <div class="badge bg-primary-subtle text-primary fs-11">
                                                            Progress</div>
                                                    </div>
                                                </div>

                                                <div class="d-flex mt-4">
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div>
                                                                <h5 class="fs-13 text-muted mb-0">
                                                                    Members :</h5>
                                                            </div>
                                                            <div class="avatar-group">
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <img src="{{ URL::asset('build/images/users/avatar-8.jpg') }}"
                                                                            alt="" class="rounded-circle img-fluid" />
                                                                    </div>
                                                                </div>
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <img src="{{ URL::asset('build/images/users/avatar-7.jpg') }}"
                                                                            alt="" class="rounded-circle img-fluid" />
                                                                    </div>
                                                                </div>
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <img src="{{ URL::asset('build/images/users/avatar-6.jpg') }}"
                                                                            alt="" class="rounded-circle img-fluid" />
                                                                    </div>
                                                                </div>
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <div
                                                                            class="avatar-title rounded-circle bg-primary">
                                                                            2+
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-3 col-sm-6">
                                        <div class="card profile-project-card shadow-none profile-project-info">
                                            <div class="card-body p-4">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1 text-muted overflow-hidden">
                                                        <h5 class="fs-15 text-truncate"><a href="#"
                                                                class="text-body">Client - Frank
                                                                Hook</a></h5>
                                                        <p class="text-muted text-truncate mb-0">Last
                                                            Update : <span class="fw-semibold text-body">1 hr
                                                                Ago</span></p>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-2">
                                                        <div class="badge bg-info-subtle text-info fs-11">New
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex mt-4">
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div>
                                                                <h5 class="fs-13 text-muted mb-0">
                                                                    Members :</h5>
                                                            </div>
                                                            <div class="avatar-group">
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}"
                                                                            alt="" class="rounded-circle img-fluid" />
                                                                    </div>
                                                                </div>
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <div
                                                                            class="avatar-title rounded-circle bg-light text-primary">
                                                                            M
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}"
                                                                            alt="" class="rounded-circle img-fluid" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-3 col-sm-6">
                                        <div class="card profile-project-card shadow-none profile-project-primary">
                                            <div class="card-body p-4">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1 text-muted overflow-hidden">
                                                        <h5 class="fs-15 text-truncate"><a href="#"
                                                                class="text-body">Velzon Project</a>
                                                        </h5>
                                                        <p class="text-muted text-truncate mb-0">Last
                                                            Update : <span class="fw-semibold text-body">11 hr
                                                                Ago</span></p>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-2">
                                                        <div class="badge bg-success-subtle text-success fs-11">
                                                            Completed</div>
                                                    </div>
                                                </div>

                                                <div class="d-flex mt-4">
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div>
                                                                <h5 class="fs-13 text-muted mb-0">
                                                                    Members :</h5>
                                                            </div>
                                                            <div class="avatar-group">
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <img src="{{ URL::asset('build/images/users/avatar-7.jpg') }}"
                                                                            alt="" class="rounded-circle img-fluid" />
                                                                    </div>
                                                                </div>
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}"
                                                                            alt="" class="rounded-circle img-fluid" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-3 col-sm-6">
                                        <div class="card profile-project-card shadow-none profile-project-danger">
                                            <div class="card-body p-4">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1 text-muted overflow-hidden">
                                                        <h5 class="fs-15 text-truncate"><a href="#"
                                                                class="text-body">Brand Logo Design</a>
                                                        </h5>
                                                        <p class="text-muted text-truncate mb-0">Last
                                                            Update : <span class="fw-semibold text-body">10 min
                                                                Ago</span></p>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-2">
                                                        <div class="badge bg-info-subtle text-info fs-11">New
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex mt-4">
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div>
                                                                <h5 class="fs-13 text-muted mb-0">
                                                                    Members :</h5>
                                                            </div>
                                                            <div class="avatar-group">
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <img src="{{ URL::asset('build/images/users/avatar-7.jpg') }}"
                                                                            alt="" class="rounded-circle img-fluid" />
                                                                    </div>
                                                                </div>
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <img src="{{ URL::asset('build/images/users/avatar-6.jpg') }}"
                                                                            alt="" class="rounded-circle img-fluid" />
                                                                    </div>
                                                                </div>
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <div
                                                                            class="avatar-title rounded-circle bg-light text-primary">
                                                                            E
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-3 col-sm-6">
                                        <div class="card profile-project-card shadow-none profile-project-primary">
                                            <div class="card-body p-4">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1 text-muted overflow-hidden">
                                                        <h5 class="fs-15 text-truncate"><a href="#"
                                                                class="text-body">Chat App</a></h5>
                                                        <p class="text-muted text-truncate mb-0">Last
                                                            Update : <span class="fw-semibold text-body">8 hr
                                                                Ago</span></p>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-2">
                                                        <div class="badge bg-warning-subtle text-warning fs-11">
                                                            Inprogress</div>
                                                    </div>
                                                </div>

                                                <div class="d-flex mt-4">
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div>
                                                                <h5 class="fs-13 text-muted mb-0">
                                                                    Members :</h5>
                                                            </div>
                                                            <div class="avatar-group">
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <div
                                                                            class="avatar-title rounded-circle bg-light text-primary">
                                                                            R
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}"
                                                                            alt="" class="rounded-circle img-fluid" />
                                                                    </div>
                                                                </div>
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <img src="{{ URL::asset('build/images/users/avatar-8.jpg') }}"
                                                                            alt="" class="rounded-circle img-fluid" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-3 col-sm-6">
                                        <div class="card profile-project-card shadow-none profile-project-warning">
                                            <div class="card-body p-4">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1 text-muted overflow-hidden">
                                                        <h5 class="fs-15 text-truncate"><a href="#"
                                                                class="text-body">Project Update</a>
                                                        </h5>
                                                        <p class="text-muted text-truncate mb-0">Last
                                                            Update : <span class="fw-semibold text-body">48 min
                                                                Ago</span></p>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-2">
                                                        <div class="badge bg-warning-subtle text-warning fs-11">
                                                            Inprogress</div>
                                                    </div>
                                                </div>

                                                <div class="d-flex mt-4">
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div>
                                                                <h5 class="fs-13 text-muted mb-0">
                                                                    Members :</h5>
                                                            </div>
                                                            <div class="avatar-group">
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <img src="{{ URL::asset('build/images/users/avatar-6.jpg') }}"
                                                                            alt="" class="rounded-circle img-fluid" />
                                                                    </div>
                                                                </div>
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}"
                                                                            alt="" class="rounded-circle img-fluid" />
                                                                    </div>
                                                                </div>
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}"
                                                                            alt="" class="rounded-circle img-fluid" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-3 col-sm-6">
                                        <div class="card profile-project-card shadow-none profile-project-success">
                                            <div class="card-body p-4">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1 text-muted overflow-hidden">
                                                        <h5 class="fs-15 text-truncate"><a href="#"
                                                                class="text-body">Client - Jennifer</a>
                                                        </h5>
                                                        <p class="text-muted text-truncate mb-0">Last
                                                            Update : <span class="fw-semibold text-body">30 min
                                                                Ago</span></p>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-2">
                                                        <div class="badge bg-primary-subtle text-primary fs-11">
                                                            Process</div>
                                                    </div>
                                                </div>

                                                <div class="d-flex mt-4">
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div>
                                                                <h5 class="fs-13 text-muted mb-0">
                                                                    Members :</h5>
                                                            </div>
                                                            <div class="avatar-group">
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}"
                                                                            alt="" class="rounded-circle img-fluid" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-3 col-sm-6">
                                        <div class="card profile-project-card shadow-none mb-xxl-0   profile-project-info">
                                            <div class="card-body p-4">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1 text-muted overflow-hidden">
                                                        <h5 class="fs-15 text-truncate"><a href="#"
                                                                class="text-body">Bsuiness Template -
                                                                UI/UX design</a></h5>
                                                        <p class="text-muted text-truncate mb-0">Last
                                                            Update : <span class="fw-semibold text-body">7 month
                                                                Ago</span></p>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-2">
                                                        <div class="badge bg-success-subtle text-success fs-11">
                                                            Completed</div>
                                                    </div>
                                                </div>
                                                <div class="d-flex mt-4">
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div>
                                                                <h5 class="fs-13 text-muted mb-0">
                                                                    Members :</h5>
                                                            </div>
                                                            <div class="avatar-group">
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                            alt="" class="rounded-circle img-fluid" />
                                                                    </div>
                                                                </div>
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}"
                                                                            alt="" class="rounded-circle img-fluid" />
                                                                    </div>
                                                                </div>
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}"
                                                                            alt="" class="rounded-circle img-fluid" />
                                                                    </div>
                                                                </div>
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <div
                                                                            class="avatar-title rounded-circle bg-primary">
                                                                            2+
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-3 col-sm-6">
                                        <div
                                            class="card profile-project-card shadow-none mb-xxl-0  profile-project-success">
                                            <div class="card-body p-4">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1 text-muted overflow-hidden">
                                                        <h5 class="fs-15 text-truncate"><a href="#"
                                                                class="text-body">Update Project</a>
                                                        </h5>
                                                        <p class="text-muted text-truncate mb-0">Last
                                                            Update : <span class="fw-semibold text-body">1 month
                                                                Ago</span></p>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-2">
                                                        <div class="badge bg-info-subtle text-info fs-11">New
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex mt-4">
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div>
                                                                <h5 class="fs-13 text-muted mb-0">
                                                                    Members :</h5>
                                                            </div>
                                                            <div class="avatar-group">
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <img src="{{ URL::asset('build/images/users/avatar-7.jpg') }}"
                                                                            alt="" class="rounded-circle img-fluid">
                                                                    </div>
                                                                </div>
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <div
                                                                            class="avatar-title rounded-circle bg-light text-primary">
                                                                            A
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-3 col-sm-6">
                                        <div class="card profile-project-card shadow-none mb-sm-0  profile-project-danger">
                                            <div class="card-body p-4">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1 text-muted overflow-hidden">
                                                        <h5 class="fs-15 text-truncate"><a href="#"
                                                                class="text-body">Bank Management
                                                                System</a></h5>
                                                        <p class="text-muted text-truncate mb-0">Last
                                                            Update : <span class="fw-semibold text-body">10 month
                                                                Ago</span></p>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-2">
                                                        <div class="badge bg-success-subtle text-success fs-11">
                                                            Completed</div>
                                                    </div>
                                                </div>
                                                <div class="d-flex mt-4">
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div>
                                                                <h5 class="fs-13 text-muted mb-0">
                                                                    Members :</h5>
                                                            </div>
                                                            <div class="avatar-group">
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <img src="{{ URL::asset('build/images/users/avatar-7.jpg') }}"
                                                                            alt="" class="rounded-circle img-fluid" />
                                                                    </div>
                                                                </div>
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <img src="{{ URL::asset('build/images/users/avatar-6.jpg') }}"
                                                                            alt="" class="rounded-circle img-fluid" />
                                                                    </div>
                                                                </div>
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}"
                                                                            alt="" class="rounded-circle img-fluid" />
                                                                    </div>
                                                                </div>
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <div
                                                                            class="avatar-title rounded-circle bg-primary">
                                                                            2+
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-3 col-sm-6">
                                        <div class="card profile-project-card shadow-none mb-0  profile-project-primary">
                                            <div class="card-body p-4">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1 text-muted overflow-hidden">
                                                        <h5 class="fs-15 text-truncate"><a href="#"
                                                                class="text-body">PSD to HTML
                                                                Convert</a></h5>
                                                        <p class="text-muted text-truncate mb-0">Last
                                                            Update : <span class="fw-semibold text-body">29 min
                                                                Ago</span></p>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-2">
                                                        <div class="badge bg-info-subtle text-info fs-11">New
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex mt-4">
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div>
                                                                <h5 class="fs-13 text-muted mb-0">
                                                                    Members :</h5>
                                                            </div>
                                                            <div class="avatar-group">
                                                                <div class="avatar-group-item">
                                                                    <div class="avatar-xs">
                                                                        <img src="{{ URL::asset('build/images/users/avatar-7.jpg') }}"
                                                                            alt="" class="rounded-circle img-fluid" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="mt-4">
                                            <ul class="pagination pagination-separated justify-content-center mb-0">
                                                <li class="page-item disabled">
                                                    <a href="javascript:void(0);" class="page-link"><i
                                                            class="mdi mdi-chevron-left"></i></a>
                                                </li>
                                                <li class="page-item active">
                                                    <a href="javascript:void(0);" class="page-link">1</a>
                                                </li>
                                                <li class="page-item">
                                                    <a href="javascript:void(0);" class="page-link">2</a>
                                                </li>
                                                <li class="page-item">
                                                    <a href="javascript:void(0);" class="page-link">3</a>
                                                </li>
                                                <li class="page-item">
                                                    <a href="javascript:void(0);" class="page-link">4</a>
                                                </li>
                                                <li class="page-item">
                                                    <a href="javascript:void(0);" class="page-link">5</a>
                                                </li>
                                                <li class="page-item">
                                                    <a href="javascript:void(0);" class="page-link"><i
                                                            class="mdi mdi-chevron-right"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    <!--end tab-pane-->
                    <div class="tab-pane fade" id="documents" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <h5 class="card-title flex-grow-1 mb-0">Documents</h5>
                                    <div class="flex-shrink-0">
                                        <input class="form-control d-none" type="file" id="formFile">
                                        <label for="formFile" class="btn btn-danger"><i
                                                class="ri-upload-2-fill me-1 align-bottom"></i> Upload
                                            File</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-borderless align-middle mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col">File Name</th>
                                                        <th scope="col">Type</th>
                                                        <th scope="col">Size</th>
                                                        <th scope="col">Upload Date</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm">
                                                                    <div
                                                                        class="avatar-title bg-primary-subtle text-primary rounded fs-20">
                                                                        <i class="ri-file-zip-fill"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="ms-3 flex-grow-1">
                                                                    <h6 class="fs-15 mb-0"><a
                                                                            href="javascript:void(0)">Artboard-documents.zip</a>
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>Zip File</td>
                                                        <td>4.57 MB</td>
                                                        <td>12 Dec 2021</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <a href="javascript:void(0);"
                                                                    class="btn btn-light btn-icon" id="dropdownMenuLink15"
                                                                    data-bs-toggle="dropdown" aria-expanded="true">
                                                                    <i class="ri-equalizer-fill"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-end"
                                                                    aria-labelledby="dropdownMenuLink15">
                                                                    <li><a class="dropdown-item"
                                                                            href="javascript:void(0);"><i
                                                                                class="ri-eye-fill me-2 align-middle text-muted"></i>View</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item"
                                                                            href="javascript:void(0);"><i
                                                                                class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a>
                                                                    </li>
                                                                    <li class="dropdown-divider"></li>
                                                                    <li><a class="dropdown-item"
                                                                            href="javascript:void(0);"><i
                                                                                class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm">
                                                                    <div
                                                                        class="avatar-title bg-danger-subtle text-danger rounded fs-20">
                                                                        <i class="ri-file-pdf-fill"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="ms-3 flex-grow-1">
                                                                    <h6 class="fs-15 mb-0"><a
                                                                            href="javascript:void(0);">Bank
                                                                            Management System</a></h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>PDF File</td>
                                                        <td>8.89 MB</td>
                                                        <td>24 Nov 2021</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <a href="javascript:void(0);"
                                                                    class="btn btn-light btn-icon" id="dropdownMenuLink3"
                                                                    data-bs-toggle="dropdown" aria-expanded="true">
                                                                    <i class="ri-equalizer-fill"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-end"
                                                                    aria-labelledby="dropdownMenuLink3">
                                                                    <li><a class="dropdown-item"
                                                                            href="javascript:void(0);"><i
                                                                                class="ri-eye-fill me-2 align-middle text-muted"></i>View</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item"
                                                                            href="javascript:void(0);"><i
                                                                                class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a>
                                                                    </li>
                                                                    <li class="dropdown-divider"></li>
                                                                    <li><a class="dropdown-item"
                                                                            href="javascript:void(0);"><i
                                                                                class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm">
                                                                    <div
                                                                        class="avatar-title bg-secondary-subtle text-secondary rounded fs-20">
                                                                        <i class="ri-video-line"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="ms-3 flex-grow-1">
                                                                    <h6 class="fs-15 mb-0"><a
                                                                            href="javascript:void(0);">Tour-video.mp4</a>
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>MP4 File</td>
                                                        <td>14.62 MB</td>
                                                        <td>19 Nov 2021</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <a href="javascript:void(0);"
                                                                    class="btn btn-light btn-icon" id="dropdownMenuLink4"
                                                                    data-bs-toggle="dropdown" aria-expanded="true">
                                                                    <i class="ri-equalizer-fill"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-end"
                                                                    aria-labelledby="dropdownMenuLink4">
                                                                    <li><a class="dropdown-item"
                                                                            href="javascript:void(0);"><i
                                                                                class="ri-eye-fill me-2 align-middle text-muted"></i>View</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item"
                                                                            href="javascript:void(0);"><i
                                                                                class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a>
                                                                    </li>
                                                                    <li class="dropdown-divider"></li>
                                                                    <li><a class="dropdown-item"
                                                                            href="javascript:void(0);"><i
                                                                                class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm">
                                                                    <div
                                                                        class="avatar-title bg-success-subtle text-success rounded fs-20">
                                                                        <i class="ri-file-excel-fill"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="ms-3 flex-grow-1">
                                                                    <h6 class="fs-15 mb-0"><a
                                                                            href="javascript:void(0);">Account-statement.xsl</a>
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>XSL File</td>
                                                        <td>2.38 KB</td>
                                                        <td>14 Nov 2021</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <a href="javascript:void(0);"
                                                                    class="btn btn-light btn-icon" id="dropdownMenuLink5"
                                                                    data-bs-toggle="dropdown" aria-expanded="true">
                                                                    <i class="ri-equalizer-fill"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-end"
                                                                    aria-labelledby="dropdownMenuLink5">
                                                                    <li><a class="dropdown-item"
                                                                            href="javascript:void(0);"><i
                                                                                class="ri-eye-fill me-2 align-middle text-muted"></i>View</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item"
                                                                            href="javascript:void(0);"><i
                                                                                class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a>
                                                                    </li>
                                                                    <li class="dropdown-divider"></li>
                                                                    <li><a class="dropdown-item"
                                                                            href="javascript:void(0);"><i
                                                                                class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm">
                                                                    <div
                                                                        class="avatar-title bg-info-subtle text-info rounded fs-20">
                                                                        <i class="ri-folder-line"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="ms-3 flex-grow-1">
                                                                    <h6 class="fs-15 mb-0"><a
                                                                            href="javascript:void(0);">Project
                                                                            Screenshots Collection</a>
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>Floder File</td>
                                                        <td>87.24 MB</td>
                                                        <td>08 Nov 2021</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <a href="javascript:void(0);"
                                                                    class="btn btn-light btn-icon" id="dropdownMenuLink6"
                                                                    data-bs-toggle="dropdown" aria-expanded="true">
                                                                    <i class="ri-equalizer-fill"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-end"
                                                                    aria-labelledby="dropdownMenuLink6">
                                                                    <li><a class="dropdown-item"
                                                                            href="javascript:void(0);"><i
                                                                                class="ri-eye-fill me-2 align-middle"></i>View</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item"
                                                                            href="javascript:void(0);"><i
                                                                                class="ri-download-2-fill me-2 align-middle"></i>Download</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item"
                                                                            href="javascript:void(0);"><i
                                                                                class="ri-delete-bin-5-line me-2 align-middle"></i>Delete</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm">
                                                                    <div
                                                                        class="avatar-title bg-danger-subtle text-danger rounded fs-20">
                                                                        <i class="ri-image-2-fill"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="ms-3 flex-grow-1">
                                                                    <h6 class="fs-15 mb-0"><a
                                                                            href="javascript:void(0);">Velzon-logo.png</a>
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>PNG File</td>
                                                        <td>879 KB</td>
                                                        <td>02 Nov 2021</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <a href="javascript:void(0);"
                                                                    class="btn btn-light btn-icon" id="dropdownMenuLink7"
                                                                    data-bs-toggle="dropdown" aria-expanded="true">
                                                                    <i class="ri-equalizer-fill"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-end"
                                                                    aria-labelledby="dropdownMenuLink7">
                                                                    <li><a class="dropdown-item"
                                                                            href="javascript:void(0);"><i
                                                                                class="ri-eye-fill me-2 align-middle"></i>View</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item"
                                                                            href="javascript:void(0);"><i
                                                                                class="ri-download-2-fill me-2 align-middle"></i>Download</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item"
                                                                            href="javascript:void(0);"><i
                                                                                class="ri-delete-bin-5-line me-2 align-middle"></i>Delete</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="text-center mt-3">
                                            <a href="javascript:void(0);" class="text-success "><i
                                                    class="mdi mdi-loading mdi-spin fs-20 align-middle me-2"></i>
                                                Load more </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!--end tab-pane-->
                </div>
                <!--end tab-content-->
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
@endsection
@section('script')

    <script>
        window.usersFollowUrl = @json(route('users.toggle-follow'));
        window.usersConnectUrl = @json(route('connections.send'));
        window.csrfToken = '{{ csrf_token() }}';
    </script>

    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('js/modules/users/settings.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/profile.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>

@endsection
