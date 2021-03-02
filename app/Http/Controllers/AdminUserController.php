<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{

    public function index(Request $request)
    {
        $users=User::join('user_types','users.type','=','user_types.id')->select('users.*', 'user_types.role as type_name')->get();
        return view('auth.admin.user.index',['users'=>$users]);
    }
    public function update(Request $request)
    {
        $validated = $request->validate([
            'edit_username' => 'required|max:25',
            'edit_email' => 'required|max:25|email',
            'edit_name' => 'required|max:25',
            'edit_ideal_username' => 'nullable|max:25',
            'edit_id' => 'required',
            'edit_type' => 'required|numeric',
        ]);
        $user=User::find($request->edit_id);
        $user->name=$request->edit_name;
        $user->username=$request->edit_username;
        $user->email=$request->edit_email;
        $user->ideal_username=$request->edit_ideal_username;
        $user->type=$request->edit_type;
        $user->save();

        return redirect()->route('admin.user.index')->with('message', 'Kullanıcı Başarıyla Güncellendi !');
    }


    public function delete(Request $request)
    {
        $validated = $request->validate([
            'id' => ['required',
                Rule::notIn([Auth::id()]),]
        ]);
        $user=User::find($request->id);
        $user->delete();

        return redirect()->route('admin.user.index')->with('message', 'Kullanıcı Başarıyla Silindi !');
    }
}
