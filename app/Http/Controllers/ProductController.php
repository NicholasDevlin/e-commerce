<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function create_product(){
        return view('product/create_product');
    }

    public function index(){
        return view('product/index');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required'
        ]);

        $file = $request->file('image');
        $path = time() . "_" . $request->name . '.' . $file->getClientOriginalExtension();
        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->desctiption,
            'image' => $path
        ]);

        return Redirect::route('product');
    }
}
