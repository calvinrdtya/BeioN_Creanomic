<div class="app-brand demo">
  <a href="index.html" class="app-brand-link">
    {{-- <span class="app-brand-logo demo"></span> --}}
      <span class="app-brand-text demo menu-text fw-bolder ms-2">{{ Auth::guard('admin')->user()->name }}</span>
    </a>
    <a href="" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>
  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <a href="{{ route('admin.dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard</div>
      </a>
    </li>

    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Artikel</span>
    </li>

    {{-- Perjalanan --}}
    <li class="menu-item {{ request()->routeIs('admin.kategori') ? 'active' : '' }}">
      <a href="{{ route('admin.kategori') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-copy"></i>
        <div data-i18n="Analytics">Kategori</div>
      </a>
    </li>
    <li class="menu-item {{ request()->routeIs('admin.artikel', 'admin.artikel.create') ? 'active' : '' }}">
      <a href="{{ route('admin.artikel') }}" class="menu-link">
        <i class='menu-icon tf-icons bx bx-file'></i>
        <div data-i18n="Analytics">Artikel</div>
      </a>
    </li>
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Pages</span>
    </li>

    {{-- Perjalanan --}}
    <li class="menu-item {{ request()->routeIs('admin.mitra.perjalanan', 'admin.mitra.perjalanan.detail') ? 'active' : '' }}">
      <a href="{{ route('admin.mitra.perjalanan') }}" class="menu-link">
        <i class="menu-icon bx bx-map-pin"></i>
        <div data-i18n="Analytics">Perjalanan</div>
      </a>
    </li>
  
    {{-- Perjalanan End --}}

    {{-- Transportasi --}}
    <li class="menu-item">
      <a class="menu-link menu-toggle cursor-pointer">
        <i class="menu-icon bx bx-car"></i>
        <div data-i18n="Account Settings">Kendaraan</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('admin.mitra.transportasi.motor') ? 'active' : '' }}">
          <a href="{{ route('admin.mitra.transportasi.motor') }}" class="menu-link">
            <div data-i18n="Account">Motor</div>
          </a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.mitra.transportasi.mobil') ? 'active' : '' }}">
          <a href="{{ route('admin.mitra.transportasi.mobil') }}" class="menu-link">
            <div data-i18n="Notifications">Mobil</div>
          </a>
        </li>
      </ul>
    </li>
    {{-- <li class="menu-item {{ request()->routeIs('admin.mitra.transportasi') ? 'active' : '' }}">
      <a href="{{ route('admin.mitra.transportasi') }}" class="menu-link">
        <i class="menu-icon bx bx-notepad"></i>
        <div data-i18n="Notifications">Transportasi</div>
      </a>
    </li> --}}
    {{-- Transportasi End --}}

    {{-- Homestay --}}
    <li class="menu-item {{ request()->routeIs('admin.mitra.homestay') ? 'active' : '' }}">
      <a href="{{ route('admin.mitra.homestay') }}" class="menu-link">
        <i class="menu-icon bx bx-home"></i>
        <div data-i18n="Notifications">Homestay</div>
      </a>
    </li>
    {{-- Homestay End --}}

    {{-- Perlengkapan --}}
    <li class="menu-item {{ request()->routeIs('admin.mitra.perlengkapan') ? 'active' : '' }}">
      <a href="{{ route('admin.mitra.perlengkapan') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-briefcase"></i>
        <div data-i18n="Notifications">Perlengkapan</div>
      </a>
    </li>
    {{-- Perlengkapan End --}}


    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Semua</span>
    </li>
    {{-- Setting Mitra --}}
  <li class="menu-item">
    <a class="menu-link menu-toggle cursor-pointer">
      <i class="menu-icon bx bx-cog"></i>
      <div data-i18n="Account Settings">Pengaturan</div>
    </a>
    <ul class="menu-sub">
      <li class="menu-item">
        <a href="" class="menu-link">
          <div data-i18n="Notifications">Akun</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="" class="menu-link">
          <div data-i18n="Account">Biodata</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="" class="menu-link">
          <div data-i18n="Account">Web App</div>
        </a>
      </li>
    </ul>
  </li>
    <li class="menu-item">
      <a href="" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
        <div data-i18n="Authentications">Lainnya</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="auth-login-basic.html" class="menu-link" target="_blank">
            <div data-i18n="Basic">Akun</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="auth-forgot-password-basic.html" class="menu-link" target="_blank">
            <div data-i18n="Basic">Ganti Password</div>
          </a>
        </li>
      </ul>
    </li>
  </ul>