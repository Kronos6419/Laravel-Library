<?php

use App\Http\Controllers\Api\BookApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| These routes return JSON. Public routes are open to guests.
| Write routes require an active session (same-domain session auth).
*/

// Public endpoints — no auth required
Route::get('/books', [BookApiController::class, 'index']);
Route::get('/books/{book}', [BookApiController::class, 'show']);

// Protected endpoints — must be logged in
Route::middleware('auth:web')->group(function () {
    Route::post('/books', [BookApiController::class, 'store']);
    Route::post('/books/{book}', [BookApiController::class, 'update']); // POST with _method=PUT for multipart
    Route::delete('/books/{book}', [BookApiController::class, 'destroy']);
});
