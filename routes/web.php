<?php

use App\Http\Controllers\CampController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SubmissionController as AdminSubmissionController;
use App\Http\Controllers\Admin\CampController as AdminCampController;
use Illuminate\Support\Facades\Route;


// Dashboard redirect
Route::get('/dashboard', function () {
    return redirect()->route('camps.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Public Routes
Route::get('/', function () {
    return redirect()->route('camps.index');
});

Route::get('/camps', [CampController::class, 'index'])->name('camps.index');
Route::get('/camps/map', [CampController::class, 'map'])->name('camps.map');
Route::get('/camps/{camp}', [CampController::class, 'show'])->name('camps.show');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/submit', [SubmissionController::class, 'create'])->name('submissions.create');
    Route::post('/submit', [SubmissionController::class, 'store'])->name('submissions.store');
    Route::get('/camps/{camp}/edit', [SubmissionController::class, 'edit'])->name('camps.edit');
    Route::post('/camps/{camp}/edit', [SubmissionController::class, 'update'])->name('camps.update');
    
    Route::resource('activities', ActivityController::class);
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/submissions', [AdminSubmissionController::class, 'index'])->name('submissions.index');
    Route::get('/submissions/{submission}', [AdminSubmissionController::class, 'show'])->name('submissions.show');
    Route::post('/submissions/{submission}/approve', [AdminSubmissionController::class, 'approve'])->name('submissions.approve');
    Route::post('/submissions/{submission}/reject', [AdminSubmissionController::class, 'reject'])->name('submissions.reject');
    
    Route::resource('camps', AdminCampController::class);
});

require __DIR__.'/auth.php';