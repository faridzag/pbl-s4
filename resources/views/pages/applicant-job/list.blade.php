@extends('layouts.app')

@section('title','Manajemen Lamaranku')
@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Lamaran') }}</h1>

    <!-- Main Content goes here -->

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Lamaranku</h6>
    </div>
    <div class="card-body">

    @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    @if(request()->has('search'))
        @if($applications->count())
            <div class="alert alert-info">
                <h2>Ditemukan {{ $applications->count() }} hasil untuk pencarian "{{ request('search') }}"</h2>
            </div>
        @else
            <div class="alert alert-warning">
                <h2>Tidak ada hasil ditemukan untuk "{{ request('search') }}"</h2>
                <p>Pencarian Anda "{{ request('search') }}" tidak menghasilkan data. Silakan coba dengan kata kunci lain.</p>
            </div>
        @endif
    @endif
    <div class="table-responsive">
        <table class="table table-bordered table-stripped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kegiatan</th>
                    <th>Nama Perusahaan</th>
                    <th>Tentang Perusahaan</th>
                    <th>Posisi</th>
                    <th>Status</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($applications as $application)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $application->event->name }}</td>
                        <td>{{ $application->company->user->name }}</td>
                        <td>{{ $application->company->description }}</td>
                        <td>{{ $application->vacancy->position }}</td>
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
                                <form action="{{ route('my-job-application.destroy', $application->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus?')">Hapus</button>
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
