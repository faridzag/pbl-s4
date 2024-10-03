<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Applicant;
use App\Models\Company;
use App\Models\Event;
use App\Models\Vacancy;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;
        if ($role === 'JPC') {
            $userCount = User::count();
            $applicantCount = Applicant::count();
            $companiesCount = Company::count();
            $eventCount = Event::count();

            $widget = [
                'users' => $userCount,
                'applicants' => $applicantCount,
                'companies' => $companiesCount,
                'events' => $eventCount,
            ];

            $events = Event::withCount(['companies', 'jobVacancies', 'jobApplications'])
                ->with(['jobApplications' => function ($query) {
                    $query->select('event_id', 'status')
                        ->selectRaw('COUNT(*) as total')
                        ->groupBy('event_id', 'status');
                }])
                ->get()
                ->map(function ($event) {
                    $applicationStatus = $event->jobApplications->pluck('total', 'status')->toArray();
                    return [
                        'name' => $event->name,
                        'companies_count' => $event->companies_count,
                        'jobs_count' => $event->jobVacancies_count,
                        'applications_count' => $event->jobApplications_count,
                        'pending_count' => $applicationStatus['pending'] ?? 0,
                        'reject_count' => $applicationStatus['reject'] ?? 0,
                        'accept_count' => $applicationStatus['accept'] ?? 0,
                        'event_type' => $event->event_type,
                        'status' => $event->status,
                        'start_date' => $event->start_date,
                        'end_date' => $event->end_date,
                    ];
                });

            return view('home', compact('user', 'role', 'widget', 'events'));
        }

        // view untuk user selain JPC
        return view('home', compact('user', 'role'));
    }
}
