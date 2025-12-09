<?php

namespace App\Models;

use App\Traits\HasCreator;
use App\Traits\HasNepaliDate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class BaseModel extends Model{
    public $timestamps = false;
    use SoftDeletes, HasCreator, HasNepaliDate {
        HasNepaliDate::runSoftDelete insteadof SoftDeletes;
    }

    // use SoftDeletes, HasCreator, HasNepaliDate;
    protected $casts = [
        'deleted_at' => 'string',
    ];

}