<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();
        return view('profile/index', compact('user'));
    }

    public function update(Request $request) {
        $request->validate([
            'name'=> 'required'
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $request->input('name'),
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back();
    }
}
