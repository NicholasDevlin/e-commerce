<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $query = Order::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            });
        }
    
        $orders = $query->paginate(1);
        return view('order/index', compact('orders'));
    }

    public function detail(Order $order){
        return view('order/detail', compact('order'));
    }

    public function checkout() {
        $userId = Auth::id();
        $carts = Cart::where('user_id', $userId)->get();

        if ($carts == null){
            return Redirect::to('show_cart')->with('error', 'Your cart is empty');
        }

        DB::beginTransaction();
        try{
            $order = Order::Create([
                'user_id'=> $userId
            ]);
    
            foreach($carts as $cart) {
                $product = Product::find($cart->product_id);
                $product->update([
                    'stock' => $product->stock - $cart->amount
                ]);

                Transaction::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'amount' => $cart->amount
                ]);
            }

            Cart::where('user_id', $userId)->delete();
            DB::commit();

            return Redirect::back();
        } catch(Exception $e) {
            DB::rollback();
            return Redirect::back()->with('error', 'Checkout failed. Please try again.');
        }
    }

    public function submit_payment_receipt(Order $order, Request $request){
        $file = $request->file('payment_receipt');
        $path = time() . "_" . $order->id . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('storage'), $path);
        
        $order->update([
            'payment_receipt' => $path
        ]);

        return Redirect::back();
    }

    public function confirm_payment(Order $order) {
        $order->update([
            'is_paid'=> true
        ]);
        return Redirect::back();
    }
}
