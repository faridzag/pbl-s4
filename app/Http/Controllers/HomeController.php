<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Event;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /*$users = User::count();
        $companies = Company::count();

        $widget = [
            'users' => $users,
            'companies' => $companies
        ];*/

        // // Mengambil jumlah total user dan company dari database
        $userCount = User::count(); //menghitung jumlah total pengguna
        $companiesCount = Company::count(); //menghitung jumlah total perusahaan

        $widget = [
            'users' => $userCount,
            'companies' => $companiesCount
        ];

        $user = Auth::user();

        //return view('pages.home', compact('widget'));
        return view('home', compact('user', 'widget'));
    }
}
