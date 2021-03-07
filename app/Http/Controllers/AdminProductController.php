<?php

namespace App\Http\Controllers;

use App\Models\Licence;
use App\Models\Log;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
    public function define(Request $request)
    {
        $validated = $request->validate([
            'define_user' => 'required',
            'define_product' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);


        $start_date= Carbon::parse($request->start_date)->format('Y-d-m H:i:s');
        $end_date= Carbon::parse($request->end_date)->format('Y-d-m H:i:s');
        $user_id=$request->define_user;
        $product_id=$request->define_product;

        $old_licence=Licence::where('product_id',$product_id)->where('user_id',$user_id)->whereDate('end_date','>=', $end_date)->whereDate('start_date','<=', $start_date)->first();
        if(!$old_licence)
        {
            Licence::create([
                'user_id'=>$user_id,
                'product_id'=>$product_id,
                'start_date'=>$start_date,
                'end_date'=>$end_date,
            ]);
            $product=Product::find($product_id);
            Log::create([
                'type'=>2,
                'user_id'=>$user_id,
                'message'=>Auth::user()->name."' Tarafından ".$product->name." lisansı tanımlandı. (".$request->start_date."-".$request->end_date.")",
            ]);

            Log::create([
                'type'=>2,
                'user_id'=>Auth::id(),
                'message'=>User::find($user_id)->name."Kullanıcısına ".$product->name." lisansı tanımlandı. (".$request->start_date."-".$request->end_date.")",
            ]);

            return redirect()->route('admin.product.index')->with('message', 'Kullanıcıya lisans tanımlandı!');
        }
        else
            return redirect()->route('admin.product.index')->with('error', 'Kullanıcının zaten aktif lisansı mevcut !');

    }
}
