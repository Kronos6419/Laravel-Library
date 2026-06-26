<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;

Route::redirect('/','posts');

Route::resource('posts', PostController::class);

Route::get('/{user}/posts', [DashboardController::class, 'userPosts'])->name('posts.user');

// stops the GET logout error, the real logout stays a POST below
Route::get('/logout',function(){
    return redirect()->route('posts.index');
});

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class,'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware('guest')->group(function(){
    Route::view('/register','auth.register')->name('register');
    Route::post('/register',[AuthController::class,'register']);

    Route::view('/login','auth.login')->name('login');
    Route::post('/login',[AuthController::class,'login']);
});
