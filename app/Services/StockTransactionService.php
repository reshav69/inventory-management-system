<?php

namespace App\Services;

use App\Models\Product;
use App\Models\StockTransaction;
use App\Services\StockTransferService;
use App\Traits\HasNepaliDate;
use Illuminate\Support\Facades\DB;

class StockTransactionService
{
    // use HasNepaliDate;

    public function handle(array $data)
    {
        return DB::transaction(function () use ($data) {
            $type = $data['transaction_type'];

            if ($type === 'incoming') {
                return $this->incoming($data);
            }

            if ($type === 'sale') {
                return $this->sale($data);
            }

            if ($type === 'transfer') {
                return app(StockTransferService::class)->transfer($data);
            }

            throw new \Exception("Invalid transaction type");
        });
    }

    private function incoming(array $data)
    {
        $product = Product::findOrFail($data['product_id']);
        $product->quantity -= $data['quantity'];
        $product->save();

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
