<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\LineNotify\app\Http\Controllers\LineNotifyController;

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

Route::controller(LineNotifyController::class)->prefix('/lineNotify')->group(function(){
     // 新增Line推播
     Route::post('', 'createLineNotify');
});

