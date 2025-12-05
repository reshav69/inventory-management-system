<?php

namespace App\Models;

use App\Traits\HasCreator;
use App\Traits\HasNepaliDate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;



class Product extends Model
{
    public $timestamps = false;
    use SoftDeletes,HasCreator,HasNepaliDate;
    protected static function booted()
    {
        static::creating(function ($product) {
            if (empty($product->key)) {
                $product->key = $product->generateKey();
            }
            if (empty($product->barcode)) {
                $product->barcode = $product->generateBarcode();
            }
            
        });
    }
    
    protected $fillable = [
        'name',
        'description',
        'key',
        'price',
        'quantity',
        'barcode',
        'image_path',
        'status',
        
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    
    protected function generateKey(){
        $base = Str::slug($this->name, '_');
        $key = $base;
        $counter = 1;
    
        while (static::where('key', $key)->exists()) {
            $key = $base . '_' . $counter++;
        }
    
        return $key;
        
    }
    
    
    protected function generateBarcode()
    {
        do {
            $barcode = 'PRD-' . strtoupper(Str::random(8));
        } while (static::where('barcode', $barcode)->exists());
        
        return $barcode;
    }

    public function toShowData(){
        $data = [
            'ID'=>$this->id,
            'Name'=>$this->name,
            'Status'=>$this->status,
            'Description'=>$this->description,
            'Image'=>$this->image_path,
            'Barcode'=>$this->barcode,
            'Created_by'=>$this->createdBy->email,
            'Created_at'=>$this->created_at,
            'Updated_at'=>$this->updated_at,
            'Updated_by'=>$this->updatedBy->email ?? '-',

        ];
        return $data;
    }


}
