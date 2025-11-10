<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('welcome');
})->name('home');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/reset-email', [AuthController::class, 'showResetEmail'])->name('reset.email');
Route::post('/reset-email', [AuthController::class, 'resetEmail']);

Route::get('/privacy-policy', function () {
    return view('legal.privacy');
})->name('privacy');

Route::get('/terms-of-service', function () {
    return view('legal.terms');
})->name('terms');



Route::get('/popi-consent', [LegalController::class, 'popi'])->name('popi');

Route::middleware('auth')->group(function () {

    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('auth')
        ->name('user.dashboard');

    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])
        ->middleware('auth')
        ->name('admin.dashboard');
    //logout route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //profile routes shared by all users
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'changePassword'])->name('profile.password');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.delete');

    //settings routes shared by all users
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');
    Route::post('/settings/toggle-2fa', [SettingsController::class, 'toggle2FA'])->name('settings.toggle2fa');

    // Property routes
    Route::get('/properties/provinces', [App\Http\Controllers\PropertyController::class, 'propertiesBasedOnProvinces'])
        ->name('properties.provinces');
    Route::get('/admin/properties', [PropertyController::class, 'index'])->name('properties.index');
    Route::get('/admin/properties/{id}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
   // Update logic
    Route::put('/admin/properties/{id}', [PropertyController::class, 'update'])->name('properties.update');
  // Delete property
    Route::delete('/admin/properties/{id}', [PropertyController::class, 'destroy'])->name('properties.destroy');
    Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
    Route::post('/properties/store', [PropertyController::class, 'store'])->name('properties.store');
    Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');

   //Otp routes
    Route::get('/verify-otp', [OtpController::class, 'showVerifyForm'])->name('otp.verify.form');
    Route::post('/verify-otp', [OtpController::class, 'verifyOtp'])->name('otp.verify');
    Route::post('/resend-otp', [OtpController::class, 'resendOtp'])->name('otp.resend');

    //review routes
    Route::get('/properties/{id}/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::post('/properties/{id}/reviews', [ReviewController::class, 'store'])->middleware('auth')->name('reviews.store');

    // Email verification notice page
    Route::get('/email/verify', function () {
        return view('auth.verify-email-notice');
    })->middleware('auth')->name('verification.notice');

// Handle verification link
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill(); // marks the user as verified
        return redirect()->route('dashboard')->with('success', 'Your email has been verified!');
    })->middleware(['auth', 'signed'])->name('verification.verify');

// Resend verification email
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', 'Verification email sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');


    Route::get('/legal', [LegalController::class, 'index'])->name('legal');
// Accept POPI consent
    Route::post('/popi-consent', [LegalController::class, 'acceptPopi'])->name('popi.accept')->middleware('auth');

//User controller routes for admin
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');



});
