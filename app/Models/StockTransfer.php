<?php

namespace App\Models;

use App\Traits\HasCreator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockTransfer extends Model
{
    use SoftDeletes,HasCreator;
    protected $fillable = [
        'quantity',
        'transfer_date',

        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
