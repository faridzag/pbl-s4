@extends('layouts.app')

@section('main-content')
<div class="container">
    <a href="{{ route('home') }}" class="btn btn-secondary mb-3">Kembali ke Dasbor</a>
    <h1 class="mb-4">{{ $event->name }}</h1>

    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('event.show', $event->id) }}">
                    @if($event->image)
                        <img src="{{ asset(str_replace('public/', '','storage/' . $event->image)) }}" alt="{{ $event->name }}" class="img-fluid">
                    @endif
                    </a>
                </div>
                <div class="col-md-6">
                    <p><strong>Tipe:</strong> {{ $event->event_type }}</p>
                    <p><strong>Status:</strong> {{ $event->status }}</p>
                    <p><strong>Tanggal Mulai:</strong> {{ $event->start_date }}</p>
                    <p><strong>Tanggal Selesai:</strong> {{ $event->end_date ?? 'N/A' }}</p>
                    <p><strong>Lokasi:</strong> {{ $event->location ?? 'N/A' }}</p>
                </div>
            </div>
            <div class="mt-3">
                <h5>Deskripsi</h5>
                <p>{{ $event->description }}</p>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Statistik Partisipasi</div>
        <div class="card-body">
            <div class="row text-center">
                <div class="col-md-4">
                    <h3>{{ $event->companies->count() }}</h3>
                    <p>Perusahaan</p>
                </div>
                <div class="col-md-4">
                    <h3>{{ $event->jobVacancies->count() ?? 'N/A' }}</h3>
                    <p>Lowongan</p>
                </div>
                <div class="col-md-4">
                    <h3>{{ $event->jobApplications->count() }}</h3>
                    <p>Lamaran</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Status Lamaran</div>
        <div class="card-body">
            <div class="row text-center">
                <div class="col-md-4">
                    <h3>{{ $event->jobApplications->where('status', 'pending')->count() }}</h3>
                    <p>Diproses</p>
                </div>
                <div class="col-md-4">
                    <h3>{{ $event->jobApplications->where('status', 'reject')->count() }}</h3>
                    <p>Ditolak</p>
                </div>
                <div class="col-md-4">
                    <h3>{{ $event->jobApplications->where('status', 'accept')->count() }}</h3>
                    <p>Diterima</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Perusahaan Terdaftar</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Perusahaan</th>
                        <th>Jumlah Lowongan</th>
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
        <div class="card-header">Daftar Lamaean</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Posisi</th>
                        <th>Perusahaan</th>
                        <th>Status</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($event->jobVacancies as $vacancy)
                    <tr>
                        <td>{{ $vacancy->position }}</td>
                        <td>{{ $vacancy->company->user->name }}</td>
                        <td>{{ $vacancy->status }}</td>
                        <td>
                            <a href="{{ route('vacancy.show', $vacancy->id) }}" class="btn btn-sm btn-primary">Lihat</a>
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
                            <a href="{{ route('applications.show', $application->id) }}" class="btn btn-sm btn-primary">Lihat</a>
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
