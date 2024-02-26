<?php

namespace ThirdParties\Fugle;

use Illuminate\Support\Facades\Http;

class FugleService {

    private $headers = [
        'Content-Type' => 'application/json',
        'X-API-KEY' => 'YjdmZTY4OTAtNTAzYS00ZGRhLTg4MjctNjFhMzk2YjE1ZWQxIDg5YzY5ZGM1LTdjYTQtNDlkMS1hMTA5LTdkNTViNDEwNjFiMQ=='
    ];

    /**
     * 取得股票報價資訊
     *
     * @param string $stockCode
     * @return array
     * @author ZhiYong
     */
    public function getStockQuoteDeatil(string $stockCode) : array{
        $url = 'intraday/quote/%s';
        $fugle_Quote = sprintf(env('Fugle_API') . DIRECTORY_SEPARATOR . $url, $stockCode);
        $data = Http::withHeaders($this->headers)->get($fugle_Quote)->json();
        return $data;
    }
}
