<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function storeOrUpdate(array $data)
    {
        $product = Product::where('name', $data['name'])
                          ->where('price', $data['price'])
                          ->first();

        if ($product) {
            $product->quantity += $data['quantity'];
            $product->save();

            return $product;
        }

        return Product::create($data);
    }
}
