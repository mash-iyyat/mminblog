<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\PagesController;

Route::get('/', function () {
    return view('pages.index');
})->name('index');
Route::get('profile', [PagesController::class, 'profile'])->name('profile');

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'create'])->name('register');
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'create'])->name('login');
Route::post('/logout', [LogoutController::class, 'create'])->name('logout');

Route::prefix('blog')->group(function() {
	Route::get('/', [BlogsController::class, 'index'])->name('blogs');
	Route::post('/create', [BlogsController::class, 'create']);
	Route::delete('/update/{id}', [BlogsController::class, 'update']);
	Route::post('/delete/{id}', [BlogsController::class, 'delete']);
});
