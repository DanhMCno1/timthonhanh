<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $rule = [
            'genre_id' => ['bail', 'required', 'exists:genres,id'],
            'name' => ['bail', 'required', 'string', 'unique:categories,name,' . request()->id],
        ];

        if (request()->id) {
            $rule['image'] = ['bail', 'nullable', 'image', 'max:2048'];
        } else {
            $rule['image'] = ['bail', 'required', 'image', 'max:2048'];
        }

        return $rule;
    }

    public function messages(): array
    {
        return [
            'genre_id.required' => 'Chưa chọn thể loại.',
            'genre_id.exists' => 'Thể loại không tồn tại.',
            'name.required' => 'Tên danh mục không được để trống.',
            'name.string' => 'Tên danh mục phải là chữ.',
            'name.unique' => 'Tên danh mục đã tồn tại.',
            'image.required' => 'Chưa chọn ảnh danh mục.',
            'image.image' => 'Ảnh sai định dạng.',
            'image.max' => 'Kích thước ảnh quá lớn (>2024KB).',
        ];
    }
}
