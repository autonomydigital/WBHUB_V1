<div class="row">
    <div class="col-md-4">
        <div class="footer-widget">
            <h4 class="footer-widget-title">About</h4>
            <p class="text-muted">
                <?php echo e($business->description ?? 'We help you sell, rent, and buy properties in the Whitsundays with ease and trust.'); ?>

            </p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="footer-widget">
            <h4 class="footer-widget-title">Contact</h4>
            <ul class="list-unstyled text-muted">
                <?php if($business->phone): ?>
                    <li><i class="ri-phone-line me-1"></i> <?php echo e($business->phone); ?></li>
                <?php endif; ?>
                <?php if($business->email): ?>
                    <li><i class="ri-mail-line me-1"></i> <?php echo e($business->email); ?></li>
                <?php endif; ?>
                <?php if($business->street || $business->suburb || $business->state): ?>
                    <li><i class="ri-map-pin-line me-1"></i>
                        <?php echo e($business->street); ?>, <?php echo e($business->suburb); ?>, <?php echo e($business->state); ?> <?php echo e($business->postcode); ?>

                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <div class="col-md-4">
        <div class="footer-widget">
            <h4 class="footer-widget-title">Quick Links</h4>
            <ul class="list-unstyled text-muted">
                <li>
                    <a href="<?php echo e(request()->getHost() === $business->custom_domain
                        ? route('website.home.custom')
                        : route('website.home', ['business' => $business->subdomain])); ?>">Home</a>
                </li>
                <li>
                    <a href="<?php echo e(request()->getHost() === $business->custom_domain
                        ? route('website.page.custom', ['slug' => 'about'])
                        : route('website.page', ['business' => $business->subdomain, 'slug' => 'about'])); ?>">About</a>
                </li>
                <li>
                    <a href="<?php echo e(request()->getHost() === $business->custom_domain
                        ? route('website.page.custom', ['slug' => 'contact'])
                        : route('website.page', ['business' => $business->subdomain, 'slug' => 'contact'])); ?>">Contact</a>
                </li>
                <li>
                    <a href="<?php echo e(request()->getHost() === $business->custom_domain
                        ? route('website.page.custom', ['slug' => 'properties'])
                        : route('website.page', ['business' => $business->subdomain, 'slug' => 'properties'])); ?>">Properties</a>
                </li>
            </ul>
        </div>
    </div>
</div><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/Modules/WebsiteContent/Resources/views/websites/plp/partials/footer-widgets.blade.php ENDPATH**/ ?>