<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        return view('auth.admin.product.index');
    }
    public function add(Request $request)
    {
        $validated = $request->validate([
            'add_product_name' => 'required|max:25',
            'add_product_summary' => 'required|max:100',
            'add_product_description' => 'required|max:250',
            'add_product_price' => 'required',
            'add_product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $image = $request->file('add_product_image');
        $filename =  time().'.'.$image->getClientOriginalName();
        $image->move(public_path('dist/images/product'), $filename);




        return redirect()->route('admin.product.index')->with('message', 'Yeni Ürün Eklendi !');
    }
}
