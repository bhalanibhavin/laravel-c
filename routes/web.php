<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\PublicPostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'admin.role'])->prefix('admin')->group(function () {
    Route::resource('users', UserController::class)
        ->only(['index', 'edit', 'update', 'destroy'])
        ->names('admin.users');
    Route::resource('posts', PostController::class)->names('admin.posts');
});

Route::get('/posts', [PublicPostController::class, 'publicIndex'])->name('posts.index');
Route::get('/posts/{slug}', [PublicPostController::class, 'showPublic'])->name('posts.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
