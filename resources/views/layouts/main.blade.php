<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Default')</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <style>
            html * {
            font-family: Roboto !important;
            }
            .nav-hover:hover {
                background-color: #004878;
                color: white;
                border-radius: 9px;
            }
        </style>
        <!-- Favicon -->
        <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">
    </head>
    <body class="d-flex flex-column min-vh-100" id="page-top">
        <!-- Include Navbar -->
        @include('layouts.main-partials.navbar')

        <!-- Content -->
        @yield('content')

        <!-- Include Footer -->
        @include('layouts.main-partials.footer')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>