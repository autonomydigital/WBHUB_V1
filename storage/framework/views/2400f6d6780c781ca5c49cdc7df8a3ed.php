<?php $__env->startSection('title'); ?> Users <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4 align-items-center g-2">
    <div class="col-md-auto">
        <div class="btn-group" role="group" aria-label="User Filters">
            <button type="button" class="btn btn-outline-success" id="filterFollowingBtn">
                <i class="ri-eye-line me-1"></i> Following
            </button>
            <button type="button" class="btn btn-outline-secondary" id="filterConnectedBtn">
                <i class="ri-team-line me-1"></i> Connections
            </button>
            <?php
            $requestCount = auth()->user()->receivedConnections()->where('status', 'pending')->count();
        ?>
        
        <button type="button" class="btn btn-outline-primary position-relative" id="filterRequestsBtn">
            <i class="ri-user-add-line me-1"></i> Requests
            <?php if($requestCount > 0): ?>
                <span id="requestCountBadge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?php echo e($requestCount); ?>

                </span>
            <?php endif; ?>
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
    <?php echo $__env->make('users::partials._user_cards', ['users' => $users], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
        <?php echo $__env->make('users::partials._pagination', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script>

window.usersFilterUrl = "<?php echo e(route('users.filter')); ?>";
window.usersFollowUrl = "<?php echo e(route('users.toggle-follow')); ?>";
window.usersConnectUrl = "<?php echo e(route('connections.send')); ?>";

window.csrfToken = "<?php echo e(csrf_token()); ?>";


</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/Modules/Users/Resources/views/index.blade.php ENDPATH**/ ?>