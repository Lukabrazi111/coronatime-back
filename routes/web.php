<?php

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

// Redirect if user not logged in
Route::get('/', function () {
})->middleware('auth');

// Testing route
Route::get('/main-page', function () {
    return view('main');
})->name('main');

// Testing route
Route::get('/main-by-country', function () {
    return view('main-by-country');
})->name('main.country');

// Route login
Route::get('/login', function () {
    return view('login');
})->name('login');

// Route register
Route::get('/register', function () {
    return view('register');
})->name('register');

// Route forgot-password
Route::get('/forgot-password', function () {
    return view('forgot-password');
})->name('forgot.password');

// Route reset-password
Route::get('/reset-password', function () {
    return view('reset-password');
})->name('reset.password');

// Route password-changed
Route::get('/password-changed', function () {
    return view('password-changed');
})->name('password.changed');

// Route account-confirm
Route::get('/account-confirmed', function () {
    return view('account-confirmed');
})->name('account.confirmed');
