<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'admin']], function() {
    Route::get('admin', [AdminController::class, 'showAdminBlade']);
    Route::get('user_edit/{id}', [AdminController::class, 'showUserEditBlade']);
    Route::put('user_update/{id}', [AdminController::class, 'userUpdate']);
    Route::get('user_activate/{id}', [AdminController::class, 'userActivate']);
    Route::get('user_deactivate/{id}', [AdminController::class, 'userDeactivate']);
    Route::delete('user_delete/{id}', [AdminController::class, 'userSoftDelete'])->name('user.delete');
});