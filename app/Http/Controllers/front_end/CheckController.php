<?php

namespace App\Http\Controllers\front_end;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Orderitem;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckController extends Controller
{
    //
    public function index(){

        $cart_data = Session::get('cart');
        return view('front_end.checkout.index')->with('cart_data',$cart_data);
    }

    public function storeOrder(Request $request){
        if(isset($_POST['order_btn']))
        {
            //user data update
            $user_id = Auth::id();
            $user = User::find($user_id);
            $user->name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->phone = $request->input('phone');
            $user->Address1 = $request->input('address1');
            $user->Address2 = $request->input('address2');
            $user->city = $request->input('city');
            $user->save();

            //placing order
            /* Payment status
            0 pending
            1 cash accepted
            2 cancelled
            3 for online

            */
            $trackno = rand(1111,9999);
            $order = new Order();
            $order ->user_id = $user_id ;
            $order->tracking_no ='food_co'.$trackno;
            //$order->tracking_message = "";
            $order->payment_mode = "Cash on delivery";

            $order->payment_status = "0";
            $order->order_status = "0";
            $order->notify= "0";
            $order->save();

            $last_order_id = $order->id;


            //ordered cart item
            $cart_data = session('cart');
            $item_in_cart = $cart_data;
            foreach($item_in_cart as $itemdata){
                Orderitem::create([
                    'order_id'=>$last_order_id,
                    'product_id'=>$itemdata['product_id'],
                    'price'=>$itemdata['offer_price'],
                    'quantity'=>$itemdata['quantity']
                ]);

            }
            session()->forget('cart');
            return redirect('thank-you')->with('status','Order has been placed successfully');

        }

    }

    public function thankYou(){
        return view('front_end.checkout.thankyou');
    }
}
