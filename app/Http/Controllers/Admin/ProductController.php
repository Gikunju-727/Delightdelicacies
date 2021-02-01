<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $product = Products::where('status','!=','2')->get();
        return view('admin.collection.products.index')->with('product',$product);


    }

    public function create(){
        $subcategory = Subcategory::where('status','!=','2')->get();
        return view('admin.collection.products.create')->with('subcategory',$subcategory);
    }

    public function store(Request $request){
        $product = new Products();

        $product->sub_category_id= $request->input('subcategory_name');
        $product->name = $request->input('name');
        $product->url = $request->input('url');
        $product->small_description = $request->input('description');
        //$product->image = $request->input('image');
        if($request->hasFile('image')){
            $image_file = $request->file('image');
            $image_extension = $image_file->getClientOriginalExtension();
            $image_filename = time().'_'.$image_extension;
            $image_file->move('uploads/ProductsImages',$image_filename);
            $product->image= $image_filename;
        }

        $product->highlight_heading = $request->input('highlight_heading');
        $product->p_highlights = $request->input('p_highlights');
        $product->description_heading = $request->input('description_heading');
        $product->p_description= $request->input('p_description');
        $product->details_heading = $request->input('details_heading');
        $product->p_details = $request->input('p_details');

        $product->sale_tag = $request->input('sale_tag');

        $product->original_price = $request->input('original_price');
        $product->offer_price = $request->input('offer_price');
        $product->quantity = $request->input('quantity');
        $product->priority = $request->input('priority');

        $product->new_arrival = $request->input('new_arrivals')==true ?'1':'0';
        $product->featured_products = $request->input('efatured_products')==true ?'1':'0';
        $product->popular_products  = $request->input('popular_products')==true ?'1':'0';
        $product->offer_products = $request->input('featured_products')==true ?'1':'0';
        $product->status = $request->input('status')==true ?'1':'0';

        $product->meta_title = $request->input('meta_title');
        $product->meta_description = $request->input('meta_description');
        $product->meta_keyword  = $request->input('meta_keyword');

        $product->save();
        return redirect()->back()->with('status','Product added succesfully');


    }

    public function edit($id){

        $product = Products::find($id);
        $subcategory = Subcategory::where('status','!=','2')->get();
        return view('admin.collection.products.edit')->with('product',$product)->with('subcategory',$subcategory);
    }

    public function update(Request $request, $id){

        $product = Products::find($id);
        $product->sub_category_id= $request->input('subcategory_name');
        $product->name = $request->input('name');
        $product->url = $request->input('url');
        $product->small_description = $request->input('description');
        //$product->image = $request->input('image');
        if($request->hasFile('image')){
            $image_file = $request->file('image');
            $image_extension = $image_file->getClientOriginalExtension();
            $image_filename = time().'_'.$image_extension;
            $image_file->move('uploads/ProductsImages',$image_filename);
            $product->image= $image_filename;
        }

        $product->highlight_heading = $request->input('highlight_heading');
        $product->p_highlights = $request->input('p_highlights');
        $product->description_heading = $request->input('description_heading');
        $product->p_description= $request->input('p_description');
        $product->details_heading = $request->input('details_heading');
        $product->p_details = $request->input('p_details');

        $product->sale_tag = $request->input('sale_tag');

        $product->original_price = $request->input('original_price');
        $product->offer_price = $request->input('offer_price');
        $product->quantity = $request->input('quantity');
        $product->priority = $request->input('priority');

        $product->new_arrival = $request->input('new_arrivals')==true ?'1':'0';
        $product->featured_products = $request->input('featured_products')==true ?'1':'0';
        $product->popular_products  = $request->input('popular_products')==true ?'1':'0';
        $product->offer_products = $request->input('featured_products')==true ?'1':'0';
        $product->status = $request->input('status')==true ?'1':'0';

        $product->meta_title = $request->input('meta_title');
        $product->meta_description = $request->input('meta_description');
        $product->meta_keyword  = $request->input('meta_keyword');

        $product->update();
        return redirect()->back()->with('status','Product updated succesfully');
    }

    public function delete($id){
        $product = Products::find($id);
        $product->status='2';
        $product->update();
        return redirect()->back()->with('status','Deleted successfully');
    }

    public function deletedRecords(){
        $product = Products::where('status','2')->get();
        return view('admin.collection.products.deleted')->with('product',$product);

    }

    public function deletedRestore($id)
    {
        $product = Products::find($id);
        $product->status ="0";//0 = show and 1= hide, 2= delete
        $product->update();
        return redirect('product')->with('status','Data restored successfully');

    }
}
