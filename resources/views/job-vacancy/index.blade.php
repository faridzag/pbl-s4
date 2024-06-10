@extends('layout-company.app')

@section('title','Lowongan Pekerjaan')
@section('content')
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Lowongan</h6>
                        </div>
                        <div class="card-body">
                            <!-- <a href="{{route('event.tambah')}}" class="btn btn-primary mb-3">Buat Acara</a> -->
                            <a href="" class="btn btn-primary mb-3">Tambah Lowongan</a>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Posisi Lowongan</th>
                                            <th>Deskripsi</th>
                                            <th>Jenis Pekerjaan</th>
                                            <th>Status Lowongan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <a href="#" class="btn btn-warning">Edit</a>
                                                <a href="#" class="btn btn-danger">Hapus</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
@endsection