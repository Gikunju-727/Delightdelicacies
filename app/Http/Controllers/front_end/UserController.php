<?php

namespace App\Http\Controllers\front_end;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function myProfile(){
        return view('front_end.users.profile');
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
