<?php

use Illuminate\Support\Facades\Route;
use Modules\Properties\Http\Controllers\PropertiesController;

Route::middleware(['web', 'auth'])->prefix('properties')->name('properties.')->group(function () {
    Route::get('/', [PropertiesController::class, 'index'])->name('index');
});