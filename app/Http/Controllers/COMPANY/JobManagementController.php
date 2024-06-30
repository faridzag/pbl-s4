<?php

namespace App\Http\Controllers\COMPANY;

use App\Models\Company;
use App\Models\Vacancy;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class JobManagementController extends Controller
{
    public function index()
    {
        $jobs = Vacancy::where('company_id', auth()->user()->company->id)->paginate(10);
        return view('pages.job-management.list', [
            'title' => 'Manajemen Lowongan',
            'jobs' => $jobs,
        ]);
    }

    public function create()
    {
        $user = auth()->user();
        $availableEvents = $user->company->events; 
        $jobs = Vacancy::paginate(10);
        return view('pages.job-management.create', compact('jobs', 'availableEvents'));
    }

    public function store(Request $request)
    { 
        $request->validate([
            'event_id' => 'required',
            'position' => 'required|string|max:255',
            'description' => 'required|string|max:1500',
            'status' => 'required|string',
        ]);

        $job = new Vacancy();
        $job->event_id = $request->event_id;
        $job->position = $request->position;
        $job->description = $request->description;
        $job->status = $request->status;
        $job->user_id = auth()->user()->id;
        $job->company_id = auth()->user()->company->id;

        $job->save();

        return redirect()->route('job-management.index')->with('success', 'Lowongan berhasil dibuat!');
    }

    public function edit(string $id)
    {
        $user = auth()->user();
        $availableEvents = $user->company->events;
        $job = Vacancy::find($id); 
        //dd($user->company->id);
        //dd($job->company_id);
        if (!Gate::allows('update-job', $job)) {
            return redirect()->route('job-management.index')->withErrors(['error' => 'Anda Tidak Memiliki Izin Untuk Mengupdate Kegiatan Tersebut.']);
        }
        return view('pages.job-management.edit', compact('job', 'availableEvents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'position' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'status' => 'required|string',
        ]);
        $job = Vacancy::find($id);

        $job->position = $request->position;
        $job->description = $request->description;
        $job->status = $request->status;

        $job->save();

        return redirect()->route('job-management.index')->with('success', 'Lowongan berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $job = Vacancy::find($id);
        $job->delete();
        return redirect()->route('job-management.index')->with('message', 'Lowongan berhasil dihapus!');
    }
}
