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

Route::middleware(['web', 'auth'])->prefix('profile')->name('profile.')->group(function () {

    // 🧑 View profile and settings
    Route::get('/', [UserProfilesController::class, 'profile'])->name('view');
    Route::get('/settings', [UserProfilesController::class, 'profileSettings'])->name('settings');

    // ✏️ Update profile details & password
    Route::post('/update/{id}', [UserProfilesController::class, 'updateProfile'])->name('update');
    Route::post('/update-password/{id}', [UserProfilesController::class, 'updatePassword'])->name('password.update');

    // 🖼️ Cover photo & avatar handling
    Route::post('/update-cover-photo/{id}', [UserProfilesController::class, 'updateCoverPhoto'])->name('cover.update');
    Route::post('/choose-cover', [UserProfilesController::class, 'chooseDefaultCover'])->name('cover.choose');
    Route::get('/api/default-covers', [UserProfilesController::class, 'listDefaultCovers'])->name('cover.list');

    // 📊 Profile completion meter
    Route::get('/api/completion', [UserProfilesController::class, 'profileCompletion'])->name('completion');

    // 🔗 Social media links
    Route::post('/update-socials/{id}', [UserProfilesController::class, 'updateSocials'])->name('socials.update');
    Route::delete('/socials/delete/{platform}', [UserProfilesController::class, 'deleteSocial'])->name('socials.delete');

    // 🔐 Password validation (AJAX)
    Route::post('/validate-password', [UserProfilesController::class, 'validateCurrentPassword'])->name('password.validate');

    // 📜 Login history
    Route::delete('/login-history/clear', [UserProfilesController::class, 'clearLoginHistory'])->name('login-history.clear');

    // 🛡️ Security toggles (2FA, verification, etc.)
    Route::post('/security/update-toggle', [UserProfilesController::class, 'updateSecuritySetting'])->name('security.update');

    Route::post('/generate-backup-code', [UserProfilesController::class, 'generateBackupCode'])->name('backup.generate');
    
    Route::post('/notifications/toggle', [UserProfilesController::class, 'toggleNotification'])->name('notifications.toggle');});