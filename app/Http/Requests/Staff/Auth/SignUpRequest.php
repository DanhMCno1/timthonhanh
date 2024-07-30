<?php

namespace App\Http\Requests\Staff\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone' => ['bail' ,'required', 'unique:staffs,phone', 'regex:/^(0[3|5|7|8|9])+([0-9]{8})\b$/'],
            'phone_otp' => ['bail' ,'required', 'digits:6'],
            'email' => ['bail' ,'required', 'email:rfc,dns', 'unique:staffs,email'],
            'password' => ['bail' ,'required', 'string', 'min:8', 'confirmed'],
            'name' => ['bail' ,'required', 'string', 'max:255'],
            'birthday' => ['bail' ,'required', 'date', 'before:today'],
            'gender' => ['bail' ,'required', 'boolean'],
            'province_id' => ['bail' ,'required', 'exists:provinces,id'],
            'district_id' => ['bail' ,'required', 'exists:districts,id'],
            'ward_id' => ['bail' ,'required', 'exists:wards,id'],
            'hamlet' => ['bail' ,'required', 'string', 'max:255'],
            'work_lists' => ['required'],
            'work_lists.*' => ['exists:categories,id'],
            'province_ids' => ['required'],
            'province_ids.*' => ['exists:provinces,id'],
            'district_ids' => ['required'],
            'district_ids.*' => ['exists:districts,id'],
            'ward_ids' => ['required'],
            'description' => ['bail' ,'required', 'string'],
            'image' => ['bail' ,'required', 'image', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.unique' => 'Số điện thoại đã được sử dụng.',
            'phone.regex' => 'Số điện thoại không đúng định dạng.',
            'phone_otp.required' => 'Chưa nhập mã OTP.',
            'phone_otp.digits' => 'Mã OTP phải là 6 chữ số.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã được sử dụng.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.string' => 'Mật khẩu phải là chữ.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'name.required' => 'Họ và tên không được để trống.',
            'name.string' => 'Họ và tên phải là chữ.',
            'name.max' => 'Họ và tên không được lớn hơn :max ký tự.',
            'birthday.required' => 'Ngày sinh không được để trống.',
            'birthday.date' => 'Ngày sinh phải là ngày hợp lệ (Tháng/ngày/năm).',
            'birthday.before' => 'Ngày sinh phải trước ngày hiện tại.',
            'gender.required' => 'Giới tính không được để trống.',
            'gender.boolean' => 'Không tồn tại giá trị giới tính.',
            'province_id.required' => 'Chưa chọn tỉnh/thành phố.',
            'province_id.exists' => 'Tình/Thành phố không tồn tại.',
            'district_id.required' => 'Chưa chọn quận/huyện.',
            'district_id.exists' => 'Quận/Huyện không tồn tại.',
            'ward_id.required' => 'Chưa chọn xã/phường.',
            'ward_id.exists' => 'Xã/Phường không tồn tại.',
            'hamlet.required' => 'Thôn/Xóm không được để trống.',
            'hamlet.string' => 'Thôn/Xóm phải là chữ.',
            'hamlet.max' => 'Thôn/Xóm không được lớn hơn :max ký tự.',
            'work_lists.required' => 'Chưa chọn danh sách công việc.',
            'work_lists.*.exists' => 'Công việc không tồn tại.',
            'province_ids.required' => 'Chưa chọn khu vực làm việc tỉnh/thành phố.',
            'province_ids.*.exists' => 'Khu vực làm việc tỉnh/thành phố không tồn tại.',
            'district_ids.required' => 'Chưa chọn khu vực làm việc quận/huyện.',
            'district_ids.*.exists' => 'Khu vực làm việc quận/huyện không tồn tại.',
            'ward_ids.required' => 'Chưa chọn khu vực làm việc xã/phường.',
            'description.required' => 'Miêu tả không được để trống.',
            'description.string' => 'Miêu tả phải là chữ.',
            'image.required' => 'Chưa chọn ảnh đại diện',
            'image.image' => 'Ảnh sai định dạng',
            'image.max' => 'Kích thước ảnh quá lớn (>2024KB)',
        ];
    }
}
