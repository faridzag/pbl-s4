<?php

namespace App\Http\Controllers\PROFILE;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ApplicantProfileController extends Controller
{
    public function index()
    {
        $applicant = Auth::user()->applicant;
        return view('pages.profile.applicant', compact('applicant'));
    }

    public function update(Request $request)
    {
        //ddd($request);
        $request->validate([
            'avatar' => 'image|file|max:1024',
            'cv_path' => 'file|max:1024',
            'description' => 'nullable|string|max:1500',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|max:16|required_with:current_password',
            'password_confirmation' => 'nullable|min:8|max:12|required_with:new_password|same:new_password',
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $applicant = $user->applicant;
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $applicant->description = $request->input('description');

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
            $avatar = $request->file('avatar')->store('public/applicants/avatar');
            $user->avatar = $avatar;
        }

        if ($request->hasFile('cv_path')) {
            if (isset($applicant->cv_path)) {
                Storage::delete($applicant->cv_path);
            }
            $cv_path = $request->file('cv_path')->store('public/applicant-cvs');
            $applicant->cv_path = $cv_path;
        }

        $user->save();
        $applicant->save();;

        return redirect()->route('applicant-profile');
    }
}
