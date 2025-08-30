<!-- navigation --> 
<div class="nav-holder main-menu">
    <nav>
        <ul class="no-list-style">
            {{-- Home --}}
            <li>
                <a href="{{ request()->getHost() === $business->custom_domain
                    ? route('website.home.custom')
                    : route('website.home', ['business' => $business->subdomain]) }}"
                    class="{{ request()->is('/') || request()->is('home') ? 'act-link' : '' }}">
                    Home
                </a>
            </li>

            {{-- Listings (no active check for dropdown) --}}
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

            {{-- About --}}
            <li>
                <a href="{{ request()->getHost() === $business->custom_domain
                    ? route('website.page.custom', ['slug' => 'about'])
                    : route('website.page', ['business' => $business->subdomain, 'slug' => 'about']) }}"
                    class="{{ request()->is('about') ? 'act-link' : '' }}">
                    Who We Are
                </a>
            </li>

            {{-- Services --}}
            <li>
                <a href="{{ request()->getHost() === $business->custom_domain
                    ? route('website.page.custom', ['slug' => 'services'])
                    : route('website.page', ['business' => $business->subdomain, 'slug' => 'services']) }}"
                    class="{{ request()->is('services') ? 'act-link' : '' }}">
                    What We Do
                </a>
            </li>

            {{-- News --}}
            <li>
                <a href="{{ request()->getHost() === $business->custom_domain
                    ? route('website.news.custom')
                    : route('website.news', ['business' => $business->subdomain]) }}"
                    class="{{ request()->is('news') ? 'act-link' : '' }}">
                    News
                </a>
            </li>

            {{-- Contact --}}
            <li>
                <a href="{{ request()->getHost() === $business->custom_domain
                    ? route('website.page.custom', ['slug' => 'contact'])
                    : route('website.page', ['business' => $business->subdomain, 'slug' => 'contact']) }}"
                    class="{{ request()->is('contact') ? 'act-link' : '' }}">
                    Contact
                </a>
            </li>
        </ul>
    </nav>
</div>
