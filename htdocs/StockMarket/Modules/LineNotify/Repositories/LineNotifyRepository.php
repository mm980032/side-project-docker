<?php
namespace Modules\LineNotify\Repositories;
use App\Repositories\BaseRepository;
use Modules\LineNotify\app\Models\LineNotify;

class LineNotifyRepository extends BaseRepository{

    public function model() {
        return LineNotify::class;
    }

    public function uniqueID()
    {
        return 'token';
    }

    /**
     * 新增line推播
     *
     * @param array $payload
     * @return void
     * @author ZhiYong
     */
    public function createLineNotify(array $payload){
        $this->model->insert($payload);
    }
}
