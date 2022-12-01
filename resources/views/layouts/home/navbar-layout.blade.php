<header id="home" class="header">
    <div class="header-wrapper">
        <div class="header-top theme-bg">
            <div class="container text-center">
                <div class="row justify-content-between">
                    <div class="col-md-2">
                        <a class="navbar-brand">
                            <img src="{{ asset('/images/logosipenata.png') }}">
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('loginForm') }}" class="btn btn-primary btn-block center-block">Login</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand">
                                <img src="{{ asset('/images/logo_krasem.png') }}" alt="" width="65" height="65" class="d-inline-block align-top">
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ml-auto">
                                    <li class="nav-item">
                                        <a class="page-scroll text-decoration-none" id="menu-home" href="{{ route('landing_page') }}">Beranda</a>
                                    </li>
                                    <li class="nav-item" id="berita">
                                        <a class="text-decoration-none" id="menu-tentang" href="#tentang">Tentang</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="text-decoration-none" id="menu-dasarhukum" href="{{ route('dasarhukum') }}">Dasar Hukum</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="text-decoration-none" id="menu-zoneplan" href="{{ route('zone_plan') }}">Zone Plan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="text-decoration-none" id="menu-datamenara" href="{{ route('data_menara') }}">Data Menara</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>