<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Livewire\ForgotPassword;
use App\Http\Livewire\Login;
use App\Http\Livewire\Register;
use Illuminate\Support\Facades\Route;

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
Route::get('/lang/{lang}', [LanguageController::class, 'change'])->name('language.change');

Route::fallback(function () {
	if (auth()->user())
	{
		return redirect()->route('dashboard');
	}

	return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
	// Route dashboard
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

	Route::get('/by-country', function () {
		return view('dashboard-by-country');
	})->name('dashboard.country');
});

// Route login
Route::middleware('guest')->group(function () {
	Route::get('/login', function () {
		return view('login');
	})->name('login');

	Route::post('/login', [Login::class, 'store'])->name('login.store');

	// Route register
	Route::get('/register', function () {
		return view('register');
	})->name('register');

	Route::post('register', [Register::class, 'store'])->name('register.store');

	// Route forgot-password
	Route::get('/forgot-password', function () {
		return view('forgot-password');
	})->name('forgot.password');

	Route::post('/forgot-password', [ForgotPassword::class, 'send'])->name('forgot-password.send');

	// Route reset-password
	Route::get('/reset-password/{token}', function ($token) {
		return view('reset-password', ['token' => $token, 'email' => request()->email]);
	})->name('reset-password.get');

	Route::post('/reset-password', [ResetPasswordController::class, 'store'])->name('reset-password.post');

	// Route password-changed
	Route::get('/password-changed', function () {
		return view('password-changed');
	})->name('password.changed');

	// Route account-confirm
	Route::get('/account-confirmed', function () {
		return view('account-confirmed');
	})->name('account.confirmed');
});

Route::get('/user/verify/{token}', [Register::class, 'verifyEmail'])->name('verification.notice');
