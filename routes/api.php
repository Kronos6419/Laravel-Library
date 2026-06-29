<?php

use App\Http\Controllers\Api\BookApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes — Public read-only endpoints
|--------------------------------------------------------------------------
| Write endpoints (store, update, destroy) live in web.php so they
| inherit the session middleware and auth:web works correctly.
*/

Route::get('/books', [BookApiController::class, 'index']);
Route::get('/books/{book}', [BookApiController::class, 'show']);