<?php

namespace App\Http\Controllers\front_end;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Groups;
use App\Models\Products;
use App\Models\Subcategory;
use Illuminate\Http\Request;


class CollectionsController extends Controller
{
    //
    public function index(){
         $groups = Groups::where('status','!=','2')->get();
         return view('front_end.collections.index')->with('groups',$groups);
    }

    public function groupview($group_url){

        $groups = Groups::where('url',$group_url)->first();
        $group_id = $groups->id;
         $category  = Category::where('group_id',$group_id)->where('status','!=','2')->where('status','0')->get();
        return view('front_end.collections.category')->with('category',$category)->with('groups',$groups);
    }

    public function categoryview($group_url,$cate_url){
        $category = Category::where('url',$cate_url)->first();
        $category_id =  $category->id;
         $subcategory =  Subcategory::where('category_id',$category_id)->where('status','!=','2')->where('status','0')->get();
         return view('front_end.collections.subcategory')->with('category',$category)->with('subcategory',$subcategory);
     }

     public function subcategoryview($group_url,$cate_url,$subcate_url,Request $request){
        $subcategory = Subcategory::where('url',$subcate_url)->first();
        $subcategory_id =  $subcategory->id;

        if($request->get("sort") =='price_asc'){
            $products =  Products::where('sub_category_id',$subcategory_id)
            ->orderBy('offer_price','asc')
            ->where('status','!=','2')
            ->where('status','0')->get();

        }
        elseif($request->get("sort") =='price_desc'){
            $products =  Products::where('sub_category_id',$subcategory_id)
            ->orderBy('offer_price','desc')
            ->where('status','!=','2')
            ->where('status','0')->get();
        }

        elseif($request->get("sort") =='newest'){
            $products =  Products::where('sub_category_id',$subcategory_id)

            ->orderBy('created_at','desc')
            ->where('status','!=','2')
            ->where('status','0')->get();
        }

        elseif($request->get("sort") =='popularity'){
            $products =  Products::where('sub_category_id',$subcategory_id)

            ->where('popular_products','1')
            ->where('status','!=','2')
            ->where('status','0')->get();
        }

        else{

            $products =  Products::where('sub_category_id',$subcategory_id)
            ->where('status','!=','2')
            ->where('status','0')->get();

        }


         return view('front_end.collections.products')->with('products',$products)->with('subcategory',$subcategory);
     }

    public function productview($group_url,$cate_url,$subcate_url,$product_url)
     {
         $products = Products::where('url',$product_url)
         ->where('status','!=','2')
         ->where('status','0')->first();

         return view('front_end.collections.product-view')->with('products',$products);
     }
}
