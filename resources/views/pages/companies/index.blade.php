@extends('layouts.app')

@section('title', 'Perusahaan')

@section('content')
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List Perusahaan</h6>
                        </div>
                        <div class="card-body">
                            <a href="{{route('companies.tambah')}}" class="btn btn-primary mb-3">Tambah Perusahaan</a>
                            <div class="table-responsive">
                                <table class="table table-bordered gap-5" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Perusahaan</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($no = 1)
                                        @foreach ($companies as $row)
                                        <tr>
                                        <th>{{ $no++ }}</th>
                                            <td>{{ $row->name}}</td>
                                            <td>{{ $row->user->username}}</td>
                                            <td>{{ $row->user->email}}</td>
                                            <td>{{ $row->description}}</td>
                                            <td>
                                                <a href="{{route('companies.edit', $row->id)}}" class="btn btn-warning">Edit</a>
                                                <a href="{{route('companies.hapus', $row->id)}}" class="btn btn-danger">Hapus</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
@endsection
