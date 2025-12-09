<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;



class StoreStockTransactionRequest extends FormRequest
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
            'product_id'=>'required|exists:products,id',
            'warehouse_id'=>'required|exists:warehouses,id',
            'quantity'=>'required',
            'transaction_type'=>
            [
                'required',
                Rule::in(['incoming','sale','transfer'])
            ],
            'transaction_date'=>'required',

        ];
    }
}
