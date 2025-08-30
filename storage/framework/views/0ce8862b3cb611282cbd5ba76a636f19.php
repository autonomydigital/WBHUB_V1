
<div class="container">
    <div class="breadcrumbs-list bl_flat">
        <a href="<?php echo e(request()->getHost() === $business->custom_domain
            ? route('website.home.custom')
            : route('website.home', ['business' => $business->subdomain])); ?>">Home</a>

        <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $crumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!$loop->last): ?>
                <a href="<?php echo e($crumb['url']); ?>"><?php echo e($crumb['label']); ?></a>
            <?php else: ?>
                <span><?php echo e($crumb['label']); ?></span>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/Modules/WebsiteContent/Resources/views/websites/plp/partials/breadcrumbs.blade.php ENDPATH**/ ?>