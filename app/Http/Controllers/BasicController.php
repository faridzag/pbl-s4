<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BasicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('basic.list', [
            'title' => 'Basic CRUD',
            'users' => User::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('basic.create', [
            'title' => 'New User',
            'users' => User::paginate(10)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|min:6|max:25|alpha_dash:ascii|unique:users',
            'email' => 'required|email|min:6|max:100|unique:users',
            'password' => 'required|string|min:8|confirmed',
            // 'role' => 'required',
        ]);

        User::create([
            'username' => $request->username,
            //'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('basic.index')->with('message', 'Berhasil menambahkan akun!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $basic)
    {
        return view('basic.edit', [
            'title' => 'Edit User',
            'user' => $basic
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $basic)
    {
        $request->validate([
            'username' => 'required|min:6|max:25|alpha_dash:ascii',
            'email' => 'required|email|min:6|max:100',
            'password' => 'nullable|string|min:8|confirmed',
            // 'role' => 'nullable',
        ]);
        if($request->filled('password')) {
            $basic->password = Hash::make($request->password);
        }
        $basic->username = $request->username;
        //$basic->role = $request->role;
        $basic->email = $request->email;
        $basic->save();

        return redirect()->route('basic.index')->with('message', 'Berhasil memperbarui data pengguna!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $basic)
    {
        if (Auth::id() == $basic->getKey()) {
            return redirect()->route('basic.index')->with('warning', 'Tidak bisa menghapus akun sendiri!');
        }

        $basic->delete();

        return redirect()->route('basic.index')->with('message', 'Akun berhasil dihapus!');
    }
}
