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




Route::get('blog/detail',[BlogController::class,'Deatils'])->name('blog.detail');
Route::resource('/blogs', BlogController::class);
