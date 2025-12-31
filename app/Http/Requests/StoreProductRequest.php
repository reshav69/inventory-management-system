<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name'        => 'required|regex:/^[\pL\s]+$/u|max:55|unique:products,name',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:1|gt:0',
            // 'quantity'    => 'required|numeric|min:0',
            'barcode'     => 'nullable|string|max:255',
            'status'      => 'required|boolean',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        ];
    }
}
