@extends('layouts.auth')

@section('title', 'Lupa Kata Sandi')

@section('header', 'Lupa Kata Sandi')

@section('content')
    <p class="text-center mb-4">Masukkan alamat email Anda untuk menerima tautan reset kata sandi.</p>
    @if (session()->has('status'))
    <div class="alert alert-success">
        {{ session()->get('status') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li><strong>{{ $error }}</strong></li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="mb-3">
            <input type="email" id="email" name="email" class="form-control" placeholder="Alamat Email" value="{{ old('email') }}" required autofocus>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Kirim Tautan Reset Kata Sandi</button>
        </div>
    </form>
    <div class="text-center mt-3">
        <a href="{{ route('login') }}">Kembali ke Halaman Login</a>
    </div>
@endsection
