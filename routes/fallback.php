<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Handles all unmatched routes
Route::fallback([HomeController::class, 'index'])->name('fallback');