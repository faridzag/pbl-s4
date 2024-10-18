@extends('layouts.auth')

@section('title', 'Login')

@section('header', 'Selamat Datang Kembali!')

@section('content')
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    @if (session()->has('status'))
    <div class="alert alert-success">
        {{ session()->get('status') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="mb-3">
            <input type="text" value="{{ old('login') }}" id="login" name="login" class="form-control" placeholder="Email / Nama Pengguna" autofocus>
        </div>
        <div class="mb-3">
            <input type="password" id="password" name="password" class="form-control" placeholder="Kata Sandi">
        </div>
        <div class="d-grid">
            <button name="submit" type="submit" class="btn btn-primary">Masuk</button>
        </div>
    </form>
    <div class="text-center mt-3">
        <a href="{{ route('password.request') }}" class="d-block mb-2">Lupa kata sandi?</a>
        <a href="{{ route('register') }}" class="d-block">Tidak punya akun? Buat akun</a>
    </div>
@endsection
