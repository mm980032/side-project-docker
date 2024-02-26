<?php
namespace Modules\LineNotify\Services;

use Exception;
use Modules\LineNotify\Repositories\LineNotifyRepository;

class LineNotifyService {

    public function __construct(
        private LineNotifyRepository $repo
    )
    {}

    /**
     * 新增推播類型
     *
     * @param array $data
     * @return void
     * @author ZhiYong
     */
    public function createLineNotify(array $data){
        try {
            // 新增內容
            $this->repo->createLineNotify($data);
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }
}
