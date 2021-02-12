<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UpdateAccountController;


Route::get('/', function () {
    return view('pages.index');
})->name('index');

Route::prefix('profile')->group(function() {
	Route::get('/', [PagesController::class, 'profile'])->name('profile');
	Route::get('/setting', [PagesController::class, 'setting'])->name('setting');
	//UPDATE ACCOUNT API
	Route::post('/update/account', [UpdateAccountController::class, 'updateInfo']);
	Route::post('/update/image', [UpdateAccountController::class, 'updateImage']);
	Route::post('/check-password',[UpdateAccountController::class, 'checkPassword']);
	Route::post('/update-password',[UpdateAccountController::class, 'updatePassword']);
});

// Route::get('/mashmin/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'create'])->name('register');
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'create'])->name('login');
Route::post('/logout', [LogoutController::class, 'create'])->name('logout');

Route::prefix('blog')->group(function() {
	Route::get('/', [BlogsController::class, 'index'])->name('blogs');
	Route::get('/find/{id}', [BlogsController::class, 'find']);
	Route::get('/read/{slug}', [BlogsController::class, 'readBlog']);
	Route::get('/comments/{id}', [CommentController::class, 'blogComments']);
	Route::get('/search/blog={data}', [BlogsController::class, 'search'])->name('search');
	Route::get('/json',[BlogsController::class, 'jsonBlogs']);
	Route::get('/json/profile',[BlogsController::class, 'jsonProfileBlogs']);

	Route::post('/create', [BlogsController::class, 'create']);
	Route::post('/update/{id}', [BlogsController::class, 'update']);
	Route::delete('/delete/{id}', [BlogsController::class, 'delete']);
});

Route::prefix('comment')->group(function() {
	Route::post('/create', [CommentController::class, 'create']);
	Route::delete('/delete/{id}', [CommentController::class, 'delete']);
});


Route::prefix('api')->group(function() {
	Route::get('/blogs/json', [BlogsController::class, 'blogsJson']);
	Route::get('/blogs/json/{id}',[BlogsController::class, 'blogsJsonFind']);
	Route::post('/blogs/json/create', [BlogsController::class, 'blogsJsonCreate']);
	Route::post('/blogs/json/update/{id}', [BlogsController::class, 'blogsJsonUpdate']);
	Route::delete('/blogs/delete/{id}', [BlogsController::class, 'blogsJsonDelete']);
	Route::post('/login', [LoginController::class, 'apiCreate']);
});
