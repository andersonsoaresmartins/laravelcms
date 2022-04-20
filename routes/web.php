<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', 'Site\HomeController:class', 'index');

Route::get('/', [App\Http\Controllers\Site\HomeController::class, 'index']);

Route::prefix('dashboard')->group(function ()
{
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index']);
});
