<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\V1\Auth\{
    LoginController,
    LogoutController,
    RegisterController,
};
use App\Http\Controllers\API\V1\Library\{
    AuthorController,
    BookController,
    GenderController
};

Route::prefix('auth')->group(function () {

    Route::post('register', RegisterController::class);
    Route::post('login', LoginController::class);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('logout', LogoutController::class);
    });
});

Route::prefix('librery')->middleware('auth:sanctum')->group(function () {
    Route::apiResource('authors', AuthorController::class);
    Route::apiResource('genders', GenderController::class);
    Route::apiResource('books', BookController::class);
    Route::patch('books/{book}/stock', [BookController::class, 'updateStock'])->name('book.updateStock');
});
