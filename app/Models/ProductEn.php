<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductEn extends Model
{
    use HasFactory;

    protected $table="products_en";

    protected $fillable=["name","detail","product_id"];


    public function product(){
        return $this->belongsTo(Product::class);
    }
}
