<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $products=Product::where('publish',true)->get();

        return view('auth.user.index',['products'=>$products]);
    }
}
