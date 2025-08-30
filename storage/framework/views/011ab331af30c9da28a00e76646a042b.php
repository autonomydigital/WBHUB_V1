<!-- navigation --> 
<div class="nav-holder main-menu">
    <nav>
        <ul class="no-list-style">
            
            <li>
                <a href="<?php echo e(request()->getHost() === $business->custom_domain
                    ? route('website.home.custom')
                    : route('website.home', ['business' => $business->subdomain])); ?>"
                    class="<?php echo e(request()->is('/') || request()->is('home') ? 'act-link' : ''); ?>">
                    Home
                </a>
            </li>

            
            <li>
                <a href="#">Listings <i class="fa-solid fa-caret-down"></i></a>
                <ul>
                    <li><a href="listings.php?sold">Residential</a></li>
                    <li><a href="listings.php?rural">Rural</a></li>
                    <li><a href="listings.php?land">Land</a></li>
                    <li><a href="listings.php?commercial">Commercial</a></li>
                    <li><a href="listings.php?auction">Auction</a></li>
                    <li><a href="listings.php?sold">Sold</a></li>
                </ul>
            </li>

            
            <li>
                <a href="<?php echo e(request()->getHost() === $business->custom_domain
                    ? route('website.page.custom', ['slug' => 'about'])
                    : route('website.page', ['business' => $business->subdomain, 'slug' => 'about'])); ?>"
                    class="<?php echo e(request()->is('about') ? 'act-link' : ''); ?>">
                    Who We Are
                </a>
            </li>

            
            <li>
                <a href="<?php echo e(request()->getHost() === $business->custom_domain
                    ? route('website.page.custom', ['slug' => 'services'])
                    : route('website.page', ['business' => $business->subdomain, 'slug' => 'services'])); ?>"
                    class="<?php echo e(request()->is('services') ? 'act-link' : ''); ?>">
                    What We Do
                </a>
            </li>

            
            <li>
                <a href="<?php echo e(request()->getHost() === $business->custom_domain
                    ? route('website.news.custom')
                    : route('website.news', ['business' => $business->subdomain])); ?>"
                    class="<?php echo e(request()->is('news') ? 'act-link' : ''); ?>">
                    News
                </a>
            </li>

            
            <li>
                <a href="<?php echo e(request()->getHost() === $business->custom_domain
                    ? route('website.page.custom', ['slug' => 'contact'])
                    : route('website.page', ['business' => $business->subdomain, 'slug' => 'contact'])); ?>"
                    class="<?php echo e(request()->is('contact') ? 'act-link' : ''); ?>">
                    Contact
                </a>
            </li>
        </ul>
    </nav>
</div>
<?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/Modules/WebsiteContent/Resources/views/websites/plp/partials/nav.blade.php ENDPATH**/ ?>