<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $loggedUser = Auth::user();
        return view('layouts.app', ['loggedUser' => $loggedUser]);
    }
}
