<?php

namespace Modules\User\app\Validator;

use Modules\User\Repositories\UserRepository;

class UserValidator
{

    public function __construct(
        private UserRepository $userRepo
    ){}

    /**
     * 驗證帳號是否存在
     *
     * @param string $account
     * @return void
     * @author ZhiYong
     */
    public function checkUserAccountExist(string $account)
    {
        $user = $this->userRepo->selectUserByAccount($account);
        if(!empty($user)){
            throw new \Exception('帳號已存在');
        }
    }
}
