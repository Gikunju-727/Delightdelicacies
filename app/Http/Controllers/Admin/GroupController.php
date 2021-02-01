<?php

namespace App\Http\Controllers\Admin;

use App\Models\Groups;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class GroupController extends Controller
{
    //
    public function index(){

        $group = Groups::where('status','!=','2')->get();
        return view('admin.collection.group.index')->with('group',$group);

    }
    public function viewPage(){


        return view('admin.collection.group.create');

    }

    public function store(Request $request){
        $group = new Groups();
        $group->name = $request->input('name');
        $group->url = $request->input('url');
        $group->description = $request->input('description');

        if($request->input('status')==true){
            $group->status = "1";
        }
        else{
            $group->status = "1";
        }

        $group->save();
        return redirect()->back()->with('status','Product group added succesfully');


    }
    public function edit($id)
    {
        $group = Groups::find($id);
        return view('admin.collection.group.edit')->with('group',$group);
        }

    public function  update(Request $request, $id){
        $group = Groups::find($id);
        $group->name = $request->input('name');
        $group->url= $request->input('url');
        $group->description = $request->input('description');
        $group->status = $request->input('status')==true ?'1':'0';
        $group->update();

        return redirect()->back()->with('status','Product Group upated sucessfully');


    }
    public function delete($id){
        $group = Groups::find($id);
        $group->status ="2";//0 = show and 1= hide, 2= delete
        $group->update();
        return redirect()->back()->with('status','Data deleted successfully');
    }
    public function deletedRecords(){
        $group = Groups::where('status','2')->get();
        return view('admin.collection.group.deleted')->with('group',$group);

    }

    public function deletedRestore($id)
    {
        $group = Groups::find($id);
        $group->status ="0";//0 = show and 1= hide, 2= delete
        $group->update();
        return redirect('group')->with('status','Data restored successfully');

    }
}
