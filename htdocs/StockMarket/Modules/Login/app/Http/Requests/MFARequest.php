<?php

namespace Modules\Login\app\Http\Requests;

use App\Http\Requests\BaseRequest;

class MFARequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'mfa' => 'required|max:6',
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
            'mfa.required' => 'mfa必填',
            'mfa.max' => '最多6碼'
        ];
    }

}
