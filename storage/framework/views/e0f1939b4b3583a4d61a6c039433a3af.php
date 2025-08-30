<div class="listing-item-container two-columns-grid fw-listing-item fw-listing-item2">
    <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="listing-item">
            <div class="geodir-category-listing">
                <div class="geodir-category-img">
                    <a href="<?php echo e(route('plp.property.show', ['business' => $business->subdomain, 'slug' => $property->slug])); ?>" class="geodir-category-img_item">
                        <div class="bg" data-bg="<?php echo e($property->coverImageUrl); ?>"></div>
                        <div class="overlay"></div>
                    </a>
                    <div class="geodir-category-location">
                        <a href="#" class="map-item tolt single-map-item"
                           data-newlatitude="<?php echo e($property->latitude); ?>"
                           data-newlongitude="<?php echo e($property->longitude); ?>"
                           data-microtip-position="top" data-tooltip="On the map">
                            <i class="fas fa-map-marker-alt"></i> <?php echo e($property->address); ?>

                        </a>
                    </div>
                    <ul class="list-single-opt_header_cat">
                        <li><a href="#" class="cat-opt"><?php echo e(ucfirst($property->listing_type)); ?></a></li>
                        <li><a href="#" class="cat-opt"><?php echo e($property->category); ?></a></li>
                    </ul>
                    <a href="#" class="geodir_save-btn tolt" data-microtip-position="left" data-tooltip="Save">
                        <span><i class="fal fa-heart"></i></span>
                    </a>
                    <div class="geodir-category-listing_media-list">
                        <span><i class="fas fa-camera"></i> <?php echo e($property->image_count); ?></span>
                    </div>
                </div>

                <div class="geodir-category-content">
                    <h3><a href="<?php echo e(route('plp.property.show', ['business' => $business->subdomain, 'slug' => $property->slug])); ?>">
                        <?php echo e($property->title); ?></a></h3>
                    <div class="geodir-category-content_price"><?php echo e($property->price_formatted); ?></div>
                    <p><?php echo e(Str::limit($property->description, 120)); ?></p>
                    <div class="geodir-category-content-details">
                        <ul>
                            <li><i class="fa-light fa-bed"></i><span><?php echo e($property->bedrooms); ?></span></li>
                            <li><i class="fa-light fa-bath"></i><span><?php echo e($property->bathrooms); ?></span></li>
                            <li><i class="fa-light fa-chart-area"></i><span><?php echo e($property->area); ?> ft<sup>2</sup></span></li>
                        </ul>
                    </div>
                </div>

                <div class="geodir-category-footer">
                    <a href="#" class="gcf-company">
                        <img src="<?php echo e(optional($property->agent)->avatarUrl ?? asset('default-avatar.jpg')); ?>" alt="Agent Avatar">
                        <span>
                            By <?php echo e(optional($property->agent)->name ?? 'Unknown Agent'); ?>

                        </span>
                    </a>
                    <a href="<?php echo e(route('plp.property.show', ['business' => $business->subdomain, 'slug' => $property->slug])); ?>" class="gid_link">
                        <span>View Details</span> <i class="fa-solid fa-caret-right"></i>
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php if($properties->hasPages()): ?>
<div class="pagination-wrap ajax-pagination">
    <?php echo $properties->appends(request()->except('page'))->links('websitecontent::websites.plp.partials.pagination'); ?>

</div>
<?php endif; ?><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/Modules/WebsiteContent/Resources/views/websites/plp/partials/properties-loop.blade.php ENDPATH**/ ?>