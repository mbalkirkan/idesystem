<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\LogType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function profile(Request $request)
    {
        $user=Auth::user();

        $logs=Log::where('user_id',$user->id)->orderBy('created_at','DESC')->get();
        $logTypes=LogType::all();


        return view('auth.profile',['user'=>$user,'logs'=>$logs,'logTypes'=>$logTypes]);
    }
    public function profile_update(Request $request)
    {
        $validated = $request->validate([
            'edit_email' => 'required|max:25|email',
            'edit_name' => 'required|max:25',
            'edit_ideal_username' => 'nullable|max:25',
            'edit_id' => 'required|in:'.Auth::id(),
        ]);

        $user=User::find($request->edit_id);
        $user->name=$request->edit_name;
        $user->email=$request->edit_email;
        $user->ideal_username=$request->edit_ideal_username;
        $user->save();


        Log::create([
            'type'=>3,
            'user_id'=>$user->id,
            'message'=>"Kullanıcı bilgileri güncellendi.",
        ]);

        return redirect()->route('auth.profile.index')->with('message', 'Bilgileriniz Başarıyla Güncellendi !');
    }
    public function update_password(Request $request)
    {
        $user=User::find(Auth::id());
        $validated = $request->validate([
            'old_password' => function ($attribute, $value, $fail) use ($user) {
                if (! Hash::check($value, $user->password)) {
                    $fail('Girdiğiniz şifre şuanki şifrenizle eşleşmiyor !');
                } },
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user->password=bcrypt( $request->password);
        $user->save();


        Log::create([
            'type'=>3,
            'user_id'=>$user->id,
            'message'=>"Şifre güncellendi.",
        ]);

        return redirect()->route('auth.profile.index')->with('message', 'Şifreniz Başarıyla Güncellendi !');
    }
}
