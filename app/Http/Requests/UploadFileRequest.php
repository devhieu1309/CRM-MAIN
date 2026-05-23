<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UploadFileRequest extends FormRequest
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
            'file' => ['required', 'file', 'max:5120', 'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx']
        ];
    }

    public function messages() {
        return [
            'file.required' => 'Vui lòng chọn file đính kèm.',
            'file.file' => 'Dữ liệu upload không hợp lệ.',
            'file.max' => 'File không được vượt quá 5MB.',
            'file.mimes' => 'Định dạng file không hợp lệ. Chỉ chấp nhận PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX.'
        ];
    }
}
