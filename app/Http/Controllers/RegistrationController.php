<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
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
            'name' => 'required|regex:/^[a-zA-Z\s]*$/|min:6|max:50',
            'birth_date' => 'required|date|before_or_equal:'.Carbon::now()->subYears(18)->format('Y-m-d'),
            'gender' => 'required|in:pria,wanita',
            'phone_number' => ['required', 'min:10', 'numeric', 'regex:/^(\+62[0-9]{9,11}|62[0-9]{8,11}|0[0-9]{9,12})$/'],
            'username' => 'required|min:6|max:25|alpha_dash|unique:users',
            'email' => 'required|email|min:6|max:100|unique:users',
            'password' => 'required|string|min:8|max:16|confirmed',
        ], [
                'id_number.required' => 'NIK wajib diisi.',
                'id_number.digits' => 'NIK harus terdiri dari 16 digit angka.',
                'id_number.unique' => 'NIK sudah terdaftar.',

                'name.required' => 'Nama lengkap wajib diisi.',
                'name.regex' => 'Nama lengkap harus berupa alfabet tanpa angka dan karakter unik.',
                'name.min' => 'Nama lengkap minimal terdiri dari 6 karakter.',
                'name.max' => 'Nama lengkap maksimal terdiri dari 50 karakter.',

                'birth_date.required' => 'Tanggal lahir wajib diisi.',
                'birth_date.date' => 'Tanggal lahir harus berupa tanggal yang valid.',
                'birth_date.before_or_equal' => 'Tanggal lahir setidaknya 18 tahun lalu.',

                'gender.required' => 'Jenis kelamin wajib diisi.',
                'gender.in' => 'Jenis kelamin harus berupa pria atau wanita.',

                'phone_number.required' => 'Nomor telepon wajib diisi.',
                'phone_number.min' => 'Nomor telepon minimal 10 digit.',
                'phone_number.numeric' => 'Nomor telepon harus berupa angka.',
                'phone_number.regex' => 'Nomor telepon tidak valid.',

                'username.required' => 'Nama pengguna wajib diisi.',
                'username.min' => 'Nama pengguna minimal terdiri dari 6 karakter.',
                'username.max' => 'Nama pengguna maksimal terdiri dari 25 karakter.',
                'username.alpha_dash' => 'Nama pengguna hanya boleh terdiri dari huruf, angka, tanda hubung, dan garis bawah.',
                'username.unique' => 'Nama pengguna sudah terdaftar.',

                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Email harus berupa alamat email yang valid.',
                'email.min' => 'Email minimal terdiri dari 6 karakter.',
                'email.max' => 'Email maksimal terdiri dari 100 karakter.',
                'email.unique' => 'Email sudah terdaftar.',

                'password.required' => 'Password wajib diisi.',
                'password.string' => 'Password harus berupa string.',
                'password.min' => 'Password minimal terdiri dari 8 karakter.',
                'password.max' => 'Password maksimal terdiri dari 16 karakter.',
                'password.confirmed' => 'Konfirmasi password tidak sesuai.',
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
