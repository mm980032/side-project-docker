<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
     * 成功訊息
     *
     * @param array $data
     * @param string $title
     * @param string $msg
     * @return JsonResponse
     * @author ZhiYong
     */
    public function returnSuccessMsg($data = [], $msg = '成功', $title = '提示') : JsonResponse {
        $result = [
            'status' => 1,
            'title' => $title,
            'message' => $msg
        ];
        if(!empty($data)) $result['data'] = $data;

        return response()->json($result);
    }

    /**
     * 錯誤訊息
     *
     * @param string $title
     * @param string $msg
     * @return JsonResponse
     * @author ZhiYong
     */
    public function returnErrorMsg($msg = '失敗', $title = '提示') : JsonResponse {
        $result = [
            'status' => 0,
            'title' => $title,
            'message' => $msg
        ];
        return response()->json($result);
    }
}
