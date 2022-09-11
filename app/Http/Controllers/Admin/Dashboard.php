<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class Dashboard extends Controller
{
    //

    public function dashboardView(){


        $users=User::all()->count();
        $product=Product::all()->count();
        $orders=Order::all()->count();
        $categories=Category::with('subCategory')->get();
        $brands=Brand::all();
        $productTypes=ProductType::all();


        $viewPagersIds=Redis::zrange('view_pagers',0,-1);

        $viewPagers=array();
        foreach ($viewPagersIds as $viewPagersId){
            $viewPagers[]=Redis::hgetall($viewPagersId);
        }

        $homeContentsIds=Redis::zrange('home_contents',0,-1);

        $homeContents=array();
        foreach ($homeContentsIds as $homeContentId){
            $homeContents[]=Redis::hgetall($homeContentId);
        }

        $splash=Redis::get('splash_screen');


        return view("pages.dashboard")->with(
            [
                "userCounts"=>$users,
                "productCounts"=>$product,
                "orderCounts"=>$orders,
                "categories"=>$categories,
                "brands"=>$brands,
                "productTypes"=>$productTypes,
                "viewPagers"=>$viewPagers,
                "homeContents"=>$homeContents,
                "splashScreen"=>$splash,
                "active"=>"0"
            ]
        );
    }

    public function ordersView(){


        $orders=Order::all();

        return view("pages.orders")->with(["orders"=>$orders,"active"=>"1"]);
    }

    public function productsView(){

        $product=Product::all();


        return view("pages.products")->with(["products"=>$product,"active"=>"2"]);
    }

    public function addProductView(){

        $categories=Category::with('subCategory')->get();
        $brands=Brand::all();
        $productTypes=ProductType::all();

        return view("pages.add_product")->with(["categories"=>$categories,"brands"=>$brands,"productTypes"=>$productTypes,"active"=>"2"]);
    }

    public function editProductView($id){

        $categories=Category::with('subCategory')->get();
        $brands=Brand::all();
        $productTypes=ProductType::all();
        $record=Product::find($id);

        return view("pages.edit.edit_product")->with(["product"=>$record,"categories"=>$categories,"brands"=>$brands,"productTypes"=>$productTypes,"active"=>"2"]);
    }

    public function brandsView(){


        $brands=Brand::all();

        return view("pages.brands")->with(["brands"=>$brands,"active"=>"3"]);
    }


    public function addBrandView(){



        return view("pages.add_brand")->with(["active"=>"3"]);
    }

    public function editBrandView($id){

        $record=Brand::find($id);

        return view("pages.edit.edit_brand")->with(["brand"=>$record,"active"=>"3"]);
    }
    public function categoriesView(){



        $categories=Category::all();

        return view("pages.categories")->with(["categories"=>$categories,"active"=>"4"]);
    }

    public function addCategoryView(){



        return view("pages.add_category")->with(["active"=>"4"]);
    }

    public function editCategoryView($id){

        $record=Category::find($id);

        return view("pages.edit.edit_category")->with(["category"=>$record,"active"=>"4"]);
    }

    public function subCategoriesView(){

        $subCategories=SubCategory::all();

        return view("pages.sub_categories")->with(["subCategories"=>$subCategories,"active"=>"5"]);
    }

    public function addSubCategoryView(){

        $categories=Category::all();


        return view("pages.add_sub_category")->with(["categories"=>$categories,"active"=>"5"]);
    }

    public function editSubCategoryView($id){

        $categories=Category::all();
        $record=SubCategory::find($id);


        return view("pages.edit.edit_sub_category")->with(["categories"=>$categories,"subCategory"=>$record,"active"=>"5"]);
    }

    public function productTypesView(){


        $proTypes=ProductType::all();

        return view("pages.product_types")->with(["productTypes"=>$proTypes,"active"=>"6"]);
    }

    public function addProductTypeView(){



        return view("pages.add_product_type")->with(["active"=>"6"]);
    }

    public function editProductTypeView($id){

        $record=ProductType::find($id);
        return view("pages.edit.edit_product_type")->with(["productType"=>$record,"active"=>"6"]);
    }


    /////////////////////////////////////////// Select Options /////////////////////////////////////

    public function getSubCategoriesById (Request $request){
        $html = "";
        if ($request->id>-1) {
            $category = Category::find($request->id);

            $subCategories = $category->subCategory;

            $subCategoryId = -1;
            if ($request->has('selectedId')) {
                $subCategory = $request->selectedId;
            }



            foreach ($subCategories as $subCategory) {
                if ($subCategoryId === $subCategory->id) {
                    $html .= "<option selected  value=" . $subCategory->id . ">" . $subCategory->name_en . "</option>";

                } else {
                    $html .= "<option  value=" . $subCategory->id . ">" . $subCategory->name_en . "</option>";

                }
            }
        }

        return response()->json($html);

    }

}


