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
