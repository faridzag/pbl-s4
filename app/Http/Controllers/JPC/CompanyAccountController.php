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
    public function index(Request $request)
    {
        // Query untuk mendapatkan daftar perusahaan dengan user terkait
        $companies = Company::with('user');

        // Jika ada input pencarian, lakukan filter
        if ($request->has('search') && $request->search !== '') {
            $companies = $companies->whereHas('user', function ($query) use ($request) {
                $query->where('username', 'LIKE', '%' . $request->search . '%')
                      ->orWhere('name', 'LIKE', '%' . $request ->search. '%')
                      ->orWhere('email', 'LIKE', '%' . $request->search . '%');
            })->orWhere('description', 'LIKE', '%' . $request->search . '%')
              ->orWhere('address', 'LIKE', '%' . $request->search . '%');
        }

        // Paginate hasil query
        $companies = $companies->paginate(10);

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
            'name' => 'required|string|min:6|max:50|unique:users,name',
            'address' => 'nullable|string|max:100', // address opsional
            'username' => 'required|min:6|max:25|alpha_dash:ascii|unique:users,username',
            'email' => 'required|email|min:6|max:100|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
                'name.unique' => 'Nama perusahaan sudah ada.',
                'name.required' => 'Nama lengkap wajib diisi.',
                'name.min' => 'Nama lengkap minimal harus 6 karakter.',
                'name.max' => 'Nama lengkap maksimal 50 karakter.',

                'address.string' => 'Alamat harus berupa teks.',
                'address.max' => 'Alamat maksimal 100 karakter.',

                'username.required' => 'Nama pengguna wajib diisi.',
                'username.min' => 'Nama pengguna minimal 6 karakter.',
                'username.max' => 'Nama pengguna maksimal 25 karakter.',
                'username.alpha_dash' => 'Nama pengguna hanya boleh mengandung huruf, angka, tanda hubung, dan garis bawah.',
                'username.unique' => 'Nama pengguna sudah digunakan oleh akun lain.',

                'email.required' => 'Alamat email wajib diisi.',
                'email.email' => 'Format alamat email tidak valid.',
                'email.min' => 'Alamat email minimal 6 karakter.',
                'email.max' => 'Alamat email maksimal 100 karakter.',
                'email.unique' => 'Alamat email sudah digunakan oleh akun lain.',

                'password.required' => 'Kata sandi wajib diisi.',
                'password.min' => 'Kata sandi minimal harus 8 karakter.',
                'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
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
        $company = Company::with('user')->findOrFail($id);
        $user = $company->user;
        $request->validate([
            'name' => 'required|string|min:6|max:50|unique:users,name,'.$user->id,
            'address' => 'nullable|string|max:100', // address opsional
            'username' => 'required|min:6|max:25|alpha_dash:ascii|unique:users,username,' . $user->id,
            'email' => 'required|email|min:6|max:100|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ], [
                'name.unique' => 'Nama perusahaan sudah ada.',
                'name.required' => 'Nama lengkap wajib diisi.',
                'name.min' => 'Nama lengkap minimal harus 6 karakter.',
                'name.max' => 'Nama lengkap maksimal 50 karakter.',

                'address.string' => 'Alamat harus berupa teks.',
                'address.max' => 'Alamat maksimal 100 karakter.',

                'username.required' => 'Nama pengguna wajib diisi.',
                'username.min' => 'Nama pengguna minimal 6 karakter.',
                'username.max' => 'Nama pengguna maksimal 25 karakter.',
                'username.alpha_dash' => 'Nama pengguna hanya boleh mengandung huruf, angka, tanda hubung, dan garis bawah.',
                'username.unique' => 'Nama pengguna sudah digunakan oleh akun lain.',

                'email.required' => 'Alamat email wajib diisi.',
                'email.email' => 'Format alamat email tidak valid.',
                'email.min' => 'Alamat email minimal 6 karakter.',
                'email.max' => 'Alamat email maksimal 100 karakter.',
                'email.unique' => 'Alamat email sudah digunakan oleh akun lain.',

                'password.min' => 'Kata sandi minimal harus 8 karakter.',
                'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            ]);

        if($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();
        $company->status = $request->has('status') ? 1 : 0;
        $company->address = $request->address;
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
