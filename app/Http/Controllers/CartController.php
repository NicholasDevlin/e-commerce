<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function create(Product $product, Request $request){
        $request->validate([
            'amount'=>'required|gte:1',
        ]);

        $userId = Auth::id();
        
        Cart::create([
            'user_id'=>$userId,
            'product_id'=>$product->id,
            'amount'=>$request->amount
        ]);

        return Redirect::back()->with('success','Product added to cart');
    }
}
