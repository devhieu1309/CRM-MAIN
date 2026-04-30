<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
require __DIR__ . '/auth.php';
