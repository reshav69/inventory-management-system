<?php

namespace App\Models;

use App\Traits\HasCreator;
use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    use HasCreator;
    protected $fillable = [
        'quantity',
        'transaction_type',
        'transaction_date',
        'created_at',
        'updated_at',
    ];
}
