<?php
namespace App\Trait;

use Illuminate\Database\Eloquent\Collection;

trait HasCRUD{

    /**
     * 尋找全部資訊
     *
     * @param array $where
     * @param array $select
     * @param \Closure|null $etral
     * @return Collection
     * @author ZhiYong
     */
    public function selectAllData(array $where = [], array $select = ['*'], \Closure $etral = null) : Collection {

        $model = $this->model;

        foreach ($where as $key => $item) {
            switch (count($item)) {
                case 2:
                    $model = $model->where($item[0], $item[1]);
                    break;
                case 3:
                    $model = $model->where($item[0], $item[1], $item[2]);
                    break;
                default:
                    # code...
                    break;
            }
        }
        $model = $model->select($select);

        if ($etral !== null && is_callable($etral)) {
            $model = $etral($model);
        }
        return $model->get();
    }

    /**
     * 批次新增
     *
     * @param array $payload
     * @return void
     * @author ZhiYong
     */
    public function insertData(array $payload) : void {
        $this->model->insert($payload);
    }

    /**
     * 批次刪除
     *
     * @param array $id
     * @return void
     * @author ZhiYong
     */
    public function deleteDataByUnique(array $id) : void {
        $this->model->whereIn($this->unique, $id)->delete();
    }

    /**
     * 批次刪除
     *
     * @param array $id
     * @return void
     * @author ZhiYong
     */
    public function deleteDataByColumn(string $column, array $id) : void {
        $this->model->whereIn($column, $id)->delete();
    }

    /**
     * 範圍取得資訊
     *
     * @param array $codes
     * @return Collection
     * @author ZhiYong
     */
    public function selectStockByRangeCode(array $codes) : Collection {
        return $this->model->whereIn('stockCode', $codes);

    }
}

