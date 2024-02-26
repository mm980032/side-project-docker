<?php

namespace Modules\User\Services;

use Modules\User\Repositories\UserRepository;
use ThirdParties\Google\GoogleFAMService;

class UserService
{
    public function __construct(
        private UserRepository $userRepo,
        private $google2FA = new GoogleFAMService(),
    ){}

    /**
     * 註冊帳號
     *
     * @param array $post
     * @return void
     * @author ZhiYong
     */
    public function userRegister(array $post){
        list($secret, $qrCodeUrl) = $this->google2FA->generateGoogle2FAInfo('Side-Project', $post['email']);
        $payload = [
            'userID' => $this->userRepo->createUniqueID(),
            'name' => $post['name'],
            'email' => $post['email'],
            'account' => $post['account'],
            'password' => $post['password'],
            'googleAuthCode' => $secret,
            'googleAuthQrcodeUrl' => $qrCodeUrl,
        ];
        $this->userRepo->createUser($payload);
    }
}

