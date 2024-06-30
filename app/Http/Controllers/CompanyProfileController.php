<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            'image' => 'image|file|max:1024',
            'address' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:1500',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|max:12|required_with:current_password',
            'password_confirmation' => 'nullable|min:8|max:12|required_with:new_password|same:new_password',
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

        
        if ($request->hasFile('image')) {
            if (isset($company->image)) {
                Storage::delete($company->image);
            }
            //dd($request->all());
            $image = $request->file('image')->store('public/companies');
            $company->image = $image;
        }

        $user->save();
        $company->save();;

        return redirect()->route('company-profile');
    }
}
