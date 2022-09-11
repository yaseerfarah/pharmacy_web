<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Authorization extends Controller
{
    //


    public function loginView(){
        return view("admin_login");
    }

    public function login(Request $request){


        $validated = Validator::make($request->all(),[
            'email' => 'required|email:rfc,dns',
            'password' => 'required',
        ]);

        if ($validated->fails()){
            return redirect()->back()->withErrors($validated->errors())->withInput($request->all());
           // return $validated->errors();
        }

        $credintial=$request->only(['email','password']);
        if (Auth::guard('admin')->attempt($credintial)) {

            // Authentication passed...
            return view("welcome");
        }


    }
}
