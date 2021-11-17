<?php

use App\Http\Controllers\Users\WorklogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

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

Route::redirect('/', '/login');

Route::get('/register', [RegisterController::class, 'create'])->name('user.register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'create'])->name('user.login');
Route::post('/login', [LoginController::class, 'store']);

Route::middleware('auth')->group(function(){
    Route::get('/logout', [LoginController::class, 'logout'])->name('user.logout');
    Route::resource('/worklogs', WorklogController::class)->except(['show', 'destroy']);
});
