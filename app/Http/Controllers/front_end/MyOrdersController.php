<?php

namespace App\Http\Controllers\front_end;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class MyOrdersController extends Controller
{
    //
    public function index(){
        return view('front_end.users.my-orders');
    }
    public function viewOrder($order_id){
        if(Order::where('id',$order_id)->exists()){
            $orders =Order::find($order_id);
            return view('front_end.users.view-orders',compact('orders'));

        }
        else
        {
            return redirect()->back()->with('status','No order found');
        }

    }
}
