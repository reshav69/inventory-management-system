<?php
namespace App\Services;

use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Support\Facades\DB;

class StockTransactionService
{
    public function create(array $data): StockTransaction
    {
        return DB::transaction(function () use ($data) {

            $transaction = StockTransaction::create($data);
            
            $product = Product::find($data['product_id']);

            if ($data['transaction_type'] === 'incoming') {
                $product->quantity += $data['quantity'];
            } else { 
                $product->quantity -= $data['quantity'];
            }

            $product->save();

            return $transaction;
        });
    }
}
