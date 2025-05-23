<?php $__empty_1 = true; $__currentLoopData = $businesses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $business): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<div class="col-xl-4 col-lg-6 col-md-6 mb-4">
    <div class="card business-card shadow-sm overflow-hidden position-relative" data-business-id="<?php echo e($business->id); ?>">

        
        <div style="height: 140px; overflow: hidden;">
            <img src="<?php echo e($business->cover_photo ? asset('storage/' . $business->cover_photo) : asset('build/images/profile-bg.jpg')); ?>"
                class="img-fluid w-100"
                style="object-fit: cover; object-position: center;">
        </div>

        
        <div class="d-flex justify-content-center" style="margin-top: -60px;">
            <div class="bg-white rounded-3 shadow-sm d-flex align-items-center justify-content-center"
                style="width: 100px; height: 100px; border: 3px solid #fff;">
                <img src="<?php echo e($business->logo ? asset('storage/' . $business->logo) : asset('build/images/users/avatar-1.jpg')); ?>"
                    alt="Logo"
                    style="max-width: 90px; max-height: 90px; object-fit: contain;">
            </div>
        </div>

        <div class="card-body text-center pt-3">
            <h5 class="fw-bold text-white mb-1"><?php echo e($business->name); ?></h5>
            
            <?php if($business->suburb || $business->state): ?>
                <p class="text-muted small mb-1">
                    <i class="ri-map-pin-line me-1"></i>
                    <?php echo e($business->suburb); ?>, <?php echo e($business->state); ?>

                </p>
            <?php endif; ?>

            <p class="text-muted small mb-3">
                <?php echo e(Str::limit($business->description ?? 'No description provided.', 100)); ?>

            </p>

            
            <div class="d-flex justify-content-center gap-2 mt-3">
                <a href="<?php echo e(route('businesses.show', $business)); ?>" class="btn btn-sm btn-outline-primary">
                    <i class="ri-eye-line me-1"></i> View
                </a>
                <button class="btn btn-sm btn-outline-success">
                    <i class="ri-building-line me-1"></i> Visit
                </button>
                <button class="btn btn-sm btn-outline-warning">
                    <i class="ri-star-line me-1"></i> Save
                </button>
            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
<div class="col-12">
    <div class="alert alert-warning text-center">
        No businesses found.
    </div>
</div>
<?php endif; ?><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/Modules/Businesses/Resources/views/partials/_business_cards.blade.php ENDPATH**/ ?>