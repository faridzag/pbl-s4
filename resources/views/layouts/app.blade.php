<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="top-bar">
    <img src="{{ asset('images/logo-poliwangi.png')}}" alt="logo-poliwangi" class="logo">
    <div class="dashboard-title">@yield('title')</div>
</div>

<div class="sidebar">
    <a href="{{ route('dashboard') }}">Dasbor</a>
    <a href="">Profil</a>
    <a href="{{ route('add-company') }}">Tambah Perusahaan</a>
    <a href="">Pengaturan</a>
    <a href="{{ route('logout') }}">Keluar</a>
</div>

<div class="content">
    @yield('content')
    <!-- Isi konten spesifik dari halaman fitur lain -->
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
