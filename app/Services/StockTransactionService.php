<?php

namespace App\Services;

use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\Warehouse;
use App\Models\WarehouseStock;
use App\Services\StockTransferService;
use App\Traits\HasNepaliDate;
use Illuminate\Support\Facades\DB;

class StockTransactionService
{
    // use HasNepaliDate;

    public function handle(array $data)
    {
        return DB::transaction(function () use ($data) {
            return match ($data['transaction_type']) {
                'incoming' => $this->incoming($data),
                'sale'     => $this->sale($data),
                'transfer' => app(StockTransferService::class)->transfer($data),
                default    => throw new \Exception('Invalid transaction type'),
            };
        });
    }

    private function incoming(array $data)
    {
        $product = Product::findOrFail($data['product_id']);
        $warehouse = Warehouse::findOrFail($data['warehouse_id']);
        $quantity =(int)$data['quantity'];
        WarehouseStock::updateOrCreate(
            [
                'product_id' => $product->id,
                'warehouse_id' => $warehouse->id,
            ],
            [
                'quantity' => DB::raw("quantity + {$quantity}"),
            ]
        );

        return StockTransaction::create([
            'product_id' => $data['product_id'],
            'warehouse_id' => $data['warehouse_id'],
            'quantity' => $data['quantity'],
            'transaction_type' => 'incoming',
            'transaction_date' => $data['transaction_date'],
        ]);
    }

    private function sale(array $data)
    {
        $product = Product::findOrFail($data['product_id']);
        
        if ($product->quantity < $data['quantity']) {
            throw new \Exception("Not enough stock available");
        }

        $product->quantity -= $data['quantity'];
        $product->save();

        return StockTransaction::create([
            'product_id' => $data['product_id'],
            'warehouse_id' => $data['warehouse_id'],
            'quantity' => $data['quantity'],
            'transaction_type' => 'sale',
            'transaction_date' => $data['transaction_date'],

        ]);
    }
}
