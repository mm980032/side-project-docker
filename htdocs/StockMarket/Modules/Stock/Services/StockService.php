<?php
namespace Modules\Stock\Services;

use Modules\Stock\Libraries\StockFormat;
use Modules\stock\Repositories\StockRepository;
use ThirdParties\FinMind\FinMindService;

class StockService {

    public function __construct(
        private FinMindService $finMinService,
        private StockRepository $stockRepo,
        private StockFormat $format,

    ){}

    /**
     * 所有股票選項
     *
     * @return array
     * @author ZhiYong
     */
    public function allStockOption(): array
    {
        $select = $this->stockRepo->getAllStock();
        $select = $this->format->groupStockCategory($select);
        return $select;
    }

    /**
     * 基礎資訊建制
     *
     * @return void
     * @author ZhiYong
     */
    public function buildStockBasedInformation(){
        $search = $this->finMinService->getStockInfo();
        $insert = [];
        if($search['status'] == 200){
            foreach ($search['data'] as $key => $item) {
                $insert[] = [
                    'category'  => $item['industry_category'],
                    'stockCode' => $item['stock_id'],
                    'name'      => $item['stock_name']
                ];
            }
        }
        $this->stockRepo->updateBaseStockInfo($insert);
    }
}

