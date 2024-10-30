<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Applicant;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegistrationController extends Controller
{
    function index()
    {
        return view('auth.register');
    }

    function register(Request $request)
    {
        $request->validate([
            'id_number' => 'required|digits:16|unique:applicant_profiles',
            'name' => 'required|string|string|min:6|max:50',
            'birth_date' => 'required|date',
            'gender' => 'required|in:pria,wanita',
            'phone_number' => ['required', 'min:10', 'numeric', 'regex:/^(\+62[0-9]{9,11}|62[0-9]{8,11}|0[0-9]{9,12})$/'],
            'username' => 'required|min:6|max:25|alpha_dash:ascii|unique:users',
            'email' => 'required|email|min:6|max:100|unique:users',
            'password' => 'required|string|min:8|max:16|confirmed',
        ], [
            'id_number.required' => 'NIK wajib diisi',
            'id_number.digits' => 'NIK harus terdiri dari 16 digit angka',
            'name.required' => 'Nama lengkap wajib diisi',
            'name.size' => 'Nama terdiri dari 4 sampai 40 karakter',
            'birth_date.required' => 'Tanggal lahir wajib diisi',
            'gender.required' => 'Jenis kelamin wajib diisi',
            'phone_number.required' => 'Nomor Telpon wajib diisi',
            'phone_number.regex' => 'Nomor telepon tidak valid.',
            'username.required' => 'Nama Pengguna wajib diisi',
            'username.size' => 'Nama pengguna terdiri dari 6 sampai 25 karakter',
            'email.required' => 'Email wajib diisi',
            'email.size' => 'Karakter Email 6 sampai 100 karakter',
            'password.required'=>'Password wajib diisi',
            'password.size'=>'Password minimal 8 karakter maksimal 16 karakter',
        ]);

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => User::ROLE_DEFAULT,
        ]);

        $applicantProfile = Applicant::create([
            'id_number' => $request->id_number,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'user_id' => $user->id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        $user->applicant()->save($applicantProfile);

        return redirect()->route('verification.notice');
    }
}
