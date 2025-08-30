 

<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-body">
            <h4 class="card-title mb-3">🧠 Nyrix AI Control Panel</h4>
            <p class="text-muted">Use this switch to enable or disable Nyrix globally.</p>

            <form method="POST" action="<?php echo e(route('nyrix.toggle.update')); ?>">
                <?php echo csrf_field(); ?>
                <div class="form-check form-switch fs-4">
                    <input class="form-check-input" type="checkbox" name="enabled" value="1" id="nyrixSwitch"
                        <?php echo e($enabled ? 'checked' : ''); ?> onchange="this.form.submit()">
                    <label class="form-check-label ms-2" for="nyrixSwitch">
                        Nyrix is <strong><?php echo e($enabled ? 'Enabled' : 'Disabled'); ?></strong>
                    </label>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/Modules/Nyrix/Views/godmode.blade.php ENDPATH**/ ?>