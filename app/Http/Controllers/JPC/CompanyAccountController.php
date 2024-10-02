<?php

namespace App\Http\Controllers\JPC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class CompanyAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::with('user')->paginate(10);
        return view('pages.company-account.list', [
            'title' => 'Akun Perusahaan CRUD',
            'companies' => $companies,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::paginate(10);
        return view('pages.company-account.create', [
            'title' => 'Akun Perusahaan Baru',
            'companies' => $companies,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //ddd($request);
        $request->validate([
            'name' => 'required|string|max:50',
            'address' => 'string|max:100',
            'description' => 'string|max:255',
            'username' => 'required|min:6|max:25|alpha_dash:ascii|unique:users',
            'email' => 'required|email|min:6|max:100|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            //'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'role' => User::ROLE_COMPANY,
        ]);

        Company::create([
            'address' => $request->address,
            'description' => $request->description,
            'status' => $request->has('status') ? 1 : 0,
            'user_id' => $user->id,
        ]);

        $user->markEmailAsVerified();

        return redirect()->route('company-account.index')->with('message', 'Berhasil menambahkan akun perusahaan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $company = Company::with('user')->findOrFail($id);
        return view('pages.company-account.edit', [
            'title' => 'Edit Akun Perusahaan',
            'company' => $company
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'address' => 'string|max:100',
            'description' => 'string|max:1500',
            'username' => 'required|min:6|max:25|alpha_dash:ascii',
            'email' => 'required|email|min:6|max:100',
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        $company = Company::with('user')->findOrFail($id);
        $user = $company->user;

        if($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();
        $company->status = $request->has('status') ? 1 : 0;
        $company->address = $request->address;
        $company->description = $request->description;
        $company->save();
        return redirect()->route('company-account.index')->with('message', 'Berhasil memperbarui data perusahaan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::with('user')->findOrFail($id);
        $user = $company->user;
        if ($user) {
            $user->delete();
        }
        $company->delete();

        return redirect()->route('company-account.index')->with('message', 'Akun perusahaan berhasil dihapus!');
    }
}
