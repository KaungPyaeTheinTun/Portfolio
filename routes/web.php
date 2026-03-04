<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\MessageController;

// Public
Route::get('/',         [HomeController::class, 'index'])->name('home');
Route::get('/about',    [HomeController::class, 'about'])->name('about');
Route::get('/skills',   [HomeController::class, 'skills'])->name('skills');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
Route::get('/contact',  [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

require __DIR__.'/auth.php';

// Admin
Route::prefix('kaungpyae')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/',                              [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('projects', AdminProjectController::class);
    Route::get('messages',                       [MessageController::class, 'index'])->name('messages.index');
    Route::patch('messages/{message}/read',      [MessageController::class, 'markRead'])->name('messages.read');
    Route::delete('messages/{message}',          [MessageController::class, 'destroy'])->name('messages.destroy');
});

