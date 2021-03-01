<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminUserController extends Controller
{

    public function index(Request $request)
    {
        return view('auth.admin.user.index');
    }
}
