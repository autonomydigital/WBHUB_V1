<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\UserController;
use Modules\UserProfiles\Http\Controllers\UserProfilesController;
use Modules\Users\Http\Controllers\UserFollowController;
use Modules\Users\Http\Controllers\UserConnectionController;


Route::middleware(['web', 'auth'])->prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::post('/filter', [UserController::class, 'filter'])->name('users.filter');
    Route::post('/toggle-follow', [UserFollowController::class, 'toggle'])->name('users.toggle-follow');
});

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/profile/{user}', [UserProfilesController::class, 'show'])->name('profile.show');
    Route::get('/profile/{user}/settings', [UserProfilesController::class, 'edit'])->name('profile.settings.user')->middleware('role:superadmin');
    
});


Route::middleware(['web', 'auth'])->prefix('connections')->name('connections.')->group(function () {
    Route::post('/send', [UserConnectionController::class, 'sendRequest'])->name('send');
    Route::post('/cancel/{id}', [UserConnectionController::class, 'cancelRequest'])->name('cancel');
    Route::post('/accept/{id}', [UserConnectionController::class, 'acceptRequest'])->name('accept');
    Route::post('/deny/{id}', [UserConnectionController::class, 'denyRequest'])->name('deny');
    Route::post('/disconnect/{id}', [UserConnectionController::class, 'disconnect'])->name('disconnect');

    Route::get('/', [UserConnectionController::class, 'index'])->name('index');
    Route::get('/incoming', [UserConnectionController::class, 'incoming'])->name('incoming');
    Route::get('/outgoing', [UserConnectionController::class, 'outgoing'])->name('outgoing');
});
