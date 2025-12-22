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
            'warehouse_id' => 'nullable|required_if:transaction_type,incoming|exists:warehouses,id',
            'from_warehouse_id' => 'nullable|required_if:transaction_type,transfer|exists:warehouses,id',
            'to_warehouse_id' => 'nullable|required_if:transaction_type,transfer|exists:warehouses,id|different:from_warehouse_id',
            'transaction_type' => 'required|in:incoming,transfer',
            'quantity' => 'required|integer|min:1',
            'transaction_date' => 'required|string',

        ];
    }
    public function messages()
    {
        return[
            'to_warehouse_id.different'=>'The selected warehouse must be different than sourcewarehouse',
        ];
    }

    public function withValidator($validator){
        $validator->after(function ($validator) {
            $productId = $this->input('product_id');
            $warehouseId = $this->input('from_warehouse_id');
            $quantity = $this->input('quantity');

            if ($productId && $warehouseId && $quantity) {
                $stockExists = \App\Models\WarehouseStock::where('product_id', $productId)
                    ->where('warehouse_id', $warehouseId)
                    ->where('quantity', '>=', $quantity)
                    ->exists();

                if (! $stockExists) {
                    $validator->errors()->add('from_warehouse_id', 'Selected warehouse does not have enough stock for this product.');
                }
            }
        });
    }
}
