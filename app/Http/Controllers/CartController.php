<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Product $product, Request $request){
        $userId = Auth::id();

        $existingCart = Cart::where('product_id', $product->id)
        ->where('user_id', $userId)
        ->first();

        if($existingCart != null){
            $request->validate([
                'amount'=>'required|gte:1|lte:' . ($product->stock - $existingCart->amount),
            ]);

            $existingCart->update([
                'amount'=> $existingCart->amount + $request->amount
            ]);
        } else {
            $request->validate([
                'amount'=>'required|gte:1|lte:' . $product->stock,
            ]);

            Cart::create([
                'user_id'=>$userId,
                'product_id'=>$product->id,
                'amount'=>$request->amount
            ]);
        }

        return Redirect::back()->with('success','Product added to cart');
    }

    public function show(){
        $userId = Auth::id();
        $carts = Cart::where('user_id',$userId)->get();
        return view('cart/index', compact('carts'));
    }

    public function update(Cart $cart, Request $request) {
        $request->validate([
            'amount'=>'required|gte:1|lte:' . $cart->product->stock
        ]);

        $cart->update([
            'amount'=> $request->amount
        ]);

        return Redirect::back()->with('success','Product amount updated');
    }

    public function delete(Cart $cart){
        $cart->delete();
        return Redirect::back()->with('success','Product removed from cart');
    }
}
