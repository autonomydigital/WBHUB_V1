<div class="sb-container fixed-bar">
    <div class="main-sidebar-widget">
        <div class="search-widget">
            <form action="#">
                <input type="text" class="search-inpt-item" placeholder="Search..">
                <button class="search-submit color-bg"><i class="fa-regular fa-magnifying-glass"></i></button>
            </form>
        </div>
    </div>

    <div class="boxed-content">
        <div class="boxed-content-title"><h3>Recent Posts</h3></div>
        <div class="boxed-content-item bc-item_smal_pad">
            <ul>
                <?php $__currentLoopData = $recentPosts ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <div class="recent-post-img"><img src="<?php echo e(asset('images/all/1.jpg')); ?>"></div>
                        <div class="recent-post-content">
                            <h4><a href="#"><?php echo e($recent->title); ?></a></h4>
                            <div class="recent-post-opt">
                                <span class="post-date"><?php echo e($recent->published_at->format('F j, Y')); ?></span>
                            </div>
                        </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</div><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/Modules/WebsiteContent/Resources/views/websites/plp/partials/news-sidebar.blade.php ENDPATH**/ ?>