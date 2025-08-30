<?php $__env->startSection('title', 'Edit ' . $business->name); ?>

<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(route('businesses.update', $business)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Business Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $business->name)); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"><?php echo e(old('description', $business->description)); ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Street</label>
                    <input type="text" name="street" class="form-control" value="<?php echo e(old('street', $business->street)); ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Suburb</label>
                    <input type="text" name="suburb" class="form-control" value="<?php echo e(old('suburb', $business->suburb)); ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">State</label>
                    <input type="text" name="state" class="form-control" value="<?php echo e(old('state', $business->state)); ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Postcode</label>
                    <input type="text" name="postcode" class="form-control" value="<?php echo e(old('postcode', $business->postcode)); ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Country</label>
                    <input type="text" name="country" class="form-control" value="<?php echo e(old('country', $business->country ?? 'Australia')); ?>">
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="<?php echo e(route('businesses.show', $business)); ?>" class="btn btn-light">Cancel</a>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/Modules/Businesses/Resources/views/edit.blade.php ENDPATH**/ ?>