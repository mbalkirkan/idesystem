<?php

namespace App\Http\Controllers;

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
    public function _login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|max:25',
            'password' => 'required',
        ]);

        if( Auth::attempt(['username' =>$request->username,'password'=>$request->password,'type'=>3],isset($request->remember) ? true : false))
        {
            return  redirect()->route('user.index');
        }
        elseif( Auth::attempt(['username' =>$request->username,'password'=>$request->password,'type'=>2],isset($request->remember) ? true : false))
        {
            return  redirect()->route('user.index');
        }
        elseif( Auth::attempt(['username' =>$request->username,'password'=>$request->password,'type'=>1],isset($request->remember) ? true : false))
        {
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

       return redirect()->route('login.index')->with('message', 'Başarıyla Kayıt Oldunuz !');
    }
}
