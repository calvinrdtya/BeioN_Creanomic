<!-- ======= Header ======= -->
<header id="header" class="header fixed-top">
  <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="" class="d-flex align-items-center" style="height: 50px;">
          <img src="https://ibb.co.com/6PYf7j2" alt="" width="100">
      </a>
      <nav id="navbar" class="navbar flex-grow-1 d-flex justify-content-center">
          <ul class="d-flex align-items-center">
              <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
              <li class="dropdown">
                  <a href="#"><span>Mitra</span> <i class='bx bx-sm bx-chevron-down'></i></a>
                  <ul>
                      <li><a href="{{ route('mitra.login') }}">Login</a></li>
                      <li><a href="{{ route('mitra.register') }}">Daftar Mitra</a></li>
                  </ul>
              </li>
              <li class="dropdown">
                  <a href="#"><span>Page</span> <i class='bx bx-sm bx-chevron-down'></i></a>
                  <ul>
                      <li><a href="{{ route('transportasi') }}">Transportasi</a></li>
                  </ul>
              </li>
              <li class="dropdown">
                  <a href="#"><span>User</span> <i class='bx bx-sm bx-chevron-down'></i></a>
                  <ul>
                      <li><a href="{{ route('account.login') }}">Login</a></li>
                      <li><a href="{{ route('account.logout') }}">Logout</a></li>
                  </ul>
              </li>
              <li><a class="nav-link scrollto" href="">Kupon & Promo</a></li>
              <li><a class="nav-link scrollto" href="">Paket Wisata</a></li>
          </ul>
      </nav>
      <a class="btn btn-primary getstarted" href="#about">Login</a>
      <i class="bi bi-list mobile-nav-toggle"></i>
  </div>
</header>
<!-- End Header -->
