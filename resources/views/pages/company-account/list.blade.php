@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->

    <a href="{{ route('company-account.create') }}" class="btn btn-primary mb-3">Buat Akun Baru</a>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-bordered table-stripped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pengguna</th>
                <th>Email</th>
                <th>Nama Perusahaan</th>
                <th>Deskripsi</th>
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
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->description }}</td>
                    <td>{{ $company->user->role }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('company-account.edit', $company->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                            <form action="{{ route('company-account.destroy', $company->id) }}" method="post">
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

    {{ $companies->links() }}

    <!-- End of Main Content -->
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
