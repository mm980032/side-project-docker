<?php
namespace ThirdParties\FinMind;

use Illuminate\Support\Facades\Http;

class FinMindService {

    /**
     * 取得所有股票代碼名稱(台股)
     *
     * @return array
     * @author ZhiYong
     */
    public function getStockInfo() : array{
        $parameters = [
            "dataset" => "TaiwanStockInfo"
        ];
        $response = Http::get(env('FIN_MINS_API'), $parameters);
        $data = $response->json();
        return $data;
    }

    /**
     * 取得股票股利
     *
     * @param string $code
     * @param string $price
     * @return float
     * @author ZhiYong
     */
    public function getDividend(string $code, string $price) : float {
        $fiveYearsAgo = date('Y-01-01', strtotime('-5 years', time()));
        $parameters = [
            "dataset" => "TaiwanStockDividend",
            "data_id" => $code,
            "start_date" => $fiveYearsAgo
        ];

        $response = Http::get(env('FIN_MINS_API'), $parameters);
        $response = $response->json();

        // 所有股利
        $all_dividend = array_column($response['data'], 'CashEarningsDistribution');
        // 平均股利
        $avg_dividend = array_sum($all_dividend)/ count($response);
        // 殖利率 => 股利/股價
        $dividend = ($avg_dividend / $price) * 100;
        return $dividend;
    }
}
