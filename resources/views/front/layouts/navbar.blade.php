<style>
#teks-hitam {
  display: none;
}
.navbar-first {
    /* background-color: rgba(247, 247, 247, 0.3); */
    /* background-color: hsla(0, 0%, 0%, .3); */
    /* backdrop-filter: blur(25px); */
    color: #012970 !important;
}

@media (max-width: 991px) { 
    .sidebar {
      /* background-color: rgba(203, 203, 203, 0.3) !important; */
      background-color: #fff !important;
      backdrop-filter: blur(10px);
    }
}
</style>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top">
  <nav class="navbar navbar-first navbar-expand-lg navbar-index">
    <div class="container">
      <a href="{{ route('front.home') }}" class="logo d-flex align-items-center">
        <img src="{{ asset('front-assets/img/logo/logo-hitam.svg') }}" alt="logo" width="80%">
      </a>   
      <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="sidebar offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header text-white border-bottom">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">BeioN</h5>
          <button type="button" class="btn-close btn-close-dark shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column flex-lg-row p-lg-0 p-4">
          <ul class="navbar-nav justify-content-center align-items-center flex-grow-1 pe-3">
            <li class="nav-item mx-2">
              <a class="nav-link {{ request()->routeIs('front.home') ? 'active' : '' }}" href="{{ route('front.home') }}" style="color: rgba(3,18,26,1.00) !important">Home</a>
            </li>
            @guest
            <li class="nav-item mx-2 dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: rgba(3,18,26,1.00) !important">
                Jadi Mitra
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('mitra.login') }}">Login</a></li>
                <li><a class="dropdown-item" href="{{ route('mitra.register') }}">Daftar Jadi Mitra</a></li>
              </ul>
            </li>
            @endguest
            <li class="nav-item mx-2">
              <a class="nav-link" style="color: rgba(3,18,26,1.00) !important">Artikel</a>
            </li>
            <li class="nav-item mx-2">
              <a class="nav-link" style="color: rgba(3,18,26,1.00) !important">Guide Ai</a>
            </li>
            <li class="nav-item mx-2">
              <a class="nav-link {{ request()->routeIs('front.help') ? 'active' : '' }}" href="{{ route('front.help') }}" style="color: rgba(3,18,26,1.00) !important">Help</a>
            </li>
          </ul>
          @guest
            <div class="d-flex flex-lg-row flex-column justify-content-center align-items-center gap-3">
              <a class="getsignup" href="{{ route('account.login') }}">Masuk | Daftar</a>
              {{-- <a href="{{ route('account.login') }}" style="color: rgba(3,18,26,1.00) !important">Login</a>
              <a class="getsignup" href="{{ route('account.register') }}">Sign Up</a> --}}
            </div>
          @endguest
          @auth
            <div class="d-flex flex-lg-row flex-column justify-content-center align-items-center gap-3">
              <a href="{{ route('user.order') }}">
                <img src="{{ asset('front-assets/img/male.png') }}" alt="Profile" width="40" class="rounded-circle">
              </a>
            </div>
          @endauth
          </div>
        </div>
      </div>
    </nav>
  </header>
<!-- End Header -->