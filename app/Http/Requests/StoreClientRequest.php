<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'string', 'email', 'max:255', 'unique:clients,customer_email'],
            'customer_phone' => ['required', 'string', 'max:255'],
            'company_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:255'],
            'tax_code' => ['required', 'string', 'max:255']
        ];
    }

    public function messages(){
        return [
            'customer_name.required' => 'Vui lòng nhập tên khách hàng.',
            'customer_name.string' => 'Tên khách hàng phải là chuỗi.',
            'customer_name.max' => 'Tên khách hàng không vượt quá 255 ký tự.',
            'customer_email.required' => 'Vui lòng nhập email khách hàng.',
            'customer_email.string' => 'Email khách hàng phải là chuỗi.',
            'customer_email.max' => 'Email khách hàng không vượt quá 255 ký tự.',
            'customer_email.email' => 'Email khách hàng không đúng định dạng email.',
            'customer_email.unique' => 'Email khách hàng đã tồn tại.',
            'customer_phone.required' => 'Số điện thoại khách hàng không được để trống.',
            'customer_phone.string' => 'Số điện thoại khách hàng phải là chuỗi.',
            'customer_phone.max' => 'Số điện thoại khách hàng không vượt quá 255 ký tự.',   
            'address.required' => 'Địa chỉ không được để trống.',
            'address.string' => 'Địa chỉ phải là chuỗi.',
            'address.max' => 'Địa chỉ không vượt quá 255 ký tự.',   
            'company_name.required' => 'Tên công ty không được để trống.',
            'company_name.string' => 'Tên công ty phải là chuỗi.',
            'company_name.max' => 'Tên công ty không vượt quá 255 ký tự.',   
            'city.required' => 'Tỉnh/ Thành phố không được để trống.',
            'city.string' => 'Tỉnh/ Thành phố phải là chuỗi.',
            'city.max' => 'Tỉnh/ Thành phố không vượt quá 255 ký tự.',  
            'postal_code.required' => 'Mã bưu điện không được để trống.',
            'postal_code.string' => 'Mã bưu điện phải là chuỗi.',
            'postal_code.max' => 'Mã bưu điện không vượt quá 255 ký tự.',      
            'tax_code.required' => 'Mã số thuế không được để trống.',
            'tax_code.string' => 'Mã số thuế phải là chuỗi.',
            'tax_code.max' => 'Mã số thuế không vượt quá 255 ký tự.',     
        ];
    }
}
