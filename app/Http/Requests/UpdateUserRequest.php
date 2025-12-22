<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateuserRequest extends FormRequest
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
            'first_name'=>'required|max:50|regex:/^[\pL\s]+$/u',
            'last_name'=>'required|max:50|regex:/^[\pL\s]+$/u',
            'email'=>['required','email',
                Rule::unique('users','email')->ignore($this->user)
            ],
            'password'=>'nullable|min:8',
            'role'=>'required|in:admin,staff',
            'status'=>'required|boolean'
            
        ];
    }
}
