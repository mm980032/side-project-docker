<?php

namespace Modules\User\app\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\User\app\Http\Requests\RegisterUserRequest;
use Modules\User\app\Libraries\UserLibrary;
use Modules\User\app\Validator\UserValidator;
use Modules\User\Services\UserService;

class UserController extends BaseController
{

    public function __construct(
        private UserService $service,
        private UserValidator $valid
    ){}

    /**
     * 註冊帳號
     *
     * @return JsonResponse
     * @author ZhiYong
     */
    public function userRegister(RegisterUserRequest $request): JsonResponse
    {
        $post = $request->validated();
        try {
            $this->valid->checkUserAccountExist($post['account']);
            $this->service->userRegister($post);
            return $this->returnSuccessMsg();
        } catch (\Throwable $th) {
            return $this->returnErrorMsg('失敗，原因：'. $th->getMessage());
        }
    }

}
