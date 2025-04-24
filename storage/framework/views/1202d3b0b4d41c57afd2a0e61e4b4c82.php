<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <h2>Nyrix Toggle (God Mode)</h2>

    <?php if(session('message')): ?>
        <div class="alert alert-success"><?php echo e(session('message')); ?></div>
    <?php endif; ?>

    <form action="<?php echo e(route('nyrix.toggle.update')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="nyrixSwitch" name="enabled" value="1" <?php echo e($enabled ? 'checked' : ''); ?>>
            <label class="form-check-label" for="nyrixSwitch">Enable Nyrix AI</label>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Save</button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/Modules/Nyrix/Views/toggle.blade.php ENDPATH**/ ?>