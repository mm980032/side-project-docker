<?php

namespace Modules\LineNotify\app\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateLineNotify extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'authCode'=>'required',
            'name'=>'required'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'authCode.required' => '授權碼必填',
            'name.required' => '推播名稱必填',
        ];
    }
}
