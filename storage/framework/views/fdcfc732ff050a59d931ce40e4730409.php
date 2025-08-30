<?php $__env->startSection('content'); ?>


<div class="section hero-section hero-section_sin">
    <div class="hero-section-wrap">
        <div class="hero-section-wrap-item">
            <div class="container">
                <div class="hero-section-container">
                    <div class="hero-section-title">
                        <h2>What We Do</h2>
                        <h5>Expert services in real estate, property management, and more.</h5>
                    </div>
                </div>
            </div>
            <div class="bg-wrap bg-hero bg-parallax-wrap-gradien fs-wrapper" data-scrollax-parent="true">
                <div class="bg" data-bg="<?php echo e(asset('business-sites/plp/images/bg/2.jpg')); ?>" data-scrollax="properties: { translateY: '30%' }"></div>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('websitecontent::websites.plp.partials.breadcrumbs', [
    'breadcrumbs' => [
        ['label' => 'What we do']  // Only final item needs label
    ]
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<div class="main-content">
    <div class="container">
        <div class="boxed-container">
            <div class="boxed-content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="box-item">
                            <h4>Property Sales</h4>
                            <p>Helping you buy or sell with confidence.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box-item">
                            <h4>Property Management</h4>
                            <p>Complete management services for landlords.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box-item">
                            <h4>Market Appraisals</h4>
                            <p>Know your property’s true value.</p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('websitecontent::websites.plp.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/Modules/WebsiteContent/Resources/views/websites/plp/pages/services.blade.php ENDPATH**/ ?>