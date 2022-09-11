<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Category;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserController extends Controller
{
    //
    use GeneralTrait;



    public function getUserAddresses(Request $request){

        try {
            $result=auth()->user()->addresses;
            return $this->returnData("data",$result);
        }catch (\Exception $ex){
            return $this->returnError("E0001","not Found");
        }

    }

    public function addNewAddress(Request $request){

        try {
            $validated = Validator::make($request->all(),[
                'lat' => 'required',
                'lng' => 'required',
                'address_type' => 'required',
                'street' => 'required',
            ]);

            if ($validated->fails()){
                return $this->returnError("E0001",$validated->errors());
            }

            $save=Address::create([
                "lat" =>$request->lat,
                "lng"=>$request->lng,
                "address_type"=>$request->address_type,
                "street"=>$request->street,
                "building"=>$request->has('building')?$request->building:null,
                "floor"=>$request->has('floor')?$request->floor:null,
                "apt"=>$request->has('apt')?$request->apt:null,
                "villa"=>$request->has('villa')?$request->villa:null,
                "user_id"=>auth()->user()->id,
            ]);

            if ($save){
                return $this->returnData("data",$save);
            }

        }catch (\Exception $ex){
            return $this->returnError("E0001","not Found");
        }


    }


    public function editAddress(Request $request){

        try {
            $validated = Validator::make($request->all(),[
                'id'=>'required',
                'lat' => 'required',
                'lng' => 'required',
                'address_type' => 'required',
                'street' => 'required',
            ]);

            if ($validated->fails()){
                return $this->returnError("E0001",$validated->errors());
            }

            if (Address::find($request->id)!=null) {
                $save = Address::find($request->id)->update([
                    "lat" => $request->lat,
                    "lng" => $request->lng,
                    "address_type" => $request->address_type,
                    "street" => $request->street,
                    "building" => $request->has('building') ? $request->building : null,
                    "floor" => $request->has('floor') ? $request->floor : null,
                    "apt" => $request->has('apt') ? $request->apt : null,
                    "villa" => $request->has('villa') ? $request->villa : null,
                    "user_id" => auth()->user()->id,
                ]);

                if ($save) {
                    return $this->returnData("data", Address::find($request->id));
                }
            }else{
                return $this->returnError("E0001","not Found");
            }

        }catch (\Exception $ex){
            return $this->returnError("E0001","not Found");
        }


    }


}
