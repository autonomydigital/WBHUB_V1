<?php $__env->startSection('content'); ?>


<div class="section hero-section hero-section_sin">
    <div class="hero-section-wrap">
        <div class="hero-section-wrap-item">
            <div class="container">
                <div class="hero-section-container">
                    <div class="hero-section-title">
                        <h2>About Our Company</h2>
                        <h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec tincidunt arcu, sit amet fermentum sem.</h5>
                    </div>
                </div>
            </div>
            <div class="bg-wrap bg-hero bg-parallax-wrap-gradien fs-wrapper" data-scrollax-parent="true">
                <div class="bg" data-bg="<?php echo e(asset('business-sites/plp/images/bg/1.jpg')); ?>" data-scrollax="properties: { translateY: '30%' }"></div>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('websitecontent::websites.plp.partials.breadcrumbs', [
    'breadcrumbs' => [
        ['label' => 'Who are we']  // Only final item needs label
    ]
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<div class="main-content ms_vir_height"> 
    <div class="container">
        <div class="boxed-container">
            <div class="boxed-content">
                <div class="about-wrap boxed-content-item">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="about-title ab-hero ab-hero2">
                                <h2>Our Awesome Story</h2>
                                <h4>Check video presentation to find out more about us.</h4>
                            </div>
                            <p>Ut euismod ultricies sollicitudin...</p>
                            <p>Curabitur convallis fringilla diam...</p>
                            <a href="<?php echo e(route('website.page', ['business' => $business->subdomain, 'slug' => 'contact'])); ?>" class="commentssubmit" style="margin-top: 30px">Get In Touch With Us</a>
                        </div>
                        <div class="col-lg-6">
                            <div class="about-img ab_i2">
                                <img src="<?php echo e(asset('business-sites/plp/images/all/1.jpg')); ?>" class="respimg" alt="">
                                
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    
                </div>
            </div>
        </div>
    </div>


    
    <?php echo $__env->make('websitecontent::websites.plp.partials.testimonials', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <?php echo $__env->make('websitecontent::websites.plp.partials.call-to-action', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('websitecontent::websites.plp.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/Modules/WebsiteContent/Resources/views/websites/plp/pages/about.blade.php ENDPATH**/ ?>