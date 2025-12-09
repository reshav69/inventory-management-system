<?php

namespace App\Models;


class Warehouse extends BaseModel
{
    
    protected $fillable = [
        'name',
        'location',
        'status',
        
        'created_at',
        'updated_at',
        'deleted_at'
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

    
    public function getDisplayNameAttribute()
    {
        return "{$this->name} ({$this->location})";
    }
    
    
    public function toShowData(){
        $data = [
            'ID'=>$this->id,
            'Name'=>$this->name,
            'Status'=>$this->status,
            'Location'=>$this->location,
            
        ];
        return $data;
    }
    
}
