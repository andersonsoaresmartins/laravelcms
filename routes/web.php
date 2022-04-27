<?php

use Illuminate\Support\Facades\Route;

// Rota raiz para home do site
Route::get('/', [App\Http\Controllers\Site\HomeController::class, 'index']);

// Rota raiz para o portal de administração do Site
Route::prefix('dashboard')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin');

    // Rotas de autenticação de usuários
    Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'index'])->name('login');
    Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'authenticate']);

    // Rotas de registro de novos usuários
    Route::get('register', [\App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('register');
    Route::post('register', [\App\Http\Controllers\Auth\RegisterController::class, 'register']);

    // Rotas para logout
    Route::post('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});

