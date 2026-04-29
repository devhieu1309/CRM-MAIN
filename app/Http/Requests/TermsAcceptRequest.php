<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TermsAcceptRequest extends FormRequest
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
            'terms_accept' => ['required', 'boolean']
        ];
    }

    public function messages()
    {
        return [
            'terms_accept.required' => 'Bạn hãy chấp nhận điều khoản.',
            'terms_accept.boolean' => 'Bạn hãy chấp nhận điều khoản.'
        ];
    }
}
