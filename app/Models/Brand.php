<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;


    protected $fillable=["name_ar","name_en","image"];

    public function products(){
        return $this->hasMany(Product::class,"brand_id","id");
    }

    protected static function boot()
    {
        parent::boot();

        self::deleting(function ($brand){

            $brand->products->each(function ($product){
                $product->delete();
            });


        });

    }

}
