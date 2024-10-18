<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

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

    function forgot_password()
    {
        return view('auth.forgot-password');
    }

    function forgot_password_send(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Silahkan isi email',
            'email.email' => 'Email tidak valid',
            'email.exists' => 'Email anda tidak terdaftar',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => 'Link reset password berhasil dikirim ke email anda'])
                : back()->withErrors(['email' => __($status)]);
    }

    function reset_password(string $token) {
        return view('auth.reset-password', ['token' => $token]);
    }

    function update_password(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|max:16|confirmed',
        ], [
            'email.required' => 'Silahkan isi email',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Silahkan isi kata sandi',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok',
            'password.token' => 'Email tidak cocok atau token anda telah kadaluarsa',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', 'Kata sandi Anda berhasil diperbarui. Silakan masuk dengan kata sandi baru Anda.')
            : back()->withErrors(['email' => [__($status)]]);
    }
}
