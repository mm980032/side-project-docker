<?php
namespace Modules\Login\Services;

use Illuminate\Database\Eloquent\Model;
use Modules\Login\Validator\LoginValidator;
use Modules\User\Repositories\UserRepository;
use Modules\User\Repositories\UserTokenRepository;
use ThirdParties\Google\GoogleFAMService;

class LoginService{

    public function __construct(
        private UserRepository $userRepo,
        private UserTokenRepository $userTokenRepo,
        private $google2FA = new GoogleFAMService(),
    ){}

    /**
     * 取得用戶(account)
     *
     * @param array $post
     * @return Model
     * @author ZhiYong
     */
    public function getUser(array $post) : Model
    {
        $user = $this->userRepo->selectUserByAccount($post['account']);
        if(empty($user)){
            throw new \Exception('無此用戶');
        }
        if($user->toggle !== 1){
            throw new \Exception('此用戶已被停權，請聯絡客服');
        }
        return $user;
    }

    /**
     * 取得用戶(Token)
     *
     * @param string $token
     * @return Model
     * @author ZhiYong
     */
    public function getUserByToken(string $token): Model
    {
        $userToken = $this->userTokenRepo->selectUserToken($token);
        if(empty($userToken)){
            throw new \Exception('無效登入');
        }
        $user = $this->userRepo->selectUserByUserID($userToken->userID);
        if($user->toggle !== 1){
            throw new \Exception('此用戶已被停權，請聯絡客服');
        }
        return $user;
    }

    /**
     * 登入
     *
     * @param Model $post
     * @return array
     * @author ZhiYong
     */
    public function login(Model $user): array
    {
        // 登出紀錄
        $this->userTokenRepo->logout($user->userID);
        // 建立Token
        $payload = [
            'userID' => $user->userID,
            'token' =>  $this->userTokenRepo->createUniqueID(),
        ];
        $this->userTokenRepo->createUserToken($payload);

        return ['token' => $payload['token']];
    }

    /**
     * 驗證mfa
     *
     * @param Model $user
     * @param string $mfa
     * @return void
     * @author ZhiYong
     */
    public function mfa(Model $user, string $mfa)
    {
        // 驗證 google mfa
        $valid = $this->google2FA->isValiMfa($user->googleAuthCode, $mfa);
        if(!$valid){
            throw new \Exception('MFA驗證錯誤');
        }
        // 更新Token 通過 MFA
        $this->userTokenRepo->updateTokenToPassedMFA($user->userID);
    }
}
