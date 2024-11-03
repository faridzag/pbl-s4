@extends('layouts.app')

@section('title','Manajemen Kegiatan | List')
@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Event') }}</h1>

    <!-- Main Content goes here -->

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Kegiatan</h6>
    </div>
    <div class="card-body">
        <a href="{{ route('event-management.create') }}" class="btn btn-primary mb-3">Buat Kegiatan Baru</a>

    @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    @if(request()->has('search'))
        @if($events->count())
            <div class="alert alert-info">
                <h2>Ditemukan {{ $events->count() }} hasil untuk pencarian "{{ request('search') }}"</h2>
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
                    <th>Gambar</th>
                    <th>Jenis</th>
                    <th>Lokasi</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Status</th>
                    <th>Anggota</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $event->name }}</td>
                        <td>
                            @if ($event->image)
                            <a href="{{ asset(str_replace('public/', '', 'storage/' . $event->image)) }}" target="_blank">
                                <img src="{{ asset(str_replace('public/', '', 'storage/' . $event->image)) }}" alt="{{ $event->name }} gambar" style="width: 100px; height: 50px; object-fit: cover;">
                            </a>
                            @else
                                Anda belum upload gambar
                            @endif
                        </td>
                        <td>{{ $event->event_type }}</td>
                        <td>{{ $event->location }}</td>
                        <td>{{ strip_tags($event->description, 100) }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->start_date)->format('d-M-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->end_date)->format('d-M-Y') }}</td>
                        <td>
                            <span class="badge
                                @if ($event->status === 'open')
                                    badge-primary
                                @elseif ($event->status === 'closed')
                                    badge-secondary
                                @else
                                    badge-success
                                @endif">
                                {{ $event->status }}
                            </span>
                        </td>
                        <td>
                            <ul>
                            @foreach($event->companies as $company)
                                <li>{{ $company->user->name }}</li>
                            @endforeach
                            </ul>
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('event-management.edit', $event->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                                <form action="{{ route('event-management.destroy', $event->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this?')">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

    {{ $events->links() }}

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
