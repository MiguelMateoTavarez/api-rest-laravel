<?php

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
