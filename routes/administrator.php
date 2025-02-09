<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Auth\AccountController;
use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Blog\BlogDashboardController;
use App\Http\Controllers\Category\CategoryController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/route-clear', function() {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');

    return 'Routes cache has been cleared';
});

Route::get('/composer-dump-autoload', function () {
    try {
        Artisan::call('dump-autoload');
        $output = Artisan::output();

        return "Composer dump-autoload has been run successfully.\n" . $output;
    } catch (\Exception $e) {
        return "Error running composer dump-autoload: " . $e->getMessage();
    }
});

Route::get('/migrate', function () {
    Artisan::call('migrate');

    return 'Migrations have been run.';
});




Route::group(['prefix' => '/admin'], function() {

        Route::any('/login', [AuthController::class, 'login'])->name('login');
        Route::post('authenticate', [AuthController::class, 'authentiCation'])->name('authenticate');
        Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');
        Route::get('change-password', [ChangePasswordController::class,'changePasswordForm'])->name('changePassword.form');
        Route::post('change-password/change', [ChangePasswordController::class,'changePassword'])->name('changePassword.update');
        Route::resource('accounts', AccountController::class);

        Route::get('category', [CategoryController::class, 'index'])->name('category.index');
        Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::get('category/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('category', [CategoryController::class, 'store'])->name('category.store');
        Route::put('category/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
        Route::post('category/bulkDelete', [CategoryController::class, 'bulkDelete'])->name('category.bulkDelete');





        Route::post('/delete-blog-image', [BlogDashboardController::class, 'deleteImage'])->name('deleteImage.blog');
        Route::get('create', [BlogDashboardController::class, 'addBlog'])->name('blog.create');
        Route::post('store', [BlogDashboardController::class, 'store'])->name('blog.store');
        Route::get('dashboard', [BlogDashboardController::class, 'dashboard'])->name('blog.dashboard');
        Route::get('edit/{id}', [BlogDashboardController::class, 'edit'])->name('blog.edit');
        Route::put('/update/{id}', [BlogDashboardController::class, 'BlogUpdate'])->name('blog.update');
        Route::delete('/blog/delete/{id}',[BlogDashboardController::class, 'destroy'])->name('blog.delete');
        Route::post('logoutblog',[BlogDashboardController::class, 'logout'])->name('blog.logout');



});





