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
            'product_id' => 'required|exists:products,id',
            'warehouse_id' => 'nullable|required_if:transaction_type,incoming,sale|exists:warehouses,id',
            'from_warehouse_id' => 'nullable|required_if:transaction_type,transfer|exists:warehouses,id',
            'to_warehouse_id' => 'nullable|required_if:transaction_type,transfer|exists:warehouses,id|different:from_warehouse_id',
            'transaction_type' => 'required|in:incoming,sale,transfer',
            'quantity' => 'required|integer|min:1',
            'transaction_date' => 'required|string',

            // 'product_id'=>'required|exists:products,id',
            // 'warehouse_id'=>'required|exists:warehouses,id',
            // 'quantity'=>'required',
            // 'transaction_type'=>
            // [
            //     'required',
            //     Rule::in(['incoming','sale','transfer'])
            // ],
            // 'transaction_date'=>'required',

        ];
    }
}
