<?php
namespace App\Libraries\Pusher\Services;

use Illuminate\Support\Facades\Http;

class LineNotificationService{

    private $token = [
        // 股票推薦購買
        'remmo' => 'rFSGUIAMKMdgYISFMe9f7tedSxw17L4jIaIaiQj8rwn',
        // 關注股票詳細資訊
        'detail' => 'gQqc8j6HHWEeQvBfuDkah78LLrcTuRex5EMjRW8VPKG',
        // 自己報價通知
        'own' => 'W435cdeeB0VCErIoXQwV5EEFxbXy7cMcsXmiZC6HALJ',
    ];
    private $curlUrl = 'https://notify-api.line.me/api/notify';


    /**
     * 發送訊息
     *
     * @param string $msg
     * @return void
     * @author ZhiYong
     */
    public function sendNotification(string $msg, string $authCode) : string
    {
        $headers = array(
            'Content-Type: multipart/form-data',
            'Authorization: Bearer ' . $authCode
        );
        $data = [
            'message' => $msg
        ];
        $result = curl('POST', $this->curlUrl, $headers, $data);
        if($result['httpCode'] != 200){
            return json_decode($result['content'])->message;
        }
        return 'ok!';
    }
}
