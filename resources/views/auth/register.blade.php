<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
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
        .register-container {
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
        <div class="register-container">
            <div class="text-center mb-4">
                <img src="{{ asset('img/logo-poliwangi.png') }}" alt="Logo Poliwangi" class="img-fluid" style="max-width: 120px;">
            </div>
            <h1 class="text-center h4 mb-4">Buat Sebuah Akun</h1>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li><strong>{{ $error }}</strong></li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form id="registerForm" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input class="form-control" type="text" value="{{ old('id_number')}}" id="id_number" name="id_number" placeholder="NIK" maxlength="16" minlength="16" inputmode="numeric">
                </div>
                <div class="mb-3">
                    <input class="form-control" type="text" value="{{ old('name')}}" id="name" name="name" placeholder="Nama Lengkap" minlength="6" maxlength="50">
                </div>
                <div class="mb-3">
                    <input class="form-control" type="email" value="{{ old('email')}}" id="email" name="email" placeholder="Email" minlength="6" maxlength="100">
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <input class="form-control" placeholder="Tanggal Lahir" value="{{ old('birth_date')}}" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="birth_date" name="birth_date"/>
                    </div>
                    <div class="col-6">
                        <select class="form-select" id="gender" name="gender">
                            <option value="" disabled selected>Jenis Kelamin ▼ </option>
                            <option value="pria" {{ old('gender') === 'pria' ? 'selected' : '' }}>Pria</option>
                            <option value="wanita" {{ old('gender') === 'wanita' ? 'selected' : '' }}>Wanita</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <input class="form-control" type="tel" value="{{ old('phone_number')}}" id="phone_number" name="phone_number" placeholder="No telepon" minlength="10" maxlength="13">
                </div>
                <div class="mb-3">
                    <input class="form-control" type="text" value="{{ old('username')}}" id="username" name="username" placeholder="Nama Pengguna" minlength="6" maxlength="25">
                </div>
                <div class="mb-3">
                    <input class="form-control" type="password" id="password" name="password" placeholder="Kata Sandi" minlength="8" maxlength="16">
                </div>
                <div class="mb-3">
                    <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" minlength="8" maxlength="16">
                </div>
                <div class="d-grid">
                    <button name="submit" class="btn btn-primary" type="submit">Daftar</button>
                </div>
            </form>
            <p class="text-center mt-3">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        const today = new Date();
        const eighteenYearsAgo = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
        document.getElementById('birth_date').setAttribute('max', eighteenYearsAgo.toISOString().split('T')[0]);
    </script>
</body>
</html>
