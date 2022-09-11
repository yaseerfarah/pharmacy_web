<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Feature;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductAr;
use App\Models\ProductEn;
use App\Models\ProductType;
use App\Models\SubCategory;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class NewCreate extends Controller
{
    //
    use ImageTrait;

    public function addNewProductType(Request $request){

        $validated = Validator::make($request->all(),[
            'name_ar' => 'required',
            'name_en' => 'required',
        ]);

        if ($validated->fails()){
            return response()->json($validated->errors(), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            // return $validated->errors();
        }

       $save= ProductType::create([
           "name_ar"=>$request->get('name_ar'),
           "name_en"=>$request->get('name_en')
        ]);

        if ($save)
            return response()->json([
                'status' => true,
                'msg' => 'Saved Successfully',
            ]);

        else
            return response()->json([
                'status' => false,
                'msg' => 'Something went wrong ,try again later',
            ]);


    }


    public function addNewBrand(Request $request){

        $validated = Validator::make($request->all(),[
            'name_ar' => 'required',
            'name_en' => 'required',
            'image'=>'required|mimes:jpeg,jpg,png|max:10000'
        ]);

        if ($validated->fails()){
            return response()->json($validated->errors(), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            // return $validated->errors();
        }

        $imagePath=$this->saveImage($request->image,'images/brands');

        $save= Brand::create([
            "name_ar"=>$request->name_ar,
            "name_en"=>$request->name_en,
            "image"=>$imagePath

        ]);

        if ($save)
            return response()->json([
                'status' => true,
                'msg' => 'Saved Successfully',
            ]);

        else
            return response()->json([
                'status' => false,
                'msg' => 'Something went wrong ,try again later',
            ]);

    }


    public function addNewCategory(Request $request){

        $validated = Validator::make($request->all(),[
            'name_ar' => 'required',
            'name_en' => 'required',
            'image'=>'required|mimes:jpeg,jpg,png|max:10000'
        ]);

        if ($validated->fails()){
            return response()->json($validated->errors(), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            // return $validated->errors();
        }

        $imagePath=$this->saveImage($request->image,'images/categories');

        $save= Category::create([
            "name_ar"=>$request->name_ar,
            "name_en"=>$request->name_en,
            "image"=>$imagePath

        ]);

        if ($save)
            return response()->json([
                'status' => true,
                'msg' => 'Saved Successfully',
            ]);

        else
            return response()->json([
                'status' => false,
                'msg' => 'Something went wrong ,try again later',
            ]);

    }



    public function addNewSubCategory(Request $request){

        $validated = Validator::make($request->all(),[
            'name_ar' => 'required',
            'name_en' => 'required',
            'category_id'=>'required'
        ]);

        if ($validated->fails()){
            return response()->json($validated->errors(), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            // return $validated->errors();
        }


        $save= SubCategory::create([
            "name_ar"=>$request->name_ar,
            "name_en"=>$request->name_en,
            "category_id"=>$request->category_id

        ]);

        if ($save)
            return response()->json([
                'status' => true,
                'msg' => 'Saved Successfully',
            ]);

        else
            return response()->json([
                'status' => false,
                'msg' => 'Something went wrong ,try again later',
            ]);

    }



    public function addNewProduct(Request $request){
        $validated = Validator::make($request->all(),[
            'name_ar' => 'required',
            'name_en' => 'required',
            'detail_ar' => 'required',
            'detail_en' => 'required',
            'discount' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'category' => 'required|exists:categories,id',
            'sub_category' => 'required|exists:sub_categories,id',
            'brand' => 'required|exists:brands,id',
            'product_type' => 'required|exists:product_types,id',
            'used_for' => 'required',
            'image' => 'required|array',
            'image.*' => 'image|mimes:jpeg,jpg,png|max:10000',
            'f_name_ar' => 'nullable|array',
            'f_name_ar.*' => 'required|string',
            'f_name_en' => 'nullable|array',
            'f_name_en.*' => 'required|string',
            'f_detail_ar' => 'nullable|array',
            'f_detail_ar.*' => 'required|string',
            'f_detail_en' => 'nullable|array',
            'f_detail_en.*' => 'required|string',

        ]);

        if ($validated->fails()){
            return response()->json($validated->errors(), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            // return $validated->errors();
        }


        $prePrice=($request->price*$request->discount)/100;

        $save= Product::create([
            "name" =>$request->name_en,
            "pre_price"=>$prePrice,
            "price"=>$request->price,
            "discount"=>$request->discount,
            "type_id"=>$request->product_type,
            "used_for"=>$request->used_for,
            "category_id"=>$request->category,
            "sub_category_id"=>$request->sub_category,
            "brand_id"=>$request->brand,
            "quantity"=>$request->quantity

        ]);
        if ($save){
             foreach ($request->image as $img){
                 $imagePath=$this->saveImage($img,'images/products');
                 Image::create([
                     "image"=>$imagePath,
                     "type"=>$img-> getClientOriginalExtension(),
                     "product_id"=>$save->id
                 ]);
            }


             ProductAr::create([
                 "name"=>$request->name_ar,
                 "detail"=>$request->detail_ar,
                 "product_id"=>$save->id
             ]);

            ProductEn::create([
                "name"=>$request->name_en,
                "detail"=>$request->detail_en,
                "product_id"=>$save->id
            ]);

            for ($i=0;$i<count($request->f_name_ar);$i++){
                Feature::create([
                    "title_ar"=>$request->f_name_ar[$i],
                    "title_en"=>$request->f_name_en[$i],
                    "detail_ar"=>$request->f_detail_ar[$i],
                    "detail_en"=>$request->f_detail_en[$i],
                    "product_id"=> $save->id
                ]);
            }




            return response()->json([
                'status' => true,
                'msg' => 'Saved Successfully',
            ]);


        }else{
            return response()->json([
                'status' => false,
                'msg' => 'Something went wrong ,try again later',
            ]);
        }




    }



    public function addNewFeature(Request $request){
        $validated = Validator::make($request->all(),[
            'product_id'=>'required',
            'f_name_ar' => 'required|string',
            'f_name_en' => 'required|string',
            'f_detail_ar' => 'required|string',
            'f_detail_en' => 'required|string',

        ]);

        if ($validated->fails()){
            return response()->json($validated->errors(), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            // return $validated->errors();
        }


        $prePrice=($request->price*$request->discount)/100;

        $save= Feature::create([
            "title_ar"=>$request->f_name_ar,
            "title_en"=>$request->f_name_en,
            "detail_ar"=>$request->f_detail_ar,
            "detail_en"=>$request->f_detail_en,
            "product_id"=> $request->product_id

        ]);
        if ($save){
            return response()->json([
                'status' => true,
                'msg' => 'Feature Added Successfully',
                'id'=> $save->id,
            ]);

        }else{
            return response()->json([
                'status' => false,
                'msg' => 'Something went wrong ,try again later',
            ]);
        }


    }

}
