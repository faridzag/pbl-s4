<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
        <title>Registrasi</title>
        <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    </head>
    <body>
        <div class="container">
            <div class="form-container">
                <header>
                    <img src="{{ asset('admin/img/logo-poliwangi.png') }}" alt="Logo Poliwangi">
                </header>
                <h1>Buat Sebuah Akun</h1>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li><strong>{{ $error }}</strong></li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{ route('register') }}" method="POST" onsubmit="return confirm('Yakin untuk melanjutkan? Klik OK untuk membuat akun.')">
                    @csrf
                    <div class="input-group">
                        <input type="text" value="{{ old('id_number')}}" id="id_number" name="id_number" placeholder="NIK" required maxlength="16" minlength="16" inputmode="numeric">
                    </div>
                    <div class="input-group">
                        <input type="text" value="{{ old('full_name')}}" id="full_name" name="full_name" placeholder="Nama Lengkap" required minlength="6" maxlength="100">
                    </div>
                    <div class="input-group">
                        <input type="email" value="{{ old('email')}}" id="email" name="email" placeholder="Email" required minlength="6" maxlength="100">
                    </div>
                    <div class="input-group">
                        <input placeholder="Tanggal Lahir" value="{{ old('birth_date')}}" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="birth_date" name="birth_date" required/>
                        <select id="gender" name="gender" required>
                            <option value="" disabled selected>Jenis Kelamin ▼ </option>
                            <option value="pria" {{ old('gender') === 'pria' ? 'selected' : '' }}>Pria</option>
                            <option value="wanita" {{ old('gender') === 'wanita' ? 'selected' : '' }}>Wanita</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <input type="tel" value="{{ old('phone_number')}}" id="phone_number" name="phone_number" pattern="(\+62|62|0)8[0-9]{8,11}" placeholder="No telepon" required minlength="10" maxlength="13">
                    </div>
                    <div class="input-group">
                        <input type="text" value="{{ old('username')}}" id="username" name="username" placeholder="Nama Pengguna" required minlength="6" maxlength="25">
                    </div>
                    <div class="input-group">
                        <input type="password" id="password" name="password" placeholder="Kata Sandi" required minlength="8" maxlength="50">
                    </div>
                    <div class="input-group">
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" required minlength="8" maxlength="50">
                    </div>
                    <div class="input-group">
                        <button name="submit" type="submit">Daftar</button>
                    </div>
                </form>
                <p>Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
            </div>
        </div>
        <script>
            const today = new Date();
            const eighteenYearsAgo = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
            document.getElementById('birth_date').setAttribute('max', eighteenYearsAgo.toISOString().split('T')[0]);
        </script>
    </body>
</html>
