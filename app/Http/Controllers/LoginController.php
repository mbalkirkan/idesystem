<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        return view('auth.login');
    }
public function ip()
{
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

    public function _login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|max:25',
            'password' => 'required',
        ]);

        if( Auth::attempt(['username' =>$request->username,'password'=>$request->password,'type'=>3],isset($request->remember) ? true : false))
        {
            Log::create([
                'type'=>1,
                'user_id'=>Auth::id(),
                'message'=>$this->ip()."' Üzerinden giriş yapıldı.",
            ]);
            return  redirect()->route('user.index');
        }
        elseif( Auth::attempt(['username' =>$request->username,'password'=>$request->password,'type'=>2],isset($request->remember) ? true : false))
        {
            Log::create([
                'type'=>1,
                'user_id'=>Auth::id(),
                'message'=>$this->ip()."' Üzerinden giriş yapıldı.",
            ]);
            return  redirect()->route('user.index');
        }
        elseif( Auth::attempt(['username' =>$request->username,'password'=>$request->password,'type'=>1],isset($request->remember) ? true : false))
        {
            Log::create([
                'type'=>1,
                'user_id'=>Auth::id(),
                'message'=>$this->ip()."' Üzerinden giriş yapıldı.",
            ]);
            return  redirect()->route('admin.index');
        }
        else{
            return redirect()->route('login.index')->with('error', 'Bilgileri kontrol ediniz !');
        }


    }

    public function register(Request $request)
    {
        return view('auth.register');
    }
    public function _register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users,username|max:25',
            'email' => 'required|unique:users,email|max:25|email',
            'name' => 'required|max:25',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);
       $user= User::create([
            'name'=>$request->name,
            'username'=>$request->username,
           'password'=>bcrypt($request->password),
           'email'=>$request->email
        ]);
        Log::create([
            'type'=>3,
            'user_id'=>Auth::id(),
            'message'=>$this->ip()."' Üzerinden kayıt yapıldı.",
        ]);
       return redirect()->route('login.index')->with('message', 'Başarıyla Kayıt Oldunuz !');
    }
}
