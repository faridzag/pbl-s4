@extends('layouts.app')

@section('title', 'Tambah Akun Perusahaan')

@section('content')
    <main class="container d-flex justify-content-center">
        <div class="card w-75 mx-auto mt-4 mb-4">
            <h5 class="card-header text-center">Tambah Akun Perusahaan</h5>
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
                <form action="{{ route('add-company') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="col-form-label">Nama Perusahaan:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" value="{{ old('name')}}" id="name" name="name" placeholder="Nama Perusahaan">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="username" class="col-form-label">Username:</label>
                        <input type="text" class="form-control" value="{{ old('username')}}" id="username" name="username" placeholder="Nama Pengguna" required minlength="6" maxlength="25">
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-form-label">Email:</label>
                        <input type="email" class="form-control" value="{{ old('email')}}" id="email" name="email" placeholder="Email" required minlength="6" maxlength="100">
                    </div>

                    <div class="form-group">
                        <label for="description" class="col-form-label">Deskripsi</label>
                        <textarea class="form-control" value="{{ old('description')}}" id="description" name="description" rows="4" maxlength="255"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-form-label">Kata Sandi:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Kata Sandi" required minlength="8" maxlength="50">
                    </div>

                    <div class="form-group mb-3">
                        <label for="password_confirmation" class="col-form-label">Konfirmasi Kata Sandi:</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" required minlength="8" maxlength="50">
                    </div>

                    <button type="submit" class="btn btn-danger">Batal</button>
                    <button type="submit" class="btn btn-primary" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </main>
@endsection
