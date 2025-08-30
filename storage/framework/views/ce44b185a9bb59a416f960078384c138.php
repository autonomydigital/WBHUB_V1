<div class="show-mob-filter"><i class="far fa-sliders-h"></i> Search Filters</div>

<div class="list-searh-input-wrap box_list-searh-input-wrap lws_mobile lsw_mb-btn">
    <div class="close_mob-filter cmf"><i class="fa-regular fa-xmark"></i></div>

    <div class="list-searh-input-wrap-title_wrap">
        <div class="list-searh-input-wrap-title">
            <i class="far fa-sliders-h"></i><span>Search Filters</span>
        </div>

        <div class="list-searh-input-radio_wrap">
            <div class="header-search-radio">
                <input class="hidden radio-label" type="radio" name="listing_type" id="sale-button2" checked>
                <label class="button-label" for="sale-button2">Sale</label>

                <input class="hidden radio-label" type="radio" name="listing_type" id="rent-button2">
                <label class="button-label" for="rent-button2">Rent</label>

                <input class="hidden radio-label" type="radio" name="listing_type" id="comm-button2">
                <label class="button-label" for="comm-button2">Commercial</label>
            </div>

            <div class="reset-form reset-btn tolt" data-microtip-position="bottom" data-tooltip="Reset Filters">
                <i class="fa-solid fa-arrows-rotate"></i>
            </div>
        </div>
    </div>

    <form id="property-filters-form">
        <div class="custom-form">
            <div class="row">
                
                <div class="col-lg-4">
                    <div class="cs-intputwrap">
                        <i class="fa-light fa-location-dot"></i>
                        <input type="text" name="address" placeholder="Address, Street, State...">
                    </div>
                </div>

                
                <div class="col-lg-4">
                    <div class="cs-intputwrap">
                        <i class="fa-light fa-layer-group"></i>
                        <select name="category" class="chosen-select on-radius no-search-select">
                            <option value="">All Categories</option>
                            <option value="House">House</option>
                            <option value="Apartment">Apartment</option>
                            <option value="Hotel">Hotel</option>
                            <option value="Villa">Villa</option>
                            <option value="Office">Office</option>
                        </select>
                    </div>
                </div>

                
                <div class="col-lg-4">
                    <div class="cs-intputwrap">
                        <i class="fa-light fa-city"></i>
                        <select name="city" class="chosen-select on-radius no-search-select">
                            <option value="">All Cities</option>
                            <option value="Bowen">Bowen</option>
                            <option value="Airlie Beach">Airlie Beach</option>
                            <option value="Proserpine">Proserpine</option>
                        </select>
                    </div>
                </div>

                
                <div class="col-lg-4">
                    <div class="cs-intputwrap">
                        <div class="price-range-wrap fl-wrap">
                            <label>Price Range</label>
                            <div class="price-rage-item">
                                <input type="text" class="price-range-double" name="price-range1" data-min="100" data-max="100000" data-step="1" value="1" data-prefix="$">
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-lg-4">
                    <div class="cs-intputwrap">
                        <div class="price-range-wrap fl-wrap">
                            <label>Area Sq/ft</label>
                            <div class="price-rage-item pr-nopad fl-wrap">
                                <input type="text" class="price-range-double" name="price-range2" data-min="1" data-max="1000" data-step="1" value="1">
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-lg-2">
                    <div class="hidden-listing_search_wrap">
                        <div class="more_search-btn">More Options <i class="fa-regular fa-plus"></i></div>
                        <div class="hidden-listing-filter">
                            
                            <div class="quantity_wrap">
                                <div class="quantity_wrap_title"><i class="fa-light fa-bed"></i><span>Bedrooms</span></div>
                                <div class="quantity-item">
                                    <input type="button" value="-" class="minus">
                                    <input type="text" name="bedrooms" class="qty" value="1" data-min="1" data-max="6">
                                    <input type="button" value="+" class="plus">
                                </div>
                            </div>

                            
                            <div class="quantity_wrap">
                                <div class="quantity_wrap_title"><i class="fa-light fa-bath"></i><span>Bathrooms</span></div>
                                <div class="quantity-item">
                                    <input type="button" value="-" class="minus">
                                    <input type="text" name="bathrooms" class="qty" value="1" data-min="1" data-max="6">
                                    <input type="button" value="+" class="plus">
                                </div>
                            </div>

                            
                            <div class="hidden-listing-item">
                                <div class="filter-tags-title">Amenities</div>
                                <ul class="filter-tags no-list-style">
                                    <?php $__currentLoopData = ['Elevator', 'Laundry Room', 'Kitchen', 'Air Conditioning', 'Parking', 'Pool', 'Gym', 'Security', 'Garage', 'Yard', 'Fireplace']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <input type="checkbox" id="amenity-<?php echo e(Str::slug($amenity)); ?>" name="amenities[]" value="<?php echo e($amenity); ?>">
                                            <label for="amenity-<?php echo e(Str::slug($amenity)); ?>"><?php echo e($amenity); ?></label>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-lg-2">
                    <button type="submit" class="commentssubmit commentssubmit_fw">Search</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="mob-filter-overlay cmf fs-wrapper"></div><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/Modules/WebsiteContent/Resources/views/websites/plp/partials/property-filters.blade.php ENDPATH**/ ?>