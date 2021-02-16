<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UpdateAccountController;
use App\Http\Controllers\NotificationController;


Route::get('/', function () {
    return view('pages.index');
})->name('index');

Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function() {
	Route::get('/', [PagesController::class, 'profile'])->name('profile');
	Route::get('/setting', [PagesController::class, 'setting'])->name('setting');
	Route::get('/notifications', [PagesController::class, 'notifications'])->name('notifications');
	// ================ UPDATE ACCOUNT ROUTES ==================
	Route::post('/update/account', [UpdateAccountController::class, 'updateInfo']);
	Route::post('/update/image', [UpdateAccountController::class, 'updateImage']);
	Route::post('/update-password',[UpdateAccountController::class, 'updatePassword']);
	Route::post('/check-password',[UpdateAccountController::class, 'checkPassword']);
});
// ================ USER REGISTER/LOGIN ROUTES ==================
Route::post('/register', [RegisterController::class, 'create'])->name('register');
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'create'])->name('login');
Route::post('/logout', [LogoutController::class, 'create'])->name('logout');
// ================ USER BLOG ROUTES ==================
Route::group(['prefix' => 'blog'], function() {
	Route::get('/', [BlogsController::class, 'index'])->name('blogs');
	Route::get('/find/{id}', [BlogsController::class, 'find']);
	Route::get('/edit/{slug}', [BlogsController::class, 'editBlog'])->middleware('auth');
	Route::get('/read/{slug}', [BlogsController::class, 'readBlog']);
	Route::get('/comments/{id}', [CommentController::class, 'blogComments']);
	Route::get('/search/blog={data}', [BlogsController::class, 'search'])->name('search');
	Route::get('/json',[BlogsController::class, 'jsonBlogs']);
	Route::get('/json/pinned-blogs',[BlogsController::class, 'jsonPinnedBlogs']);
	Route::get('/json/profile',[BlogsController::class, 'jsonProfileBlogs']);

	Route::post('/pin/{id}',[BlogsController::class, 'pinBlog']);
	Route::post('/unpin/{id}',[BlogsController::class, 'unpinBlog']);
	Route::post('/create', [BlogsController::class, 'create']);
	Route::post('/update/{id}', [BlogsController::class, 'update'])->name('update-blog');
	Route::delete('/delete/{id}', [BlogsController::class, 'delete']);
});
// ================ BLOG COMMENTS ROUTES ==================
Route::prefix('comment')->group(function() {
	Route::post('/create', [CommentController::class, 'create']);
	Route::delete('/delete/{id}', [CommentController::class, 'delete']);
});

Route::group(['prefix' => 'notification', 'middleware' => 'auth'], function() {
	Route::get('/json', [NotificationController::class, 'notificationsJSON']);
	Route::post('/read/{id}', [NotificationController::class, 'markAsRead']);
	Route::delete('/delete/{id}', [NotificationController::class, 'delete']);
});

// ================ VUE JS ROUTES ==================
Route::group(['prefix' => 'api/blogs/'], function() {
	Route::get('json', [BlogsController::class, 'blogsJson']);
	Route::get('json/{id}',[BlogsController::class, 'blogsJsonFind']);
	Route::post('json/create', [BlogsController::class, 'blogsJsonCreate']);
	Route::post('json/update/{id}', [BlogsController::class, 'blogsJsonUpdate']);
	Route::delete('delete/{id}', [BlogsController::class, 'blogsJsonDelete']);
	Route::post('/login', [LoginController::class, 'apiCreate']);
});
