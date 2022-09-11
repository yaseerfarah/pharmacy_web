<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use function Sodium\add;

class PublicController extends Controller
{
    //
    use GeneralTrait;

    public function getCategories(){

        $categories=Category::all();

        return $this->returnData("data",$categories);

    }


    public function getBrands(){

        $brands=Brand::all();

        return $this->returnData("data",$brands);

    }


    public function getProductTypes(){

        $productsTypes=ProductType::all();

        return $this->returnData("data",$productsTypes);

    }


    public function getSubCategoriesById($id){

        try {
            $subCategories=Category::find($id)->subCategory;

            return $this->returnData("data",$subCategories);
        }catch (\Exception $ex){
            return $this->returnError("E0001","not Found");
        }
    }



    public function filterProducts(Request $request){


        try {
            $validatedData=  Validator::make($request->all(),[
                'discount' => 'required|numeric',
                'category' => 'required|numeric',
                'sub_category' => 'required|numeric',
                'brand' => 'required|numeric',
                'product_type' => 'required|numeric',
                'used_for' => 'required|numeric',
            ]);

            if ($validatedData->fails()){
                return $this->returnValidationError("E001",$validatedData);
            }

           $conditions=Product::with('images')->with('productAr')->with('productEn')
           ->productFilter($request->discount,
               $request->category,
               $request->sub_category,
               $request->brand,
               $request->product_type,
               $request->used_for);

//            if ($request->discount>-1){
//                $conditions->where("discount",'<=',$request->discount);
//            }
//            if ($request->category>-1){
//                $conditions->where("category_id",$request->category);
//            }
//            if ($request->sub_category>-1){
//                $conditions->where("sub_category_id",$request->sub_category);
//            }
//            if ($request->brand>-1){
//                $conditions->where("brand_id",$request->brand);
//            }
//            if ($request->product_type>-1){
//                $conditions->where("type_id",$request->product_type);
//            }
//            if ($request->used_for>-1){
//                $conditions->where("used_for",$request->used_for);
//            }

            $result = $conditions->paginate(9);

            $paginateResult=$result->toArray();

            unset($paginateResult['links'],$paginateResult['from'],$paginateResult['path']);

            return $this->returnData("data",count($result)>0?$paginateResult:[]);



        }catch (\Exception $ex){
            return $this->returnError("E0001",$ex->getMessage());
        }


    }



    function getProductDetails($id){
        try {
            if ($id!=null){
                $result=Product::with('images')->with('productAr')->with('productEn')
                    ->with('features')->find($id);
                if (isset($result)){
                    return $this->returnData("data",$result);
                }else{
                    return $this->returnError("E0001","Not Found");
                }
            }else{
                return $this->returnError("E0001","No id found");
            }
        }catch (\Exception $exception){
            return $this->returnError("E0001",$exception->getMessage());
        }

    }



    function getHomePage(){

        try {
            $homeContents=$this->getHomeContent();
            $pagerContents=$this->getViewPager();

            $result=["view_pager"=>$pagerContents,"home_contents"=>$homeContents];

            return $this->returnData("data",$result);
        }catch (\Exception $exception){
            return $this->returnError("E0001",$exception->getMessage());

        }


    }


    private function getViewPager(){
       $pagerIds= Redis::zrange("view_pagers",0,-1);
       $pagerContents=array();;
       foreach ($pagerIds as $pagerId){
          $pagerContents[]=Redis::hgetall($pagerId);
       }

       return $pagerContents;
    }

    private function getHomeContent(){
        $contentIds= Redis::zrange("home_contents",0,-1);
        $homeContents=array();;
        foreach ($contentIds as $contentId){
            $homeContent=Redis::hgetall($contentId);

            $conditions=Product::with('images')->with('productAr')->with('productEn')
                ->productFilter($homeContent["discount"],
                    $homeContent["category"],
                    $homeContent["sub_category"],
                    $homeContent["brand"],
                    $homeContent["product_type"],$homeContent["used_for"]);

            $result = $conditions->take(6)->get();
            $homeContent["products"]=$result;
            $homeContents[]=$homeContent;
        }

        return $homeContents;
    }


    function getSplashScreen(){
        try {
            $result=Redis::get("splash_screen");
            return $this->returnData("data",$result);
        }catch (\Exception $exception){
            return $this->returnError("E0001",$exception->getMessage());
        }
    }

}
