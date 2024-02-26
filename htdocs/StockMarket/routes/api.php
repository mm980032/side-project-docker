<?php

use App\Http\Controllers\FinMindController;
use App\Http\Controllers\StockController;
use App\Services\StockMarketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// LineBot通知範例
Route::get('/line-bot/push',[StockMarketService::class, 'notifyStockMarketInfo']);

Route::get('/get/focuse',[StockMarketService::class, 'getFocuseInfo']);

// 關注(收藏)
Route::post('/focus',[StockController::class, 'createFocusStock']);
// 建議購買
Route::get('/recommend/buy',[StockController::class, 'recommendBuy']);

// 基礎資料建置
Route::get('buildBase', [StockController::class, 'buildBase']);


Route::prefix('/finMind/stock')->group(function () {
    Route::get('',[FinMindController::class, 'info']);
});

