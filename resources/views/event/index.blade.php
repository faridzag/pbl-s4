@extends('layout.app')

@section('title','Acara')
@section('content')
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List Acara</h6>
                        </div>
                        <div class="card-body">
                            <a href="{{route('event.tambah')}}" class="btn btn-primary mb-3">Buat Acara</a>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Acara</th>
                                            <th>Jenis Acara</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($no = 1)
                                        @foreach ($event as $row)
                                        <tr>
                                            <th>{{ $no++ }}</th>
                                            <td>{{ $row->name}}</td>
                                            <td>{{ $row->event_type}}</td>
                                            <td>{{ $row->date}}</td>
                                            <td>
                                                <a href="{{route('event.edit', $row->id)}}" class="btn btn-warning">Edit</a>
                                                <a href="{{route('event.hapus', $row->id)}}" class="btn btn-danger">Hapus</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
@endsection