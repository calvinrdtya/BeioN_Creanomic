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
        /* background-color: rgba(225, 225, 225, 0.15) !important;
        backdrop-filter: blur(10px); */
      }
  }
  </style>
  
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <nav class="navbar navbar-first navbar-expand-lg navbar-index">
      <div class="container">
        <a href="{{ route('front.home') }}" class="logo">
          <img src="{{ asset('front-assets/img/logo/logo.svg') }}" alt="logo" id="logo-stuck" width="90%">
        </a>
        <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="sidebar offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header text-white border-bottom">
            <img src="{{ asset('front-assets/img/logo/logo.svg') }}" alt="logo" id="logo-stuck offcanvas-title" width="30%">
            <button type="button" class="btn-close btn-close-dark shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body d-flex flex-column flex-lg-row p-lg-0 p-4">
            <ul class="navbar-nav justify-content-center align-items-center flex-grow-1 pe-3">
              <li class="nav-item mx-2">
                <a class="nav-link" href="{{ route('front.home') }}">Home</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link" href="{{ route('front.ecotourism') }}">Eco Tourism</a>
              </li>
              @guest
              <li class="nav-item mx-2">
                <a class="nav-link" href="{{ route('mitra.login') }}">Jadi Mitra</a>
              </li>
              @endguest
              <li class="nav-item mx-2">
                <a class="nav-link" href="{{ route('front.artikel.index') }}">Artikel</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link" href="{{ route('user.chat') }}">Guide AI</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link" href="{{ route('front.help') }}">Help</a>
              </li>
            </ul>
            @guest
             <div class="d-flex flex-lg-row flex-column justify-content-center align-items-center gap-3">
              {{-- <a href="{{ route('account.login') }}">Login</a> --}}
              <a class="getsignup" href="{{ route('account.login') }}">Masuk | Daftar</a>
             </div>
             @endguest
             @auth
              <div class="d-flex flex-lg-row flex-column justify-content-center align-items-center gap-3">
                <a href="{{ route('user.order') }}">
                  <img src="{{ asset('front-assets/img/male.png') }}" alt="Profile" width="40" class="rounded-circle">
                </a>
                {{-- <a class="nav-link" href="{{ route('front.user.checkout') }}">Pesanan</a>
                <a class="nav-link" href="">{{ auth()->user()->role }}</a> --}}
                {{-- <a class="nav-link" href="{{ route('account.logout') }}">Logout</a>  --}}
              </div>
            @endauth
            </div>
          </div>
        </div>
      </nav>
    </header>
  <!-- End Header -->