<!DOCTYPE html>
<html lang="en">
    <?php echo $__env->make('websitecontent::websites.plp.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="wrapper">
        <div class="content">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

    <?php echo $__env->make('websitecontent::websites.plp.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</html><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/Modules/WebsiteContent/Resources/views/websites/plp/layouts/app.blade.php ENDPATH**/ ?>