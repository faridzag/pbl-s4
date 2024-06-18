@extends('layouts.app')

@section('title','Manajemen Lowongan | List')
@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('job') }}</h1>

    <!-- Main Content goes here -->

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Lowongan</h6>
    </div>
    <div class="card-body">
        <a href="{{ route('job-management.create') }}" class="btn btn-primary mb-3">Buat Lowongan Baru</a>

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
                    <th>Kegiatan</th>
                    <th>Posisi Pekerjaan</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jobs as $job)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $job->event->name }}</td>
                        <td>{{ $job->position }}</td>
                        <td>{{ $job->description }}</td>
                        <td>{{ $job->status }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('job-management.edit', $job->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                                <form action="{{ route('job-management.destroy', $job->id) }}" method="post">
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
