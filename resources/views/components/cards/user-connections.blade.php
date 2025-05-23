@props(['user'])

@php
    $connections = $user->connections;
@endphp

<div class="card border shadow-sm text-white">
    <div class="card-body">
        <div class="d-flex align-items-center mb-4">
            <div class="flex-grow-1">
                <h5 class="card-title mb-0 text-white">Connections</h5>
            </div>
            <div class="flex-shrink-0">
                <div class="dropdown">
                    <a href="#" role="button" id="connectionsDropdown"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ri-more-2-fill fs-14 text-white-50"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="connectionsDropdown">
                        <li><a class="dropdown-item" href="#">View All</a></li>
                    </ul>
                </div>
            </div>
        </div>

        @if ($connections->isNotEmpty())
            @foreach ($connections as $connection)
                <div class="d-flex align-items-center py-3">
                    <div class="avatar-xs flex-shrink-0 me-3">
                        <img src="{{ $connection->avatar ? asset('storage/' . $connection->avatar) : asset('build/images/users/avatar-1.jpg') }}"
                        alt="{{ $connection->full_name }}"
                        class="img-fluid rounded-circle" />
                    </div>
                    <div class="flex-grow-1">
                        <div>
                            <h5 class="fs-15 mb-1 text-white">{{ $connection->full_name }}</h5>
                            <p class="fs-14 text-white-50 mb-0">{{ $connection->title ?? 'Member' }}</p>
                        </div>
                    </div>
                    <div class="flex-shrink-0 ms-2">
                        <a href="{{ route('profile.show', $connection->id) }}"
                            class="btn btn-sm btn-outline-light">
                             <i class="ri-user-line align-middle"></i>
                         </a>
                    </div>
                </div>
            @endforeach
            @else
            <div class="text-center">
                <div class="avatar-md mx-auto mb-3">
                    <span class="avatar-title bg-light text-muted rounded-circle fs-24">
                        <i class="ri-user-shared-line"></i>
                    </span>
                </div>
                <p class="mb-0 text-muted fst-italic">No connections yet.</p>
            </div>
        @endif
    </div>
</div>
