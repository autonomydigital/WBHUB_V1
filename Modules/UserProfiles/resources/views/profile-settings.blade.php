@extends('layouts.master')
@section('title')
    @lang('translation.settings')
@endsection
@section('content')
<form method="POST"
action="{{ route('updateCoverPhoto', $authUser->id) }}"
enctype="multipart/form-data"
id="cover-upload-form">
@csrf

<div class="position-relative mx-n4 mt-n4">
  <div class="profile-wid-bg profile-setting-img">
    <img id="cover-photo-img"
    src="{{ $authUser->cover_photo ? asset('storage/' . $authUser->cover_photo) : asset('build/images/profile-bg.jpg') }}"
    class="profile-wid-img" alt="cover-photo">

      <div class="overlay-content">
        <div class="text-end p-3 d-flex justify-content-end gap-2">

            
        
            <!-- Choose Cover Button -->
            <div class="rounded-circle profile-photo-edit">
                <button type="button"
                        class="profile-photo-edit btn btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#chooseCoverModal">
                    <i class="ri-gallery-line align-bottom me-1"></i> Choose Cover
                </button>
            </div>

            <!-- Upload Cover Button -->
            <div class="rounded-circle profile-photo-edit">
                <input id="profile-foreground-img-file-input"
                       name="cover_photo"
                       type="file"
                       class="profile-foreground-img-file-input"
                       onchange="uploadCoverPhoto(this)">
                <label for="profile-foreground-img-file-input" class="profile-photo-edit btn btn-primary">
                    <i class="ri-upload-2-line align-bottom me-1"></i> Upload
                </label>
            </div>
        
        </div>
      </div>
  </div>
</div>
</form>

<!-- Modal -->
<div class="modal fade" id="chooseCoverModal" tabindex="-1" aria-labelledby="chooseCoverModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Choose a Default Cover</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3" id="default-cover-grid">
            <!-- Thumbnails will be injected here -->
          </div>
        </div>
      </div>
    </div>
  </div>

    <div class="row">
        <div class="col-xxl-3">
            <form method="POST"
      action="{{ route('updateProfile', $authUser->id) }}"
      enctype="multipart/form-data"
      id="avatar-upload-form">
    @csrf

    <div class="card mt-n5">
        <div class="card-body p-4">
            <div class="text-center">
                <div class="profile-user position-relative d-inline-block mx-auto mb-4">
                    <img id="user-avatar-img"
                         src="{{ $authUser->avatar ? asset('storage/' . $authUser->avatar) : asset('build/images/users/avatar-1.jpg') }}"
                         class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                         alt="user-profile-image">

                    <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                        <input id="profile-img-file-input"
                               name="avatar"
                               type="file"
                               class="profile-img-file-input"
                               onchange="uploadAvatar(this)">
                        <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                            <span class="avatar-title rounded-circle bg-light text-body">
                                <i class="ri-camera-fill"></i>
                            </span>
                        </label>
                    </div>
                </div>

                <h5 class="fs-17 mb-1">{{ $authUser->first_name }} {{ $authUser->last_name }}</h5>
                <p class="text-muted mb-0">{{ $authUser->email }}</p>
            </div>
        </div>
    </div>
</form>
            <!--end card-->
            @php
            $completion = $authUser->profileCompletionPercent();
            $barClass = $completion < 40 ? 'bg-danger' : ($completion < 75 ? 'bg-warning' : 'bg-success');
        @endphp
        
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-5">
                    <div class="flex-grow-1">
                        <h5 class="card-title mb-0">Complete Your Profile</h5>
                    </div>
                    <div class="flex-shrink-0">
                        {{-- <a href="{{ route('profile.settings') }}" class="badge bg-light text-primary fs-12">
                            <i class="ri-edit-box-line align-bottom me-1"></i> Edit
                        </a> --}}
                    </div>
                </div>
        
                <div class="progress animated-progress custom-progress progress-label">
                    <div id="profile-progress-bar"
                         class="progress-bar {{ $barClass }}"
                         role="progressbar"
                         style="width: {{ $completion }}%"
                         aria-valuenow="{{ $completion }}"
                         aria-valuemin="0"
                         aria-valuemax="100">
                        <div class="label" id="profile-progress-label">{{ $completion }}%</div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <form id="socialsForm" method="POST" action="{{ route('updateSocials', auth()->id()) }}">
            @csrf
            <div class="card" id="socialsCard">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-0">Socials</h5>
                        </div>
                        <div class="flex-shrink-0 position-relative">
                            <a href="javascript:void(0);" id="socialAddButton" class="badge bg-light text-primary fs-12">
                                <i class="ri-add-fill align-bottom me-1"></i> Add
                            </a>
        
                            <!-- Popover -->
                            <div id="socialPopover" class="card shadow-sm position-absolute" style="display:none; top: 100%; right: 0; z-index: 1050; width: 280px;">
                                <div class="card-body py-2 px-2 text-center">
                                    <div class="d-flex flex-wrap justify-content-center gap-2">
                                        @php
                                            $platforms = [
                                                ['name' => 'Facebook',  'icon' => 'ri-facebook-fill',  'color' => 'bg-primary'],
                                                ['name' => 'Instagram', 'icon' => 'ri-instagram-fill', 'color' => 'bg-pink'],
                                                ['name' => 'X',         'icon' => 'ri-twitter-x-fill', 'color' => 'bg-dark'],
                                                ['name' => 'YouTube',   'icon' => 'ri-youtube-fill',   'color' => 'bg-danger'],
                                                ['name' => 'TikTok',    'icon' => 'ri-tiktok-fill',    'color' => 'bg-dark'],
                                                ['name' => 'GitHub',    'icon' => 'ri-github-fill',    'color' => 'bg-dark'],
                                                ['name' => 'Dribbble',  'icon' => 'ri-dribbble-fill',  'color' => 'bg-danger'],
                                                ['name' => 'Pinterest', 'icon' => 'ri-pinterest-fill', 'color' => 'bg-danger'],
                                                ['name' => 'Website',   'icon' => 'ri-global-fill',    'color' => 'bg-info'],
                                            ];
                                        @endphp
        
                                        @foreach ($platforms as $platform)
                                        <button type="button"
                                            class="border-0 bg-transparent p-0"
                                            style="width: 48px; height: 48px;"
                                            onclick="addSocialInput('{{ $platform['name'] }}', '{{ $platform['icon'] }}', '{{ $platform['color'] }}'); hideSocialPopover();"
                                            title="{{ $platform['name'] }}">
                                            <span class="avatar-title d-inline-flex align-items-center justify-content-center rounded-circle {{ $platform['color'] }}" style="width: 100%; height: 100%;">
                                                <i class="{{ $platform['icon'] }} text-white fs-2"></i>
                                            </span>
                                        </button>
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div id="socialsContainer">
                        @if ($user->socials->count() === 0)
                            <div class="text-muted text-center py-3" id="noSocialsMessage">
                                <i class="ri-share-line fs-3 d-block mb-2"></i>
                                Add your social media details here so people can connect with you.
                            </div>
                        @else
                            @foreach ($user->socials as $social)
                                <div class="mb-3 d-flex align-items-center social-input-row">
                                    <div class="avatar-xs d-block flex-shrink-0 me-3">
                                        <span class="avatar-title rounded-circle fs-4 {{ $social->color ?? 'bg-secondary' }}">
                                            <i class="{{ $social->icon ?? 'ri-global-fill' }} text-white"></i>
                                        </span>
                                    </div>
                                    <input type="hidden" name="socials[{{ $social->platform }}][platform]" value="{{ $social->platform }}">
                                    <input type="hidden" name="socials[{{ $social->platform }}][color]" value="{{ $social->color }}">
                                    <input type="hidden" name="socials[{{ $social->platform }}][icon]" value="{{ $social->icon }}">
                                    <input type="text" class="form-control me-2" name="socials[{{ $social->platform }}][handle]"
                                    value="{{ $social->handle }}" placeholder="{{ ucfirst($social->platform) }} handle">
                                <div class="invalid-feedback">
                                    Please enter your {{ ucfirst($social->platform) }} handle.
                                </div>        
                                    {{-- Trash Icon --}}
                                    <button
                                    type="button"
                                    class="btn btn-sm btn-icon btn-light"
                                    onclick="deleteSocial(this, '{{ $social->platform }}')">
                                    <i class="ri-delete-bin-line text-danger"></i>
                                </button>
                                </div>
                            @endforeach
                        @endif
                    </div>
        
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>
        </form>
            <!--end card-->
        </div>
        <!--end col-->
        <div class="col-xxl-9">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                <i class="fas fa-home"></i>
                                Personal Details
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                <i class="far fa-user"></i>
                                Change Password
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#experience" role="tab">
                                <i class="far fa-envelope"></i>
                                Experience
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#privacy" role="tab">
                                <i class="far fa-envelope"></i>
                                Privacy
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                            <div class="card bg-body border-dark border-4  shadow-sm mb-4">
                                <div class="card-body">
                                    <div class="d-flex position-relative align-items-center">
                                        <img src="{{ asset('images/details-icon.jpg') }}" class="flex-shrink-0 me-4 avatar-xl rounded" alt="Manage Details Icon">
                                        <div>
                                            <h5 class="mt-0 fw-semibold $text-light">Manage your details confidently</h5>
                                            <p class="text-muted mb-1">
                                                Keeping your personal information up to date helps us tailor your experience and keep your account secure. 
                                                At WB Hub, you're in full control—only you decide what to share, and everything is protected with care.
                                            </p>
                                            <a href="javascript:void(0);" class="stretched-link text-primary fw-medium">Learn more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form id="profileUpdateForm" method="POST" action="{{ route('updateProfile', auth()->id()) }}">
                                @csrf
                                <div class="row">
                            
                                    <!-- First Name -->
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="first_name" class="form-control" id="firstnameInput" placeholder="First Name" value="{{ $authUser->first_name }}">
                                            <label for="firstnameInput">First Name</label>
                                        </div>
                                    </div>
                            
                                    <!-- Last Name -->
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="last_name" class="form-control" id="lastnameInput" placeholder="Last Name" value="{{ $authUser->last_name }}">
                                            <label for="lastnameInput">Last Name</label>
                                        </div>
                                    </div>
                            
                                    <!-- Phone -->
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="phone" class="form-control" id="phonenumberInput" placeholder="Phone Number" value="{{ $authUser->phone }}">
                                            <label for="phonenumberInput">Phone Number</label>
                                        </div>
                                    </div>
                            
                                    <!-- Email -->
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="email" name="email" class="form-control" id="emailInput" placeholder="Email Address" value="{{ $authUser->email }}">
                                            <label for="emailInput">Email Address</label>
                                        </div>
                                    </div>
                            
                                    <!-- Bio -->
                                    <div class="col-lg-12">
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" name="bio" id="bioInput" placeholder="Enter your bio" style="height: 100px">{{ $authUser->bio }}</textarea>
                                            <label for="bioInput">Bio</label>
                                        </div>
                                    </div>
                            
                                    <!-- Suburb -->
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="suburb" class="form-control" id="suburbInput" placeholder="Suburb" value="{{ $authUser->suburb }}">
                                            <label for="suburbInput">Suburb</label>
                                        </div>
                                    </div>
                            
                                    <!-- State -->
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="state" class="form-control" id="stateInput" placeholder="State" value="{{ $authUser->state }}">
                                            <label for="stateInput">State</label>
                                        </div>
                                    </div>
                            
                                    <!-- Zip Code -->
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="postcode" class="form-control" id="zipcodeInput" placeholder="Postcode" value="{{ $authUser->postcode }}">
                                            <label for="zipcodeInput">Postcode</label>
                                        </div>
                                    </div>
                            
                                    <!-- Submit -->
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-success">Update Details</button>
                                            
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane fade" id="changePassword" role="tabpanel">
                            <div class="card bg-body border-dark border-4  shadow-sm mb-4">
                                <div class="card-body">
                                    <div class="d-flex position-relative align-items-center">
                                        <img src="{{ asset('images/password-icon.jpg') }}" class="flex-shrink-0 me-4 avatar-xl rounded" alt="Security Icon">
                                        <div>
                                            <h5 class="mt-0 fw-semibold $text-light">Security starts with you</h5>
                                            <p class="text-muted mb-1">
                                                Strong passwords and secure login practices are the foundation of your protection on WB Hub.
                                                Manage your password and monitor recent logins to stay in control of your account's safety.
                                            </p>
                                            <a href="javascript:void(0);" class="stretched-link text-primary fw-medium">Learn more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row g-4">
                                <!-- Change Password -->
                                <!-- Change Password -->
<!-- Change Password -->
<div class="col-lg-6">
    <form id="changePasswordForm" method="POST" action="{{ route('updatePassword', auth()->id()) }}">
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="border border-light-subtle rounded shadow-sm p-3 mb-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h5 class="fs-16 fw-semibold mb-0 $text-light">Change Password</h5>
                <a href="{{ route('password.request') }}" class="btn btn-sm  passwordButton btn-outline-secondary">Forgot Password?</a>
            </div>
            <hr class="mt-2 mb-3">

            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="oldpasswordInput" name="current_password" placeholder="Current Password">
                <label for="oldpasswordInput">Current Password</label>
                <div class="invalid-feedback" id="error-current_password"></div>
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="newpasswordInput" name="new_password" placeholder="New Password">
                <label for="newpasswordInput">New Password</label>
                <div class="invalid-feedback" id="error-new_password"></div>
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="confirmpasswordInput" name="new_password_confirmation" placeholder="Confirm Password">
                <label for="confirmpasswordInput">Confirm Password</label>
                <div class="invalid-feedback" id="error-new_password_confirmation"></div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn passButtonSave btn-success">Change Password</button>
            </div>
        </div>
    </form>
</div>

<!-- Login History -->
<div class="col-lg-6">
    <div class="border border-light-subtle rounded shadow-sm p-3 mb-4 h-100 d-flex flex-column">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="fs-16 fw-semibold mb-0 $text-light">Login History</h5>
            <button type="button" class="btn btn-sm btn-outline-danger" id="clear-history-btn">
                Clear History
            </button>
        </div>
        <hr class="mt-2 mb-3">

        <div id="loginHistoryScroll" class="scroll-container flex-grow-1" data-simplebar data-simplebar-auto-hide="false" data-simplebar-track="primary" style="min-height: 0;">

            @if ($history->isNotEmpty())
                @foreach ($history as $entry)
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-shrink-0 avatar-sm">
                            <div class="avatar-title bg-light text-primary rounded-3 fs-2">
                                <i class="{{ Str::contains(strtolower($entry->device), 'mobile') ? 'ri-smartphone-line' : 'ri-macbook-line' }}"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">{{ $entry->device }}</h6>
                            <p class="text-muted mb-0" style="font-size: 9pt;">
                                {{ $entry->city && $entry->country ? "{$entry->city}, {$entry->country}" : 'Unknown location' }}<br>
                                {{ \Carbon\Carbon::parse($entry->logged_in_at)->format('M d, Y \a\t h:i A') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="d-flex flex-column align-items-center justify-content-center text-center p-5">
                    <div class="mb-3">
                        <i class="ri-history-line text-muted" style="font-size: 64px;"></i>
                    </div>
                    <h6 class="text-muted">No login history found.</h6>
                </div>
            @endif
        </div>
    </div>
</div>
                            </div>
                        </div>
                        
                        <!--end tab-pane-->
                        <div class="tab-pane" id="privacy" role="tabpanel">
                            <div class="card bg-body border-dark border-4  shadow-sm mb-4">
                                <div class="card-body">
                                    <div class="d-flex position-relative align-items-center">
                                        <img src="{{ asset('images/privacy-icon.jpg') }}" class="flex-shrink-0 me-4 avatar-xl rounded" alt="Privacy Icon">
                                        <div>
                                            <h5 class="mt-0 fw-semibold $text-light">Your privacy matters</h5>
                                            <p class="text-muted mb-1">
                                                We’ve built the platform to ensure you have full control over your personal information, with tools that let you decide what to share and how it’s used. Your activity stays secure, and your identity is protected every step of the way.
                                            </p>
                                            <a href="javascript:void(0);" class="stretched-link text-primary fw-medium">Learn more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Left Nav Pills -->
                                <div class="col-lg-3">
                                    <div class="nav flex-column nav-pills nav-pills-tab custom-verti-nav-pills text-center gap-2" role="tablist" aria-orientation="vertical">
                                        <button class="nav-link active text-center" id="security-tab" data-bs-toggle="pill" data-bs-target="#security"
                                            type="button" role="tab" aria-controls="security" aria-selected="true">
                                            <i class="ri-shield-user-line d-block fs-20 mb-1"></i> Security
                                        </button>
                                        <button class="nav-link text-center" id="notifications-tab" data-bs-toggle="pill" data-bs-target="#notifications"
                                            type="button" role="tab" aria-controls="notifications" aria-selected="false">
                                            <i class="ri-notification-3-line d-block fs-20 mb-1"></i> Notifications
                                        </button>
                                        <button class="nav-link text-center" id="delete-tab" data-bs-toggle="pill" data-bs-target="#delete-account"
                                            type="button" role="tab" aria-controls="delete-account" aria-selected="false">
                                            <i class="ri-delete-bin-line d-block fs-20 mb-1"></i> Delete Account
                                        </button>
                                    </div>
                                </div>
                            
                                <!-- Right Tab Content -->
                                <div class="col-lg-9">
                                    <div class="tab-content text-muted mt-3 mt-lg-0">
                            
                                        <!-- Security Tab -->
                                        <div class="tab-pane fade show active" id="security" role="tabpanel" aria-labelledby="security-tab">
                            
<!-- Two-factor Authentication -->
<div class="d-flex flex-column mb-4 p-3 border border-light-subtle rounded shadow-sm position-relative">
    <div class="d-flex justify-content-between align-items-start mb-2">
        <h6 class="fs-15 mb-0">Two-factor Authentication</h6>
        <div class="form-check form-switch">
            <input class="form-check-input security-toggle" type="checkbox"
                   data-setting="two_factor_enabled"
                   {{ auth()->user()->two_factor_enabled ? 'checked' : '' }}>
        </div>
    </div>
    <hr class="mt-0 mb-2">
    <p class="text-muted pt-2 mb-0">
        Once enabled, you'll be required to provide two forms of identification when logging in.
        Google Authenticator and SMS are supported.
    </p>
</div>

<!-- Secondary Verification -->
<div class="d-flex flex-column mb-4 p-3 border border-light-subtle rounded shadow-sm position-relative">
    <div class="d-flex justify-content-between align-items-start mb-2">
        <h6 class="fs-15 mb-0">Secondary Verification</h6>
        <div class="form-check form-switch">
            <input class="form-check-input security-toggle" type="checkbox"
                   data-setting="secondary_verification"
                   {{ auth()->user()->secondary_verification ? 'checked' : '' }}>
        </div>
    </div>
    <hr class="mt-0 mb-2">
    <p class="text-muted pt-2 mb-0">
        The second factor typically includes a code sent via SMS or biometrics like fingerprint or face recognition.
    </p>
</div>
<!-- Backup Codes -->
<div class="d-flex flex-column mb-4 p-3 border border-light-subtle rounded shadow-sm position-relative">
    <div class="d-flex justify-content-between align-items-start mb-2">
        <h6 class="fs-15 mb-0">Backup Codes</h6>
        <a href="javascript:void(0);" class="btn btn-sm btn-success">Generate Codes</a>
    </div>
    <hr class="mt-0 mb-2">
    <p class="text-muted pt-2 mb-0">
        Backup codes allow login when you're unable to access your 2FA device. Generate them and store them securely.
    </p>
</div>                            
</div>      

                        <!-- Notifications Tab -->
                                        <div class="tab-pane fade" id="notifications" role="tabpanel" aria-labelledby="notifications-tab">
                                        
                                            @foreach([
                                                ['id' => 'directMessage', 'label' => 'Direct messages', 'desc' => 'Messages from people you follow.', 'checked' => true],
                                                ['id' => 'desktopNotification', 'label' => 'Show desktop notifications', 'desc' => 'Choose your default setting.'],
                                                ['id' => 'emailNotification', 'label' => 'Show email notifications', 'desc' => 'Choose the account to enable notifications for.'],
                                                ['id' => 'chatNotification', 'label' => 'Show chat notifications', 'desc' => 'Avoid duplicate mobile notifications.'],
                                                ['id' => 'purchaseNotification', 'label' => 'Show purchase notifications', 'desc' => 'Get real-time alerts to protect from fraud.'],
                                            ] as $notif)
                                                <div class="d-flex flex-column flex-sm-row mb-4 p-3 border border-light-subtle rounded shadow-sm position-relative">
                                                    <div class="flex-grow-1">
                                                        <h6 class="fs-15 mb-1">{{ $notif['label'] }}</h6>
                                                        <p class="text-muted mb-0">{{ $notif['desc'] }}</p>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-sm-3 align-self-start">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" id="{{ $notif['id'] }}" {{ $notif['checked'] ?? false ? 'checked' : '' }} />
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                            
                                        <!-- Delete Account Tab -->
                                        <div class="tab-pane fade" id="delete-account" role="tabpanel" aria-labelledby="delete-tab">
                                            <div class="card border-0 bg-danger-subtle text-white shadow mb-4">
                                                <div class="card-body d-flex flex-column flex-sm-row align-items-center">
                                                    <div class="flex-shrink-0 mb-3 mb-sm-0 me-sm-4">
                                                        <div class="rounded-circle d-flex align-items-center justify-content-center shadow"
                                                            style="width: 80px; height: 80px; background-color: #dc5c5c;">
                                                            <i class="ri-shield-user-line text-white" style="font-size: 38px;"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h4 class="text-white mb-2">Deleting Your Account</h4>
                                                        <p class="mb-0">
                                                            This is a permanent action. Your profile and all associated data will be removed and cannot be recovered. Confirm your password to continue.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <form class="row gy-3 gx-3 align-items-end" style="max-width: 600px;">
                                                <div class="col-12 col-sm-8">
                                                    <label for="deletePasswordInput" class="form-label text-white">Password</label>
                                                    <input type="password" class="form-control bg-light text-dark" id="deletePasswordInput" placeholder="Enter your password">
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <label class="form-label text-white d-sm-none">&nbsp;</label>
                                                    <button type="submit" class="btn btn-danger w-100">
                                                        <i class="ri-close-circle-line me-1 align-middle"></i> Delete Account
                                                    </button>
                                                </div>
                                            </form>
                                        
                                        </div>
                            
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end tab-pane-->
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
@endsection

@section('script')
<script>
     window.validatePasswordUrl = "{{ route('validateCurrentPassword') }}";
    window.defaultCoverUrl = "{{ route('defaultCovers') }}";
    window.chooseCoverUrl = "{{ route('chooseCover') }}";
    window.loginHistoryClearUrl = "{{ route('loginHistory.clear') }}";
</script>

<script src="https://unpkg.com/@popperjs/core@2"></script>

@vite(['resources/js/profile-settings.js'])
@endsection