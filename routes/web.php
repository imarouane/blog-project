<?php

use App\Http\Controllers\CustomLoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('admin.dashboard.index');

    Route::get('/posts', [PostController::class, 'index'])->name('admin.posts.index');
});


Auth::routes();

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/post/{post:slug}', 'show')->name('post.show');
    Route::get('/about', 'about')->name('about');
    Route::get('/contact', 'contact')->name('contact');
});

Route::controller(CustomLoginController::class)->group(function () {
    Route::get('/custom-login', 'index')->name('custom.login');
    Route::get('/custom-register', 'customRegister')->name('custom.register');
    Route::get('/password-recovery-email', 'passwordRecoveryEmail')->name('password.recovery.email');
    Route::get('/custom-password/reset/{token}', 'customPasswordReset')->name('custom.password.reset');
    Route::post('/custom-login', 'customLogin')->name('custom.login.post');
    Route::post('/custom-logout', 'customLogout')->name('custom.logout');
    Route::post('/custom-reset', 'customReset')->name('custom.reset');
    Route::post('/custom-password/reset', 'customPasswordUpdate')->name('custom.password.update');
});
