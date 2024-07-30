<?php

namespace App\Http\Requests\Staff\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'password' => ['bail' ,'required', 'string', 'min:8', 'confirmed'],
            'token' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'password.required' => 'Mật khẩu mới không được để trống.',
            'password.string' => 'Mật khẩu mới phải là chữ.',
            'password.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'token.required' => 'Không có token.'
        ];
    }
}
