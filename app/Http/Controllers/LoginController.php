<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\UserModel;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        $user = UserModel::where('username', $request->username)->first();
        // dd($user);
        if ($user) {
            if ($user->verified_at != NULL) {
                if(Auth::guard()->attempt(['username' => $request->username, 'password' => $request->password])){
                    return redirect()->route('dashboard');
                } else {
                    return redirect()->back()->with('message', 'Username atau Password Anda Salah');
                }
            } else {
                return redirect()->route('registrasiSukses');
            }
        } else {
            return redirect()->back()->with(['failed' => 'Username atau Password Anda Salah']);
        }
    }

    public function logout()
    {
        Auth::guard()->logout();

        return redirect()->route('home');
    }
}
