<?php

use Illuminate\Support\Facades\Route;
use Modules\UserProfiles\Http\Controllers\UserProfilesController;

/*
|--------------------------------------------------------------------------
| 🧩 UserProfiles Module Routes
|--------------------------------------------------------------------------
| All routes here are prefixed with "/profile" and require authentication.
| They handle everything to do with viewing and updating user profiles.
*/

Route::middleware(['web', 'auth'])->prefix('profile')->group(function () {

    // 🧑 View profile and settings
    Route::get('/', [UserProfilesController::class, 'profile'])->name('profile');
    Route::get('/settings', [UserProfilesController::class, 'profileSettings'])->name('profile.settings');

    // ✏️ Update profile details & password
    Route::post('/update/{id}', [UserProfilesController::class, 'updateProfile'])->name('profile.update');
    Route::post('/update-password/{id}', [UserProfilesController::class, 'updatePassword'])->name('profile.password.update');

    // 🖼️ Cover photo & avatar handling
    Route::post('/update-cover-photo/{id}', [UserProfilesController::class, 'updateCoverPhoto'])->name('profile.cover.update');
    Route::post('/choose-cover', [UserProfilesController::class, 'chooseDefaultCover'])->name('profile.cover.choose');
    Route::get('/api/default-covers', [UserProfilesController::class, 'listDefaultCovers'])->name('profile.cover.list');

    //  Profile completion meter
    Route::get('/api/completion', [UserProfilesController::class, 'profileCompletion'])->name('profile.completion');

    //  Social media links
    Route::post('/update-socials/{id}', [UserProfilesController::class, 'updateSocials'])->name('profile.socials.update');
    Route::delete('/socials/delete/{platform}', [UserProfilesController::class, 'deleteSocial'])->name('profile.socials.delete');

    //  Password validation (AJAX)
    Route::post('/validate-password', [UserProfilesController::class, 'validateCurrentPassword'])->name('profile.password.validate');

    //  Login history management
    Route::delete('/login-history/clear', [UserProfilesController::class, 'clearLoginHistory'])->name('profile.login-history.clear');

    //  Security settings (2FA etc.)
    Route::post('/security/update-toggle', [UserProfilesController::class, 'updateSecuritySetting'])->name('profile.security.update');



});

Route::get('/debug-check', function () {
    return 'UserProfiles module is alive!';
});

Route::get('/test-view', function () {
    return view('UserProfiles::profile'); // If using module view namespace
});