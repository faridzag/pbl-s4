@extends('layouts.auth')

@section('title', 'Registrasi')

@section('header', 'Buat Sebuah Akun')

@section('content')
    <form id="registerForm" action="{{ route('register') }}" method="POST">
        @csrf
        <div class="mb-3">
            <input class="form-control" type="text" value="{{ old('id_number')}}" id="id_number" name="id_number" placeholder="NIK" maxlength="16" minlength="16" inputmode="numeric">
            @error('id_number')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
        <div class="mb-3">
            <input class="form-control" type="text" value="{{ old('name')}}" id="name" name="name" placeholder="Nama Lengkap" minlength="6" maxlength="50">
            @error('name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
        <div class="mb-3">
            <input class="form-control" type="email" value="{{ old('email')}}" id="email" name="email" placeholder="Email" minlength="6" maxlength="100">
            @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <input class="form-control" placeholder="Tanggal Lahir" value="{{ old('birth_date')}}" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="birth_date" name="birth_date"/>
                @error('birth_date')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>
            <div class="col-6">
                <select class="form-select" id="gender" name="gender">
                    <option value="" disabled selected>Jenis Kelamin</option>
                    <option value="pria" {{ old('gender') === 'pria' ? 'selected' : '' }}>Pria</option>
                    <option value="wanita" {{ old('gender') === 'wanita' ? 'selected' : '' }}>Wanita</option>
                </select>
                @error('gender')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>
        </div>
        <div class="mb-3">
            <input class="form-control" type="tel" value="{{ old('phone_number')}}" id="phone_number" name="phone_number" placeholder="No telepon" minlength="10" maxlength="13">
            @error('phone_number')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
        <div class="mb-3">
            <input class="form-control" type="text" value="{{ old('username')}}" id="username" name="username" placeholder="Nama Pengguna" minlength="6" maxlength="25">
            @error('username')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
        <div class="mb-3">
            <input class="form-control" type="password" id="password" name="password" placeholder="Kata Sandi" minlength="8" maxlength="16">
            @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
        <div class="mb-3">
            <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" minlength="8" maxlength="16">
            @error('password_confirmation')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
        <div class="d-grid">
            <button name="submit" class="btn btn-primary" type="submit">Daftar</button>
        </div>
    </form>
    <p class="text-center mt-3">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
@endsection

@section('extra_js')
    <script>
        const today = new Date();
        const eighteenYearsAgo = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
        document.getElementById('birth_date').setAttribute('max', eighteenYearsAgo.toISOString().split('T')[0]);
    </script>
@endsection
