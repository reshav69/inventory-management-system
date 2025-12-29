<?php

namespace App\Models;

use App\Traits\HasCreator;
use App\Traits\HasNepaliDate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockTransfer extends Model
{
    use SoftDeletes,HasCreator,HasNepaliDate;
    protected $fillable = [
        'product_id',
        'quantity',
        'transfer_date',
        'from_warehouse_id',
        'to_warehouse_id',

        'created_at_bs',
        'updated_at_bs',
        'deleted_at_bs'
    ];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function fromWarehouse()
    {
        return $this->belongsTo(Warehouse::class, 'from_warehouse_id');
    }

    public function toWarehouse()
    {
        return $this->belongsTo(Warehouse::class, 'to_warehouse_id');
    }
}
