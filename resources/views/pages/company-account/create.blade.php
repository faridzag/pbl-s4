@extends('layouts.app2')

@section('title','Akun Perusahaan | Baru')
@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Akun Perusahaan') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('company-account.store') }}" method="post">
                @csrf
                <div class="form-group">
                  <label for="name">Nama Perusahaan</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nama Perusahaan" autocomplete="off" maxlength="50" value="{{ old('name') }}">
                  @error('name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="address">Alamat</label>
                  <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" placeholder="Alamat max 100 char" autocomplete="off" rows="3" maxlength="100">{{ old('address') }}</textarea>
                  @error('address')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="username">Nama Pengguna</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Nama Pengguna min 6 max 25" autocomplete="off" maxlength="25" value="{{ old('username') }}">
                    @error('username')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" autocomplete="off" value="{{ old('email') }}" maxlength="100">
                    @error('email')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                  <div class="form-group">
                    <label class="block" for="status">
                      <span>Aktif</span>
                      <input type="checkbox" class="@error('status') is-invalid @enderror" name="status" id="status" value="" checked>
                    </label>
                    @error('status')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="password">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" value="{{ old('password') }}" autocomplete="off" maxlength="255">
                    @error('password')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group col-md-6">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Password" autocomplete="off" maxlength="255">
                    @error('password_confirmation')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('company-account.index') }}" class="btn btn-default">Kembali</a>

            </form>
        </div>
    </div>

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
