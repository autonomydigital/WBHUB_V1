<?php

use Illuminate\Support\Facades\Route;
use Modules\Businesses\Http\Controllers\BusinessController;

Route::middleware(['web', 'auth'])->prefix('businesses')->name('businesses.')->group(function () {
    Route::get('/', [BusinessController::class, 'index'])->name('index');
    Route::get('create', [BusinessController::class, 'create'])->name('create');
    Route::post('/', [BusinessController::class, 'store'])->name('store');
    Route::get('{business}', [BusinessController::class, 'show'])->name('show');
    Route::get('{business}/edit', [BusinessController::class, 'edit'])->name('edit');
    Route::put('{business}', [BusinessController::class, 'update'])->name('update');
});