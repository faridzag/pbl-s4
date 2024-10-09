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
                if ($request->has('target') && $request->target === 'job-application') {
                    return redirect()->route('job-application.index', ['search' => $query]);
                } else {
                    return redirect()->route('job-management.index', ['search' => $query]);
                }

            case 'JPC':
                if ($request->has('target') && $request->target === 'company-account') {
                    return redirect()->route('company-account.index', ['search' => $query]);
                } else {
                    return redirect()->route('event-management.index', ['search' => $query]);
                }

            case 'APPLICANT':
                return redirect()->route('my-job-application.index', ['search' => $query]);

            default:
                return redirect()->back()->with('message', 'Unauthorized role');
        }
    }
}
