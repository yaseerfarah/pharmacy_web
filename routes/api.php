<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::group(["middleware"=>"api"],function (){

    Route::post('/login',[\App\Http\Controllers\Api\Authorization::class,'login']);

    Route::post("/register",[\App\Http\Controllers\Api\Authorization::class,'register']);



    Route::get("/categories",[\App\Http\Controllers\Api\PublicController::class,'getCategories']);
    Route::get("/sub_categories_by_id/{id}",[\App\Http\Controllers\Api\PublicController::class,'getSubCategoriesById']);
    Route::get("/brands",[\App\Http\Controllers\Api\PublicController::class,'getBrands']);
    Route::get("/product_types",[\App\Http\Controllers\Api\PublicController::class,'getProductTypes']);


    Route::get("/products_filter",[\App\Http\Controllers\Api\PublicController::class,'filterProducts']);

    Route::get("/products_details/{id}",[\App\Http\Controllers\Api\PublicController::class,'getProductDetails']);

    Route::get("/home_page",[\App\Http\Controllers\Api\PublicController::class,'getHomePage']);

    Route::get("/splash_screen",[\App\Http\Controllers\Api\PublicController::class,'getSplashScreen']);


    Route::group(["middleware"=>"auth.api:user-api"],function (){
        Route::get("/user_addresses",[\App\Http\Controllers\Api\UserController::class,'getUserAddresses']);
        Route::post("/add_user_address",[\App\Http\Controllers\Api\UserController::class,'addNewAddress']);
        Route::post("/edit_user_address",[\App\Http\Controllers\Api\UserController::class,'editAddress']);

        Route::post("/confirm_order",[\App\Http\Controllers\Api\OrderController::class,'confirmOrder']);

        Route::get("/user_order",[\App\Http\Controllers\Api\OrderController::class,'getUserOrders']);

    });



});
