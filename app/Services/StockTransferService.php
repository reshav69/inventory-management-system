<?php

namespace App\Services;

use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\StockTransfer;
use Illuminate\Support\Facades\DB;

class StockTransferService
{
    public function transfer(array $data)
    {
        // dd($data);
        return DB::transaction(function () use ($data) {

            $productId = $data['product_id'];
            $fromWarehouseId = $data['from_warehouse_id'];
            $toWarehouseId = $data['to_warehouse_id'];
            $quantity = $data['quantity'];
            $transactionDate = $data['transaction_date'];

            $product = Product::findOrFail($productId);

            // Calculate current stock in source warehouse
            $sourceStock = StockTransaction::where('product_id', $productId)
                ->where('warehouse_id', $fromWarehouseId)
                ->sum('quantity');
            // dd($sourceStock);

            if ($sourceStock < $quantity) {
                throw new \Exception("Not enough stock in source warehouse for transfer");
            }

            $transfer = StockTransfer::create([
                'product_id' => $data['product_id'],
                'from_warehouse_id' => $fromWarehouseId,
                'to_warehouse_id' => $toWarehouseId,
                'quantity' => $quantity,
                'transfer_date' => $transactionDate,
            ]);

            // dd($transfer);
            StockTransaction::create([
                'product_id' => $data['product_id'],

                'warehouse_id' => $fromWarehouseId,
                'quantity' => -$quantity, // subtract
                'transaction_type' => 'transfer',
                'transaction_date' => $transactionDate,
            ]);

            StockTransaction::create([
                'product_id' => $data['product_id'],
                'warehouse_id' => $toWarehouseId,
                'quantity' => $quantity, // add
                'transaction_type' => 'transfer',
                'transaction_date' => $transactionDate,
            ]);
            return $transfer;
        });
    }
}
