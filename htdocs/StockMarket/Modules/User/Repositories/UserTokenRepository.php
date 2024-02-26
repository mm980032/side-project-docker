<?php

namespace Modules\User\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Modules\User\app\Models\User;
use Modules\User\app\Models\UserToken;

class UserTokenRepository extends BaseRepository {

    public function model() {
        return UserToken::class;
    }

    public function uniqueID()
    {
        return 'token';
    }

    /**
     * 登出
     *
     * @param string $userID
     * @return void
     * @author ZhiYong
     */
    public function logout(string $userID)
    {
        $model = $this->model;
        $model->where('userID', $userID)
                ->update(
                [
                    'isLogOut' => 1,
                    'logOutTime' => time()
                ]);
    }

    /**
     * 建立Token
     *
     * @param array $paylaod
     * @return void
     * @author ZhiYong
     */
    public function createUserToken(array $paylaod){
        $this->insertData($paylaod);
    }

    /**
     * 查詢用戶Token
     *
     * @param string $toekn
     * @return Model|null
     * @author ZhiYong
     */
    public function selectUserToken(string $toekn): ?Model
    {
        $model = $this->model;
        return $model
                ->select(['userID', 'isMFA'])
                ->where('token', $toekn)
                ->where('isLogOut', 0)
                ->whereNull('logOutTime')
                ->first();
    }

    /**
     * 更新通過MFA
     *
     * @param string $userID
     * @return void
     * @author ZhiYong
     */
    public function updateTokenToPassedMFA(string $userID){
        $this->model->where('userID', $userID)
                ->where('isLogOut', 0)
                ->whereNull('logOutTime')
                ->update(['isMFA'=> 1]);
    }
}

