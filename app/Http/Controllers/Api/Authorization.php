<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Authorization extends Controller
{
    //

    use GeneralTrait;

    public function login(Request $request){


        try {
            $validatedData=  Validator::make($request->all(),[
                'phone' => 'required',

            ]);

            if ($validatedData->fails()){
                return $this->returnValidationError("E001",$validatedData);
            }

            $user=User::where('phone_number',$request->phone)->first();

            if (isset($user)){
                $token = Auth::guard("user-api")->login($user);
                return $this->returnData("data",["user"=>$user,"token"=>$token]);
            }
            return $this->returnError("E001","invalid credential");



        }catch (\Exception $ex){
            return $this->returnError("E0001",$ex->getMessage());
        }


    }


    public function register(Request $request){


        try {
            $validatedData=  Validator::make($request->all(),[

                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'phone' => 'required||unique:users,phone_number',
                'gender' => 'required',
            ]);

            if ($validatedData->fails()){
                return $this->returnValidationError("E001",$validatedData);
            }

            $user = User::create([
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'phone_number'=>$request->phone,
                'gender'=> $request->gender
            ]);

            if ($user){
                $token = Auth::guard("api")->login($user);
                return $this->returnData("data",["user"=>$user,"token"=>$token]);
            }
            return $this->returnError("E001","invalid credential");


        }catch (\Exception $ex){
            return $this->returnError("E0001",$ex->getMessage());
        }


    }
}
