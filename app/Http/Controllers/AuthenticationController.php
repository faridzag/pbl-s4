<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    function index()
    {
        return view('auth.login');
    }

    function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' =>'required',
        ], [
                'login.required'=>'Email atau Nama pengguna wajib diisi',
                'password.required'=>'Password wajib diisi',
            ]);
        $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL )
        ? 'email'
        : 'username';
        $request->merge([$login_type => $request->input('login')]);

        if (Auth::attempt($request->only($login_type, 'password'))) {
            return redirect()->intended('home');
        } else {
            //dd($request->all());
            return back()->withInput()->withErrors(['login' => 'Kredensial Login Invalid.']);
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
