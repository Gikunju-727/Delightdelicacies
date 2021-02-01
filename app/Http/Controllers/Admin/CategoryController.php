<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Groups;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class CategoryController extends Controller
{
    //
    public function index()

    {
        $category  = Category::where('status','!=','2')->get();
        return view('admin.collection.category.index')->with('category',$category);
    }

    public function create()

    {
        $group = Groups::where('status','!=','2')->get();
        return view('admin.collection.category.create')->with('group',$group);
    }

    public function store(Request $request){
        $category = new Category();
        $category->group_id = $request->input('group_name');
        $category->name = $request->input('name');
        $category->url = $request->input('url');
        $category->description = $request->input('description');
        //$category->image = $request->input('category_image');
        if($request->hasFile('category_image')){
            $image_file = $request->file('category_image');
            $img_extension = $image_file->getClientOriginalExtension();
            $img_filename = time().'_'.$img_extension;
            $image_file->move('uploads/CategoryImages/',$img_filename);
            $category->image = $img_filename;
        }
        //$category->icon = $request->input('category_icon');
        if($request->hasFile('category_icon')){
            $icon_file = $request->file('category_icon');
            $icon_extension = $icon_file->getClientOriginalExtension();
            $icon_filename = time().'_'.$icon_extension;
            $icon_file->move('uploads/CategoryIcons/',$icon_filename);
            $category->icon = $icon_filename;
        }
        $category->status = $request->input('status')==true ?'1':'0';//0 show , 1 hide
        $category->save();

        return redirect()->back()->with('status','Category added successfully');

    }

    public function edit($id){
        $group = Groups::where('status','!=','2')->get();
        $category = Category::find($id);
        return view('admin.collection.category.edit')->with('group',$group)->with('category',$category);

    }

    public function update(Request $request, $id){

        $category = Category::find($id);
        $category->group_id = $request->input('group_name');
        $category->url = $request->input('url');
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        //$category->image = $request->input('category_image');
        if($request->hasFile('category_image')){

            $filepath_image ='uploads/CategoryImages/'.$category->image;
            if(File::exists($filepath_image)){
                File::delete($filepath_image);
            }
            $image_file = $request->file('category_image');
            $img_extension = $image_file->getClientOriginalExtension();
            $img_filename = time().'_'.$img_extension;
            $image_file->move('uploads/CategoryImages/',$img_filename);
            $category->image = $img_filename;
        }
        //$category->icon = $request->input('category_icon');
        if($request->hasFile('category_icon')){

            $filepath_icon ='uploads/CategoryIcons/'.$category->icon;
            if(File::exists($filepath_icon)){
                File::delete($filepath_icon);
            }
            $icon_file = $request->file('category_icon');
            $icon_extension = $icon_file->getClientOriginalExtension();
            $icon_filename = time().'_'.$icon_extension;
            $icon_file->move('uploads/CategoryIcons/',$icon_filename);
            $category->icon = $icon_filename;
        }
        $category->status = $request->input('status')==true ?'1':'0';//0 show , 1 hide
        $category->update();

        return redirect()->back()->with('status','Category updated successfully');

    }
    public function delete($id){
        $category = Category::find($id);
        $category->status='2';
        $category->update();
        return redirect()->back()->with('status','Deleted successfully');

    }

    public function deletedRecords(){
        $category = Category::where('status','2')->get();
        return view('admin.collection.category.deleted')->with('category',$category);

    }

    public function deletedRestore($id)
    {
        $category = Category::find($id);
        $category->status ="0";//0 = show and 1= hide, 2= delete
        $category->update();
        return redirect('category')->with('status','Data restored successfully');

    }



}
