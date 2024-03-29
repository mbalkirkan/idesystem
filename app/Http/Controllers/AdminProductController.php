<?php

namespace App\Http\Controllers;

use App\Models\Licence;
use App\Models\Log;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


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
            'add_product_name' => 'required|max:50',
            'add_product_summary' => 'required|max:00',
            'add_product_description' => 'required',
            'add_product_price' => 'required',
            'add_product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'add_product_system_file' => 'required',
            'add_product_period' => 'required'
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
            'period'=>$request->add_product_period,
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


        $start_date= Carbon::createFromFormat('d/m/Y H:i',$request->start_date);
        $end_date= Carbon::createFromFormat('d/m/Y H:i',$request->end_date);
       // return $end_date->format('Y-d-m H:i:s');
    //    return $start_date->diffForHumans();
        $user_id=$request->define_user;
        $product_id=$request->define_product;

        $old_licence=Licence::where('product_id',$product_id)->where('user_id',$user_id)->where('end_date','>=', now())->where('start_date','<=', now())->get();

        if(count($old_licence)==0)
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
                'message'=>User::find($user_id)->name." Kullanıcısına ".$product->name." lisansı tanımlandı. (".$request->start_date."-".$request->end_date.")",
            ]);

            return redirect()->route('admin.product.index')->with('message', 'Kullanıcıya lisans tanımlandı!');
        }
        else
            return redirect()->route('admin.product.index')->with('error', 'Kullanıcının zaten aktif lisansı mevcut.');

    }
    public function delete(Request $request)
    {
        $product=Product::find($request->id);

        File::delete('dist/systems/product/'.$product->system_file);
        File::delete('dist/images/product/'.$product->image);
        $product->delete();
        return redirect()->route('admin.product.index')->with('message', 'Sistem başarıyla silindi!');
    }
    public function update(Request $request)
    {

        $validated = $request->validate([
            'edit_product_id' => 'required',
            'edit_product_name' => 'required|max:50',
            'edit_product_summary' => 'required|max:200',
            'edit_product_description' => 'required',
            'edit_product_price' => 'required',
            'edit_product_period' => 'required',
            'edit_product_image' => 'nullable',
            'edit_product_system_file' => 'nullable'
        ]);

        $product=Product::find($request->edit_product_id);

        if($request->edit_product_image!=null)
        {

            File::delete('dist/images/product/'.$product->image);
            $image = $request->file('edit_product_image');
            $filename =  time().'.'.$image->getClientOriginalName();
            $image->move(public_path('dist/images/product'), $filename);
            $product->image=$filename;

        }
       if($request->edit_product_system_file!=null)
       {
           File::delete('dist/systems/product/'.$product->system_file);
           $system_file = $request->file('edit_product_system_file');
           $system_file_filename =  time().'.'.$system_file->getClientOriginalName();
           $system_file->move(public_path('dist/systems/product'), $system_file_filename);
           $product->system_file=$system_file_filename;
       }


       $product->name=$request->edit_product_name;
       $product->description=$request->edit_product_description;
       $product->summary=$request->edit_product_summary;
       $product->price=$request->edit_product_price;
       $product->period=$request->edit_product_period;

       $product->save();

        return redirect()->route('admin.product.index')->with('message', 'Sistem başarıyla güncellendi!');
    }
}
