<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    </head>
    <body>
        <div class="container">
            <div class="login-container">
                <img src="{{ asset('admin/img/logo-poliwangi.png')}}" alt="logo-poliwangi">
                @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
                @endif
                <h1>Selamat Datang Kembali!</h1>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <input type="text" value="{{ old('login') }}" id="login" name="login" class="form-control" placeholder="Email / Nama Pengguna" required autofocus>
                    <input type="password" id="password" name="password" placeholder="Kata Sandi" required />
                    <button name="submit" type="submit">Masuk</button>
                </form>
                <a href="">Lupa kata sandi?</a>
                <a href="{{ route('register') }}">Tidak punya akun? Buat akun</a>
            </div>
        </div>
    </body>
</html>
