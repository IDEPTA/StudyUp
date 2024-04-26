<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class registerValidationRequest extends FormRequest
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
            "name" => "required|min:2|max:20",
            "lastname" => "required|min:2|max:20",
            "email" => "required|min:5|unique:users,email",
            "phone" => "required|min:11|max:11",
            "password" => "required|min:7|confirmed",
        ];
    }
}
