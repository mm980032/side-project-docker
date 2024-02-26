<?php

namespace App\Http\Middleware;

use App\ValueObject\ClientVO;
use Closure;
use Illuminate\Http\Request;
use Modules\User\app\Models\UserToken;
use Modules\User\Repositories\UserRepository;
use Modules\User\Repositories\UserTokenRepository;
use Symfony\Component\HttpFoundation\Response;

class AuthToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 實例
        app()->singleton('clientVO', ClientVO::class);

        $token = $request->bearerToken();
        if(empty($token)){
            return response()->json([
                'status' => 0,
                'title' => '提示',
                'msg' => '未傳入token'
            ]);
        }
        $userToken = app(UserTokenRepository::class)->selectUserToken($token);
        if(empty($userToken)){
            return response()->json([
                'status' => 0,
                'title' => '提示',
                'msg' => '未登入'
            ]);
        }
        if($userToken->isMFA === 0){
            return response()->json([
                'status' => 0,
                'title' => '提示',
                'msg' => '尚未驗證MFA'
            ]);
        }

        $user = $userToken->user;
        if(empty($user)){
            return response()->json([
                'status' => 0,
                'title' => '提示',
                'msg' => '用戶不存在'
            ]);
        }

        if($user->toggle == 0){
            return response()->json([
                'status' => 0,
                'title' => '提示',
                'msg' => '用戶未啟用'
            ]);
        }
        // 填充資料
        $clientVO = app('clientVO');
        $clientVO->token = $token;
        $clientVO->clientInfo = $user->toArray();
        $clientVO->userID = $user->userID;
        return $next($request);


    }
}
