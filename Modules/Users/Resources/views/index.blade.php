@extends('layouts.master')

@section('title') Users @endsection

@section('content')
<div class="row mb-4 align-items-center g-2">
    <div class="col-md-auto">
        <div class="btn-group" role="group" aria-label="User Filters">
            <button type="button" class="btn btn-outline-primary" id="filterFollowingBtn">
                <i class="ri-eye-line me-1"></i> Following
            </button>
            <button type="button" class="btn btn-outline-success" id="filterConnectedBtn">
                <i class="ri-link-line me-1"></i> Connected
            </button>
        </div>
    </div>

    <div class="col-md">
        <input type="text" id="searchInput" class="form-control" placeholder="Search users...">
    </div>

    <div class="col-md-auto">
        <select id="roleFilter" class="form-select" data-choices>
            <option value="">Filter Roles</option>
            <option value="superadmin">Super Admin</option>
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>
    </div>

    <div class="col-md-auto">
        <select id="sortSelect" class="form-select" data-choices>
            <option value="">Sort</option>
            <option value="latest" selected>Newest First</option>
            <option value="name_asc">Name A–Z</option>
            <option value="name_desc">Name Z–A</option>
            <option value="email_asc">Email A–Z</option>
            <option value="email_desc">Email Z–A</option>
            <option value="suburb_asc">Suburb A–Z</option>
            <option value="suburb_desc">Suburb Z–A</option>
        </select>
    </div>

    <div class="col-md-auto">
        <button id="resetFilters" class="btn btn-outline-secondary w-100">
            <i class="ri-refresh-line me-1"></i> Reset
        </button>
    </div>
</div>

<div id="usersContainer" class="row">
    @include('users::partials._user_cards', ['users' => $users])
</div>

<div class="row align-items-center mt-4">
    <div class="col-auto">
        <select id="perPageSelect" class="form-select form-select-sm mb-3" data-choices style="min-width: 160px;">
            <option value="20" selected>20 per page</option>
            <option value="50">50 per page</option>
            <option value="100">100 per page</option>
            <option value="all">All</option>
        </select>
    </div>

    <div class="col" id="paginationWrapper">
        @include('users::partials._pagination')
    </div>
</div>

<div class="modal fade" id="connectionRequestModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow">
            <div class="modal-header">
                <h5 class="modal-title">Respond to Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <p id="connRequestMsg" class="fs-6 mb-4">Someone wants to connect with you.</p>
                <button class="btn btn-success me-2" id="modalAcceptBtn">Accept</button>
                <button class="btn btn-outline-danger" id="modalDenyBtn">Deny</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>

window.usersFilterUrl = "{{ route('users.filter') }}";
window.usersFollowUrl = "{{ route('users.toggle-follow') }}";
window.usersConnectUrl = "{{ route('connections.send') }}";

window.csrfToken = "{{ csrf_token() }}";


</script>

@endsection
