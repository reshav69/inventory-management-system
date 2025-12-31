<?php

namespace App\Services;

use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\StockTransfer;
use App\Models\WarehouseStock;
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

            if ($fromWarehouseId === $toWarehouseId) {
                throw new \Exception('Source and destination warehouses must be different');
            }

            $sourceStock = WarehouseStock::where('product_id', $productId)
            ->where('warehouse_id', $fromWarehouseId)
            ->lockForUpdate()
            ->first();

            if (!$sourceStock || $sourceStock->quantity < $quantity) {
                throw new \Exception('Not enough stock in source warehouse');
            }

            $sourceStock->decrement('quantity', $quantity);

            WarehouseStock::updateOrCreate(
                [
                    'product_id' => $productId,
                    'warehouse_id' => $toWarehouseId,
                ],
                [
                    'quantity' => DB::raw("quantity + {$quantity}")
                ]
            );

            $transfer = StockTransfer::create([
                'product_id' => $productId,
                'from_warehouse_id' => $fromWarehouseId,
                'to_warehouse_id' => $toWarehouseId,
                'quantity' => $quantity,
                'transfer_date' => $transactionDate,
            ]);

            // dd($transfer);
            StockTransaction::create([
                'product_id' => $productId,

                'warehouse_id' => $fromWarehouseId,
                'quantity' => -$quantity,
                'transaction_type' => 'transfer',
                'transaction_date' => $transactionDate,
            ]);

            StockTransaction::create([
                'product_id' => $productId,
                'warehouse_id' => $toWarehouseId,
                'quantity' => $quantity, 
                'transaction_type' => 'transfer',
                'transaction_date' => $transactionDate,
            ]);
            return $transfer;
        });
    }
}
