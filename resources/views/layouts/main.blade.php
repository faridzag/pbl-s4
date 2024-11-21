<!DOCTYPE html>
<html lang="id">
    <head>
        <title>@yield('title') - {{ config('app.name', 'Job Fair Poliwangi') }}</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        @include('layouts.partials.links')
        <style>
            html * {
            /* font-family: Roboto !important; */
            }
            .nav-hover:hover {
                background-color: #004878;
                color: white;
                border-radius: 9px;
            }
        </style>
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
