<?php $__env->startSection('title', 'Alerts'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card mt-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Alerts & Notifications</h5>
                </div>

                <div class="card-body">
                    <?php if($notifications->count()): ?>
                        <div class="list-group list-group-flush">
                            <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="list-group-item list-group-item-action py-3 d-flex align-items-start">
                                    <div class="avatar-xs me-3 flex-shrink-0">
                                        <span class="avatar-title bg-info-subtle text-info rounded-circle fs-16">
                                            <i class="<?php echo e($notification->icon); ?>"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1"><?php echo $notification->title; ?></h6>
                                        <p class="mb-0 text-muted fs-12">
                                            <i class="mdi mdi-clock-outline"></i> <?php echo e($notification->created_at->diffForHumans()); ?>

                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center p-4">
                            <i class="ri-notification-off-line display-4 text-muted mb-3"></i>
                            <h6 class="text-muted">No notifications just yet.</h6>
                        </div>
                    <?php endif; ?>
                </div>

            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/Modules/Notifications/Resources/views/alerts.blade.php ENDPATH**/ ?>