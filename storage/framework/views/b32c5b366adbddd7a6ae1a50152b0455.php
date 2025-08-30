<?php $__env->startSection('title', 'Create Business'); ?>

<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(route('businesses.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="row">
            <div class="col-lg-6">

                <div class="mb-3">
                    <label class="form-label">Business Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Street</label>
                    <input type="text" name="street" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Suburb</label>
                    <input type="text" name="suburb" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">State</label>
                    <input type="text" name="state" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Postcode</label>
                    <input type="text" name="postcode" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Country</label>
                    <input type="text" name="country" class="form-control" value="Australia">
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">Create</button>
                    <a href="<?php echo e(route('businesses.index')); ?>" class="btn btn-light">Cancel</a>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/Modules/Businesses/Resources/views/create.blade.php ENDPATH**/ ?>