<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Stock\app\Http\Controllers\StockController;

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

Route::controller(StockController::class)->middleware('authToken')->prefix('stock')->group(function(){

    // 選項
    Route::prefix('/options')->group(function () {
        Route::get('/all', 'allStockOption');
    });

    // 基礎建置
    Route::get('/build-based', 'buildBasedInformation');

    // 關注清單
    Route::get('/focus', 'listFocuseStock');

    Route::prefix('/options/focuse')->group(function () {

        // 清單
        Route::get('/', 'listFocuseStock');
        // 新增關注
        Route::post('/', 'createFocuseStock');
    });
});

