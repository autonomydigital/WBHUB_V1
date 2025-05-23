<?php

use Modules\Notifications\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->prefix('notifications')->name('notifications.')->group(function () {
    Route::get('/', [NotificationController::class, 'alerts'])->name('alerts');
    Route::post('{notification}/dismiss', [NotificationController::class, 'dismiss'])->name('dismiss');
});