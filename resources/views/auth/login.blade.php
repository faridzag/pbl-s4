<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #004878;
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Roboto', sans-serif;
        }
        .login-container {
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 500px;
            width: 100%;
            margin: 2rem auto;
        }
        .btn-primary {
            background-color: #004878;
            border-color: #004878;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            color: #004878;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="login-container">
                    <div class="text-center mb-4">
                        <img src="{{ asset('img/logo-poliwangi.png')}}" alt="logo-poliwangi" class="img-fluid" style="max-width: 120px;">
                    </div>
                    @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                    @endif
                    <h1 class="text-center h4 mb-4">Selamat Datang Kembali!</h1>
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
                            <input type="password" id="password" name="password" class="form-control" placeholder="Kata Sandi" minlength="8" maxlength="16">
                        </div>
                        <div class="d-grid">
                            <button name="submit" type="submit" class="btn btn-primary">Masuk</button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <a href="" class="d-block mb-2">Lupa kata sandi?</a>
                        <a href="{{ route('register') }}" class="d-block">Tidak punya akun? Buat akun</a>
                    </div>
                </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
