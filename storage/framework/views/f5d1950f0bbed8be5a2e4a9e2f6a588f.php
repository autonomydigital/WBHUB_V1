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
    $posts = $user->posts ?? collect();
?>

<div class="card border shadow-sm text-white">
    <div class="card-body">
        <h5 class="card-title text-white mb-4">
            <i class="ri-image-2-line me-2 text-info"></i>Posts
        </h5>

        <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="mb-4 pb-4 border-bottom border-dark-subtle">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar-xs me-2">
                        <img src="<?php echo e($user->avatarUrl()); ?>" alt="<?php echo e($user->full_name); ?>" class="img-fluid rounded-circle">
                    </div>
                    <div>
                        <strong class="text-white"><?php echo e($user->full_name); ?></strong><br>
                        <small class="text-white-50"><?php echo e($post->created_at->diffForHumans()); ?></small>
                    </div>
                </div>

                <?php if($post->image): ?>
                    <div class="ratio ratio-16x9 mb-3">
                        <img src="<?php echo e(asset('storage/' . $post->image)); ?>" alt="Post Image" class="rounded img-fluid object-fit-cover w-100 h-100">
                    </div>
                <?php endif; ?>

                <?php if($post->caption): ?>
                    <p class="text-white-50 mb-2"><?php echo e($post->caption); ?></p>
                <?php endif; ?>

                <div class="d-flex gap-3">
                    <button class="btn btn-sm btn-outline-light">
                        <i class="ri-heart-line me-1"></i> Like
                    </button>
                    <button class="btn btn-sm btn-outline-light">
                        <i class="ri-chat-1-line me-1"></i> Comment
                    </button>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center py-5">
                <div class="avatar-md mx-auto mb-3">
                    <span class="avatar-title bg-light text-muted rounded-circle fs-24">
                        <i class="ri-image-line"></i>
                    </span>
                </div>
                <p class="mb-0 text-muted fst-italic">No posts yet.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/resources/views/components/cards/user-posts.blade.php ENDPATH**/ ?>