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
                ->withCount([
                    'jobApplications as pending_count' => function ($query) {
                        $query->where('status', 'pending');
                    },
                    'jobApplications as reject_count' => function ($query) {
                        $query->where('status', 'reject');
                    },
                    'jobApplications as accept_count' => function ($query) {
                        $query->where('status', 'accept');
                    }
                ])
                ->get()
                ->map(function ($event) {
                    $applicationStatus = $event->jobApplications->pluck('total', 'status')->toArray();
                    return [
                        'name' => $event->name,
                        'companies_count' => $event->companies_count,
                        'jobs_count' => $event->job_vacancies_count,
                        'applications_count' => $event->job_applications_count,
                        'pending_count' => $event->pending_count ?? 0,
                        'reject_count' => $event->reject_count ?? 0,
                        'accept_count' => $event->accept_count ?? 0,
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
