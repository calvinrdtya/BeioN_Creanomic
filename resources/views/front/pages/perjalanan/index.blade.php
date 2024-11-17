@extends('front.layouts.apps')

@section('content')

<style>
    @keyframes shimmer {
        0% {
            background-position: -1000px 0;
        }
        100% {
            background-position: 1000px 0;
        }
    }

    @keyframes shimmer {
        0% {
            background-position: -150% 0;
        }
        100% {
            background-position: 150% 0;
        }
    }
.preload {
  background: #f6f7f8;
  background-image: linear-gradient(to right, #e3e3e3 0%, #cecece 20%, #f6f7f8 40%, #f6f7f8 100%);
  background-repeat: no-repeat;
  background-size: 1000px 100%;
  display: inline-block;
  position: relative;
  overflow: hidden;
  animation: shimmer 1.7s infinite linear;
}

/* .jumbotron {
	height: 500px;
    width: 100%;
    height: 50vh;
	background-image: url('/front-assets/img/2.jpg');
	background-size: cover;
	background-attachment: fixed;
	background-position: 0 -140px;
	overflow: hidden;
	position: relative;
} */
</style>

{{-- @include('front.pages.perjalanan.layouts.navbar') --}}
@include('front.layouts.navbar-home')

<!-- ======= Breadcrumbs ======= -->
{{-- <section class="breadcrumbs">
    <div class="container">
        <ol class="all">
            <li><a href="{{ route('front.home') }}" class="title3">Home</a></li>
            <li class="title2">Perjalanan</li>
        </ol>
    </div>
</section> --}}
<!-- End Breadcrumbs -->

<!-- ======= Hero Section ======= -->
<section id="hero-sub" class="hero-sub d-flex align-items-center">
    <div class="container">
        <div class="row">
            {{-- <div class="col-lg-12 col-md-12 col-sm-12 d-flex flex-column align-items-start"> --}}
            <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center align-items-center">
                <h1>Paket Perjalanan</h1>
            </div>
        </div>
    </div>      
</section>
<!-- End Hero -->

    {{-- <div class="jumbotron text-center hero-sub">
        <h1>Be Yourself Trust BeioN</h1>
    </div> --}}


<main id="main">
<div class="pt-5">
    <div class="container">
        {{-- <form action="" class="" method="POST"> --}}
            {{-- <input type="hidden" name="_token" value=""> --}}
            <div class="row">
                <div class="col-lg-3 py-2 p-3">
                    <div class="d-flex justify-content-between align-items-center title-filter">
                        <h3 class="mb-0">FILTER</h3>
                        <a href="{{ route('perjalanan') }}">
                            <p class="mb-0">Reset</p>
                        </a>
                    </div>
                    <hr>
                    <div class="my-4 p-1">
                        <div class="wrapper">
                            <div class="range-slider m-0 mb-0">
                                <input type="text" class="js-range-slider" value="">
                            </div>
                            <div class="row price-input mt-4">
                                <div class="col-md-6 d-flex align-items-center">
                                    <span class="title-secondary">Rp</span>
                                    <input type="number" class="border-0 js-input-from form-control title-secondary" value="0" readonly style="pointer-events: none;">
                                </div>
                                <div class="col-md-6 d-flex align-items-center">
                                    <span class="title-secondary">Rp</span>
                                    <input type="number" class="border-0 js-input-to form-control title-secondary" value="130.000" readonly style="pointer-events: none;">
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-12">
                        <label for="sortBy" class="form-label me-2 title2">Kota</label>
                        <select class="form-select title-secondary" id="sortBy" aria-label="Default select example" onchange="sortPerjalanan()">
                            <option value="all" {{ request('sortBy') == 'all' ? 'selected' : '' }}>Semua</option>
                            <option value="populer" {{ request('sortBy') == 'populer' ? 'selected' : '' }}>Populer</option>
                            <option value="termurah" {{ request('sortBy') == 'termurah' ? 'selected' : '' }}>Harga Termurah</option>
                            <option value="termahal" {{ request('sortBy') == 'termahal' ? 'selected' : '' }}>Harga Termahal</option>
                        </select>
                    </div> --}}
                    <div class="accordion mb-2" id="accordionLokasi">
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header all">
                                <button class="accordion-button title2 bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#filter-lokasi" aria-expanded="true" aria-controls="filter-lokasi">
                                    Kota
                                </button>
                            </h2>
                            <form id="filterForm" method="GET" action="{{ url()->current() }}">
                                <div id="filter-lokasi" class="accordion-collapse collapse show" data-bs-parent="#accordionLokasi">
                                    <div class="accordion-body accordion-title">
                                        <div class="form-check mt-1">
                                            <input type="checkbox" class="form-check-input shadow-none" id="lokasi-all" name="lokasi[]" value="all" 
                                                {{ in_array('all', request()->input('lokasi', ['all'])) ? 'checked' : '' }}>
                                            <label class="form-check-label float-start" for="lokasi-all">All</label>
                                        </div>
                                        @foreach ($kotas as $kota)
                                            <div class="form-check mt-1">
                                                <input type="checkbox" class="form-check-input shadow-none" id="lokasi-{{ $kota->kota }}" name="lokasi[]" value="{{ $kota->kota }}"
                                                    {{ in_array($kota->kota, request()->input('lokasi', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label float-start" for="lokasi-{{ $kota->kota }}">{{ ucfirst($kota->kota) }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </form>                                                                            
                        </div>
                        <div class="accordion mb-2" id="accordionTipe">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header all">
                                    <button class="accordion-button title2 bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#filter-tipe" aria-expanded="true" aria-controls="filter-tipe">
                                        Aktifitas
                                    </button>
                                </h2>
                                <div id="filter-tipe" class="accordion-collapse collapse show" data-bs-parent="#accordionTipe">
                                    <div class="accordion-body accordion-title">
                                        <div class="form-check mt-1">
                                            <input type="checkbox" class="form-check-input shadow-none" id="aktifitas-all" name="aktifitas[]" value="all" 
                                                {{ in_array('all', request()->input('aktifitas', ['all'])) ? 'checked' : '' }}>
                                            <label class="form-check-label float-start" for="aktifitas-all">All</label>
                                        </div>
                                        @foreach ($categories as $category)
                                            <div class="form-check mt-1">
                                                <input type="checkbox" class="form-check-input shadow-none" id="aktifitas-{{ $category->name }}" name="aktifitas[]" value="{{ $category->name }}"
                                                    {{ in_array($category->name, request()->input('aktifitas', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label float-start" for="aktifitas-{{ $category->name }}">{{ ucfirst($category->name) }}</label>
                                            </div>
                                        @endforeach
                                    </div>                                    
                                </div>                                                                
                            </div>
                        </div>
                        {{-- <button class="button-booking w-100 border-0 my-1">Terapkan</button>
                        <button class="button-booking w-100 border-0 my-1">Reset</button> --}}
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row mb-4 justify-content-between align-items-center">
                        <div class="col-md-4">
                            {{-- <label for="sortBy" class="form-label me-2 mb-0 title-secondary">Urutkan</label> --}}
                            {{-- <form action="{{ route('perjalanan') }}" method="GET" id="filter-form">
                                <select class="form-select title-secondary nav-group-mvp form-md" id="city" name="lokasi[]" onchange="document.getElementById('filter-form').submit();">
                                    <option value="all">Pilih Destinasi / Aktifitas</option>
                                    @foreach ($kotas as $kota)
                                        <option value="{{ $kota->kota }}">{{ ucfirst($kota->kota) }}</option>
                                    @endforeach
                                </select>
                            </form>                             --}}
                                  
                            {{-- <h5 class="title1">Tersedia</h5> --}}
                            {{-- <div class="card shadow-sm rounded-pill card-group-perjalanan">
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
                            </div> --}}
                        </div>
                        <div class="col-md-4">
                            <form action="{{ route('perjalanan') }}" method="GET" id="filter-form">
                                <select class="form-select title-secondary nav-group-mvp form-md" id="city" name="lokasi[]" onchange="document.getElementById('filter-form').submit();">
                                    <option value="all">Pilih Kota</option>
                                    @foreach ($kotas as $kota)
                                        <option value="{{ $kota->kota }}">{{ ucfirst($kota->kota) }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end align-items-center">
                            <label for="sortBy" class="form-label me-2 mb-0 title-secondary">Urutkan</label>
                            <select class="form-select title-secondary" id="sortBy" aria-label="Default select example" onchange="sortPerjalanan()">
                                <option value="all" {{ request('sortBy') == 'all' ? 'selected' : '' }}>Semua</option>
                                {{-- <option value="populer" {{ request('sortBy') == 'populer' ? 'selected' : '' }}>Populer</option> --}}
                                <option value="termurah" {{ request('sortBy') == 'termurah' ? 'selected' : '' }}>Harga Termurah</option>
                                <option value="termahal" {{ request('sortBy') == 'termahal' ? 'selected' : '' }}>Harga Termahal</option>
                            </select>
                        </div>
                    </div>
                    <div id="loader-perjalanan" class="row g-3">
                        @for ($i = 0; $i < 9; $i++)
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="card card-artikel rounded-3 border-0">
                                    <div class="preload skeleton-image rounded-2" style="width: 100%; height: 150px;"></div>
                                    <div class="preload skeleton-text my-2" style="width: 80%; height: 20px;"></div>
                                    <div class="my-2 d-flex align-items-center justify-content-between">
                                        <div class="m-0 d-flex align-items-center">
                                            <div class="preload skeleton-logo" style="width: 20px; height: 20px; margin-right: 5px;"></div>
                                            <div class="preload skeleton-text" style="width: 50px; height: 15px;"></div>
                                        </div>
                                        <div class="m-0 d-flex align-items-center">
                                            <div class="preload skeleton-text" style="width: 30px; height: 15px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                    
                    <div class="row g-3" id="content-perjalanan" style="display: none">
                        @forelse($perjalanans as $perjalanan)
                            <div class="col-lg-4 col-md-4 paket-item">
                                <div class="card border-0 card-paket position-relative overflow-hidden">
                                    @if ($perjalanan->thumbnail)
                                        <img src="{{ asset('img/' . $perjalanan->thumbnail) }}" alt="Perjalanan Image" class="card-img-top img-fluid">
                                    @else
                                        <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image"/>
                                    @endif
                                    <div class="ket-paket">
                                        <h3 class="text-capitalize">{{ $perjalanan->kota }}</h3>
                                    </div>
                                </div>
                                <div class="title-paket my-2 p-1">
                                    <a href="{{ route('perjalanan.detail', ['perjalananId' => $perjalanan->id]) }}" class="text-reset text-decoration-none">
                                        <h3>{{ $perjalanan->title }}</h3>
                                        <div class="m-0 d-flex align-items-center justify-content-between my-1">
                                            <div class="d-flex align-items-center">
                                                <i class="far fa-calendar-check me-2" style="color: #012970"></i>
                                                <p class="mb-0">{{ \Carbon\Carbon::parse($perjalanan->tgl_perjalanan)->translatedFormat('d F Y') }}</p>
                                            </div>
                                            <span class="badge bg-first-transparent ms-2">{{ $perjalanan->durasi }}</span>
                                        </div>
                                        {{-- <div class="m-0 d-flex align-items-center">
                                            @if ($perjalanan->shipping_return == 1)
                                                <i class="fas fa-undo-alt me-2" style="color: #012970"></i>
                                                <p class="mb-0">Refund Tersedia</p>
                                            @endif
                                        </div> --}}
                                        <div class="m-0 d-flex align-items-center my-1">
                                            @if ($perjalanan->shipping_return == 1)
                                                <span class="badge bg-first-transparent">Open</span>
                                            @else
                                                <span class="badge bg-first-transparent">Private</span>
                                            @endif
                                            @if($perjalanan->price_discount !== null)
                                                <p class="mb-0 ms-auto text-decoration-line-through text-end">Rp {{ $perjalanan->price }}</p>
                                            @endif
                                        </div>
                                        <div class="price align-items-center justify-content-end">
                                            <h4 class="mb-0 text-end">Rp {{ $perjalanan->final_price }}</h4>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-12 text-center">
                                <h3 class="mb-0 text-center">-- Belum Ada Perjalanan --</h3>
                            </div>
                        @endforelse
                    </div>
                    
                </div>
            </div>
        </div>
</main>

{{-- @include('front.pages.transportasi.layouts.footer') --}}
<script>
    // Sort Kendaraan
    function sortPerjalanan() {
        var sortBy = document.getElementById("sortBy").value;
        var url = new URL(window.location.href);

        if (sortBy === 'all') {
            url.searchParams.delete('sortBy');
        } else {
            url.searchParams.set('sortBy', sortBy);
        }
        window.location.href = url.toString();
    }

    // Filter Kota
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('#filter-lokasi input[type="checkbox"]');
        const form = document.getElementById('filterForm');
        const allCheckbox = document.getElementById('lokasi-all');

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                if (checkbox === allCheckbox) {
                    if (allCheckbox.checked) {
                        checkboxes.forEach(function(cb) {
                            if (cb !== allCheckbox) {
                                cb.checked = false;
                            }
                        });
                    }
                } else {
                    if (checkbox.checked) {
                        allCheckbox.checked = false;
                    }
                }
                const anyChecked = Array.from(checkboxes).some(cb => cb.checked && cb !== allCheckbox);
                    if (!anyChecked) {
                        allCheckbox.checked = true;
                    }
                form.submit(); // Submit form saat checkbox diubah
            });
        });
    });

    // Loader untuk Artikel
    function handleLoader(loaderId, contentId) {
        var loader = document.querySelector(loaderId);
        var content = document.querySelector(contentId);

        if (loader && content) {
            setTimeout(function() {
                loader.style.display = 'none';
                content.style.display = 'flex';
            }, 1000);
        } else {
            console.error(`Error: Loader dengan ID ${loaderId} atau konten dengan ID ${contentId} tidak ditemukan`);
        }
    }
    window.onload = function() {
        handleLoader('#loader-perjalanan', '#content-perjalanan');
    };

    document.addEventListener('DOMContentLoaded', function () {
        const allCheckbox = document.getElementById('aktifitas-all');
        const otherCheckboxes = document.querySelectorAll('input[name="aktifitas[]"]:not(#aktifitas-all)');

        allCheckbox.addEventListener('change', function () {
            if (this.checked) {
                otherCheckboxes.forEach(cb => {
                    cb.checked = false;
                });
            }
        });

        otherCheckboxes.forEach(cb => {
            cb.addEventListener('change', function () {
                if (this.checked) {
                    allCheckbox.checked = false;
                }
            });
        });
    });

</script>
@endsection