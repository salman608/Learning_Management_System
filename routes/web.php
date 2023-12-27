<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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



Route::get('/', [UserController::class, 'Index'])->name('index');

Route::get('/dashboard', function () {
    return view('frontend.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::get('user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::post('user/profile/update', [UserController::class, 'UserProfileUpdate'])->name('user.profile.update');
    Route::get('user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('user/password/update', [UserController::class, 'UserPasswordUpdate'])->name('user.password.update');
});

require __DIR__ . '/auth.php';

////.Admin Group Middleware
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');

    //  All  Category route
    Route::controller(CategoryController::class)->group(function () {
        Route::get('all/category', 'AllCategory')->name('all.category');
        Route::get('add/category', 'AddCategory')->name('add.category');
        Route::post('store/category', 'StoreCategory')->name('store.category');
        Route::get('edit/category/{id}', 'EditCategory')->name('edit.category');
        Route::post('update/category', 'UpdateCategory')->name('update.category');
    });
}); //end admin middleware

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

////.Instructor Group Middleware
Route::middleware(['auth', 'roles:instructor'])->group(function () {
    Route::get('/instructor/dashboard', [InstructorController::class, 'InstructorDashboard'])->name('instructor.dashboard');
    Route::get('/instructor/logout', [InstructorController::class, 'InstructorLogout'])->name('instructor.logout');
    Route::get('/instructor/profile', [InstructorController::class, 'InstructorProfile'])->name('instructor.profile');
    Route::post('/instructor/profile/store', [InstructorController::class, 'InstructorProfileStore'])->name('instructor.profile.store');
    Route::get('/instructor/change/password', [InstructorController::class, 'InstructorChangePassword'])->name('instructor.change.password');
    Route::post('/instructor/password/update', [InstructorController::class, 'InstructorPasswordUpdate'])->name('instructor.password.update');
}); //end admin middleware
Route::get('/instructor/login', [InstructorController::class, 'InstructorLogin'])->name('instructor.login');
