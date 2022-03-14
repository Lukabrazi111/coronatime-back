<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Livewire\ForgotPassword;
use App\Http\Livewire\Register;
use Illuminate\Support\Facades\Route;

Route::get('/lang/{lang}', [LanguageController::class, 'change'])->name('language.change');

//Route::fallback(function () {
//	if (auth()->user())
//	{
//		return redirect()->route('dashboard');
//	}
//
//	return redirect()->route('login');
//});

//Route::middleware(['auth', 'verified'])->group(function () {
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/by-country', function () {
	return view('dashboard-by-country');
})->name('dashboard.country');
//});

Route::middleware('guest')->group(function () {
	Route::get('/login', function () {
		return view('login');
	})->name('login');

	Route::post('/login', [LoginController::class, 'store'])->name('login.store');

	Route::get('/register', function () {
		return view('register');
	})->name('register');

	Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

	Route::get('/forgot-password', function () {
		return view('forgot-password');
	})->name('forgot.password');

	Route::post('/forgot-password', [ForgotPassword::class, 'send'])->name('forgot-password.send');

	Route::get('/reset-password/{token}', function ($token) {
		return view('reset-password', ['token' => $token, 'email' => request()->email]);
	})->name('reset-password.get');

	Route::post('/reset-password', [ResetPasswordController::class, 'store'])->name('reset-password.post');

	Route::get('/password-changed', function () {
		return view('password-changed');
	})->name('password.changed');

	Route::get('/account-confirmed', function () {
		return view('account-confirmed');
	})->name('account.confirmed');
});

Route::get('/user/verify/{token}', [Register::class, 'verifyEmail'])->name('verification.notice');
