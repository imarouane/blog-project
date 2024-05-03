<?php

use App\Http\Controllers\CustomAuthController;
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

Route::controller(CustomAuthController::class)->group(function () {
    Route::get('/custom-login', 'index')->name('custom.login')->middleware('guest');
    Route::get('/custom-register', 'customRegisterIndex')->name('custom.show.register')->middleware('guest');
    Route::post('/custom-register', 'customRegister')->name('custom.register')->middleware('guest');
    Route::get('/password-recovery-email', 'passwordRecoveryEmail')->name('password.recovery.email')->middleware('guest');
    Route::get('/custom-password/reset/{token}', 'customPasswordReset')->name('custom.password.reset')->middleware('guest');
    Route::post('/custom-login', 'customLogin')->name('custom.login.post')->middleware('guest');
    Route::post('/custom-logout', 'customLogout')->name('custom.logout');
    Route::post('/custom-reset', 'customReset')->name('custom.reset')->middleware('guest');
    Route::post('/custom-password/reset', 'customPasswordUpdate')->name('custom.password.update')->middleware('guest');
});
