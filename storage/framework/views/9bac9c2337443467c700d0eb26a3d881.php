<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-xl-3 col-lg-4 col-sm-6 user-card-wrapper">
        <?php echo $__env->make('users::partials._user_cards', ['user' => $user], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php usleep(50000); ?> 
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<!-- Lazy load trigger -->
<div id="lazyLoadTrigger" class="text-center w-100 py-4">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/Modules/Users/Resources/views/partials/_user_cards_lazy.blade.php ENDPATH**/ ?>