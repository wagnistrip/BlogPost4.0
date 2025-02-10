<?php

use App\Http\Controllers\Frontend\Blogs\BlogController;
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




Route::get('/category/{slug}', [BlogController::class, 'categoryBlogs'])->name('category.blogs');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.details');

Route::resource('/blogs', BlogController::class);
