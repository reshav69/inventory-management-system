<?php

namespace App\Models;

use App\Traits\HasCreator;
use App\Traits\HasNepaliDate;
use Illuminate\Database\Eloquent\Model;

class Sale extends BaseModel
{

    protected $fillable = [
        'product_id',
        'warehouse_id',
        'quantity',
        'sale_date',
        'customer_full_name',
        'customer_phone_number',
        'customer_extra_info',
        'total_amount',

        'created_at',
        'updated_at',
        'deleted_at'

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
