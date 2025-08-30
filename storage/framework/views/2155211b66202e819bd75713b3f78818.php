<div class="container">
    <!--breadcrumbs-list-->
    <div class="breadcrumbs-list bl_flat">
        <a href="#">Home</a> <span>Latest Properties</span>
        <div class="breadcrumbs-list_dec"><i class="fa-thin fa-arrow-up"></i></div>
    </div>
    <!--breadcrumbs-list end-->        

    <!--main-content-->
    <div class="main-content ms_vir_height" id="sec1">
        <!--boxed-container-->
        <div class="boxed-container">
            <div class="listing-grid_heroheader">
                <h3>Browse Latest  Properties</h3>
                <div class="gallery-filters">
                    <a href="#" class="gallery-filter gallery-filter-active"  data-filter="*"> All Properties</a>
                    <a href="#" class="gallery-filter " data-filter=".cat-sale">Residential</a>
                    <a href="#" class="gallery-filter" data-filter=".cat-rent">Rural</a>
                    <a href="#" class="gallery-filter" data-filter=".cat-comercial">Commercial</a>
                </div>
            </div>

            <!-- listing-grid-->
            <div class="listing-grid gisp">
                <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="listing-grid-item cat-<?php echo e(strtolower($property->category)); ?>">
                        <div class="listing-item">
                            <div class="geodir-category-listing">
                                <div class="geodir-category-img">
                                    <a href="#" class="geodir-category-img_item">
                                        <div class="bg" data-bg="<?php echo e($property->cover_image_url); ?>"></div>
                                        <div class="overlay"></div>
                                    </a>
                                    <div class="geodir-category-location">
                                        <a href="#" class="map-item tolt single-map-item" data-newlatitude="<?php echo e($property->latitude); ?>" data-newlongitude="<?php echo e($property->longitude); ?>" data-microtip-position="top" data-tooltip="View on the map">
                                            <i class="fas fa-map-marker-alt"></i>  <?php echo e($property->address); ?>

                                        </a>
                                    </div>
                                    <ul class="list-single-opt_header_cat">
                                        <li><a href="#" class="cat-opt"><?php echo e($property->type); ?></a></li>
                                        <li><a href="#" class="cat-opt"><?php echo e($property->subtype); ?></a></li>
                                    </ul>
                                    <a href="#" class="geodir_save-btn tolt" data-microtip-position="left" data-tooltip="Save"><span><i class="fal fa-heart"></i></span></a>
                                    <div class="geodir-category-listing_media-list">
                                        <span><i class="fas fa-camera"></i> <?php echo e($property->image_count); ?></span>
                                    </div>
                                </div>
                                <div class="geodir-category-content">
                                    <h3><a href="#"><?php echo e($property->title); ?></a></h3>
                                    <div class="geodir-category-content_price">$<?php echo e(number_format($property->price)); ?></div>
                                    <p><?php echo e(Str::limit($property->description, 160)); ?></p>
                                    <div class="geodir-category-content-details">
                                        <ul>
                                            <li><i class="fa-light fa-bed"></i><span><?php echo e($property->bedrooms); ?></span></li>
                                            <li><i class="fa-light fa-bath"></i><span><?php echo e($property->bathrooms); ?></span></li>
                                            <li><i class="fa-light fa-car"></i><span><?php echo e($property->garage); ?></span></li>
                                            <li><i class="fa-light fa-chart-area"></i><span><?php echo e($property->land_size); ?></span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="geodir-category-footer">
                                    <a href="#" class="gcf-company"><img src="<?php echo e($property->agent_avatar); ?>" alt=""><span>By <?php echo e($property->agent_name); ?></span></a>
                                    <a href="#" class="gid_link"><span>View Details</span> <i class="fa-solid fa-caret-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <!-- listing-grid end-->

            <a href="#" class="commentssubmit csb-no-align">View All Properties <i class="fa-solid fa-caret-right"></i></a>
        </div>
        <!--boxed-container end-->
    </div>
    <!--main-content end-->    
</div><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/Modules/WebsiteContent/Resources/views/websites/plp/partials/latest-properties.blade.php ENDPATH**/ ?>