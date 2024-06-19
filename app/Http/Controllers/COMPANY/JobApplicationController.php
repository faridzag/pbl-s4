<?php

namespace App\Http\Controllers\COMPANY;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companyId = auth()->user()->company->id;
        $applications = Application::where('company_id', $companyId)
            ->with('applicant.user', 'vacancy.event')
            ->paginate(10);
        return view('pages.job-application.list', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Application $application)
    {        
        $this->authorize('update', $application);
        if ($application->company_id != auth()->user()->company->id) {
            abort(403, 'Unauthorized access');
        }

        return view('company.job-applications.update', compact('application'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        $this->authorize('update', $application);
        if ($application->company_id != auth()->user()->company->id) {
            abort(403, 'Unauthorized access');
        }

        $request->validate([
            'status' => 'required|in:accept,reject',
        ]);

        $application->update(['status' => $request->status]);

        return redirect()->route('company.job-applications.index')->with('success', 'Status lamaran berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
