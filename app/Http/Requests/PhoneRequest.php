<?php

namespace App\Http\Requests;

use App\Rules\PhoneExistsInTable;
use Illuminate\Foundation\Http\FormRequest;

class PhoneRequest extends FormRequest
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
        $rules = [
            'phone' => ['bail', 'required', 'regex:/^(0[3|5|7|8|9])+([0-9]{8})\b$/'],
        ];

        if ($this->has('role') && $this->get('role') != '') {
            $rules['phone'][] = new PhoneExistsInTable($this->role === 'user' ? 'users' : 'staffs', 'phone');
        }

        if ($this->has('phone_otp')) {
            $rules['phone_otp'] = ['bail', 'required', 'digits:6'];
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.regex' => 'Số điện thoại không đúng định dạng.',
        ];

        if ($this->has('phone_otp')) {
            $messages = array_merge($messages, [
                'phone_otp.required' => 'Chưa nhập mã OTP.',
                'phone_otp.digits' => 'Mã OTP phải là 6 chữ số.',
            ]);
        }

        return $messages;
    }
}
