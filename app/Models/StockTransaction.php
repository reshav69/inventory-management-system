<?php

namespace App\Models;

use App\Traits\HasCreator;
use App\Traits\HasNepaliDate;
use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    use HasCreator,HasNepaliDate;
    protected $fillable = [
        'product_id',
        'warehouse_id',
        'quantity',
        'transaction_type',
        'transaction_date',

        'created_at',
        'updated_at',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

}
