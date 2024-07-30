<?php

namespace App\Http\Requests\Staff\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SignInRequest extends FormRequest
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
            'phone' => ['bail', 'required', 'regex:/^(0[3|5|7|8|9])+([0-9]{8})\b$/', 'exists:staffs,phone'],
            'password' => ['bail', 'required', 'string', 'min:8'],
        ];
    }

    public function messages()
    {
        return [
            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.regex' => 'Số điện thoại không đúng định dạng.',
            'phone.exists' => 'Số điện thoại chưa được đăng ký.',
            'email.required' => 'Email không được để trống.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.string' => 'Mật khẩu phải là chữ.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
        ];
    }
}
