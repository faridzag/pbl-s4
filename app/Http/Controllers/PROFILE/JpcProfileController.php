<?php

namespace App\Http\Controllers\PROFILE;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class JpcProfileController extends Controller
{
    public function index()
    {
        return view('pages.profile.jpc');
    }

    public function update(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'avatar' => 'image|file|max:1024',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|max:16|required_with:current_password',
            'password_confirmation' => 'nullable|min:8|max:16|required_with:new_password|same:new_password'
        ]);


        $user = User::findOrFail(Auth::user()->id);
        $user->username = $request->input('username');
        $user->email = $request->input('email');

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
            $avatar = $request->file('avatar')->store('public/jpcs/avatar');
            $user->avatar = $avatar;
        }

        $user->save();

        return redirect()->route('profile');
    }
}
