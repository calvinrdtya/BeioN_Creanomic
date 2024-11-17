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
            <img src="{{ asset('front-assets/img/logo/logo-hitam.svg') }}" alt="logo" width="90%">
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
                <li class="nav-item mx-2">
                  <a class="nav-link" href="{{ route('front.home') }}" style="color: rgb(67, 67, 67); !mportant">Home</a>
                </li>
                @guest
                <li class="nav-item mx-2 dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: rgb(67, 67, 67); !mportant">
                    Jadi Mitra
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('mitra.login') }}" style="color: rgb(67, 67, 67); !mportant">Login</a></li>
                    <li><a class="dropdown-item" href="{{ route('mitra.register') }}" style="color: rgb(67, 67, 67); !mportant">Daftar Jadi Mitra</a></li>
                  </ul>
                </li>
                @endguest
                <li class="nav-item mx-2">
                  <a class="nav-link" href="#" style="color: rgb(67, 67, 67); !mportant">Panduan Perjalanan</a>
                </li>
                <li class="nav-item mx-2">
                  <a class="nav-link" href="{{ route('front.help') }}" style="color: rgb(67, 67, 67); !mportant">Help</a>
                </li>
              </ul>
              <!-- Login / Sign Up -->
                @guest
                    <div class="d-flex flex-lg-row flex-column justify-content-center align-items-center gap-3">
                        <a href="{{ route('account.login') }}" style="color: rgb(67, 67, 67); !mportant">Login</a>
                        <a class="getsignup" href="{{ route('account.register') }}">Sign Up</a>
                    </div>
                @endguest
                @auth
                    <div class="d-flex flex-lg-row flex-column justify-content-center align-items-center gap-3">
                        <a class="nav-link" href="">{{ auth()->user()->role }}</a>
                        <a class="nav-link" href="{{ route('account.logout') }}">Logout</a>
                    </div>
                    <div class="d-flex flex-lg-row flex-column justify-content-center align-items-center gap-3">
                        <a href="{{ route('front.cart') }}" class="text-dark">
                        <i class="fas fa-shopping-cart"></i>
                            {{ $totalCart ?? 0 }}
                        </a>
                    </div>
                @endauth
                
              </div>
            </div>
          </div>
        </nav>
      </header>
    <!-- End Header -->
    