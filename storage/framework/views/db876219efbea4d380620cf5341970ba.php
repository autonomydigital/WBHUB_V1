<?php $__env->startSection('title'); ?> Businesses <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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
    <?php echo $__env->make('businesses::partials._business_cards', ['businesses' => $businesses], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
        <?php echo $__env->make('businesses::partials._pagination', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
window.businessesFilterUrl = "<?php echo e(route('businesses.index')); ?>";
window.csrfToken = "<?php echo e(csrf_token()); ?>";
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/Modules/Businesses/Resources/views/index.blade.php ENDPATH**/ ?>