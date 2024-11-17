<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="">
      <i class="bx bx-menu bx-sm"></i>
    </a>
  </div>
  <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    <!-- Search -->
    <div class="navbar-nav align-items-center">
      <div class="nav-item d-flex align-items-center">
        <li class="nav-item lh-1 me-3">
          @if(Auth::guard('mitra')->check())
            <span class="demo menu-text fw-bolder ms-2">
              {{ Auth::guard('mitra')->user()->name }}
            </span>
          @else
            <span class="demo menu-text fw-bolder ms-2">MITRA</span>
          @endif
        </li>
      </div>
    </div>
    <!-- /Search -->

    <ul class="navbar-nav flex-row align-items-center ms-auto">
      <!-- User -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow" href="" data-bs-toggle="dropdown">
          <div class="avatar avatar-online">
            <img src="{{ asset('front-assets/img/male.png') }}" alt class="w-px-40 h-auto rounded-circle">
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item" href="#">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar avatar-online">
                    <img src="{{ asset('front-assets/img/male.png') }}" alt class="w-px-40 h-auto rounded-circle">
                  </div>
                </div>
                <div class="flex-grow-1">
                  <span class="fw-semibold d-block">Mitra</span>
                  @if(Auth::guard('mitra')->check())
                    <small class="text-muted">{{ Auth::guard('mitra')->user()->role }}</small>
                  @else
                    <small class="text-muted">Admin</small>
                  @endif
                </div>
              </div>
            </a>
          </li>
          {{-- <li>
            <div class="dropdown-divider"></div>
          </li> --}}
          {{-- <li>
            <a class="dropdown-item" href="#">
              <i class="bx bx-user me-2"></i>
              <span class="align-middle">My Profile</span>
            </a>
          </li> --}}
          {{-- <li>
            <a class="dropdown-item" href="#">
              <i class="bx bx-cog me-2"></i>
              <span class="align-middle">Settings</span>
            </a>
          </li> --}}
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <a href="{{ route('mitra.logout') }}" class="dropdown-item" href="auth-login-basic.html">
              <i class="bx bx-power-off me-2"></i>
              <span class="align-middle">Log Out</span>
            </a>
          </li>
        </ul>
      </li>
      <!--/ User -->
    </ul>
  </div>