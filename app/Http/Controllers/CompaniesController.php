<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::with('user')->get();
        return view('pages.companies.index', ['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function tambah()
    {
        return view('pages.companies.tambah-company');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function simpan(Request $request)
    {
        // Validasi Data
        $request->validate([
            'name' => 'required|string|min:3|max:100',
            'description' => 'string|max:255',
            'is_active' => 'boolean',
            // 'website' => 'required',
            'username' => 'required|min:6|max:25|alpha_dash:ascii|unique:users',
            'email' => 'required|email|min:6|max:100|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            //'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'role' => User::ROLE_COMPANY,
        ]);

        Company::create([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->is_active,
            'user_id' => $user->id,
        ]);

        $user->markEmailAsVerified();


        // Menyimpan data event ke database
        // Companies::forceCreate($request->all());

        return redirect()->route('companies');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $companies = Company::find($id)->first();

        return view('pages.companies.tambah-company', ['companies'=>$companies]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:100',
            'description' => 'string|max:255',
            // 'website' => 'required',
            'username' => 'required|min:6|max:25|alpha_dash:ascii|unique:users',
            'email' => 'required|email|min:6|max:100|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => User::ROLE_COMPANY,
        ]);

        $companies = Company::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => $user->id,
        ]);

        $user->companies()->save($companies);

        // return route('company.create');
        // Companies::find($id)->update($request->all());

        return redirect()->route('companies');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function hapus($id)
    {
        Company::find($id)->delete();
        //User::find($id->user_id)->delete(); // harusnya hapus akun user dengan refer user_id yang terkait..

        return redirect()->route('companies');
    }
}
