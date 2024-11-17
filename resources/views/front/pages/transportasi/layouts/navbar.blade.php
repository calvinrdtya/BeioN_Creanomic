<!-- ======= Header ======= -->
<header id="header" class="header fixed-top">
  <!-- Navbar -->
  <nav class="navbar navbar-first navbar-expand-lg navbar-index">
    <div class="container">
      <!-- Logo Navbar -->
      {{-- <a class="navbar-brand fs-4" href="#">BeioN</a> --}}
      <a href="{{ route('front.home') }}" class="logo d-flex align-items-center">
        <img src="{{ asset('front-assets/img/logo/logo-hitam.svg') }}" alt="logo" class="text-logo" width="80">
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
              <div class="card p-1 rounded-pill card-group-homestay">
                <div class="input-group align-items-center rounded-3">
                    <div class="nav-item dropdown position-relative">
                        <select id="city" class="form-select form-md rounded-5 border-0" style="width: 120px; box-shadow: none !important; cursor: pointer;">
                        <option value="">Pilih Kota</option>
                        <option value="surabaya">Surabaya</option>
                        <option value="malang">Malang</option>
                        <option value="banyuwangi">Banyuwangi</option>
                        <option value="pasuruan">Pasuruan</option>
                        </select>
                    </div>
                <div style="border-left: 1px solid #bfbfbf; height: 27px; margin: 0 10px;"></div>
                <input type="text" class="form-control form-md border-0" id="tgl_mulai" placeholder="Pinjam" readonly aria-label="Tanggal Pinjam" style="cursor: pointer; width: 120px; box-shadow: none !important;">
                <span class="badge bg-first rounded-2" style="background-color: #4154f1; color: white; margin: 0 10px;">0 Hari</span>
                <input type="text" class="form-control form-md border-0" id="tgl_selesai" placeholder="Pengembalian" readonly aria-label="Tanggal Pengembalian" style="cursor: pointer; width: 120px; box-shadow: none !important;">
                <div style="border-left: 1px solid #bfbfbf; height: 27px; margin: 0 10px;"></div>
                    <div class="nav-item dropdown position-relative">
                        <select id="kendaraan" class="form-select form-md rounded-5 border-0" style="width: 120px; box-shadow: none !important; cursor: pointer;">
                        <option value="">Tipe</option>
                        <option value="motor">Motor</option>
                        <option value="mobil">Mobil</option>
                        </select>
                    </div>
                </div>
            </div>
          </ul>
          <!-- Login / Sign Up -->
          @guest
            <div class="d-flex flex-lg-row flex-column justify-content-center align-items-center gap-3">
              {{-- <a href="" style="color: rgb(67, 67, 67) !important">Login</a> --}}
              <a href="{{ route('account.login') }}" class="getsignup">Masuk | Daftar</a>
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