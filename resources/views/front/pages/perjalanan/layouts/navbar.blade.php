<style>
  @media (max-width: 991px) { 
    .sidebar {
      background-color: rgba(203, 203, 203, 0.3) !important;
      /* background-color: rgba(225, 225, 225, 0.15) !important; */
      backdrop-filter: blur(10px);
    }
}
</style>

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
        background-color: rgba(225, 225, 225, 0.15) !important;
        backdrop-filter: blur(10px);
      }
  }
  </style>
  
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <!-- Navbar -->
    <nav class="navbar navbar-first navbar-expand-lg navbar-index">
      <div class="container">
        <!-- Logo Navbar -->
        {{-- <a class="navbar-brand fs-4" href="#">BeioN</a> --}}
        <a href="{{ route('front.home') }}" class="logo d-flex align-items-center">
          <img src="{{ asset('front-assets/img/logo/logo.svg') }}" alt="logo" class="text-logo" width="80">
        </a>   
          <!-- Toggle Button -->
        <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Sidebar Nav -->
        <div class="sidebar offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <!-- Sidebar Header -->
          <div class="offcanvas-header text-white border-bottom">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">BeioN</h5>
            <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <!-- Sidebar Body -->
          <div class="offcanvas-body d-flex flex-column flex-lg-row p-lg-0 p-4">
            <ul class="navbar-nav justify-content-center align-items-center flex-grow-1 pe-3">
              <div class="card shadow-sm rounded-pill card-group-perjalanan">
                <div class="input-group align-items-center rounded-3">
                  <div class="nav-item dropdown position-relative">
                    <input type="text" class="form-control rounded-4 border-0 nav-group-transportasi w-100" id="idSearch" placeholder="Pilih Kota" readonly aria-label="Pilih Kota" style="cursor: pointer; max-width: 250px;">
                    <ul class="dropdown-menu mt-2 w-auto" aria-labelledby="searchInput" style="max-height: 300px; overflow-y: auto; overflow-x: hidden;">
                      <div class="row g-2 p-2 flex-wrap">
                        <div class="col-12 col-md-6">
                          <p class="title-city ms-2 m-0">Pilih Kota</p>
                          <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                              <i class="fas fa-map-marker-alt me-3"></i>
                              <div>
                                <span>Surabaya</span>
                                <span>(50)</span>
                              </div>
                            </a>
                          </li>
                        </div>
                        <div class="col-12 col-md-6">
                          <p class="title-city ms-2 m-0">Pilih Kota</p>
                          <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                              <i class="fas fa-map-marker-alt me-3"></i>
                              <div>
                                <span>Surabaya</span>
                                <span>(50)</span>
                              </div>
                            </a>
                          </li>
                        </div>
                      </div>
                    </ul>
                  </div>
                <div style="border-left: 1px solid #bfbfbf; height: 27px; margin: 0 10px;"></div>
                    <div class="nav-item dropdown position-relative">
                        <select id="kendaraan" class="form-select form-md rounded-5 border-0" style="width: 250px; box-shadow: none !important; cursor: pointer;">
                          <option value="">Pilih Destinasi/Aktifitas</option>
                          <option value="surabaya">Surabaya</option>
                          <option value="malang">Malang</option>
                          <option value="banyuwangi">Banyuwangi</option>
                          <option value="pasuruan">Pasuruan</option>
                        </select>
                    </div>
                </div>
            </div>
          </ul>
            <!-- Login / Sign Up -->
            @guest
              <div class="d-flex flex-lg-row flex-column justify-content-center align-items-center gap-3">
                  {{-- <a href="{{ route('account.login') }}">Login</a> --}}
                  <a class="getsignup" href="{{ route('account.login') }}">Masuk | Daftar</a>
                {{-- <a href="{{ route('account.login') }}" style="color: #4154f1">Login</a>
                <a class="getsignup" href="{{ route('account.register') }}">Sign Up</a> --}}
              </div>
            @endguest
            @auth
              <div class="d-flex flex-lg-row flex-column justify-content-center align-items-center gap-3">
                <a href="{{ route('user.order') }}">
                  <img src="{{ asset('front-assets/img/male.png') }}" alt="Profile" width="40" class="rounded-circle">
                </a>
                {{-- <a class="nav-link" href="{{ route('front.user.checkout') }}">Pesanan</a>
                <a class="nav-link" href="">{{ auth()->user()->role }}</a> --}}
                <a class="nav-link" href="{{ route('account.logout') }}">Logout</a> 
              </div>
            @endauth
            </div>
          </div>
        </div>
      </nav>
    </header>
  <!-- End Header -->