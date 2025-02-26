<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        return view('product/create');
    }

    public function index(){
        $products = Product::all();
        return view('product/index', compact('products'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required'
        ]);

        $file = $request->file('image');
        $path = time() . "_" . $request->name . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('storage'), $path);

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $path
        ]);

        return Redirect::route('product');
    }

    public function show(Product $product) {
        return view('product/show', compact('product'));
    }

    public function edit(Product $product) {
        return view('product/edit', compact('product'));
    }

    public function update(Product $product, Request $request) {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required'
        ]);

        $file = $request->file('image');
        $path = time() . "_" . $request->name . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('storage'), $path);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $path
        ]);

        return Redirect::route('product');
    }

    public function delete(Product $product){
        $product->delete();
        return Redirect::route('product');
    }
}
