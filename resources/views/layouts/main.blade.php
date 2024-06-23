<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .nav-hover:hover {
            background-color: #004878;
            color: white;
            border-radius: 9px;
        }
    </style>
    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">
</head>
<body>
    <!-- Include Navbar -->
    @include('layouts.main-partials.navbar')

    <!-- Content -->
    @yield('content')

    <!-- Include Footer -->
    @include('layouts.main-partials.footer')
</body>
</html>