<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Exists;

class StoreSaleRequest extends FormRequest
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
            'warehouse_id' => 'required','exists:warehouse,id',
            'quantity' => 'required|integer|min:1',
            'sale_date' => 'required|string',
            'customer_full_name'=>'nullable|regex:/^[\pL\s]+$/u',
            'customer_phone_number'=>'nullable|numeric',
            'customer_extra_info'=>'nullable|string'
        ];
    }

    public function withValidator($validator){
        $validator->after(function ($validator) {
            $productId = $this->input('product_id');
            $warehouseId = $this->input('warehouse_id');
            $quantity = $this->input('quantity');

            if ($productId && $warehouseId && $quantity) {
                $stockExists = \App\Models\WarehouseStock::where('product_id', $productId)
                    ->where('warehouse_id', $warehouseId)
                    ->where('quantity', '>=', $quantity)
                    ->exists();

                if (! $stockExists) {
                    $validator->errors()->add('warehouse_id', 'Selected warehouse does not have enough stock for this product.');
                }
            }
        });
    }
}
