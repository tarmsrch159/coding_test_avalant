<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\RestApiController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/challenge3/get/{id}', [PostController::class, "show"]);

Route::middleware(['auth:sanctum'])->group(function () {
    //

    Route::resource('challenge3', PostController::class, [
        "names" => [
            'index' => 'admin.challenge3.index',
            'create' => 'admin.challenge3.create',
            'store' => 'admin.challenge3.store',
            'edit' => 'admin.challenge3.edit',
            'update' => 'admin.challenge3.update',
            'destroy' => 'admin.challenge3.destroy',
        ]
    ]);
});
