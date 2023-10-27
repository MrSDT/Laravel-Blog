<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [\App\Http\Controllers\BlogPostController::class, 'index']);

Route::get('/blog/{blogPost}', [\App\Http\Controllers\BlogPostController::class, 'show'])->name('blog.show');

Route::get('/blog/create/post', [\App\Http\Controllers\BlogPostController::class, 'create']);

Route::post('/blog/create/post', [\App\Http\Controllers\BlogPostController::class, 'store']);

Route::get('/blog/{blogPost}/edit', [\App\Http\Controllers\BlogPostController::class, 'edit']);

Route::put('/blog/{blogPost}/edit', [\App\Http\Controllers\BlogPostController::class, 'update']);

Route::delete('/blog/{blogPost}', [\App\Http\Controllers\BlogPostController::class, 'destroy']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::resource('dashboard', 'App\Http\Controllers\Admin\AdminDashboardController');
    Route::resource('users', 'App\Http\Controllers\Admin\UserController');

});
Route::delete('admin/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'destroy']);

//Route::get('/admin/dashboard', [AdminDashboardController::class, 'index']);

