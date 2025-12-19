<?php

namespace App\Models;

use App\Traits\HasNepaliDate;
use Illuminate\Database\Eloquent\Model;

class WarehouseStock extends Model
{
    use HasNepaliDate;
    public $timestamps = false;
    protected $table = 'warehouse_stocks';

    protected $fillable = [
        'product_id',
        'warehouse_id',
        'quantity',
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
