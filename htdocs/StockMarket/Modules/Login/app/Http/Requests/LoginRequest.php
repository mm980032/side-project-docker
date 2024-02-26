<?php

namespace Modules\Login\app\Http\Requests;

use App\Http\Requests\BaseRequest;

class LoginRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'account' => 'required',
            'password' => 'required'
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
            'account.required' => '帳號必填',
            'password.required' => '密碼必填'
        ];
    }

}
