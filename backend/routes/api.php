<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Api\PostApiController;
use App\Http\Controllers\Api\RegisterController;



Route::post('/challenge3/user', [AuthorController::class, "store"]);
Route::post('/challenge3/auth', [AuthorController::class, "auth"]);

Route::get('/challenge3/{id}', [PostApiController::class, "show"]);
Route::get('/challenge3', [PostApiController::class, "index"]);

Route::post('/register', [RegisterController::class, "store"]);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/challenge3/store', [PostApiController::class, "store"]);
    Route::delete('/challenge3/delete/{id}', [PostApiController::class, "destroy"]);
    Route::put('/challenge3/update/{id}', [PostApiController::class, "update"]);
});
