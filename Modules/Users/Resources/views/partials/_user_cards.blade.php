@forelse ($users as $user)
<div class="col-xl-3 col-lg-4 col-sm-6">
    <div class="ribbon-box right">

        <div class="card user-card shadow-sm overflow-hidden position-relative" data-user-id="{{ $user->id }}">

            @php
                $connection = auth()->user()->receivedConnections()
                    ->where('user_id', $user->id)
                    ->where('status', 'pending')
                    ->first();
            
                $notification = auth()->user()->notifications()
                    ->where('data->connection_id', $connection?->id)
                    ->first();
            @endphp
            
            @if ($connection)
                <div class="connection-banner position-absolute w-100 d-flex justify-content-between align-items-center ps-3 pe-2 py-2"
                    style="top: 0; left: 0; z-index: 2; background-color: rgba(63, 148, 121, 0.85);">
                    <strong class="text-white">Wants to Connect</strong>
                    <div>
                        <button class="btn btn-sm text-white me-1 btn-success deny-connection-btn"
                            style="border: 1px solid #fff;"
                            data-id="{{ $connection->id }}"
                            @if($notification) data-notification-id="{{ $notification->id }}" @endif>
                            Deny
                        </button>
                        <button class="btn btn-sm text-white btn-success accept-connection-btn"
                            style="border: 1px solid #fff;"
                            data-id="{{ $connection->id }}"
                            @if($notification) data-notification-id="{{ $notification->id }}" @endif>
                            Accept
                        </button>
                    </div>
                </div>
            @endif

            @php $status = $user->regionStatus(); @endphp

            @if ($status === 'local')
                <div class="ribbon ribbon-success">Local</div>
            @else
                <div class="ribbon ribbon-secondary">Visitor</div>
            @endif

            <div style="height: 100px; overflow: hidden;">
                <img src="{{ $user->cover_photo ? asset('storage/' . $user->cover_photo) : asset('build/images/profile-bg.jpg') }}"
                    class="img-fluid w-100"
                    style="object-fit: cover; object-position: center;">
            </div>

            <div class="card-body text-center pt-4">

                <div class="mx-auto mb-3"
                    style="width: 80px; height: 80px; border-radius: 50%; margin-top: -60px;
                        overflow: hidden; background-image: url('{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('build/images/users/avatar-1.jpg') }}');
                        background-size: cover; background-position: center; background-color: #fff;
                        border: 3px solid #fff; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
                </div>

                <h5 class="fs-16 mb-0">{{ $user->first_name }} {{ $user->last_name }}</h5>

                @if (!empty($user->title))
                    <p class="fw-semibold text-primary small mb-1">{{ $user->title }}</p>
                @endif

                <p class="text-muted small fst-italic mb-2">
                    {{ Str::limit($user->bio ?? 'No bio provided.', 80) }}
                </p>

                <div class="d-flex justify-content-center gap-2 mt-3">


                    <a href="{{ route('profile.show', $user->id) }}" class="btn btn-sm btn-outline-primary">
                        <i class="ri-eye-line me-1"></i>View
                    </a>
                    

                    @if (auth()->id() !== $user->id)
                    @php
                    $isFollowing = auth()->user()->isFollowing($user);
                @endphp
                
                <button type="button"
                    class="btn btn-sm btn-outline-success {{ $isFollowing ? 'following-btn' : 'follow-btn' }}"
                    data-id="{{ $user->id }}"
                    style="min-width: 100px; padding: 0.25rem 0.5rem;">
                    {!! $isFollowing
                        ? '<i class="ri-user-follow-line align-bottom"></i> Following'
                        : '<i class="ri-user-follow-line align-bottom"></i> Follow' !!}
                </button>

                        @php
                            $auth = auth()->user();
                            $isConnected = $auth->isConnectedWith($user);
                            $hasPendingSent = $auth->hasPendingConnectionWith($user);
                            $hasPendingReceived = $connection !== null;
                        @endphp

                        @if ($isConnected)
                            <button class="btn btn-sm btn-secondary" disabled>
                                <i class="ri-link align-bottom"></i> Connected
                            </button>
                        @elseif ($hasPendingSent || $hasPendingReceived)
                        <button class="btn btn-sm btn-outline-warning pending-connection-btn" disabled data-id="{{ $user->id }}"
                            style="min-width: 100px; text-align:left;">
                            <i class="ri-time-line align-bottom me-1"></i>
                            <span class="pending-text">Connection</span>
                        </button>
                        @else
                            <button class="btn btn-sm btn-outline-info connect-btn" data-id="{{ $user->id }}">
                                <i class="ri-link align-bottom"></i> Connect
                            </button>
                        @endif
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@empty
<div class="col-12">
    <div class="alert alert-warning text-center">
        No users found.
    </div>
</div>
@endforelse