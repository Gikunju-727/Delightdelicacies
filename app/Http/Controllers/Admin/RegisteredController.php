<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class RegisteredController extends Controller
{
    //
    public function index(){
        $users =User::all();
        return view('admin.users.index')->with('users',$users);
    }
    public function edit($id){

        $user_role = User::find($id);
        return view('admin.users.edit')->with('user_role',$user_role);

    }
    public function updaterole(Request $request, $id){
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->role_as = $request->input('roles');
        $user->IsBan= $request->input('isban');
        $user->update();
        return redirect()->back()->with('status','Role updated');
    }

    public function myProfile(){
        return view('admin.profile');
    }
    
    public function profileUpdate(Request $request){
        $user_id = Auth::user()->id;
        $user = User::findOrfail($user_id);
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->Address1 = $request->input('address1');
        $user->Address2 = $request->input('address2');
        $user->city = $request->input('city');
        $user->phone = $request->input('phone');
        if($request->hasFile('image')){
            $destination = 'uploads/profile/'.$user->image;
            if(File::exists($destination)){

                File::delete($destination);
            }
            $file =  $request->file('image');
            $extension = $file->getClientOriginalName();
            $filename = $extension;
            $file->move('uploads/profile/',$filename);
            $user->image = $filename;
        }
        $user->update();
        return redirect()->back()->with('status', 'Profile Updated');

    }



}
