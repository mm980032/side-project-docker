<?php

namespace Modules\LineNotify\app\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Modules\LineNotify\app\Http\Requests\CreateLineNotify;
use Modules\LineNotify\Services\LineNotifyService;

class LineNotifyController extends BaseController
{
    public function __construct(
        private LineNotifyService $service
    ) {}

    /**
     * 新增line通知類型
     *
     * @param array $data
     * @return void
     * @author ZhiYong
     */
    public function createLineNotify(CreateLineNotify $request)
    {
        $post = $request->all();
        try {
            $this->service->createLineNotify($post);
            return $this->returnSuccessMsg();
        } catch (Exception $e) {
           return $this->returnErrorMsg($e->getMessage());
        }
    }
}
