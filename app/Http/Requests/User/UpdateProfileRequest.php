<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
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
            'phone' => ['bail' ,'required', 'regex:/^(0[3|5|7|8|9])+([0-9]{8})\b$/', 'unique:users,phone,'. Auth::id()],
            'name' => ['bail' ,'required', 'string', 'max:255'],
            'province_id' => ['bail' ,'required', 'exists:provinces,id'],
            'district_id' => ['bail' ,'required', 'exists:districts,id'],
            'ward_id' => ['bail' ,'required', 'exists:wards,id'],
            'hamlet' => ['bail' ,'required', 'string', 'max:50'],
        ];
    }

    public function messages(): array {
        return [
            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.unique' => 'Số điện thoại đã được sử dụng.',
            'phone.regex' => 'Số điện thoại không đúng định dạng.',
            'name.required' => 'Họ và tên không được để trống.',
            'name.string' => 'Họ và tên phải là chữ.',
            'name.max' => 'Họ và tên không được lớn hơn :max ký tự.',
            'province_id.required' => 'Chưa chọn tỉnh/thành phố.',
            'province_id.exists' => 'Tình/Thành phố không tồn tại.',
            'district_id.required' => 'Chưa chọn quận/huyện.',
            'district_id.exists' => 'Quận/Huyện không tồn tại.',
            'ward_id.required' => 'Chưa chọn xã/phường.',
            'ward_id.exists' => 'Xã/Phường không tồn tại.',
            'hamlet.required' => 'Thôn/Xóm không được để trống.',
            'hamlet.string' => 'Thôn/Xóm phải là chữ.',
            'hamlet.max' => 'Thôn/Xóm không được lớn hơn :max ký tự.',
        ];
    }
}
