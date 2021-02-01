<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('front_end.index');
});


Auth::routes();

Route::get('collections','App\Http\Controllers\front_end\CollectionsController@index');


//front end
Route::get('collection/{group_url}','App\Http\Controllers\front_end\CollectionsController@groupview');
Route::get('collection/{group_url}/{cate_url}','App\Http\Controllers\front_end\CollectionsController@categoryview');
Route::get('collection/{group_url}/{cate_url}/{subcate_url}','App\Http\Controllers\front_end\CollectionsController@subcategoryview');
Route::get('collection/{group_url}/{cate_url}/{subcate_url}/{product_url}','App\Http\Controllers\front_end\CollectionsController@productview');
Route::get('cart', 'App\Http\Controllers\front_end\CartController@index');
Route::get('add-to-cart/{products}', 'App\Http\Controllers\front_end\CartController@addTocart');
Route::get('remove-from-cart/{id}', 'App\Http\Controllers\front_end\CartController@removeCart');
Route::get('updateCart/{id}', 'App\Http\Controllers\front_end\CartController@updateItem');


    Route::group(['middleware'=>['auth','IsUser']],function(){
        Route::get('/home', 'App\Http\Controllers\HomeController@Index')->name('home');
        Route::get('/my-profile','App\Http\Controllers\front_end\UserController@myProfile');
        Route::post('/my-profile-update','App\Http\Controllers\front_end\UserController@profileUpdate');
        Route::get('checkout','App\Http\Controllers\front_end\CheckController@index');
        Route::post('place-order','App\Http\Controllers\front_end\CheckController@storeOrder');
        Route::get('thank-you','App\Http\Controllers\front_end\CheckController@thankYou');
        Route::get('my-orders','App\Http\Controllers\front_end\MyOrdersController@index');
        Route::get('my-order-view/{order_id}','App\Http\Controllers\front_end\MyOrdersController@viewOrder');
        //
    });

Route::group(['middleware'=>['auth','IsAdmin']],function(){
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
    Route::get('registered_users', 'App\Http\Controllers\Admin\RegisteredController@index');
    Route::get('role_edit/{id}', 'App\Http\Controllers\Admin\RegisteredController@edit');
    Route::put('role-update/{id}', 'App\Http\Controllers\Admin\RegisteredController@updaterole');
    Route::get('/profile','App\Http\Controllers\Admin\RegisteredController@myProfile');
    Route::get('/profile-update','App\Http\Controllers\Admin\RegisteredController@profileUpdate');
    //groups
    Route::get('/group','App\Http\Controllers\Admin\GroupController@index');
    Route::get('/group-add','App\Http\Controllers\Admin\GroupController@viewPage');
    Route::post('/group-store','App\Http\Controllers\Admin\GroupController@store');
    Route::get('group-edit/{id}','App\Http\Controllers\Admin\GroupController@edit');
    Route::put('group-update/{id}','App\Http\Controllers\Admin\GroupController@update');
    Route::get('group-delete/{id}','App\Http\Controllers\Admin\GroupController@delete');
    Route::get('deleted-records','App\Http\Controllers\Admin\GroupController@deletedRecords');
    Route::get('group-restore/{id}','App\Http\Controllers\Admin\GroupController@deletedRestore');

    //category
    Route::get('category','App\Http\Controllers\Admin\CategoryController@index');
    Route::get('category-add','App\Http\Controllers\Admin\CategoryController@create');
    Route::post('category-store','App\Http\Controllers\Admin\CategoryController@store');
    Route::get('category-edit/{id}','App\Http\Controllers\Admin\CategoryController@edit');
    Route::put('category-update/{id}','App\Http\Controllers\Admin\CategoryController@update');
    Route::get('category-delete/{id}','App\Http\Controllers\Admin\CategoryController@delete');
    Route::get('deleted-category','App\Http\Controllers\Admin\CategoryController@deletedRecords');
    Route::get('category-restore/{id}','App\Http\Controllers\Admin\CategoryController@deletedRestore');

    //sub category
    Route::get('sub-category','App\Http\Controllers\Admin\SubcategoryController@index');
    Route::get('subcategory-add','App\Http\Controllers\Admin\SubcategoryController@create');
    Route::post('subcategory-store','App\Http\Controllers\Admin\SubcategoryController@store');
    Route::get('subcategory-edit/{id}','App\Http\Controllers\Admin\SubcategoryController@edit');
    Route::put('subcategory-update/{id}','App\Http\Controllers\Admin\SubcategoryController@update');
    Route::get('subcategory-delete/{id}','App\Http\Controllers\Admin\SubcategoryController@delete');
    Route::get('deleted-subcategory','App\Http\Controllers\Admin\SubcategoryController@deletedRecords');
    Route::get('subcategory-restore/{id}','App\Http\Controllers\Admin\SubcategoryController@deletedRestore');

    //products
    Route::get('product','App\Http\Controllers\Admin\ProductController@index');
    Route::get('product-add','App\Http\Controllers\Admin\ProductController@create');
    Route::post('product-store','App\Http\Controllers\Admin\ProductController@store');
    Route::get('product-edit/{id}','App\Http\Controllers\Admin\ProductController@edit');
    Route::put('product-update/{id}','App\Http\Controllers\Admin\ProductController@update');
    Route::get('product-delete/{id}','App\Http\Controllers\Admin\ProductController@delete');
    Route::get('product-deleted','App\Http\Controllers\Admin\ProductController@deletedRecords');
    Route::get('product-restore/{id}','App\Http\Controllers\Admin\ProductController@deletedRestore');

    //order management
    Route::get('orders','App\Http\Controllers\Admin\OrderController@index');
    Route::get('order-view/{order_id}','App\Http\Controllers\Admin\OrderController@viewOrder');



});
Route::group(['middleware'=>['auth','IsVendor']],function(){
    Route::get('/vendor-dashboard', function () {
        return view('vendor.vendor-dashboard');
    });

});


