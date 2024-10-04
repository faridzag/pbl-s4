@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">{{ $event->name }}</h1>

    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Type:</strong> {{ $event->event_type }}</p>
                    <p><strong>Status:</strong> {{ $event->status }}</p>
                    <p><strong>Start Date:</strong> {{ $event->start_date }}</p>
                    <p><strong>End Date:</strong> {{ $event->end_date ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Location:</strong> {{ $event->location ?? 'N/A' }}</p>
                    @if($event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" class="img-fluid">
                    @endif
                </div>
            </div>
            <div class="mt-3">
                <h5>Description</h5>
                <p>{{ $event->description }}</p>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Participation Statistics</div>
        <div class="card-body">
            <div class="row text-center">
                <div class="col-md-4">
                    <h3>{{ $event->companies->count() }}</h3>
                    <p>Companies</p>
                </div>
                <div class="col-md-4">
                    <h3>{{ $event->jobVacancies->count() ?? 'N/A' }}</h3>
                    <p>Job Vacancies</p>
                </div>
                <div class="col-md-4">
                    <h3>{{ $event->jobApplications->count() }}</h3>
                    <p>Applications</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Application Status</div>
        <div class="card-body">
            <div class="row text-center">
                <div class="col-md-4">
                    <h3>{{ $event->jobApplications->where('status', 'pending')->count() }}</h3>
                    <p>Pending</p>
                </div>
                <div class="col-md-4">
                    <h3>{{ $event->jobApplications->where('status', 'reject')->count() }}</h3>
                    <p>Rejected</p>
                </div>
                <div class="col-md-4">
                    <h3>{{ $event->jobApplications->where('status', 'accept')->count() }}</h3>
                    <p>Accepted</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Participating Companies</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>Vacancies</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($event->companies as $company)
                    <tr>
                        <td>{{ $company->user->name }}</td>
                        <td>{{ $company->vacancies->where('event_id', $event->id)->count() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Job Vacancies</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Position</th>
                        <th>Company</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($event->jobVacancies as $vacancy)
                    <tr>
                        <td>{{ $vacancy->position }}</td>
                        <td>{{ $vacancy->company->user->name }}</td>
                        <td>{{ $vacancy->status }}</td>
                        <td>
                            <a href="{{ route('vacancy.show', $vacancy->id) }}" class="btn btn-sm btn-primary">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @can('view-applicants')
    <div class="card mb-4">
        <div class="card-header">Applicants</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Applied Position</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($event->jobApplications as $application)
                    <tr>
                        <td>{{ $application->user->name }}</td>
                        <td>{{ $application->vacancy->position }}</td>
                        <td>{{ $application->status }}</td>
                        <td>
                            <a href="{{ route('applications.show', $application->id) }}" class="btn btn-sm btn-primary">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endcan
</div>
@endsection
