<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Login\app\Http\Controllers\LoginController;

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

Route::controller(LoginController::class)->group(function(){
    // 登入
    Route::post('/login', 'login');
    // MFA驗證
    Route::post('/login/mfa', 'mfa');
});
