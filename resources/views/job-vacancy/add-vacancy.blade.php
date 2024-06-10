@extends('layout-company.app')

@section('title', 'Tambah Lowongan')

@section('content')
<!-- <form action="{{isset($event) ? route('event.tambah.update', $event->id) : route('event.tambah.simpan')}}" method="post"> -->
<form action="" method="post">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> Tambah Lowongan
                        <!-- {{isset ($event) ? 'Edit Detail Acara' : 'Buat Acara Baru'}} -->
                    </h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Posisi Lowongan</label>
                        <!-- <input type="text" class="form-control" id="name" name="name" value="{{isset($event) ? $event->name : ''}}"> -->
                    </div>

                    <div class="form-group">
                        <label for="">Deskripsi</label>
                    </div>

                    <div class="form-group">
                        <label for="">Jenis Pekerjaan</label>
                        <select class="form-control">
                            <option value="Penuh Waktu">Penuh Waktu</option>
                            <option value="Paruh Waktu">Paruh Waktu</option>
                            <option value="Kontrak">Kontrak</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Status Lowongan</label>
                        <select class="form-control">
                            <option value="Aktif">Aktif</option>
                            <option value="Tutup">Tutup</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection