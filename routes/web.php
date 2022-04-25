<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\Site\HomeController::class, 'index']);

Route::prefix('dashboard')->group(function ()
{
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin');

    Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'index'])->name('login');
    Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'authenticate']);

    Route::get('register', [\App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('register');
    Route::post('register', [\App\Http\Controllers\Auth\RegisterController::class, 'register']);
});

