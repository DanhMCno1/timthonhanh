<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class FeedbackRequest extends FormRequest
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
            'category' => [
                'required', 
                function ($attribute, $value, $fail) { 
                    $exists = DB::table('work_lists') 
                        ->where('staff_id', request()->staff->id) 
                        ->where('category_id', $value) 
                        ->exists(); 
                    if (!$exists) { 
                        $fail('Thợ không có công việc này'); 
                    }
                },
            ],
            'rating' => ['integer', 'between:1,5'],
        ];
    }

    public function messages()
    {
        return [
            'category.required' => 'Danh mục là bắt buộc',
            'rating.integer' => 'Số sao phải là số',
            'rating.between' => 'Đánh giá từ 1 đến 5',
        ];
    }

    
}
