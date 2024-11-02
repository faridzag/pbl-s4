<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;
use App\Models\Vacancy;
use App\Models\Company;
use App\Models\Event;

class LandingPageController extends Controller
{
    public function index()
    {
        $companies = Company::paginate(3, ['*'], 'company_per_page');
        //$events = Event::paginate(3, ['*'], 'event_per_page');
        $events = Event::where('status', 'open')->paginate(3, ['*'], 'event_per_page');
        return view('welcome', compact('companies', 'events'));
    }

    public function company_profile(Company $company)
    {
        $events = $company->events;
        $openVacancies = $company->vacancies()->where('status', 'open')->limit(3)->get();
        return view('pages.company.company-profile', compact('company', 'events', 'openVacancies'));
    }

    public function event_show(Event $event)
    {
        if ($event->status !== 'open') {
            abort(403);
        }
        $companies = $event->companies()->with('vacancies')->paginate(3);
        return view('pages.event.detail-event', compact('event', 'companies'));
    }

    public function vacancy_show(Vacancy $vacancy)
    {
        if ($vacancy->status !== 'open') {
            abort(403);
        }

        $user = Auth::user();
        $applicant = null;

        if ($user) {
            $applicant = $user->applicant;
        }
        $company = $vacancy->company;
        $similarVacancies = $vacancy->company->vacancies()->where('id', '!=', $vacancy->id)->where('status', 'open')->limit(3)->get();

        return view('pages.vacancy.show', compact('vacancy', 'company', 'similarVacancies', 'applicant'));
    }

    public function apply(Request $request, Vacancy $vacancy)
    {
        $user = Auth::user();

        $applicant = $user->applicant;
        $application = new Application;
        $application->user_id = $user->id;
        $application->company_id = $request->input('company_id');
        $application->vacancy_id = $request->input('vacancy_id');
        $application->event_id =  $request->input('event_id');
        $application->applicant_id = $applicant->id_number;
        $application->status = 'pending';
        $application->save();

        return redirect()->back()->with('success', 'Lamaran Anda berhasil diajukan!');
    }
}
