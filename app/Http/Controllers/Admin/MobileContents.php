<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class MobileContents extends Controller
{
    //

    use ImageTrait;

    public function addSplashScreen(Request $request){

        $validated = Validator::make($request->all(),[
            'image' => 'required|mimes:jpeg,jpg,png|max:10000',
        ]);

        if ($validated->fails()){
            return response()->json($validated->errors(), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            // return $validated->errors();
        }

        $imagePath=$this->saveImage($request->image,'images/splash');


        Redis::set('splash_screen',$imagePath);

        return response()->json([
            'status' => true,
            'msg' => 'Added Successfully',
        ]);

    }

    public function addViewPager(Request $request){

        $validated = Validator::make($request->all(),[
            'discount' => 'required',
            'category' => 'required',
            'sub_category' => 'required',
            'brand' => 'required',
            'product_type' => 'required',
            'used_for' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png|max:10000',
        ]);

        if ($validated->fails()){
            return response()->json($validated->errors(), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            // return $validated->errors();
        }

        $imagePath=$this->saveImage($request->image,'images/view_pagers');
        $viewPagerId=Redis::incr('next_pager_id');

        Redis::hmset('view_pager:'.$viewPagerId,[
            'id'=>$viewPagerId,
            'discount'=>$request->discount,
            'category'=>$request->category,
            'sub_category'=>$request->sub_category,
            'brand'=>$request->brand,
            'product_type'=>$request->product_type,
            'used_for'=>$request->used_for,
            'image'=>$imagePath,
            'active'=>1
        ]);
        $save=Redis::hgetall('view_pager:'.$viewPagerId);
        Redis::zadd('view_pagers',$viewPagerId,'view_pager:'.$viewPagerId);

        return response()->json([
            'status' => true,
            'msg' => 'Added Successfully',
            'record'=>$save
        ]);

    }


    public function addHomeContent(Request $request){

        $validated = Validator::make($request->all(),[
            'discount' => 'required',
            'category' => 'required',
            'sub_category' => 'required',
            'brand' => 'required',
            'product_type' => 'required',
            'used_for' => 'required',
            'name_ar' => 'required',
            'name_en' => 'required',

        ]);

        if ($validated->fails()){
            return response()->json($validated->errors(), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            // return $validated->errors();
        }

        $id=Redis::incr('next_home_content_id');

        Redis::hmset('home_content:'.$id,[
            'id'=>$id,
            'discount'=>$request->discount,
            'category'=>$request->category,
            'sub_category'=>$request->sub_category,
            'brand'=>$request->brand,
            'product_type'=>$request->product_type,
            'used_for'=>$request->used_for,
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
           'active'=>1
        ]);

        $save=Redis::hgetall('home_content:'.$id);
        Redis::zadd('home_contents',$id,'home_content:'.$id);

        return response()->json([
            'status' => true,
            'msg' => 'Added Successfully',
            'record'=>$save
        ]);

    }


    public function deleteContent(Request $request){
        $validated = Validator::make($request->all(),[
            'id' => 'required',

        ]);

        if ($validated->fails()){
            return response()->json($validated->errors(), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            // return $validated->errors();
        }

         $id='home_content:'.$request->id;

        Redis::zrem('home_contents',$id);
        Redis::hdel($id,[
            'id',
            'discount',
            'category',
            'sub_category',
            'brand',
            'product_type',
            'used_for',
            'name_ar',
            'name_en',
            'active'
        ]);
        return response()->json([
            'status' => true,
            'msg' => 'Deleted Successfully',
        ]);
    }


    public function deletePager(Request $request){
        $validated = Validator::make($request->all(),[
            'id' => 'required',

        ]);

        if ($validated->fails()){
            return response()->json($validated->errors(), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            // return $validated->errors();
        }

        $id='view_pager:'.$request->id;

        Redis::zrem('view_pagers',$id);
        Redis::hdel($id,[
            'id',
            'discount',
            'category',
            'sub_category',
            'brand',
            'product_type',
            'used_for',
            'image',
            'active'
        ]);
        return response()->json([
            'status' => true,
            'msg' => 'Deleted Successfully',
        ]);
    }

}
