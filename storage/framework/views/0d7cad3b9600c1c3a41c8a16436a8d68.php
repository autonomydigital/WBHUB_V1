<?php $__env->startSection('title', 'Role Permissions'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Role Permissions</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="<?php echo e(route('permissions.update')); ?>">
            <?php echo csrf_field(); ?>

            <div class="mb-4">
                <label class="form-label">Select Role</label>
                <select name="role_id" class="form-select" onchange="this.form.submit()">
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roleOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($roleOption->id); ?>" <?php echo e($selected == $roleOption->id ? 'selected' : ''); ?>>
                            <?php echo e(ucfirst($roleOption->name)); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="row">
                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module => $modulePermissions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4 mb-3">
                        <h6 class="text-uppercase"><?php echo e(ucfirst($module)); ?></h6>
                        <?php $__currentLoopData = $modulePermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="permissions[]"
                                    value="<?php echo e($permission->name); ?>"
                                    <?php echo e($role->hasPermissionTo($permission->name) ? 'checked' : ''); ?>>
                                <label class="form-check-label"><?php echo e(Str::title(str_replace('_',' ',$permission->name))); ?></label>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-success">Save Permissions</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/resources/views/permissions/index.blade.php ENDPATH**/ ?>