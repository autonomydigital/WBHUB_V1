<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['user']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['user']); ?>
<?php foreach (array_filter((['user']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $businesses = $user->connectedBusinesses ?? collect();
?>

<div class="card border shadow-sm text-white mb-4">
    <div class="card-body">
        <h5 class="card-title mb-3 text-white">Connected Businesses</h5>

        <?php if($businesses->isEmpty()): ?>
            <div class="text-center">
                <div class="avatar-md mx-auto mb-3">
                    <span class="avatar-title bg-light text-muted rounded-circle fs-24">
                        <i class="ri-building-line"></i>
                    </span>
                </div>
                <p class="mb-0 text-muted fst-italic">No business connections yet.</p>
            </div>
        <?php else: ?>
            <?php $__currentLoopData = $businesses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $biz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card border bg-dark bg-opacity-10 mb-3">
                    <div class="row g-0">
                        <div class="col-3">
                            <img src="<?php echo e($biz->logoUrl()); ?>" class="img-fluid rounded-start" alt="<?php echo e($biz->name); ?>">
                        </div>
                        <div class="col-9">
                            <div class="card-body p-3">
                                <h6 class="card-title mb-1 text-white"><?php echo e($biz->name); ?></h6>
                                <p class="card-text text-white-50 mb-2"><?php echo e($biz->tagline ?? 'No description'); ?></p>
                                <div class="d-flex gap-3">
                                    <a href="<?php echo e(route('businesses.show', $biz->id)); ?>" class="btn btn-sm btn-outline-light">
                                        <i class="ri-eye-line"></i> View
                                    </a>
                                    <a href="<?php echo e($biz->website); ?>" target="_blank" class="btn btn-sm btn-outline-secondary">
                                        <i class="ri-global-line"></i> Website
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
</div><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/resources/views/components/cards/user-businesses.blade.php ENDPATH**/ ?>