<?php
namespace App\Libraries\Pusher\Services;

use App\Helpers\Curl;
use Illuminate\Http\JsonResponse;

class LineBotService{

    private $channelAccessToken = 'gvZyKONO7HWBfJXZQq1wKVEpaUWFRuDTtcZRc7XHC17KD6Q7JKAqlG1his8bPpGJTxtdbPyW9Q6HVEhPEMrYGAbQdltPd7MHmlLlE5ZZpcSPjz37pmADffQV082ftCvpldbKpSvzd5uxTwMRrG1qFwdB04t89/1O/w1cDnyilFU=';
    private $userID = 'U454db464af7f0da84b8e029d95cdf4e3';
    private $curlUrl = 'https://api.line.me/v2/bot/message/push';

    /**
     * LineBot發送訊息
     *
     * @param string $msg

     * @author ZhiYong
     */
    public function sendNotification(array $messages)
    {
        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->channelAccessToken
        );
        $message['to'] = $this->userID;
        foreach ($messages as $key => $value) {
            $message['messages'][] = [
                "type" => "text",
                "text" => $value
            ];
        }
        $result = curl('POST', $this->curlUrl, $headers, json_encode($message));
        if($result['httpCode'] != 200){
            return json_decode($result['content'])->message;
        }
        return 'ok!';
    }
}
