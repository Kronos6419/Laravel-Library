<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::view('/','posts.index')->name('home');

Route::view('/register','auth.register')->name('register');
Route::post('/register',[AuthController::class,'register']);

// Route::get('/', function () {
//     return view('posts.index');
// })->name('home');

// Route::get('/register', function () {
//     return view('auth.register');
// })->name('register');

Route::view('/login','auth.login')->name('login');
Route::post('/login',[AuthController::class,'login']);