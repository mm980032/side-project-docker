<?php

namespace Modules\Stock\app\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateFocusStockRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'method' => 'required|in:own,remmo',
            'stockCode' => 'nullable|array',
            'lineAuthCode' => 'required'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages() : array
    {
        return [
            'method.required' => '推播類型必填',
            'method.in' => '推播類型錯誤',
            'stockCode.array' => '關注代碼類型錯誤',
            'lineAuthCode.required' => '推播群組必填'
        ];
    }
}
