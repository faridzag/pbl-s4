@extends('layout.app')

@section('title', 'Tambah Perusahaan')
@section('content')
    <form action="{{isset($companies) ? route('companies.tambah.update', $companies->id) : route('companies.tambah.simpan')}}" method="post">
    @csrf
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{isset ($companies) ? 'Edit Detail Perusahaan' : 'Tambah Perusahaan'}}</h6>
                    </div>

                    <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li><strong>{{ $error }}</strong></li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                        <div class="form-group">
                            <label for="name" class="col-form-label">Nama Perusahaan</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{isset($companies) ? $companies->name : ''}}">
                        </div>

                        <div class="form-group">
                            <label for="username" class="col-form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{isset($companies) ? $companies->username : ''}}" required minlength="6" maxlength="25">
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{isset($companies) ? $companies->email : ''}}" required minlength="6" maxlength="100">
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" value="{{isset($companies) ? $companies->description : ''}}" rows="4" maxlength="255"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-form-label">Kata Sandi</label>
                            <input type="password" class="form-control" id="password" name="password" required minlength="8" maxlength="50">
                        </div>

                        <div class="form-group mb-3">
                            <label for="password_confirmation" class="col-form-label">Konfirmasi Kata Sandi</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required minlength="8" maxlength="50">
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