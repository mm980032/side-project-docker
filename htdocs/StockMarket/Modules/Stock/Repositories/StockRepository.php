<?php

namespace Modules\stock\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Stock\app\Models\Stock;

/**
 * Class StockRepository.
 */
class StockRepository extends BaseRepository
{

    public function model() {
        return Stock::class;
    }

    public function uniqueID()
    {
        return 'id';
    }

    /**
     * 取得所有股票
     *
     * @return Collection
     * @author ZhiYong
     */
    public function getAllStock() : Collection
    {
        $model = $this->model;
        return $model->select(
                [
                    'category',
                    'stockCode',
                    'name'
                ]
            )->get();
    }

    // 新增或編輯股票資訊
    public function updateBaseStockInfo(array $payload){
        $this->model->upsert($payload, ['stockCode']);
    }
}
