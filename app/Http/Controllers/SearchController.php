<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $role = auth()->user()->role;
        $query = $request->input('search');

        switch ($role) {
            case 'COMPANY':
                return redirect()->route('job-management.index', ['search' => $query]);

            case 'JPC':
                return redirect()->route('event-management.index', ['search' => $query]);

            case 'APPLICANT':
                return redirect()->route('application.index', ['search' => $query]);

            default:
                return redirect()->back()->with('message', 'Unauthorized role');
        }
    }
}
