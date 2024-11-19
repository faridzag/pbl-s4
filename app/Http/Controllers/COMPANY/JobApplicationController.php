<?php

namespace App\Http\Controllers\COMPANY;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Event;
use App\Models\Vacancy;

class JobApplicationController extends Controller
{
    public function index(Request $request)
    {
        $companyId = auth()->user()->company->id;
        $applications = Application::where('company_id', $companyId)
            ->with('applicant.user', 'vacancy.event');

        if ($request->has('search') && $request->search !== '') {
            $applications = $applications->where('company_id', auth()->user()->company->id)
                ->where(function($query) use ($request) {
                    $query->whereHas('applicant.user', function($query) use ($request) {
                        $query->where('name', 'LIKE', '%' . $request->search . '%');
                    })->orWhereHas('vacancy', function($query) use ($request) {
                            $query->where('position', 'LIKE', '%' . $request->search . '%');
                        })->orWhereHas('event', function ($query) use ($request) {
                            $query->where('name', 'LIKE', '%' . $request->search . '%');
                        });
                });
        }
        // status filter
        if ($request->filled('status')) {
            $applications->where('status', $request->status);
        }

        // position filter
        if ($request->filled('position')) {
            $applications->whereHas('vacancy', function ($query) use ($request) {
                $query->where('position', $request->position);
            });
        }

        // event filter
        if ($request->filled('event')) {
            $applications->whereHas('vacancy', function ($query) use ($request) {
                $query->where('event_id', $request->event);
            });
        }


        // Get unique positions and events for filter dropdowns
        $positions = Vacancy::where('company_id', $companyId)->distinct()->pluck('position');
        $events = Event::whereHas('jobVacancies', function($query) use ($companyId) {
            $query->where('company_id', $companyId);
        })->get();

        $applications = $applications->paginate(10);
        return view('pages.job-application.list', [
            'applications' => $applications,
            'positions' => $positions,
            'events' => $events,
        ]);
    }

    public function update(Request $request, $id)
    {
        $application = Application::findOrFail($id);
        $application->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Lamaran berhasil diupdate!');
    }
}
