<?php $__env->startSection('content'); ?>
    
    <div class="section hero-section hero-section_sin">
        <div class="hero-section-wrap">
            <div class="hero-section-wrap-item">
                <div class="container">
                    <div class="hero-section-container">
                        <div class="hero-section-title">
                            <h2>Our Last News</h2>
                            <h5>Stay updated with the latest happenings</h5>
                        </div>
                    </div>
                </div>
                <div class="hs-scroll-down-wrap">
                    <div class="scroll-down-item">
                        <div class="mousey"><div class="scroller"></div></div>
                        <span>Scroll Down To Discover</span>
                    </div>
                </div>
                <div class="bg-wrap bg-hero bg-parallax-wrap-gradien fs-wrapper" data-scrollax-parent="true">
                    <div class="bg" data-bg="<?php echo e(asset('images/bg/1.jpg')); ?>" data-scrollax="properties: { translateY: '30%' }"></div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $__env->make('websitecontent::websites.plp.partials.breadcrumbs', [
        'breadcrumbs' => [
            ['label' => 'News']  // Only final item needs label
        ]
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <div class="main-content ms_vir_height"> 

    <div class="container">
        <div class="row">
            
            <div class="col-lg-8">
                <div class="post-container">
                    <div class="post-items">
                        <?php $__currentLoopData = $newsPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('websitecontent::websites.plp.partials.news-card', ['post' => $post], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    
                    <div class="pagination-wrap">
                        <div class="pagination float-pagination">
                            <?php echo e($newsPosts->links('vendor.pagination.default')); ?>

                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-lg-4">
                <?php echo $__env->make('websitecontent::websites.plp.partials.news-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
    
    <?php echo $__env->make('websitecontent::websites.plp.partials.call-to-action', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('websitecontent::websites.plp.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/Modules/WebsiteContent/Resources/views/websites/plp/pages/news.blade.php ENDPATH**/ ?>