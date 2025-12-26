<?php

namespace App\Traits;

use Anuzpandey\LaravelNepaliDate\LaravelNepaliDate;
use Carbon\Carbon;


trait HasNepaliDate
{
    
    protected function runSoftDelete()
    {
        $this->deleted_at = self::nowNepali();
        $this->save();
    }

    protected static function bootHasNepaliDate()
    {
        static::creating(function ($model) {
            $model->created_at = self::nowNepali();
            // $model->updated_at = self::nowNepali();
        });
        
        static::updating(function ($model) {
            $model->updated_at = self::nowNepali();
        });
        
        static::deleting(function ($model) {
            $model->deleted_at = self::nowNepali();
        });

    }

    public static function nowNepali()
    {
        $date = static::getNepaliDate();
        $time = static::getNepaliTime();

        return $date. ' ' . $time;

    }
    public static function getNepaliDate(){
        $englishDate = Carbon::now('Asia/Kathmandu')->toDateString();
        $date= LaravelNepaliDate::from($englishDate)->toNepaliDate('Y-m-d','en');
        return $date;
    }
    public static function getNepaliTime(){
        $time= Carbon::now('Asia/Kathmandu')->toTimeString();
        return $time;
    }
}
