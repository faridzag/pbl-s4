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
            'avatar' => 'image|max:2048',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|max:16|required_with:current_password',
            'password_confirmation' => 'nullable|min:8|max:16|required_with:new_password|same:new_password'
        ], [
                // Avatar
                'avatar.image' => 'Avatar harus berupa file gambar.',
                'avatar.max' => 'Ukuran avatar maksimal 2MB.',

                // Email
                'email.required' => 'Alamat email wajib diisi.',
                'email.email' => 'Format alamat email tidak valid.',
                'email.max' => 'Alamat email maksimal 255 karakter.',
                'email.unique' => 'Alamat email sudah digunakan oleh akun lain.',

                // Password
                'current_password.required_with' => 'password saat ini wajib diisi ketika mengubah kata sandi.',
                'new_password.required_with' => 'password baru wajib diisi ketika kata sandi saat ini diisi.',
                'new_password.min' => 'password baru minimal 8 karakter.',
                'new_password.max' => 'password baru maksimal 16 karakter.',
                'password_confirmation.required_with' => 'Konfirmasi password wajib diisi.',
                'password_confirmation.same' => 'Konfirmasi password tidak cocok dengan kata sandi baru.',
                'password_confirmation.min' => 'Konfirmasi password minimal 8 karakter.',
                'password_confirmation.max' => 'Konfirmasi password maksimal 16 karakter.',
            ]);

        if ($request->filled('current_password') && !Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'password lama tidak cocok.']);
        }


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

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui!');
    }
}
