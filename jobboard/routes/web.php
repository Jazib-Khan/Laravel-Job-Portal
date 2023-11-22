<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Jobs\JobsController;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');


Route::group(['prefix' => 'jobs'], function(){

    Route::get('single/{id}', [App\Http\Controllers\Jobs\JobsController::class, 'single'])->name('single.job');

    Route::post('save', [App\Http\Controllers\Jobs\JobsController::class, 'saveJob'])->name('save.job');

    Route::post('apply', [App\Http\Controllers\Jobs\JobsController::class, 'jobApply'])->name('apply.job');

    Route::any('search', [App\Http\Controllers\Jobs\JobsController::class, 'search'])->name('search.job');


});

Route::group(['prefix' => 'categories'], function(){

    Route::get('single/{name}', [App\Http\Controllers\Categories\CategoriesController::class, 'singleCategory'])->name('categories.single');

});

Route::group(['prefix' => 'users'], function(){

    Route::get('profile', [App\Http\Controllers\Users\UsersController::class, 'profile'])->name('profile');

    Route::get('applications', [App\Http\Controllers\Users\UsersController::class, 'applications'])->name('applications');

    Route::get('savedjobs', [App\Http\Controllers\Users\UsersController::class, 'savedJobs'])->name('saved.jobs');

    Route::get('edit-details', [App\Http\Controllers\Users\UsersController::class, 'editDetails'])->name('edit.details');
    Route::post('edit-details', [App\Http\Controllers\Users\UsersController::class, 'updateDetails'])->name('update.details');

    Route::get('edit-cv', [App\Http\Controllers\Users\UsersController::class, 'editCV'])->name('edit.cv');
    Route::post('edit-cv', [App\Http\Controllers\Users\UsersController::class, 'updateCV'])->name('update.cv');

});

Route::get('admin/login', [App\Http\Controllers\Admins\AdminsController::class, 'viewLogin'])->name('view.login');
Route::post('admin/login', [App\Http\Controllers\Admins\AdminsController::class, 'checkLogin'])->name('check.login');

Route::get('admin', [App\Http\Controllers\Admins\AdminsController::class, 'index'])->name('admins.dashboard');














