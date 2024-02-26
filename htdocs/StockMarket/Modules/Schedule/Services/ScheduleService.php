<?php

namespace Modules\Schedule\Services;

use App\Libraries\Pusher\Services\LineNotificationService;
use Modules\stock\Repositories\FocusStockRepository;
use ThirdParties\FinMind\FinMindService;
use ThirdParties\Fugle\FugleService;

class ScheduleService{

    public function __construct(
        private FinMindService $finMinService,
        private FugleService $fugleService,
        private FocusStockRepository $focusStockRepo,
        private LineNotificationService $lineNotify
    ){}

     /**
     * 推薦購買
     *
     * @return void
     * @author ZhiYong
     */
    public function recommendBuy() : void {
        // 關注股票
        $focus = $this->focusStockRepo->selectAllFocusStock('remo');
        // line推播
        $authCode = $focus->pluck('lineAuthCode');
        // 訊息組合
        $msg[0] = "當前判斷設定： 殖利率為3%以上 且 開盤價+-0.05%"."\n".
        "掃描股票範圍:";
        foreach ($focus as $key => $item) {
            $msg[0] .= $item['name'] . '(' .$item['stockCode'] . '), ';
            // 推播群組
            $lineAuth[] = $authCode[$key];
            // 股票資訊
            $data = $this->fugleService->getStockQuoteDeatil($item['stockCode']);
            // 取得殖利率
            $dividendYield = $this->finMinService->getDividend($data['symbol'], $data['lastPrice']);
            // 購買期望價格
            [$expectHightPrice, $expectLostPrice] = $this->getExpectPrice($data['openPrice'], 0.005);
            if($dividendYield >= 3 && ($expectLostPrice <= $data['lastPrice'] && $data['lastPrice'] <= $expectHightPrice)){
                $msg[] = "〖日期〗" . date('Y-m-d H:i:s') ."\n".
                "〖個股名稱〗". $data['name']. "(" . $data['symbol'] .")" . "\n".
                "〖殖利率〗". "(" .number_format($dividendYield, 2) . "%)" ."\n".
                "〖開盤價格〗". $data['openPrice']."\n".
                "〖當前價格〗". $data['lastPrice'] . '('. $data['change'] .')'."\n".
                "〖期望最高價格〗". $expectHightPrice."\n".
                "〖期望最低價格〗". $expectLostPrice."\n".
                "〖最高價格〗". $data['highPrice']. "\n".
                "〖最低價格〗". $data['lowPrice']."\n";
            }
        }

        if(!empty($msg[1])){
            foreach ($msg as $key => $item) {
                $this->lineNotify->sendNotification($item, $lineAuth[$key]);
            }
        }
        // 推薦購買邏輯(關注股票)
        // foreach ($focuCodes as $key => $code) {
        //     // 股票資訊
        //     $data = $this->fugleService->getStockQuoteDeatil($code);
        //     // 取得殖利率
        //     $dividendYield = $this->finMinService->getDividend($data['symbol'], $data['lastPrice']);

        //     // 購買期望價格
        //     [$expectHightPrice, $expectLostPrice] = $this->getExpectPrice($data['openPrice'], 0.005);
        //     if($dividendYield >= 3 && ($expectLostPrice <= $data['lastPrice'] && $data['lastPrice'] <= $expectHightPrice)){
        //         $msg[] = "〖日期〗" . date('Y-m-d H:i:s') ."\n".
        //         "〖個股名稱〗". $data['name']. "(" . $data['symbol'] .")" . "\n".
        //         "〖殖利率〗". "(" .number_format($dividendYield, 2) . "%)" ."\n".
        //         "〖開盤價格〗". $data['openPrice']."\n".
        //         "〖當前價格〗". $data['lastPrice'] . '('. $data['change'] .')'."\n".
        //         "〖期望最高價格〗". $expectHightPrice."\n".
        //         "〖期望最低價格〗". $expectLostPrice."\n".
        //         "〖最高價格〗". $data['highPrice']. "\n".
        //         "〖最低價格〗". $data['lowPrice']."\n";
        //     }
        // }
    }

     /**
     * 取得高低期望值
     *
     * @param string $openPrice
     * @param float $ratio
     * @return array
     * @author ZhiYong
     */
    public function getExpectPrice(string $openPrice, float $ratio) : array {
        $hightPrice = $openPrice + ($openPrice * $ratio);
        $lostPrice = $openPrice - ($openPrice * $ratio);

        return [$hightPrice, $lostPrice];
    }


    /**
     * 自己購買
     *
     * @return void
     * @author ZhiYong
     */
    public function ownBuy(){
        $msg = [];
        // 關注股票
        $focus = $this->focusStockRepo->selectAllFocusStock('own');
        // line推播
        $authCode = $focus->pluck('lineAuthCode');
        foreach ($focus as $key => $item) {
            // 股票資訊
            $data = $this->fugleService->getStockQuoteDeatil($item['stockCode']);
            $msg[$authCode[$key]] = "日期：" . date('Y-m-d H:i:s') ."\n".
            "個股名稱：". $data['name']. "(" . $data['symbol'] .")"."\n".
            "〖當前股價〗". $data['lastPrice']. "\n". $data['change'] ." (" . $data['changePercent'] ."%) " ."\n";
        }
        if(!empty($msg)){
            foreach ($msg as $authCode => $item) {
                $this->lineNotify->sendNotification($item, $authCode);
            }
        }
    }
}

