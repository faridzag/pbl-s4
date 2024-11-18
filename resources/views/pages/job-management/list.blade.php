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
            <form action="{{ route('job-management.index') }}" method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="event_filter" class="form-label">Kegiatan</label>
                        <select class="form-control" id="event_filter" name="event">
                            <option value="">Semua Kegiatan</option>
                            @foreach($events as $event)
                                <option value="{{ $event->id }}" {{ request('event') == $event->id ? 'selected' : '' }}>
                                    {{ $event->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('job-management.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
            <a href="{{ route('job-management.create') }}" class="btn btn-primary mb-3">Buat Lowongan Baru</a>

            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            @if(request()->has('search'))
                @if($jobs->count())
                    <div class="alert alert-info">
                        <h2>Ditemukan {{ $jobs->count() }} hasil untuk pencarian "{{ request('search') }}"</h2>
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
                            <th>Kegiatan</th>
                            <th>Posisi Pekerjaan</th>
                            <th>Deskripsi</th>
                            <th>Pesan Pelamar Diterima</th>
                            <th>Pesan Pelamar Ditolak</th>
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
                                <td>{!! Str::limit($job->description, 250) !!}</td>
                                <td>{!! Str::limit($job->accept_message, 200) !!}</td>
                                <td>{!! Str::limit($job->reject_message, 200) !!}</td>
                                <td>
                                    <span class="badge
                                                 @if ($job->status === 'open')
                                                     badge-success
                                                 @else
                                                     badge-warning
                                                 @endif
                                                 ">{{ $job->status }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('job-management.edit', $job->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                                        <form action="{{ route('job-management.destroy', $job->id) }}" method="post">
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
