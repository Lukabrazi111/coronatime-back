<?php

use App\Http\Controllers\DashboardController;
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


Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/statistics', [DashboardController::class, 'statistics']);
    Route::get('/summarized-statistics', [DashboardController::class, 'summarizedStatistics']);
});

Route::post('/login', [LoginController::class, 'store']);
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/forgot-password', [ForgotPasswordController::class, 'send']);
Route::post('/reset-password', [ResetPasswordController::class, 'store']);
Route::get('/verify-user/{token}', [RegisterController::class, 'verifyEmail']);
