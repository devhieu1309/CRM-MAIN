<?php

namespace App\Http\Requests;

use App\Enums\TaskStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
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
            'client_id' => ['required', 'exists:clients,id'],
            'project_id' => ['required', 'exists:projects,id'],
            'user_id' => ['required', 'exists:users,id'],
            'deadline' => ['required', 'date'],
            'status' => ['required', Rule::in(TaskStatus::values())]
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Vui lòng nhập tiêu đề công việc.',
            'title.string' => 'Tiêu đề công việc phải là chuỗi.',
            'title.max' => 'Tiêu đề công việc không vượt quá 255 ký tự.',
            'description.required' => 'Vui lòng nhập mô tả công việc.',
            'description.string' => 'Mô tả công việc phải là chuỗi.',
            'description.max' => 'Mô tả công việc không vượt quá 255 ký tự',
            'client_id.required' => 'Vui lòng chọn khách hàng.',
            'client_id.exists' => 'Khách hàng không tồn tại trong hệ thống.',
            'user_id.required' => 'Vui lòng chọn người phụ trách công việc.',
            'user_id.exists' => 'Người phụ trách công việc không tồn tại trong hệ thống.',
            'project_id.required'  => 'Vui lòng chọn dự án.',
            'deadline.required' => 'Vui lòng chọn ngày hết hạn công việc.',
            'deadline.date' => 'Ngày hết hạn công việc không hợp lệ.',
            'status.required' => 'Vui lòng chọn trạng thái công việc.',
            'status.in' => 'Trạng thái công việc không hợp lệ.'
        ];
    }
}
