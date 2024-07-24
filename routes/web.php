<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    ray('Hi world');

    return view('welcome');
});
