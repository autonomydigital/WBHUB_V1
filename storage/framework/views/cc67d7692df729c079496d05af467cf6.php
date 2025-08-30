<?php if($paginator->hasPages()): ?>
    <div class="pagination-wrap">
        <ul class="pagination">

            
            <?php if($paginator->onFirstPage()): ?>
                <li class="pagination-item disabled" aria-disabled="true">
                    <span><i class="fas fa-angle-double-left"></i></span>
                </li>
            <?php else: ?>
                <li class="pagination-item">
                    <a href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev">
                        <i class="fas fa-angle-double-left"></i>
                    </a>
                </li>
            <?php endif; ?>

            
            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <?php if(is_string($element)): ?>
                    <li class="pagination-item disabled"><span><?php echo e($element); ?></span></li>
                <?php endif; ?>

                
                <?php if(is_array($element)): ?>
                    <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($page == $paginator->currentPage()): ?>
                            <li class="pagination-item active"><span><?php echo e($page); ?></span></li>
                        <?php else: ?>
                            <li class="pagination-item"><a href="<?php echo e($url); ?>"><?php echo e($page); ?></a></li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            
            <?php if($paginator->hasMorePages()): ?>
                <li class="pagination-item">
                    <a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next">
                        <i class="fas fa-angle-double-right"></i>
                    </a>
                </li>
            <?php else: ?>
                <li class="pagination-item disabled" aria-disabled="true">
                    <span><i class="fas fa-angle-double-right"></i></span>
                </li>
            <?php endif; ?>

        </ul>
    </div>
<?php endif; ?><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/Modules/WebsiteContent/Resources/views/websites/plp/partials/pagination.blade.php ENDPATH**/ ?>