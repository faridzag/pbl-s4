<?php

namespace App\Http\Controllers\PROFILE;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CompanyProfileController extends Controller
{
    public function index()
    {
        $company = Auth::user()->company;
        return view('pages.profile.company', compact('company'));
    }

    public function update(Request $request)
    {
        //ddd($request);
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id,
            'avatar' => 'image|file|max:1024',
            'address' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:1500',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|max:16|required_with:current_password',
            'password_confirmation' => 'nullable|min:8|max:16|required_with:new_password|same:new_password',
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $company = $user->company;
        $user->username = $request->input('username');
        $company->address = $request->input('username');
        $user->email = $request->input('email');
        $company->description = $request->input('description');

        if (!is_null($request->input('current_password'))) {
            if (Hash::check($request->input('current_password'), $user->password)) {
                $user->password = Hash::make($request->input('new_password'));
            } else {
                return redirect()->back()->withInput();
            }
        }


        if ($request->hasFile('avatar')) {
            if (isset($user->avatar)) {
                Storage::delete($user->avatar);
            }
            //dd($request->all());
            $avatar = $request->file('avatar')->store('public/companies/avatar');
            $user->avatar = $avatar;
        }

        $user->save();
        $company->save();;

        return redirect()->route('company-profile');
    }
}
