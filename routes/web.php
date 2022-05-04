<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\ReportController;


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

Auth::routes();

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'admin']], function() {
    Route::get('admin', [AdminController::class, 'showAdminBlade']);
    Route::get('user_edit/{id}', [AdminController::class, 'showUserEditBlade']);
    Route::put('user_update/{id}', [AdminController::class, 'userUpdate']);
    Route::get('user_activate/{id}', [AdminController::class, 'userActivate']);
    Route::get('user_deactivate/{id}', [AdminController::class, 'userDeactivate']);
    Route::delete('user_delete/{id}', [AdminController::class, 'userSoftDelete'])->name('user.delete');
    
    Route::get('reports', [ReportController::class, 'showReportsBlade']);
    Route::get('pdf', [ReportController::class, 'createSellerPDF'])->name('pdf');
    Route::get('pdf2', [ReportController::class, 'createCategoryPDF'])->name('pdf2');

});

Route::group(['middleware' => ['auth', 'verified']], function() {
    Route::get('user_menu', [AnuncioController::class, 'showUserMenuBlade']);
    Route::get('ad_create', [AnuncioController::class, 'adCreate']);
    Route::delete('ad_delete/{id}', [AnuncioController::class, 'adSoftDelete'])->name('ad.delete');
});