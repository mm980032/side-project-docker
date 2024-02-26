<?php

namespace App\Repositories;

use App\Models\SystemErrorLog;
use Throwable;

/**
 * Class StockRepository.
 */
class SystemErrorLogRepository extends BaseRepository
{

    public function model() {
        return SystemErrorLog::class;
    }

    public function uniqueID()
    {
        return 'id';
    }

    public function errorLogRecoed(array $payload){
        $this->model->insert($payload);
    }
}
