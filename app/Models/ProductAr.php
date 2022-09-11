<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAr extends Model
{
    use HasFactory;
    protected $table="products_ar";

    protected $fillable=["name","detail","product_id"];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
