<?php

namespace Modules\User\app\Http\Requests;

use App\Http\Requests\BaseRequest;

class RegisterUserRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'account' => 'required',
            'password' => 'required',
            'passwordConfirm' => 'required|same:password',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages(){
        return [
            'name.required' => '姓名必填',
            'email.required' => '信箱必填',
            'email.email' => '信箱格式錯誤',
            'account.required' => '帳號必填',
            'password.required' => '密碼必填',
            'passwordConfirm.required' => '密碼確認必填',
            'passwordConfirm.same' => '填入密碼不符',
        ];
    }

}
