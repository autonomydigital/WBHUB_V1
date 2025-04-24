<?php

use Illuminate\Support\Facades\Route;
use Modules\Notifications\Http\Controllers\NotificationController;
use Modules\Users\Http\Controllers\UserConnectionController;

Route::middleware(['web', 'auth'])->prefix('notifications')->name('notifications.')->group(function () {
    Route::get('/', [NotificationController::class, 'alerts'])->name('alerts');
});