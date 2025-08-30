<?php

use Illuminate\Support\Facades\Route;
use Modules\WebsiteContent\Http\Controllers\WebsiteFrontendController;
use Modules\WebsiteContent\Http\Controllers\PLPController;

Route::domain('{business}.wbhub.test')
    ->middleware(['web', 'validate.subdomain'])
    ->group(function () {
        Route::get('/', [WebsiteFrontendController::class, 'home'])->name('website.home');
        Route::get('/profile', [WebsiteFrontendController::class, 'publicProfile'])->name('website.profile');
        Route::get('/news', [WebsiteFrontendController::class, 'news'])->name('website.news');
        Route::post('/contact/submit', [WebsiteFrontendController::class, 'submitContactForm'])->name('website.contact.submit');

        // ✅ Insert these just before the catch-all {slug} route
        Route::get('/properties', [PLPController::class, 'listings'])->name('plp.properties.index');
        Route::get('/properties/{listingType}', [PLPController::class, 'listings'])->name('plp.properties.filtered');
        Route::get('/property/{slug}', [PLPController::class, 'show'])->name('plp.property.show');

        Route::get('/{slug}', [WebsiteFrontendController::class, 'page'])->name('website.page');
    });

// 🔶 Custom domain-based routing (e.g., city2country.com.au)
Route::middleware(['web', 'validate.customdomain'])
    ->group(function () {
        Route::get('/', [WebsiteFrontendController::class, 'home'])->name('website.home.custom');
        Route::get('/profile', [WebsiteFrontendController::class, 'publicProfile'])->name('website.profile.custom');
        Route::get('/{slug}', [WebsiteFrontendController::class, 'page'])->name('website.page.custom');
        Route::get('/news', [WebsiteFrontendController::class, 'news'])->name('website.news.custom');
    });