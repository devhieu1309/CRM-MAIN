<?php

namespace App\Http\Requests;

use App\Enums\ProjectStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
      public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'deadline' => ['required', 'date'],
            'client_id' => ['required', 'integer', 'exists:clients,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'status' => ['required', Rule::in(ProjectStatus::values())],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề dự án không thể để trống.',
            'title.string' => 'Tiêu đề dự án phải là chuỗi.',
            'title.max' => 'Tiêu đề dự án không thể vượt quá 255 ký tự.',
            'description.required' => 'Mô tả dự án không thể để trống.',
            'description.string' => 'Mô tả dự án phải là chuỗi.',
            'description.max' => 'Mô tả dự án không thể vượt quá 255 ký tự.',
            'deadline.required' => 'Hạn dự án không thể để trống.',
            'deadline.date' => 'Hạn dự án phải là ngày tháng năm hợp lệ.',
            'client_id.required' => 'Khách hàng không thể để trống.',
            'client_id.integer' => 'Khách hàng phải là số nguyên.',
            'client_id.exists' => 'Khách hàng không tồn tại.',
            'user_id.required' => 'Người phụ trách không thể để trống.',
            'user_id.integer' => 'Người phụ trách phải là số nguyên.',
            'user_id.exists' => 'Người phụ trách không tồn tại.',
            'status.required' => 'Trạng thái không thể để trống.',
            'status.in' => 'Trạng thái không hợp lệ.',
        ];
    }
}
