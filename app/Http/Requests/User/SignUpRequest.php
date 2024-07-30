<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
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
            'phone' => [
                'required',
                'string',
                'regex:/^(0[3|5|7|8|9])+([0-9]{8})\b$/'
            ],
            'password' => ['required', 'string', 'min:8'],
            'confirm_password' => ['required', 'same:password'],
            'fullname' => ['required', 'string', 'max:255'],
            'province_id' => ['required', 'exists:provinces,id'],
            'district_id' => ['required', 'exists:districts,id'],
            'ward_id' => ['required', 'exists:wards,id'],
            'hamlet' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'phone.regex' => 'Số điện thoại không đúng định dạng. ',
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'phone.string' => 'Số điện thoại phải là dạng chuỗi.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.string' => 'Mật khẩu phải là chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'confirm_password.required' => 'Xác nhận mật khẩu là bắt buộc.',
            'confirm_password.same' => 'Xác nhận mật khẩu không khớp với mật khẩu.',
            'fullname.required' => 'Họ và tên là bắt buộc.',
            'fullname.string' => 'Họ và tên phải là chuỗi ký tự.',
            'fullname.max' => 'Họ và tên không được vượt quá nhiều ký tự.',
            'province_id.required' => 'Tỉnh/Thành phố là bắt buộc.',
            'province_id.exists' => 'Tỉnh/Thành phố không hợp lệ.',
            'district_id.required' => 'Quận/Huyện là bắt buộc.',
            'district_id.exists' => 'Quận/Huyện không hợp lệ.',
            'ward_id.required' => 'Phường/Xã là bắt buộc.',
            'ward_id.exists' => 'Phường/Xã không hợp lệ.',
            'hamlet.required' => 'Thôn/Xóm/Số nhà là bắt buộc.',
            'hamlet.string' => 'Thôn/Xóm/Số nhà phải là chuỗi ký tự.',
            'hamlet.max' => 'Thôn/Xóm/Số nhà không được vượt quá nhiều ký tự.',
        ];
    }
}
