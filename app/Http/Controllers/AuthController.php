<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function main(Request $request)
    {
        $type=Auth::user()->type;
        switch ($type) {
            case 1:
                return redirect()->route('admin.index');
            case 2:
                return redirect()->route('supervisor.index');
            case 3:
                return redirect()->route('user.index');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login.index')->with('message', 'Başarıyla Çıkış Yaptınız !');
    }
}
