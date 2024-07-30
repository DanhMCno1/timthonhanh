<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'buy_request_id' => ['required', 'exists:buy_requests,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'buy_request_id.required' => 'Chưa chọn số lượt xem.',
            'buy_request_id.exists' => 'Vui lòng chọn số lượt xem hợp lệ.'
        ];
    }
}
