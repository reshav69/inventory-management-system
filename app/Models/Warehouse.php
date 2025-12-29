<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCreator;
use App\Traits\HasNepaliDate;
use Illuminate\Database\Eloquent\SoftDeletes;
class Warehouse extends Model
{
    use SoftDeletes, HasCreator, HasNepaliDate;
    protected $fillable = [
        'name',
        'location',
        'status',
        
        'created_at_bs',
        'updated_at_bs',
        'deleted_at_bs'
    ];

    public function stockTransactions()
    {
        return $this->hasMany(StockTransaction::class);
    }

    public function outgoingTransfers()
    {
        return $this->hasMany(StockTransfer::class, 'from_warehouse_id');
    }

    public function incomingTransfers()
    {
        return $this->hasMany(StockTransfer::class, 'to_warehouse_id');
    }

    public function warehouseStocks()
    {
        return $this->hasMany(WarehouseStock::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'warehouse_stocks')
                    ->withPivot('quantity');
    }

    
    public function getDisplayNameAttribute()
    {
        return "{$this->name} ({$this->location})";
    }
    
    
}
