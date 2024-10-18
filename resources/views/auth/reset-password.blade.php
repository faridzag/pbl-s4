@extends('layouts.auth')

@section('title', 'Reset Password')

@section('header', 'Reset Password untuk Login')

@section('content')
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li><strong>{{ $error }}</strong></li>
            @endforeach
        </ul>
    </div>
    @endif
    <form id="resetPasswordForm" action="{{ route('password.update') }}" method="POST">
        @csrf
        <div class="mb-3">
            <input type="hidden" value="{{$token}}" id="token" name="token">
        </div>
        <div class="mb-3">
            <input class="form-control" type="email" value="{{ old('email')}}" id="email" name="email" placeholder="Email" minlength="6" maxlength="100">
        </div>
        <div class="mb-3">
            <input class="form-control" type="password" id="password" name="password" placeholder="Kata Sandi" minlength="8" maxlength="16">
        </div>
        <div class="mb-3">
            <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" minlength="8" maxlength="16">
        </div>
        <div class="d-grid">
            <button name="submit" class="btn btn-primary" type="submit">Konfirmasi</button>
        </div>
    </form>
@endsection
