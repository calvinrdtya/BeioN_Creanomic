<!-- Start nav -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light scrolled awake" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.html">
            <img src="{{ asset('front-assets/img/logo/Logo.svg') }}" alt="" class="img-fluid" width="90">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto align-items-center">
                <li class="nav-item active"><a href="{{ route('front.home') }}" class="nav-link">Home</a></li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Jadi Mitra
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('mitra.login') }}">Login</a>
                        <a class="dropdown-item" href="{{ route('mitra.register') }}">Daftar</a>
                    </div>
                </li>
                <li class="nav-item"><a href="{{ route('front.ecotourism') }}" class="nav-link">Ecotourism</a></li>
                <li class="nav-item"><a href="{{ route('user.chat') }}" class="nav-link">Guide AI</a></li>
                <li class="nav-item"><a href="{{ route('front.artikel.index') }}" class="nav-link">Artikel</a></li>
                <li class="nav-item"><a href="{{ route('front.help') }}" class="nav-link">Help</a></li>
                @guest
                    <li class="nav-item d-flex justify-content-center align-items-center">
                        <a href="#" class="nav-link btn btn-login border-0 px-2 mr-2"><i
                                class="mr-2 fas fa-user"></i>Login</a>
                    </li>
                    <li class="nav-item d-flex justify-content-center align-items-center">
                        <a href="#" class="nav-link btn btn-register border-0 px-2 mr-2">Daftar</a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item">
                        <a href="{{ route('user.order') }}" class="nav-link">
                            <img src="{{ asset('front-assets/img/male.png') }}" alt="Profile" width="40"
                                class="rounded-circle">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('account.logout') }}" class="nav-link">Logout</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<!-- End nav -->
