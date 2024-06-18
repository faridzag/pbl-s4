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
        <a href="{{ route('job-application.create') }}" class="btn btn-primary mb-3">Buat Lamaran Baru</a>

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
                    <th>Nama Lamaran</th>
                    <th>Jenis</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Mulai</th>
                    <th>Status</th>
                    <th>Anggota</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jobs as $job)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $job->name }}</td>
                        <td>{{ $job->job_type }}</td>
                        <td>{{ $job->description }}</td>
                        <td>{{ $job->start_date }}</td>
                        <td>{{ $job->status }}</td>
                        <td>
                            <ul>
                            @foreach($job->companies as $company)
                                <li>{{ $company->name }}</li>
                            @endforeach
                            </ul>
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('job-application.edit', $job->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                                <form action="{{ route('job-application.destroy', $job->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

    {{ $jobs->links() }}

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
