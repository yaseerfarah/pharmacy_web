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
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class EditRecord extends Controller
{
    //
    use ImageTrait;

    public function updateProductType(Request $request){

        $validated = Validator::make($request->all(),[
            'id'=>'required',
            'name_ar' => 'required',
            'name_en' => 'required',
        ]);

        if ($validated->fails()){
            return response()->json($validated->errors(), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            // return $validated->errors();
        }

        $record= ProductType::find($request->id)->update([
            "name_ar"=>$request->get('name_ar'),
            "name_en"=>$request->get('name_en')
        ]);


        if ($record)
            return response()->json([
                'status' => true,
                'msg' => 'Updated Successfully',
            ]);

        else
            return response()->json([
                'status' => false,
                'msg' => 'Something went wrong ,try again later',
            ]);


    }

    public function updateBrand(Request $request){

        $validated = Validator::make($request->all(),[
            'id'=>'required',
            'name_ar' => 'required',
            'name_en' => 'required',
            'image'=>'nullable|mimes:jpeg,jpg,png'
        ]);

        if ($validated->fails()){
            return response()->json($validated->errors(), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            // return $validated->errors();
        }

        $record= Brand::find($request->id);
        $save=null;
        if ($request->has('image')){
            $imagePath=$this->saveImage($request->image,'images/brands');
            $save= $record->update([
                "name_ar"=>$request->name_ar,
                "name_en"=>$request->name_en,
                "image"=>$imagePath

            ]);
        }else{
            $save= $record->update([
                "name_ar"=>$request->name_ar,
                "name_en"=>$request->name_en,
            ]);
        }




        if ($save)
            return response()->json([
                'status' => true,
                'msg' => 'Updated Successfully',
            ]);

        else
            return response()->json([
                'status' => false,
                'msg' => 'Something went wrong ,try again later',
            ]);

    }

    public function updateCategory(Request $request){

        $validated = Validator::make($request->all(),[
            'id'=>'required',
            'name_ar' => 'required',
            'name_en' => 'required',
            'image'=>'nullable|mimes:jpeg,jpg,png'
        ]);

        if ($validated->fails()){
            return response()->json($validated->errors(), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            // return $validated->errors();
        }



        $record= Category::find($request->id);
        $save=null;
        if ($request->has('image')){
            $imagePath=$this->saveImage($request->image,'images/categories');
            $save= $record->update([
                "name_ar"=>$request->name_ar,
                "name_en"=>$request->name_en,
                "image"=>$imagePath

            ]);
        }else{
            $save= $record->update([
                "name_ar"=>$request->name_ar,
                "name_en"=>$request->name_en,
            ]);
        }




        if ($save)
            return response()->json([
                'status' => true,
                'msg' => 'Updated Successfully',
            ]);

        else
            return response()->json([
                'status' => false,
                'msg' => 'Something went wrong ,try again later',
            ]);

    }


    public function updateSubCategory(Request $request){

        $validated = Validator::make($request->all(),[
            'id'=>'required',
            'name_ar' => 'required',
            'name_en' => 'required',
            'category_id'=>'required'
        ]);

        if ($validated->fails()){
            return response()->json($validated->errors(), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            // return $validated->errors();
        }


        $record= SubCategory::find($request->id)->update([
            "name_ar"=>$request->name_ar,
            "name_en"=>$request->name_en,
            "category_id"=>$request->category_id
        ]);

        if ($record)
            return response()->json([
                'status' => true,
                'msg' => 'Updated Successfully',
            ]);

        else
            return response()->json([
                'status' => false,
                'msg' => 'Something went wrong ,try again later',
            ]);

    }


    public function editProduct(Request $request){
        $validated = Validator::make($request->all(),[
            'id'=>'required',
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
            'image' => 'nullable|array',
            'image.*' => 'image|mimes:jpeg,jpg,png|max:10000',
        ]);

        if ($validated->fails()){
            return response()->json($validated->errors(), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            // return $validated->errors();
        }


        $prePrice=($request->price*$request->discount)/100;

        $record=Product::find($request->id);

        $save=null;
        if ($request->has('image')){
            foreach ($request->image as $img){
                $imagePath=$this->saveImage($img,'images/products');
                Image::create([
                    "image"=>$imagePath,
                    "type"=>$img-> getClientOriginalExtension(),
                    "product_id"=>$record->id
                ]);
            }
        }


        $record->productAr->update([
            "name"=>$request->name_ar,
            "detail"=>$request->detail_ar,
        ]);

        $record->productEn->update([
            "name"=>$request->name_en,
            "detail"=>$request->detail_en,
        ]);



        $save= $record->update([
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
            return response()->json([
                'status' => true,
                'msg' => 'Updated Successfully',
            ]);

        }else{
            return response()->json([
                'status' => false,
                'msg' => 'Something went wrong ,try again later',
            ]);
        }

    }


    public function editFeature(Request $request){

        $validated = Validator::make($request->all(),[
            'id'=>'required',
            'f_name_ar' => 'required|string',
            'f_name_en' => 'required|string',
            'f_detail_ar' => 'required|string',
            'f_detail_en' => 'required|string',
        ]);

        if ($validated->fails()){
            return response()->json($validated->errors(), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            // return $validated->errors();
        }


        $record=Feature::find($request->id);

        $save=null;


        $save= $record->update([
            "title_ar"=>$request->f_name_ar,
            "title_en"=>$request->f_name_en,
            "detail_ar"=>$request->f_detail_ar,
            "detail_en"=>$request->f_detail_en,

        ]);
        if ($save){
            return response()->json([
                'status' => true,
                'msg' => ' Feature Updated Successfully',
            ]);

        }else{
            return response()->json([
                'status' => false,
                'msg' => 'Something went wrong ,try again later',
            ]);
        }




    }


}
