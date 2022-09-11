<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table="categories";

    protected $fillable=["name_ar","name_en","image"];


    public function products(){
        return $this->hasMany(Product::class,"category_id","id");
    }
    public function subCategory(){
        return $this->hasMany(SubCategory::class,"category_id","id");
    }


    protected static function boot()
    {
        parent::boot();

        self::deleting(function ($category){

            $category->subCategory->each(function ($subCategory){
                $subCategory->delete();
            });


        });

    }


}
