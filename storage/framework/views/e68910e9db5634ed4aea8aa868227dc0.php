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
    $suburb = $user->suburb ?? '';
    $state = $user->state ?? '';
    $locationQuery = urlencode(trim("$suburb, $state"));
    $status = $user->regionStatus();
    $label = $status === 'local' ? 'Local' : 'Visitor';
    $badgeClass = $status === 'local' ? 'bg-success' : 'bg-secondary';
    $mapsKey = $googleMapsKey ?? config('services.google.maps_key');
?>

<div class="card border shadow-sm text-white">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title mb-0 text-white">Home town</h5>
            <span class="badge <?php echo e($badgeClass); ?> fs-12"><?php echo e($label); ?></span>
        </div>

        <?php if($locationQuery !== ','): ?>
            <div class="ratio ratio-16x9 mb-3">
                <iframe
                    class="rounded"
                    frameborder="0"
                    style="border:0; width: 100%; height: 100%;"
                    allowfullscreen
                    referrerpolicy="no-referrer-when-downgrade"
                    src="https://www.google.com/maps/embed/v1/place?key=<?php echo e($mapsKey); ?>&q=<?php echo e($locationQuery); ?>">
                </iframe>
            </div>
            <div class="text-white-50 small">
                Located in: <strong><?php echo e($suburb ?: '—'); ?>, <?php echo e($state ?: '—'); ?></strong>
            </div>
        <?php else: ?>
            <div class="text-muted text-center py-4">
                <i class="ri-map-pin-line fs-32 d-block mb-2"></i>
                <p class="mb-0">Location not provided.</p>
            </div>
        <?php endif; ?>
    </div>
</div><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/resources/views/components/cards/map-location.blade.php ENDPATH**/ ?>