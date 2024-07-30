<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class ContactRequest extends FormRequest
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
            'fullname' => ['required', 'string', 'max:255'],
            'phone' => ['required','regex:/^(0[3|5|7|8|9])+([0-9]{8})\b$/'],
            'email' => ['required', 'email:rfc,dns'],
            'description' => ['required', 'string'],
        ];
    }
    public function messages(): array
    {
        return [
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'phone.regex' => 'Số điện thoại không đúng định dạng.',
            'fullname.required' => 'Họ và tên là bắt buộc.',
            'fullname.string' => 'Họ và tên phải là chuỗi ký tự.',
            'fullname.max' => 'Họ và tên không được vượt quá nhiều ký tự.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không đúng định dạng.',
            'description.required' => 'Nội dung là bắt buộc.',
            'description.string' => 'Nội dung phải là chuỗi ký tự.',
        ];
    }
}
