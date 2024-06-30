<?php

namespace App\Http\Controllers\COMPANY;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;

class JobApplicationController extends Controller
{
    public function index()
    {
        $companyId = auth()->user()->company->id;
        $applications = Application::where('company_id', $companyId)
            ->with('applicant.user', 'vacancy.event')
            ->paginate(10);
        
        return view('pages.job-application.list', compact('applications'));
    }

    public function update(Request $request, $id)
    {    
        $application = Application::findOrFail($id);
        $application->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Lamaran berhasil diupdate!');
    }
}
