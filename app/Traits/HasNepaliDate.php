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
        $date = Carbon::now('Asia/Kathmandu');
        $englishDate = $date->toDateString();
        $time = $date->toTimeString();
        $nepaliDate = LaravelNepaliDate::from($englishDate)->toNepaliDate(format: 'D-j-F-Y', locale: 'en');

        return $nepaliDate . ' ' . $time;

    }
}
