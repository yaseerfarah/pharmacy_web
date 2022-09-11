<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    protected $fillable=["name_ar","name_en"];

    public function products(){
        return $this->hasMany(Product::class,"type_id","id");
    }


    protected static function boot()
    {
        parent::boot();

        self::deleting(function ($productType){

            $productType->products->each(function ($product){
                $product->delete();
            });


        });

    }

}
