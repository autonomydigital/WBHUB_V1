@extends('layouts.master')
@section('title')
@lang('translation.users')
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1')
Pages
@endslot
@slot('title')
Users
@endslot
@endcomponent

<div class="card">
    <div class="card-body">
        <div class="row g-2">
            <div class="col-sm-4">
                <div class="search-box">
                    <input type="text" class="form-control" id="searchMemberList" placeholder="Search for name or email...">
                    <i class="ri-search-line search-icon"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="row team-list grid-view-filter" id="team-member-list">
            @foreach ($users as $user)
                <div class="col-xxl-3 col-lg-3 col-md-6">
                    <div class="card team-box">
                        <!-- Cover Image from DB -->
                        <div class="team-cover">
                            <img src="{{ asset('storage/' . $user->cover_photo) }}" class="img-fluid" alt="cover" />
                                                </div>
        
                        <div class="card-body p-4">
                            <div class="row align-items-center team-row">
        
                                <!-- Top Right Tools -->
                                <div class="col team-settings">
                                    <div class="row">
                                        <div class="col">
                                            <div class="flex-shrink-0 me-2">
                                                <button type="button" class="btn btn-light btn-icon rounded-circle btn-sm favourite-btn">
                                                    <i class="ri-star-fill fs-14"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col text-end dropdown">
                                            <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill fs-17"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item edit-list" href="#addmemberModal" data-bs-toggle="modal"><i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit</a></li>
                                                <li><a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal"><i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
        
                                <!-- Profile Info -->
                                <div class="col-lg-4 col">
                                    <div class="team-profile-img">
                                        <div class="avatar-lg">
                                            <img src="@if ($user->avatar) {{ asset('storage/' . $user->avatar) }} @else {{ asset('build/images/users/user-dummy-img.jpg') }} @endif"
                                                alt="avatar"
                                                class="img-thumbnail rounded-circle object-fit-cover"
                                                style="width: 90px; height: 90px;" />
                                        </div>
                                        <div class="team-content">
                                            <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">
                                                <h5 class="fs-16 mb-1">{{ $user->first_name }} {{ $user->last_name }}</h5>
                                            </a>
                                            <p class="text-muted member-designation mb-0">{{ $user->designation ?? 'Member' }}</p>
                                        </div>
                                    </div>
                                </div>
        
                                <!-- Projects/Tasks -->
                                <div class="col-lg-4 col">
                                    <div class="row text-muted text-center">
                                        <div class="col-6 border-end border-end-dashed">
                                            <h5 class="mb-1 projects-num">0</h5>
                                            <p class="text-muted mb-0">Projects</p>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="mb-1 tasks-num">0</h5>
                                            <p class="text-muted mb-0">Tasks</p>
                                        </div>
                                    </div>
                                </div>
        
                                <!-- View Button -->
                                <div class="col-lg-2 col">
                                    <div class="text-end">
                                        <a href="{{ route('users.profile', $user->id) }}" class="btn btn-light view-btn">View Profile</a>
                                    </div>
                                </div>
        
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
