<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'email', 'unique:users,email,' . $this->user->id],
            'password' => ['nullable', 'string', 'min:8'],
            'address' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'terms_accepted' => ['required', 'boolean'],
            'role' => ['required', 'string', 'exists:roles,name']
        ];
    }

     public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên người dùng.',
            'name.string' => 'Tên người phải là chuỗi.',
            'name.max' => 'Tên người dùng không vượt quá 255 ký tự.',
            'email.required' => 'Vui lòng nhập email.',
            'email.string' => 'Email người dùng phải là chuỗi.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại trong hệ thống.',
            'password.string' => 'Mật khẩu phải là chuỗi.',
            'password.min' => 'Mật khẩu phải từ :min ký tự trở lên.',
            'address.required' => 'Vui lòng nhập địa chỉ người dùng.',
            'address.string' => 'Địa chỉ người dùng phải là chuỗi.',
            'address.max' => 'Địa chỉ người dùng không vượt quá 255 ký tự.',
            'phone_number.required' => 'Vui lòng nhập số điện thoại người dùng.',
            'phone_number.string' => 'Số điện thoại người dùng phải là chuỗi.',
            'phone_number.max' => 'Số điện thoại người dùng không vượt quá 255 ký tự.',
            'role.required' => 'Vui lòng chọn vai trò người dùng.',
            'role.string' => 'Vai trò người dùng phải là chuỗi.',
            'role.exists' => 'Vai trò người dùng không tồn tại trong hệ thống.',
            'terms_accepted.required' => 'Vui lòng chấp nhận điều khoản.',
            'terms_accepted.boolean' => 'Vui lòng chấp nhận điều khoản.'
        ];
    }
}
