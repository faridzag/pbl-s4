<?php

namespace App\Http\Controllers\COMPANY;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vacancy;

class JobManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Vacancy::where('company_id', auth()->user()->company->id)->paginate(10);
        return view('pages.job-management.list', [
            'title' => 'Manajemen Lowongan',
            'jobs' => $jobs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        $availableEvents = $user->company->events; 
        $jobs = Vacancy::paginate(10);
        return view('pages.job-management.create', compact('jobs', 'availableEvents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $request->validate([
            'event_id' => 'required',
            'position' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        $job = new Vacancy();
        $job->event_id = $request->event_id;
        $job->position = $request->position;
        $job->description = $request->description;
        $job->status = $request->status;
        $job->company_id = auth()->user()->company->id;

        $job->save();

        return redirect()->route('job-management.index')->with('success', 'Lowongan berhasil dibuat!');
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
    public function edit(string $id)
    {
        $user = auth()->user();
        $availableEvents = $user->company->events; 
        $job = Vacancy::find($id);
        return view('pages.job-management.edit', compact('job', 'availableEvents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'position' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required|string',
        ]);
        $job = Vacancy::find($id);

        $job->position = $request->position;
        $job->description = $request->description;
        $job->status = $request->status;

        $job->save();

        return redirect()->route('job-management.index')->with('success', 'Lowongan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $job = Vacancy::find($id);
        $job->delete();
        return redirect()->route('job-management.index')->with('message', 'Lowongan berhasil dihapus!');
    }
}
