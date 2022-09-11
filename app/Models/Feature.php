<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $fillable=["title_ar","title_en","detail_en","detail_ar","product_id"];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
