<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    //
    public function index()
    {
        $category = Category::where('status','!=','2')->get();
        $subcategory = Subcategory::where('status','!=','2')->get();
        return view('admin.collection.sub-category.index')
        ->with('subcategory',$subcategory)
        ->with('category',$category);

    }

    public function create()

    {
        $category = Category::where('status','!=','2')->get();
        return view('admin.collection.sub-category.create')->with('category',$category);
    }
    public function store(Request $request){
        $subcategory = new Subcategory();
        $subcategory->category_id = $request->input('category_name');
        $subcategory->url = $request->input('url');
        $subcategory->name = $request->input('name');
        $subcategory->description = $request->input('description');
        //$subcategory->image = $request->input('image');
        if($request->hasFile('image')){
            $image_file = $request->file('image');
            $image_extension = $image_file->getClientOriginalExtension();
            $image_filename = time().'_'.$image_extension;
            $image_file->move('uploads/SubCategoryImages',$image_filename);
            $subcategory->image= $image_filename;
        }
        $subcategory->priority = $request->input('priority');
        $subcategory->status = $request->input('status')==true ?'1':'0';//0 show , 1 hide
        $subcategory->save();
        return redirect()->back()->with('status','Sub-category added succesfully');
    }
    public function edit($id){

        $category = Category::where('status','!=','2')->get();
        $subcategory = Subcategory::find($id);
        return view('admin.collection.sub-category.edit')->with('category',$category)->with('subcategory',$subcategory);
    }

    public function update(Request $request, $id){

        $subcategory = Subcategory::find($id);
        $subcategory->category_id = $request->input('category_name');
        $subcategory->url = $request->input('url');
        $subcategory->name = $request->input('name');
        $subcategory->description = $request->input('description');
        //$subcategory->image = $request->input('image');
        if($request->hasFile('image')){
            $filepath_image ='uploads/SubCategoryImages/'.$subcategory->image;
            if(File::exists($filepath_image)){
                File::delete($filepath_image);
            }
            $image_file = $request->file('image');
            $image_extension = $image_file->getClientOriginalExtension();
            $image_filename = time().'_'.$image_extension;
            $image_file->move('uploads/SubCategoryImages',$image_filename);
            $subcategory->image= $image_filename;
        }
        $subcategory->priority = $request->input('priority');
        $subcategory->status = $request->input('status')==true ?'1':'0';//0 show , 1 hide
        $subcategory->update();
        return redirect('sub-category')->with('status','Sub-category updated  succesfully');
    }

    public function delete($id){
        $subcategory = Subcategory::find($id);
        $subcategory->status='2';
        $subcategory->update();
        return redirect()->back()->with('status','Deleted successfully');

    }

    public function deletedRecords(){
        $subcategory = SubCategory::where('status','2')->get();
        return view('admin.collection.sub-category.deleted')->with('subcategory',$subcategory);

    }

    public function deletedRestore($id)
    {
        $subcategory = Subcategory::find($id);
        $subcategory->status ="0";//0 = show and 1= hide, 2= delete
        $subcategory->update();
        return redirect('sub-category')->with('status','Data restored successfully');

    }
}
