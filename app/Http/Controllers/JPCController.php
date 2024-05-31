<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class JPCController extends Controller
{
    function addCompany()
    {
        return view('jpc.add-company');
    }

    function createCompanyAccount(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:100',
            'description' => 'string|max:255',
            // 'website' => 'required',
            'username' => 'required|min:6|max:25|alpha_dash:ascii|unique:users',
            'email' => 'required|email|min:6|max:100|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        //dd($request->all());

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'COMPANY',
        ]);

        $company = Company::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => $user->id,
        ]);


        event(new Registered($user));

        // Auth::login($user);

        $user->company()->save($company);

        return route('add-company');
    }
}
