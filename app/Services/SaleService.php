<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Sale;
use App\Models\StockTransaction;
use App\Models\WarehouseStock;
use Exception;
use Illuminate\Support\Facades\DB;

class SaleService
{
    public function create_sale($data){
        return DB::transaction(function () use ($data) {
            $product = Product::where('status',1)->where('id', $data['product_id'])->firstOrFail();
            $reqQuantity = $data['quantity'];

            $stock = WarehouseStock::where('product_id', $product->id)
                ->where('warehouse_id', $data['warehouse_id'])
                ->lockForUpdate()
                ->first();

            if (! $stock) {
                throw new Exception('Selected warehouse does not have this product.');
            }

            if ($stock->quantity < $reqQuantity) {
                throw new Exception('Not enough stock in selected warehouse.');
            }

            $stock->quantity -= $reqQuantity;
            $stock->save();
            $totalamount = $reqQuantity * $product->price;

            $sale = Sale::create([
                'product_id' => $product->id,
                'warehouse_id' => $data['warehouse_id'],
                'quantity' => $reqQuantity,
                'total_amount' => $totalamount ?? 0,
                'sale_date' => $data['sale_date'],
                'customer_full_name' => $data['customer_full_name'] ?? null,
                'customer_phone_number' => $data['customer_phone_number'] ?? null,
                'customer_extra_info' => $data['customer_extra_info'] ?? null,
            ]);

            StockTransaction::create([
                'product_id' => $product->id,
                'warehouse_id' => $data['warehouse_id'],
                'quantity' => $reqQuantity,
                'transaction_type' => 'sale',
                'transaction_date' => $data['sale_date'],
            ]);

            return $sale;
        });
    }

}
