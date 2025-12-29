<?php

namespace App\Models;

use App\Traits\HasCreator;
use App\Traits\HasNepaliDate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use SoftDeletes, HasCreator, HasNepaliDate;

    protected $fillable = [
        'product_id',
        'warehouse_id',
        'quantity',
        'sale_date',
        'customer_full_name',
        'customer_phone_number',
        'customer_extra_info',
        'total_amount',

        'status',
        'created_at_bs',
        'updated_at_bs',
        'deleted_at_bs'

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
