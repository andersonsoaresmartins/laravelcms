<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\Site\HomeController::class, 'index']);

Route::prefix('dashboard')->group(function ()
{
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin');
    Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'index'])->name('login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
