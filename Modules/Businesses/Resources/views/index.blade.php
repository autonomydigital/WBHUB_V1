@extends('layouts.master')

@section('title') Businesses @endsection

@section('content')
<div class="row mb-4 align-items-center g-2">
    <div class="col-md">
        <input type="text" id="searchInput" class="form-control" placeholder="Search businesses...">
    </div>

    <div class="col-md-auto">
        <select id="sortSelect" class="form-select" data-choices>
            <option value="">Sort</option>
            <option value="latest" selected>Newest First</option>
            <option value="name_asc">Name A–Z</option>
            <option value="name_desc">Name Z–A</option>
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

<div id="businessesContainer" class="row">
    @include('businesses::partials._business_cards', ['businesses' => $businesses])
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
        @include('businesses::partials._pagination')
    </div>
</div>
@endsection

@section('script')
<script>
window.businessesFilterUrl = "{{ route('businesses.index') }}";
window.csrfToken = "{{ csrf_token() }}";
</script>
@endsection