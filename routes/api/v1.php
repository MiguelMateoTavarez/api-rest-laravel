<?php

use App\Http\Controllers\API\V1\Library\AuthorController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\V1\Auth\{
    LoginController,
    LogoutController,
    RegisterController,
};

Route::prefix('auth')->group(function(){

    Route::post('register', RegisterController::class);
    Route::post('login', LoginController::class);

    Route::middleware(['auth:sanctum'])->group(function(){
        Route::post('logout', LogoutController::class);
    });
});
Route::prefix('librery')->middleware('auth:sanctum')->group(function(){
    Route::apiResource('authors', AuthorController::class);
});
