<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\VerificationController;

Auth::routes();

// Public pages
Route::get('/', [HomeController::class, 'root'])->name('root');
Route::get('index/{locale}', [HomeController::class, 'lang'])->name('lang');

// Authenticated user routes
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Email Verification
    Route::get('/verify', [VerificationController::class, 'show'])->name('verification.notice');
    Route::post('/verify', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('/verify/resend', [VerificationController::class, 'resend'])->name('verification.resend');

    // Superadmin-only permissions
    Route::middleware('role:superadmin')->group(function () {
        Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');
        Route::post('permissions', [PermissionController::class, 'update'])->name('permissions.update');
    });
});

// Catch-all fallback
Route::get('{any}', [HomeController::class, 'index'])->where('any', '.*')->name('index');