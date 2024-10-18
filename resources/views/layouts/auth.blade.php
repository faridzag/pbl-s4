<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Job Fair Poliwangi</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">
    <style>
        body {
            background-color: #004878;
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Roboto', sans-serif;
        }
        .auth-container {
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
    @yield('extra_css')
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="auth-container">
            <div class="text-center mb-4">
                <img src="{{ asset('img/logo-poliwangi.png') }}" alt="Logo Poliwangi" class="img-fluid" style="max-width: 100px;">
            </div>
            <h1 class="text-center h4 mb-4">@yield('header')</h1>
            @yield('content')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @yield('extra_js')
</body>
</html>
