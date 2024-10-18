<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Applicant;
use App\Models\Company;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use League\Csv\Writer;
use SplTempFileObject;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $role = $user->role;

        if ($role === 'JPC') {
            // Data widget
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

            // Pencarian
            $search = $request->input('search');

            $eventsQuery = Event::withCount(['companies', 'jobVacancies', 'jobApplications'])
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
                ]);

            // Jika ada pencarian, tambahkan kondisi pencarian
            if ($search) {
                $eventsQuery->where(function($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('event_type', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%');
                });
            }

            // Dapatkan hasil pencarian atau semua event
            $events = $eventsQuery->get()->map(function ($event) {
                return [
                    'id' => $event->id,
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

            return view('home', compact('user', 'role', 'widget', 'events', 'search'));
        }

        // View untuk user selain JPC
        return view('home', compact('user', 'role'));
    }

    public function show($id)
    {
        $event = Event::with(['companies', 'jobVacancies', 'jobApplications.user', 'jobApplications.vacancy'])
            ->findOrFail($id);

        return view('dashboard-detail', compact('event'));
    }

    public function export($id)
    {
        $event = Event::with([
            'companies.user',
            'companies.vacancies',
            'jobVacancies.company.user',
            'jobVacancies.applications',
            'jobApplications.user',
            'jobApplications.vacancy',
        ])->findOrFail($id);

        // CSV writer
        $csv = Writer::createFromFileObject(new SplTempFileObject());

        // Tambahkan informasi event
        $csv->insertOne(['Laporan Kegiatan - ' . $event->name]);
        $csv->insertOne(['']);

        // Informasi dasar
        $csv->insertOne(['Kegiatan']);
        $csv->insertAll([
            ['Nama', $event->name],
            ['Tipe', $event->event_type],
            ['Status', $event->status],
            ['Tanggal Mulai', $event->start_date],
            ['Tanggal Berakhir', $event->end_date ?? 'N/A'],
            ['Lokasi', $event->location ?? 'N/A'],
            ['Deskripsi', $event->description],
            ['']
        ]);

        // Statistik
        $csv->insertOne(['Statistik Event']);
        $csv->insertAll([
            ['Total Perusahaan', $event->companies->count()],
            ['Total Lowongan', $event->jobVacancies->count()],
            ['Total Lamaran', $event->jobApplications->count()],
            ['Lamaran pending', $event->jobApplications->where('status', 'pending')->count()],
            ['Lamaran tertolak', $event->jobApplications->where('status', 'reject')->count()],
            ['Lamaran diterima', $event->jobApplications->where('status', 'accept')->count()],
            ['']
        ]);

        // Perusahaan terdaftar
        $csv->insertOne(['Perusahaan Terdaftar']);
        $csv->insertOne(['Nama Perusahaan', 'Jumlah lamaran']);
        foreach ($event->companies as $company) {
            $csv->insertOne([
                $company->user->name,
                $company->vacancies->where('event_id', $event->id)->count()
            ]);
        }
        $csv->insertOne(['']);

        // Info lowongan
        $csv->insertOne(['Informasi Lowongan']);
        $csv->insertOne(['Posisi', 'Perusahaan', 'Status', 'Total Lamaran']);
        foreach ($event->jobVacancies as $vacancy) {
            $csv->insertOne([
                $vacancy->position,
                $vacancy->company->user->name,
                $vacancy->status,
                $vacancy->applications ? $vacancy->applications->count() : 0
            ]);
        }
        $csv->insertOne(['']);

        // info lamaran
        $csv->insertOne(['Informasi Lamaran']);
        $csv->insertOne(['Nama Pelamar', 'Posisi', 'Perusahaan', 'Status']);
        foreach ($event->jobApplications as $application) {
            $csv->insertOne([
                $application->user->name,
                $application->vacancy->position,
                $application->vacancy->company->user->name,
                $application->status
            ]);
        }

        // nama file
        $filename = "laporan-" . Str::slug($event->name) . "-" . date('Y-m-d') . ".csv";

        // Headers untuk download
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        return response($csv->getContent(), 200, $headers);
    }
}
