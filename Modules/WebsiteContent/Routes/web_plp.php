<?php

use Illuminate\Support\Facades\Route;
use Modules\WebsiteContent\Http\Controllers\PLPController;

Route::get('/plp-test', function () {
    return 'PLP Routes ARE loading';
});

Route::domain('plp.wbhub.au')->group(function () {
    Route::get('/', [PLPController::class, 'home'])->name('plp.home');
    Route::get('/properties', [PLPController::class, 'listings'])->name('plp.properties.index');
    Route::get('/properties/{listingType}', [PLPController::class, 'listings'])->name('plp.properties.filtered');
    Route::get('/property/{slug}', [PLPController::class, 'show'])->name('plp.property.show');
});