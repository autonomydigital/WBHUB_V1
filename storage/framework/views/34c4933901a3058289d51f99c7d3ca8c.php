 

<?php $__env->startSection('title', $business->name); ?>

<?php $__env->startSection('content'); ?>
    <div class="profile-foreground position-relative mx-n4 mt-n4">
        <?php if($business->cover_photo): ?>
            <div class="profile-wid-bg">
                <img src="<?php echo e(asset('storage/' . $business->cover_photo)); ?>" alt="" class="profile-wid-img" />
            </div>
        <?php else: ?>
            <div class="profile-wid-bg bg-primary"></div>
        <?php endif; ?>
    </div>

    <div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
        <div class="row g-4">
            <div class="col-auto">
                <div class="avatar-lg">
                    <?php if($business->logo): ?>
                        <img src="<?php echo e(asset('storage/' . $business->logo)); ?>" alt="logo" class="img-thumbnail rounded-circle">
                    <?php else: ?>
                        <div class="avatar-title rounded-circle bg-secondary text-white fs-3">
                            <?php echo e(strtoupper(substr($business->name, 0, 1))); ?>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col">
                <div class="p-2">
                    <h3 class="mb-1"><?php echo e($business->name); ?></h3>
                    <?php if($business->description): ?>
                        <p class="text-muted mb-0"><?php echo e($business->description); ?></p>
                    <?php endif; ?>
                    <?php if($business->street || $business->suburb || $business->state): ?>
                        <p class="text-muted mt-2">
                            📍 <?php echo e($business->street); ?>, <?php echo e($business->suburb); ?>, <?php echo e($business->state); ?> <?php echo e($business->postcode); ?>

                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <?php if($business->created_by === auth()->id()): ?>
                <div class="col-12 col-lg-auto ms-auto text-lg-end">
                    <a href="<?php echo e(route('businesses.edit', $business)); ?>" class="btn btn-soft-primary">
                        <i class="ri-edit-box-line align-bottom me-1"></i> Edit Business
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/Modules/Businesses/Resources/views/show.blade.php ENDPATH**/ ?>