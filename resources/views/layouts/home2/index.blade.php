<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="images/logo_krasem.png" rel="icon">
    @yield('title')

    <link href="landing2/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="landing2/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="landing2/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">

    <!-- Template Main CSS File -->
    <link href="landing2/css/style.css" rel="stylesheet">

    @stack('css')
</head>

<body>
    <header>
        <a href="{{ route('home') }}" class="logo"><img src="{{ asset('/images/logosipenata.png') }}"
                alt=""></a>
        <div class="bx bx-menu" id="menu-icon"></div>

        <ul class="navbar">
            <li><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
            <li><a class="nav-link" href="{{ route('dasarhukum') }}">Dasar Hukum</a></li>
            <li><a class="nav-link" href="{{ route('zone_plan') }}">Zone Plan</a></li>
            <li><a class="nav-link" href="{{ route('data_menara') }}">Data Menara</a></li>
            <li><a class="nav-link" href="{{ route('loginForm') }}">Login</a></li>
        </ul>
    </header>

    <main id="main">

        @yield('content')

    </main>

    <script src="landing2/js/main.js"></script>
    <script src="landing2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    @stack('js')
</body>

</html>
