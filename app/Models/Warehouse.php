<?php

namespace App\Models;

use App\Traits\HasCreator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use SoftDeletes,HasCreator;
    protected $fillable = [
        'name',
        'location',
        'status',
        
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
