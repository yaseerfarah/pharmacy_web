<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    protected $fillable=["name","pre_price","price","discount","type_id","used_for","category_id","sub_category_id","brand_id","quantity"];

    public function features(){
        return $this->hasMany(Feature::class,"product_id","id");
    }

    public function images(){
        return $this->hasMany(Image::class,"product_id","id");
    }

    public function orders(){
        return $this->belongsToMany(Order::class,'product_order','product_id','order_id')
            ->withPivot('price','quantity');
    }

    public function subCategory(){
        return $this->belongsTo(SubCategory::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function productType(){
        return $this->belongsTo(ProductType::class,'type_id','id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function productAr(){
        return $this->hasone(ProductAr::class,"product_id","id");
    }
    public function productEn(){
        return $this->hasone(ProductEn::class,"product_id","id");
    }




    public function scopeProductFilter($query,$discount,$category,$sub_category,$brand,$product_type,$used_for){

        if ($discount>-1){
            $query->where("discount",'>=',$discount);
        }
        if ($category>-1){
            $query->where("category_id",$category);
        }
        if ($sub_category>-1){
            $query->where("sub_category_id",$sub_category);
        }
        if ($brand>-1){
            $query->where("brand_id",$brand);
        }
        if ($product_type>-1){
            $query->where("type_id",$product_type);
        }
        if ($used_for>-1){
            $query->where("used_for",$used_for);
        }
        return $query;
    }









    protected static function boot()
    {
        parent::boot();

        self::deleting(function ($product){

            $product->features->each(function ($feature){
                $feature->delete();
            });


            $product->images->each(function ($image){
                $image->delete();
            });

            $product->orders->each(function ($order){
                $order->delete();
            });

            $product->productAr->delete();
            $product->productEn->delete();


        });

    }

}
