<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::view('/users', 'users.index')->name('users.index');
    // Route::view('/users/create', 'users.create')->name('users.create');
    // Route::view('/users/{user}/edit', 'users.edit')->name('users.edit');
});

Route::get('/terms', [TermsController::class, 'index'])->name('terms.index');
Route::post('/terms', [TermsController::class, 'store'])->name('terms.store');

Route::group(['middleware' => 'role:admin'], function() {
    Route::resource('users', UserController::class);
    Route::patch('/users/{user}/restore', [UserController::class, 'restore'])->withTrashed()->name('users.restore');
    Route::delete('/users/{user}/force-delete', [UserController::class, 'forceDelete'])->withTrashed()->name('users.forceDelete');
});

Route::resource('clients', ClientController::class);
Route::resource('projects', ProjectController::class);
Route::resource('tasks', TaskController::class);
require __DIR__ . '/auth.php';
