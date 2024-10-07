@extends('layouts.app')

@section('title','Akun Perusahaan | List')
@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Akun Perusahaan') }}</h1>

    <!-- Main Content goes here -->

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Perusahaan</h6>
    </div>
    <div class="card-body">
        <a href="{{ route('company-account.create') }}" class="btn btn-primary mb-3">Buat Akun Baru</a>

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
                    <th>Nama Pengguna</th>
                    <th>Email</th>
                    <th>Nama Perusahaan</th>
                    <th>Alamat</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th>Role</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $company->user->username }}</td>
                        <td>{{ $company->user->email }}</td>
                        <td>{{ $company->user->name }}</td>
                        <td>{{ $company->address }}</td>
                        <td>{{ $company->description }}</td>
                        <td>
                            <span class="badge
                                        @if ($company->status == 1)
                                            badge-success
                                        @else
                                            badge-danger
                                        @endif
                                    ">{{ $company->status == 1 ? 'Aktif' : 'NonAktif' }}
                            </span>
                        </td>
                        <td>{{ $company->user->role }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('company-account.edit', $company->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                                <form action="{{ route('company-account.destroy', $company->id) }}" method="post">
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

    {{ $companies->links() }}

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
