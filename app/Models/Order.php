<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    protected $fillable=['status','user_id','address_id','payment_method','total_price'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function Address(){
        return $this->belongsTo(Address::class);
    }

//    public function product(){
//        return $this->belongsTo(Product::class);
//    }

    public function products(){
        return $this->belongsToMany(Product::class,'product_order','order_id','product_id')
            ->withPivot('price','quantity');
    }
}
