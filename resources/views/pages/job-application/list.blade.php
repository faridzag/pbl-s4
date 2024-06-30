@extends('layouts.app')

@section('title','Manajemen Lamaran | List')
@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Lamaran') }}</h1>

    <!-- Main Content goes here -->

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Lamaran</h6>
    </div>
    <div class="card-body">

    @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered table-stripped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kegiatan</th>
                    <th>Nama Pelamar</th>
                    <th>Tentang Pelamar</th>
                    <th>Posisi</th>
                    <th>Cv</th>
                    <th>Status</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($applications as $application)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $application->event->name }}</td>
                        <td>{{ $application->user->fullname }}</td>
                        <td>{{ $application->applicant->description }}</td>
                        <td>{{ $application->vacancy->position }}</td>
                        <td>
                            @if (isset($application->applicant->cv_path))
                                <a href="{{ Storage::url($application->applicant->cv_path) }}" target="_blank">Lihat CV</a>
                            @else
                                <span class="text-muted">Pelamar belum mengupload CV</span>
                            @endif
                            </td>
                        <td>
                            <span class="badge 
                                @if ($application->status === 'reject')
                                    badge-danger
                                @elseif ($application->status === 'pending')
                                    badge-warning
                                @else
                                    badge-success
                                @endif">
                                @if ($application->status === 'accept')
                                    Diterima
                                @elseif ($application->status === 'reject')
                                    Ditolak
                                @else
                                    {{ $application->status }}
                                @endif
                            </span>
                        </td>
                        <td>
                            <div class="d-flex">
                                    <form action="{{ route('job-application.update', $application->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                        <div class="form-group">
                                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" value="{{ old('status') }}">
                                                <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="accept" {{ $application->status == 'accept' ? 'selected' : '' }}>Terima</option>
                                                <option value="reject" {{ $application->status == 'reject' ? 'selected' : '' }}>Tolak</option>
                                            </select>
                                        </div>
                                            @error('status')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-sm btn-primary">Konfirmasi</button>
                                        </div>
                                    </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

    {{ $applications->links() }}

    <!-- End of Main Content -->
</div>
@endsection

@push('notif')
    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning border-left-warning alert-dismissible fade show" role="alert">
            {{ session('warning') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
@endpush
