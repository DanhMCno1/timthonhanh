<?php

namespace App\Http\Requests\User;

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
            'phone_signin' => ['required', 'string', 'regex:/^(0[3|5|7|8|9])+([0-9]{8})\b$/'],
            'password_signin' => ['required', 'string', 'min:8'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone_signin.regex' => 'Số điện thoại không đúng định dạng',
            'phone_signin.required' => 'Số điện thoại là bắt buộc.',
            'phone_signin.string' => 'Số điện thoại phải là chuỗi ký tự.',
            'password_signin.required' => 'Mật khẩu là bắt buộc.',
            'password_signin.string' => 'Mật khẩu phải là chuỗi ký tự.',
            'password_signin.min' => 'Mật khẩu phải có ít nhất :min ký tự.'
        ];
    }
}
