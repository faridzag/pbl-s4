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
            'id_number' => 'required|digits:16|alpha_num:ascii|unique:applicant_profiles',
            'full_name' => 'required|string|min:3',
            'birth_date' => 'required|date',
            'gender' => 'required|in:pria,wanita',
            'phone_number' => 'required|min:10|max:13|alpha_num:ascii',
            'username' => 'required|min:6|max:25|alpha_dash:ascii|unique:users',
            'email' => 'required|email|min:6|max:100|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => User::ROLE_DEFAULT,
        ]);

        $applicantProfile = Applicant::create([
            'id_number' => $request->id_number,
            'full_name' => $request->full_name,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'user_id' => $user->id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        $user->applicantProfile()->save($applicantProfile);

        return redirect()->route('verification.notice');
    }
}
