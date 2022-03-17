<?php

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Models\CountryStatistics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
	return $request->user();
});

Route::post('/login', [LoginController::class, 'store']);
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/forgot-password', [ForgotPasswordController::class, 'send']);
Route::post('/reset-password', [ResetPasswordController::class, 'store']);
Route::get('/user/verify/{token}', [RegisterController::class, 'verifyEmail']);

Route::get('/statistics', function () {
	return CountryStatistics::select('confirmed', 'recovered', 'deaths')->get();
});

Route::get('/get-all-statistics', function () {
	return CountryStatistics::all();
});
