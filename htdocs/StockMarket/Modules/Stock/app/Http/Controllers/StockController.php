<?php

namespace Modules\Stock\app\Http\Controllers;

use App\Http\Controllers\BaseController;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Stock\app\Http\Requests\CreateFocusStockRequest;
use Modules\Stock\Services\FocusStockService;
use Modules\Stock\Services\StockService;

class StockController extends BaseController
{

    public function __construct(
        private StockService $service,
        private FocusStockService $focusService
    ){}

    /**
     * 所有股票選項
     *
     * @return JsonResponse
     * @author ZhiYong
     */
    public function allStockOption(): JsonResponse{
        try {
            $data = $this->service->allStockOption();
            return $this->returnSuccessMsg($data);
        } catch (\Throwable $th) {
            return $this->returnErrorMsg('失敗，原因：'. $th->getMessage());
        }
    }

    /**
     * 建立基礎資訊
     *
     * @return JsonResponse
     * @author ZhiYong
     */
    public function buildBasedInformation() : JsonResponse{
        try {
            $this->service->buildStockBasedInformation();
            return $this->returnSuccessMsg();
        } catch (\Throwable $th) {
            return $this->returnErrorMsg('失敗，原因：'. $th->getMessage());
        }
    }

    /**
     * 建立關注股票
     *
     * @param CreateFocusStockRequest $request
     * @return JsonResponse
     * @author ZhiYong
     */
    public function createFocuseStock(CreateFocusStockRequest $request) : JsonResponse{
        $post = $request->validated();
        try {
            $this->focusService->createFocusStock($post);
            return $this->returnSuccessMsg();
        } catch (Exception $e) {
            return $this->returnErrorMsg($e->getMessage());
        }
    }

    /**
     * 關注股票清單
     *
     * @return void
     * @author ZhiYong
     */
    public function listFocuseStock(){
        try {
            $data = $this->focusService->list();
            return $this->returnSuccessMsg($data);
        } catch (Exception $e) {
            return $this->returnErrorMsg($e->getMessage());
        }
    }
}
