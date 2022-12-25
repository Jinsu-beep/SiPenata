<header id="header" class="fixed-top d-flex align-items-center ">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <a class="navbar-brand">
            <img src="{{ asset('/images/logosipenata.png') }}">
        </a>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
            <li><a class="nav-link scrollto " id="beranda" href="{{ route('home') }}">Beranda</a></li>
            <li><a class="nav-link scrollto" id="dasarHukum" href="{{ route('dasarhukum') }}">Dasar Hukum</a></li>
            <li><a class="nav-link scrollto" id="zonePlan" href="{{ route('zone_plan') }}">Zone Plan</a></li>
            <li><a class="nav-link scrollto" id="dataMenara" href="{{ route('data_menara') }}">Data Menara</a></li>
            <li><a class="scrollto" href="{{ route('loginForm') }}">Login</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
      <!-- .navbar -->

    </div>
  </header>