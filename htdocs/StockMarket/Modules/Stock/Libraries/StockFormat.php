<?php

namespace Modules\Stock\Libraries;
use Illuminate\Database\Eloquent\Collection;

class StockFormat
{
    /**
     * 分組
     *
     * @param Collection $data
     * @return array
     * @author ZhiYong
     */
    public function groupStockCategory(Collection $data): array
    {
        $result = [];
        foreach ($data as $key => $item) {
           if(!isset($result[$item['category']])){
                $result[$item['category']] = [];
           }
           $result[$item['category']][] = [
                'code' => $item['stockCode'],
                'name' => $item['name']
           ];
        }

        return $result;
    }
}

