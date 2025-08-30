<?php

use Illuminate\Support\Facades\Route;
use Modules\WebsiteContent\Http\Controllers\WebsiteContentController;

Route::middleware(['web', 'auth'])
    ->prefix('website-content')
    ->name('websitecontent.')
    ->group(function () {
        // Route::get('{business}/pages/{slug}', [WebsiteContentController::class, 'edit'])->name('webpage.edit');
        // Route::post('{business}/pages/{slug}', [WebsiteContentController::class, 'update'])->name('webpage.update');
    });