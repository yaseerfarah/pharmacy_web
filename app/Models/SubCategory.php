<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable=["name_ar","name_en","category_id"];


    public function products(){
        return $this->hasMany(Product::class,"sub_category_id","id");
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    protected static function boot()
    {
        parent::boot();

        self::deleting(function ($subCategory){

            $subCategory->products->each(function ($product){
               $product->delete();
            });


        });

    }

}
