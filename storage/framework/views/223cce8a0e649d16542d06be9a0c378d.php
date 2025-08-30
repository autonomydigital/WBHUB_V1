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

<div class="card">
    <div class="card-body">
        <h5 class="card-title mb-4">Socials</h5>

        <?php if($user->socials->isEmpty()): ?>
            <div class="text-center">
                <div class="avatar-md mx-auto mb-3">
                    <span class="avatar-title bg-light text-muted rounded-circle fs-24">
                        <i class="ri-links-line"></i>
                    </span>
                </div>
                <p class="mb-0 text-muted fst-italic">No social accounts linked yet.</p>
            </div>
        <?php else: ?>
            <div class="d-flex flex-wrap gap-2">
                <?php $__currentLoopData = $user->socials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $platform = strtolower($social->platform);
                        $handle = $social->handle;
                        $platformIcons = [
                            'github' => ['icon' => 'ri-github-fill', 'color' => 'bg-dark', 'url' => "https://github.com/{$handle}"],
                            'website' => ['icon' => 'ri-global-fill', 'color' => 'bg-primary', 'url' => $handle],
                            'dribbble' => ['icon' => 'ri-dribbble-fill', 'color' => 'bg-success', 'url' => "https://dribbble.com/{$handle}"],
                            'pinterest' => ['icon' => 'ri-pinterest-fill', 'color' => 'bg-danger', 'url' => "https://pinterest.com/{$handle}"],
                            'facebook' => ['icon' => 'ri-facebook-fill', 'color' => 'bg-primary', 'url' => "https://facebook.com/{$handle}"],
                            'instagram' => ['icon' => 'ri-instagram-line', 'color' => 'bg-danger', 'url' => "https://instagram.com/{$handle}"],
                            'twitter' => ['icon' => 'ri-twitter-fill', 'color' => 'bg-info', 'url' => "https://twitter.com/{$handle}"],
                            'linkedin' => ['icon' => 'ri-linkedin-fill', 'color' => 'bg-primary', 'url' => "https://linkedin.com/in/{$handle}"],
                        ];
                        $iconData = $platformIcons[$platform] ?? ['icon' => 'ri-links-line', 'color' => 'bg-secondary', 'url' => $handle];
                    ?>

                    <div>
                        <a href="<?php echo e($iconData['url']); ?>" target="_blank" class="avatar-xs d-block">
                            <span class="avatar-title rounded-circle fs-16 <?php echo e($iconData['color']); ?>">
                                <i class="<?php echo e($iconData['icon']); ?>"></i>
                            </span>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
</div><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/resources/views/components/cards/user-socials.blade.php ENDPATH**/ ?>