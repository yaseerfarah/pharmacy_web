<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});


Route::group(["prefix"=>"admin",'middleware' => ['web']],function (){
    Route::get('/login',[\App\Http\Controllers\Admin\Authorization::class,'loginView'])->name('admin.login');
    Route::post('/check-login',[\App\Http\Controllers\Admin\Authorization::class,'login'])->name("login");

    Route::get('/dashboard',[\App\Http\Controllers\Admin\Dashboard::class,'dashboardView'])->name('admin.dashboard');

    Route::post('/add-splash',[\App\Http\Controllers\Admin\MobileContents::class,'addSplashScreen'])->name('admin.addNewSplash');


    Route::post('/add-pager',[\App\Http\Controllers\Admin\MobileContents::class,'addViewPager'])->name('admin.addNewPager');
    Route::post('/delete-pager',[\App\Http\Controllers\Admin\MobileContents::class,'deletePager'])->name('admin.deletePager');


    Route::post('/add-home-content',[\App\Http\Controllers\Admin\MobileContents::class,'addHomeContent'])->name('admin.addNewContent');
    Route::post('/delete-home-content',[\App\Http\Controllers\Admin\MobileContents::class,'deleteContent'])->name('admin.deleteContent');





    Route::get('/orders',[\App\Http\Controllers\Admin\Dashboard::class,'ordersView'])->name('admin.orders');


    Route::get('/products',[\App\Http\Controllers\Admin\Dashboard::class,'productsView'])->name('admin.products');
    Route::get('/add-product',[\App\Http\Controllers\Admin\Dashboard::class,'addProductView'])->name('admin.addProduct');
    Route::get('/edit-product/{id}',[\App\Http\Controllers\Admin\Dashboard::class,'editProductView'])->name('admin.editProduct');

    Route::post('/edit-product',[\App\Http\Controllers\Admin\EditRecord::class,'editProduct'])->name('admin.updateProduct');
    Route::post('/edit-feature',[\App\Http\Controllers\Admin\EditRecord::class,'editFeature'])->name('admin.updateFeature');

    Route::post('/add-feature',[\App\Http\Controllers\Admin\NewCreate::class,'addNewFeature'])->name('admin.addNewFeature');
    Route::post('/add-product',[\App\Http\Controllers\Admin\NewCreate::class,'addNewProduct'])->name('admin.addNewProduct');
    Route::post('/delete-product',[\App\Http\Controllers\Admin\DeleteRecord::class,'deleteProduct'])->name('admin.deleteProduct');
    Route::post('/delete-feature',[\App\Http\Controllers\Admin\DeleteRecord::class,'deleteFeature'])->name('admin.deleteFeature');
    Route::post('/delete-product-image',[\App\Http\Controllers\Admin\DeleteRecord::class,'deleteProductImage'])->name('admin.deleteProductImage');



    Route::post('/sub-categories-byid',[\App\Http\Controllers\Admin\Dashboard::class,'getSubCategoriesById'])->name('subCategoriesById');



    Route::get('/brands',[\App\Http\Controllers\Admin\Dashboard::class,'brandsView'])->name('admin.brands');
    Route::get('/add-brand',[\App\Http\Controllers\Admin\Dashboard::class,'addBrandView'])->name('admin.addBrand');
    Route::get('/edit-brand/{id}',[\App\Http\Controllers\Admin\Dashboard::class,'editBrandView'])->name('admin.editBrand');

    Route::post('/add-brand',[\App\Http\Controllers\Admin\NewCreate::class,'addNewBrand'])->name('admin.addNewBrand');
    Route::post('/edit-brand',[\App\Http\Controllers\Admin\EditRecord::class,'updateBrand'])->name('admin.updateBrand');
    Route::post('/delete-brand',[\App\Http\Controllers\Admin\DeleteRecord::class,'deleteBrand'])->name('admin.deleteBrand');



    Route::get('/categories',[\App\Http\Controllers\Admin\Dashboard::class,'categoriesView'])->name('admin.categories');
    Route::get('/add-category',[\App\Http\Controllers\Admin\Dashboard::class,'addCategoryView'])->name('admin.addCategory');
    Route::get('/edit-category/{id}',[\App\Http\Controllers\Admin\Dashboard::class,'editCategoryView'])->name('admin.editCategory');

    Route::post('/edit-category',[\App\Http\Controllers\Admin\EditRecord::class,'updateCategory'])->name('admin.updateCategory');
    Route::post('/add-category',[\App\Http\Controllers\Admin\NewCreate::class,'addNewCategory'])->name('admin.addNewCategory');
    Route::post('/delete-category',[\App\Http\Controllers\Admin\DeleteRecord::class,'deleteCategory'])->name('admin.deleteCategory');


    Route::get('/sub-categories',[\App\Http\Controllers\Admin\Dashboard::class,'subCategoriesView'])->name('admin.subCategories');
    Route::get('/add-sub-category',[\App\Http\Controllers\Admin\Dashboard::class,'addSubCategoryView'])->name('admin.addSubCategory');
    Route::get('/edit-sub-category/{id}',[\App\Http\Controllers\Admin\Dashboard::class,'editSubCategoryView'])->name('admin.editSubCategory');

    Route::post('/edit-sub-category',[\App\Http\Controllers\Admin\EditRecord::class,'updateSubCategory'])->name('admin.updateSubCategory');
    Route::post('/add-sub-category',[\App\Http\Controllers\Admin\NewCreate::class,'addNewSubCategory'])->name('admin.addNewSubCategory');
    Route::post('/delete-sub-category',[\App\Http\Controllers\Admin\DeleteRecord::class,'deleteSubCategory'])->name('admin.deleteSubCategory');


    Route::get('/product-type',[\App\Http\Controllers\Admin\Dashboard::class,'productTypesView'])->name('admin.productTypes');
    Route::get('/add-product-type',[\App\Http\Controllers\Admin\Dashboard::class,'addProductTypeView'])->name('admin.addProductType');
    Route::get('/edit-product-type/{id}',[\App\Http\Controllers\Admin\Dashboard::class,'editProductTypeView'])->name('admin.editProductType');

    Route::post('/edit-product-type',[\App\Http\Controllers\Admin\EditRecord::class,'updateProductType'])->name('admin.updateProductType');
    Route::post('/add-product-type',[\App\Http\Controllers\Admin\NewCreate::class,'addNewProductType'])->name('admin.addNewProductType');
    Route::post('/delete-product-type',[\App\Http\Controllers\Admin\DeleteRecord::class,'deleteProductType'])->name('admin.deleteProductType');



});



