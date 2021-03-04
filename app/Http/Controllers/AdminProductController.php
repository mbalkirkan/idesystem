<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;


class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $products=Product::all();

        return view('auth.admin.product.index',['products'=>$products]);
    }
    public function add(Request $request)
    {
        $validated = $request->validate([
            'add_product_name' => 'required|max:25',
            'add_product_summary' => 'required|max:100',
            'add_product_description' => 'required',
            'add_product_price' => 'required',
            'add_product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'add_product_system_file' => 'required'
        ]);
        $image = $request->file('add_product_image');
        $filename =  time().'.'.$image->getClientOriginalName();
        $image->move(public_path('dist/images/product'), $filename);

        $system_file = $request->file('add_product_system_file');
        $system_file_filename =  time().'.'.$system_file->getClientOriginalName();
        $system_file->move(public_path('dist/systems/product'), $system_file_filename);


        $product=Product::create([
            'name'=>$request->add_product_name,
            'description'=>$request->add_product_description,
            'summary'=>$request->add_product_summary,
            'price'=>$request->add_product_price,
            'image'=>$filename,
            'system_file'=>$system_file_filename,
        ]);



        return redirect()->route('admin.product.index')->with('message', 'Yeni Ürün Eklendi !');
    }
    public function toggle(Request $request)
    {
        $product=Product::find($request->id);
        $message="";
        $publish=$product->publish;
        if($publish)
        {
            $product->publish=false;
            $message=$product->name.' adlı ürün yayından kaldırıldı.';
        }

        else
        {
            $product->publish=true;
            $message=$product->name.' adlı ürün yayınlandı.';
        }

        $product->save();
        return redirect()->route('admin.product.index')->with('message', $message);
    }
}
