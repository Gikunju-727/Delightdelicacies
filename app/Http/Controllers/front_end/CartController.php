<?php

namespace App\Http\Controllers\front_end;

use App\Http\Controllers\Controller;

use App\Models\Products;

class CartController extends Controller

{



    public function index(){
        return view('front_end.cart.cart');
    }
    public function addTocart(Products $products)
    {

        $cart = session()->get('cart');
        if (!$cart){
            $cart = [$products->id => $this->sessionData($products)];
            return $this->setSessionAndReturnResponse($cart);
        }
        if (isset($cart[$products->id])){
            $cart[$products->id]['quantity']++;
            return $this->setSessionAndReturnResponse($cart);
        }
        $cart[$products->id] = $this->sessionData($products);
        return $this->setSessionAndReturnResponse($cart);
    }

    protected function sessionData(Products $products){
        return [
            'product_id'=>$products->id,
            'name'        => $products->name,
            'quantity'    => 1,
            'offer_price'  => $products->offer_price,
            'image'       => $products->image
        ];
    }

    protected function setSessionAndReturnResponse($cart){
        session()->put('cart', $cart);
        return redirect('cart')->with('status', "Added to Cart");
    }

    public function removeCart($id){
        $cart = session()->get('cart');

        if (isset($cart[$id])){
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('status', "Removed from Cart");
    }


}
