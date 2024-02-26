<?php

namespace Modules\stock\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Stock\app\Models\FocusStock;

/**
 * Class StockRepository.
 */
class FocusStockRepository extends BaseRepository
{
    public function model() {
        return FocusStock::class;
    }

    public function uniqueID()
    {
        return 'focusID';
    }

    // 建立關注股票
    public function createFocus(array $payload) : void
    {
        $this->model->upsert($payload, ['userID', 'stockCode']);
    }

    /**
     * 取得關注股票
     *
     * @param string $method
     * @return Collection
     * @author ZhiYong
     */
    public function selectAllFocusStock(string $method = 'remo') : Collection
    {
        return $this->model
            ->select(['lineAuthCode', 'stockCode', 'name'])
            ->where('method', $method)
            ->where('toggle', 1)
            ->get();
    }
}
