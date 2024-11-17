<div class="app-brand demo">
  <a href="index.html" class="app-brand-link">
    <span class="app-brand-logo demo">
      <span class="app-brand-text demo menu-text fw-bolder ms-2">
        Mitra
      </span>
      {{-- @if(Auth::guard('mitra')->check())
        <span class="app-brand-text demo menu-text fw-bolder ms-2">
          {{ Auth::guard('mitra')->user()->name }}
        </span>
      @else
        <span class="app-brand-text demo menu-text fw-bolder ms-2">MITRA</span>
      @endif --}}
      {{-- <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <defs>
          <path d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"id="path-1"></path>
          <path d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z" id="path-3" ></path>
          <path d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z" id="path-4" ></path>
          <path d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"id="path-5"></path>
        </defs>
          <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
              <g id="Icon" transform="translate(27.000000, 15.000000)">
                <g id="Mask" transform="translate(0.000000, 8.000000)">
                  <mask id="mask-2" fill="white">
                    <use xlink:href="#path-1"></use>
                  </mask>
                  <use fill="#696cff" xlink:href="#path-1"></use>
                  <g id="Path-3" mask="url(#mask-2)">
                    <use fill="#696cff" xlink:href="#path-3"></use>
                    <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                  </g>
                  <g id="Path-4" mask="url(#mask-2)">
                    <use fill="#696cff" xlink:href="#path-4"></use>
                    <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                  </g>
                </g>
                <g id="Triangle" transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) ">
                  <use fill="#696cff" xlink:href="#path-5"></use>
                  <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                </g>
              </g>
            </g>
          </g>
        </svg> --}}
    </span>
    
  </a>
  <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
    <i class="bx bx-chevron-left bx-sm align-middle"></i>
  </a>
</div>

<div class="menu-inner-shadow"></div>

<ul class="menu-inner py-1">
  <!-- Dashboard -->
  <li class="menu-item {{ request()->routeIs('mitra.dashboard') ? 'active' : '' }}">
    <a href="{{ route('mitra.dashboard') }}" class="menu-link">
      <i class="menu-icon bx bx-home-circle"></i>
      <div data-i18n="Analytics">Dashboard</div>
    </a>
  </li>

  <li class="menu-header small text-uppercase">
    <span class="menu-header-text">Aksi</span>
  </li>

  {{-- Category --}}
  {{-- <li class="menu-item">
    <a href="" class="menu-link menu-toggle cursor-pointer">
      <i class="menu-icon bx bx-category"></i>
      <div>Category</div>
    </a>
    <ul class="menu-sub">
      <li class="menu-item">
        <a href="{{ route('categories.index') }}" class="menu-link">
  <div>Category</div>
  </a>
  </li>
  <li class="menu-item">
    <a href="{{ route('sub-categories.index') }}" class="menu-link">
      <div>Sub Category</div>
    </a>
  </li>
</ul>
</li> --}}

@if(Auth::guard('mitra')->check())
  @if(Session::get('jenis') !== 'homestay')
    <li class="menu-item {{ request()->routeIs('mitra.category', 'mitra.category.create') ? 'active' : '' }}">
      <a href="{{ route('mitra.category') }}" class="menu-link">
        {{-- <i class="menu-icon bx bx-copy"></i> --}}
        <div>Kategori</div>
      </a>
    </li>
  @endif

{{-- @if(Session::get('jenis') !== 'homestay')
  <li class="menu-item {{ request()->routeIs('categories.index') ? 'active' : '' }}">
<a href="javascript:void(0)" class="menu-link menu-toggle">
  <i class="menu-icon bx bx-copy"></i>
  <div data-i18n="Extended UI">Kategori</div>
</a>
<ul class="menu-sub">
  <li class="menu-item {{ request()->routeIs('categories.index') ? 'active' : '' }}">
    <a href="{{ route('categories.index') }}" class="menu-link">

  {{-- Paket Wisata --}}
  {{-- @if(Auth::guard('mitra')->check() && Session::get('jenis') === 'perjalanan')
  <li class="menu-item {{ request()->routeIs('mitra.perjalanan.index') ? 'active' : '' }}">
    <a href="{{ route('mitra.perjalanan.index') }}" class="menu-link">
      <i class="menu-icon bx bx-trip"></i>
      <div>Paket Wisata</div>
      <div data-i18n="Perfect Scrollbar">Motor</div>
    </a>
  </li>
  <li class="menu-item">
    <a href="{{ route('categories.index') }}" class="menu-link">
      <div data-i18n="Text Divider">Mobil</div>
    </a>
  </li>
</ul>
</li>
@endif --}}

{{-- Paket Wisata --}}
@if(Session::get('jenis') === 'perjalanan')
<li class="menu-item {{ request()->routeIs('mitra.perjalanan.index') ? 'active' : '' }}">
  <a href="{{ route('mitra.perjalanan.index') }}" class="menu-link">
    {{-- <i class="menu-icon bx bx-trip"></i> --}}
    <div>Paket Wisata</div>
  </a>
</li>
@endif


{{-- Transportasi Motor --}}
@if(Session::get('jenis') === 'transportasi motor')
  <li class="menu-item {{ request()->routeIs('mitra.motor', 'mitra.motor.detail') ? 'active' : '' }}">
    <a href="{{ route('mitra.motor') }}" class="menu-link">
      {{-- <i class="menu-icon bx bx-handicap"></i> --}}
      <div>Motor</div>
    </a>
  </li>
@endif

{{-- Transportasi Motor --}}
@if(Session::get('jenis') === 'transportasi mobil')
  <li class="menu-item {{ request()->routeIs('mitra.mobil') ? 'active' : '' }}">
    <a href="{{ route('mitra.mobil') }}" class="menu-link">
      {{-- <i class="menu-icon bx bx-car"></i> --}}
      <div>Mobil</div>
    </a>
  </li>
  <li class="menu-item {{ request()->routeIs('mitra.sopir', 'mitra.sopir.detail') ? 'active' : '' }}">
    <a href="{{ route('mitra.sopir') }}" class="menu-link">
      {{-- <i class="menu-icon bx bx-user"></i> --}}
      <div>Sopir</div>
    </a>
  </li>
@endif

{{-- @if(Session::get('jenis') === 'transportasi motor' || Session::get('jenis') === 'transportasi mobil')
  <li class="menu-item {{ request()->routeIs('transportasi.index') ? 'active' : '' }}">
<a href="{{ route('mitra.transportasi.index') }}" class="menu-link">
  <i class="menu-icon bx bx-map-pin"></i>
  <div>Transportasi</div>
</a>
</li>
@endif --}}



{{-- Homestay --}}
@if(Session::get('jenis') === 'homestay')
  <li class="menu-item {{ request()->routeIs('mitra.homestay.index') ? 'active' : '' }}">
    <a href="{{ route('mitra.homestay.index') }}" class="menu-link">
      {{-- <i class="menu-icon bx bx-hotel"></i> --}}
      <div>Homestay</div>
    </a>
  </li>
  <li class="menu-item {{ request()->routeIs('homestay.fasilitas.index') ? 'active' : '' }}">
    <a href="{{ route('homestay.fasilitas.index') }}" class="menu-link">
      {{-- <i class="menu-icon bx bx-hotel"></i> --}}
      <div>Fasilitas</div>
    </a>
  </li>
@endif

{{-- Perlengkapan --}}
@if(Session::get('jenis') === 'perlengkapan')
  <li class="menu-item {{ request()->routeIs('mitra.perlengkapan.index', 'mitra.perlengkapan.detail') ? 'active' : '' }}">
    <a href="{{ route('mitra.perlengkapan.index') }}" class="menu-link">
      <div>Perlengkapan</div>
    </a>
  </li>
  <li class="menu-item {{ request()->routeIs('mitra.perlengkapan.dropoff') ? 'active' : '' }}">
    <a href="{{ route('mitra.perlengkapan.dropoff') }}" class="menu-link">
      <div>Drop Off</div>
    </a>
  </li>
@endif

<li class="menu-header small text-uppercase">
  <span class="menu-header-text">Order</span>
</li>

@php
    $jenis = Session::get('jenis');
    $routes = [];

    if ($jenis === 'transportasi motor') {
        $routes = ['mitra.motor.order', 'mitra.motor.order.detail'];
    } elseif ($jenis === 'transportasi mobil') {
        $routes = ['mitra.mobil.order', 'mitra.mobil.order.detail'];
    } elseif ($jenis === 'perjalanan') {
        $routes = ['mitra.perjalanan.order', 'mitra.perjalanan.order.detail'];
    } elseif ($jenis === 'homestay') {
        $routes = ['mitra.homestay.order'];
    } elseif ($jenis === 'perlengkapan') {
        $routes = ['mitra.perlengkapan.order', 'mitra.perlengkapan.order.detail'];
    }
@endphp

<li class="menu-item {{ in_array(Route::currentRouteName(), $routes) ? 'active' : '' }}">
  @if($routes)
    <a href="{{ route($routes[0]) }}" class="menu-link">
      {{-- <i class="menu-icon bx bx-notepad"></i> --}}
      <div>Order</div>
    </a>
  @endif
</li>

@php
    $jenis = Session::get('jenis');
    $routes = [];

    if ($jenis === 'transportasi motor') {
        $routes = ['order.motor.history'];
    } elseif ($jenis === 'perlengkapan') {
        $routes = ['order.perlengkapan.history'];
    }
@endphp

<li class="menu-item {{ in_array(Route::currentRouteName(), $routes) ? 'active' : '' }}">
  @if($routes)
    <a href="{{ route($routes[0]) }}" class="menu-link">
      <div>History</div>
    </a>
  @endif
</li>

  {{-- Transportasi Motor --}}
  {{-- @if(Session::get('jenis') === 'transportasi motor')
    <li class="menu-item {{ request()->routeIs('order.motor.history') ? 'active' : '' }}">
      <a href="{{ route('order.motor.history') }}" class="menu-link">
        <div>History</div>
      </a>
    </li>
    <li class="menu-item {{ request()->routeIs('order.motor.pencairan') ? 'active' : '' }}">
      <a href="{{ route('order.motor.pencairan') }}" class="menu-link">
        <div>Pencairan</div>
      </a>
    </li>
  @endif --}}

  {{-- @if(Session::get('jenis') === 'perlengkapan')
    <li class="menu-item {{ request()->routeIs('order.perlengkapan.history') ? 'active' : '' }}">
      <a href="{{ route('order.perlengkapan.history') }}" class="menu-link">
        <i class="menu-icon bx bx-handicap"></i>
        <div>History</div>
      </a>
    </li>
    <li class="menu-item {{ request()->routeIs('order.perlengkapan.pencairan') ? 'active' : '' }}">
      <a href="{{ route('order.perlengkapan.pencairan') }}" class="menu-link">
        <i class="menu-icon bx bx-handicap"></i>
        <div>Pencairan</div>
      </a>
    </li>
  @endif --}}


  {{-- @if(Session::get('jenis') === 'perjalanan')
  <li class="menu-item">
    <a href="" class="menu-link">
      <i class="menu-icon bx bx-history"></i>
      <div>History</div>
    </a>
  </li>
  <li class="menu-item {{ request()->routeIs('mitra.perjalanan.pencairan') ? 'active' : '' }}">
    <a href="{{ route('order.perjalanan.pencairan') }}" class="menu-link">
      <i class="menu-icon bx bx-dollar-circle"></i>
      <div>pencairan</div>
    </a>
  </li>
  @endif --}}
  
  @endif
  
  <li class="menu-header small text-uppercase">
    <span class="menu-header-text">Transaksi</span>
  </li>
  @php
    $jenis = Session::get('jenis');
    $routes = [];

    if ($jenis === 'transportasi motor') {
        $routes = ['order.motor.pencairan'];
    } elseif ($jenis === 'perjalanan') {
        $routes = ['order.perjalanan.pencairan'];
    } elseif ($jenis === 'perlengkapan') {
        $routes = ['mitra.perlengkapan.pencairan'];
    }
  @endphp
    <li class="menu-item {{ in_array(Route::currentRouteName(), $routes) ? 'active' : '' }}">
      @if($routes)
        <a href="{{ route($routes[0]) }}" class="menu-link">
          <div>Pencairan</div>
        </a>
      @endif
    </li>
  @php
      $jenis = Session::get('jenis');
      $routes = [];

      if ($jenis === 'perlengkapan') {
          $routes = ['mitra.perlengkapan.bank'];
      // } elseif ($jenis === 'perjalanan') {
      //     $routes = ['order.perjalanan.pencairan'];
      // } elseif ($jenis === 'perlengkapan') {
      //     $routes = ['mitra.perlengkapan.pencairan'];
      }
  @endphp

  <li class="menu-item {{ in_array(Route::currentRouteName(), $routes) ? 'active' : '' }}">
    @if($routes)
      <a href="{{ route($routes[0]) }}" class="menu-link">
        <div>Bank</div>
      </a>
    @endif
  </li>


  <li class="menu-header small text-uppercase">
    <span class="menu-header-text">Setting</span>
  </li>
  @php
      $jenis = Session::get('jenis');
      $routes = [];

      if ($jenis === 'perlengkapan') {
          $routes = ['mitra.perlengkapan.profil'];
      // } elseif ($jenis === 'perjalanan') {
      //     $routes = ['order.perjalanan.pencairan'];
      // } elseif ($jenis === 'perlengkapan') {
      //     $routes = ['mitra.perlengkapan.pencairan'];
      }
  @endphp

  <li class="menu-item {{ in_array(Route::currentRouteName(), $routes) ? 'active' : '' }}">
    @if($routes)
      <a href="{{ route($routes[0]) }}" class="menu-link">
        <div>Profil</div>
      </a>
    @endif
  </li>
{{-- Setting Mitra --}}
{{-- <li class="menu-item {{ request()->routeIs('mitra.transportasi.setting.data.index') ? 'active' : '' }}">
    <a href="{{ route('mitra.account') }}" class="menu-link">
      <i class="menu-icon bx bx-cog"></i>
      <div data-i18n="Notifications">Setting</div>
    </a>
  </li>
</ul> --}}

@if(Session::get('jenis') === 'homestay')
  <li class="menu-item {{ request()->routeIs('homestay.setting') ? 'active' : '' }}">
    <a href="{{ route('homestay.setting') }}" class="menu-link">
      <i class="menu-icon bx bx-cog"></i>
      <div>Setting</div>
    </a>
  </li>
@endif