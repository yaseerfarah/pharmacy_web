<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Feature;
use App\Models\Order;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class OrderController extends Controller
{
    //
    use GeneralTrait;

    public function confirmOrder(Request $request){

        try {
            $validated = Validator::make($request->all(),[
                'address_id' => 'required',
                'payment_method' => 'required',
               // 'total_price' => 'required',
                'products' => 'required|array',
                'products.*.product_id' => 'required|string',
                'products.*.quantity' => 'required|integer',
                'products.*.price' => 'required|numeric',

            ]);

            if ($validated->fails()){
                return $this->returnError("E0001",$validated->errors());
            }


            $totalPrice=0;
            $product_orderArr=[];
            for ($i=0;$i<count($request->products);$i++){
               $totalPrice+=$request->products[$i]["price"]*$request->products[$i]["quantity"];

               $product_orderArr[$request->products[$i]["product_id"]]= [
                   "price"=>$request->products[$i]["price"],
                   "quantity"=>$request->products[$i]["quantity"]
               ];
            }

            $save=Order::create([
                "status" =>1,
                "address_id"=>$request->address_id,
                "payment_method"=>$request->payment_method,
                "total_price"=>$totalPrice,
                "user_id"=>auth()->user()->id,
            ]);

            if ($save){
                $save->products()->syncWithoutDetaching($product_orderArr);

                return $this->returnData("data",$save);

            }



        }catch (\Exception $ex){
            return $this->returnError("E0001",$ex->getMessage());
        }

    }



    public function getUserOrders(Request $request){

        try {
            $result=Order::with('Address')->with('products')
                ->where("user_id",auth()->user()->id)->get();
            return $this->returnData("data",$result);
        }catch (\Exception $ex){
            return $this->returnError("E0001",$ex->getMessage());
        }

    }
}
