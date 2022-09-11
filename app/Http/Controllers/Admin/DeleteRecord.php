<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Feature;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DeleteRecord extends Controller
{
    //

    public function deleteProductType(Request $request){
        $validated = Validator::make($request->all(),[
            'id' => 'required',
        ]);

        if ($validated->fails()){
            return response()->json($validated->errors(), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            // return $validated->errors();
        }

         ProductType::find($request->id)->delete();

        return response()->json([
            'status' => true,
            'msg' => 'Deleted Successfully',
        ]);

    }

    public function deleteBrand(Request $request){
        $validated = Validator::make($request->all(),[
            'id' => 'required',
        ]);

        if ($validated->fails()){
            return response()->json($validated->errors(), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            // return $validated->errors();
        }

        Brand::find($request->id)->delete();

        return response()->json([
            'status' => true,
            'msg' => 'Deleted Successfully',
        ]);

    }

    public function deleteCategory(Request $request){
        $validated = Validator::make($request->all(),[
            'id' => 'required',
        ]);

        if ($validated->fails()){
            return response()->json($validated->errors(), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            // return $validated->errors();
        }

        Category::find($request->id)->delete();

        return response()->json([
            'status' => true,
            'msg' => 'Deleted Successfully',
        ]);

    }

    public function deleteSubCategory(Request $request){
        $validated = Validator::make($request->all(),[
            'id' => 'required',
        ]);

        if ($validated->fails()){
            return response()->json($validated->errors(), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            // return $validated->errors();
        }

        SubCategory::find($request->id)->delete();

        return response()->json([
            'status' => true,
            'msg' => 'Deleted Successfully',
        ]);

    }

    public function deleteProduct(Request $request){
        $validated = Validator::make($request->all(),[
            'id' => 'required',
        ]);

        if ($validated->fails()){
            return response()->json($validated->errors(), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            // return $validated->errors();
        }

        Product::find($request->id)->delete();

        return response()->json([
            'status' => true,
            'msg' => 'Deleted Successfully',
        ]);

    }


    public function deleteFeature(Request $request){
        $validated = Validator::make($request->all(),[
            'id' => 'required',
        ]);

        if ($validated->fails()){
            return response()->json($validated->errors(), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            // return $validated->errors();
        }

        Feature::find($request->id)->delete();

        return response()->json([
            'status' => true,
            'msg' => 'Deleted Successfully',
        ]);

    }


    public function deleteProductImage(Request $request){
        $validated = Validator::make($request->all(),[
            'id' => 'required',
        ]);

        if ($validated->fails()){
            return response()->json($validated->errors(), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            // return $validated->errors();
        }

        $record=Image::find($request->id);

        if (count($record->product->images)>1){
            $record->delete();
            return response()->json([
                'status' => true,
                'msg' => 'Deleted Successfully',
            ]);
        }else{
            return response()->json([
                'status' => false,
                'msg' => 'Cant delete last image',
            ]);
        }



    }


}
