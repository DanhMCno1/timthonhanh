<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'password' => ['bail', 'required', 'min:8'],
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Mật khẩu là bắt buộc',
            'password.min' => 'Mật khẩu phải dài tối thiểu 8 ký tự',
        ];
    }
}
