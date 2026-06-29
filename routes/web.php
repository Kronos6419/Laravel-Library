<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminBookController;
use App\Http\Controllers\Api\BookApiController;

Route::redirect('/', 'books');

Route::resource('books', BookController::class);

// stops the GET logout error
Route::get('/logout', function () {
    return redirect()->route('books.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // API write routes served through web middleware so session auth works
    // Returns JSON responses, consumed by the JS front-end
    Route::post('/api/books', [BookApiController::class, 'store']);
    Route::post('/api/books/{book}', [BookApiController::class, 'update']);
    Route::delete('/api/books/{book}', [BookApiController::class, 'destroy']);

    // Admin routes
    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::resource('users', AdminUserController::class)->except(['show']);
        Route::resource('books', AdminBookController::class)->except(['show']);
    });
});

Route::middleware('guest')->group(function () {
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Keep last to avoid matching /admin/books
Route::get('/{user}/books', [DashboardController::class, 'userBooks'])->name('books.user');