<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\CommentController;

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
	Route::get('/find/{id}', [BlogsController::class, 'find']);
	Route::post('/update/{id}', [BlogsController::class, 'update']);
	Route::delete('/delete/{id}', [BlogsController::class, 'delete']);
	Route::get('/view={id}', [BlogsController::class, 'readBlog']);
	Route::get('/paginate',[BlogsController::class, 'paginate']);
	Route::get('/profile/myblogs',[BlogsController::class, 'viewMoreProfileBlog']);
});

Route::prefix('comment')->group(function() {
	Route::post('/create', [CommentController::class, 'create']);
	Route::delete('/delete/{id}', [CommentController::class, 'delete']);
});