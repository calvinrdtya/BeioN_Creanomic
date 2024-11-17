@extends('front.layouts.apps')

@section('content')

@include('front.pages.transportasi.layouts.navbar')

<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
    {{-- <div class="container">
        <ol class="all">
            <li><a href="{{ route('front.home') }}" class="title3">Home</a></li>
            <li class="title2">Transportasi</li>
        </ol>
    </div> --}}
</section>
<!-- End Breadcrumbs -->

<div class="pt-2">
    <div class="container">
        <form action="" class="" method="POST">
            <input type="hidden" name="_token" value="">
            <div class="row">
                <div class="col-lg-3 pb-5">
                    <div class="my-2">
                        <h5 class="title1">Filter</h5>
                        <hr>
                    </div>
                    <div class="mb-3 p-2">
                        <div class="wrapper">
                            <div class="range-slider m-0 mb-0">
                                <input type="text" class="js-range-slider" value="" />
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
                    <div class="accordion mb-2" id="accordionLokasi">
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header all">
                                <button class="accordion-button title2 bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#filter-lokasi" aria-expanded="true" aria-controls="filter-lokasi">
                                    Lokasi
                                </button>
                            </h2>
                            <div id="filter-lokasi" class="accordion-collapse collapse show" data-bs-parent="#accordionLokasi">
                                <div class="accordion-body accordion-title">
                                    <div class="form-check mt-1">
                                        <input type="checkbox" class="form-check-input shadow-none" id="lokasi-all" name="lokasi" value="all" checked>
                                        <label class="form-check-label float-start ms-1" for="lokasi-all">All</label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" class="form-check-input shadow-none" id="lokasi-surabaya" name="lokasi" value="surabaya">
                                        <label class="form-check-label float-start ms-1" for="lokasi-surabaya">Surabaya</label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" class="form-check-input shadow-none" id="lokasi-malang" name="lokasi" value="malang">
                                        <label class="form-check-label float-start ms-1" for="lokasi-malang">Malang</label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" class="form-check-input shadow-none" id="lokasi-pasuruan" name="lokasi" value="pasuruan">
                                        <label class="form-check-label float-start ms-1" for="lokasi-pasuruan">Pasuruan</label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" class="form-check-input shadow-none" id="lokasi-banyuwangi" name="lokasi" value="banyuwangi">
                                        <label class="form-check-label float-start ms-1" for="lokasi-banyuwangi">Banyuwangi</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion mb-2" id="accordionTipe">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header all">
                                    <button class="accordion-button title2 bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#filter-tipe" aria-expanded="true" aria-controls="filter-tipe">
                                        Tipe
                                    </button>
                                </h2>
                                <div id="filter-tipe" class="accordion-collapse collapse show" data-bs-parent="#accordionTipe">
                                    <div class="accordion-body accordion-title">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-check mt-1">
                                                    <input type="checkbox" class="form-check-input shadow-none" id="tipe-motor" name="motor" value="motor" checked>
                                                    <label class="form-check-label float-start ms-1" for="tipe-motor">Motor</label>
                                                </div>
                                                <div class="form-check mt-1">
                                                    <input type="checkbox" class="form-check-input shadow-none" id="tipe-mobil" name="mobil" value="mobil">
                                                    <label class="form-check-label float-start ms-1" for="tipe-mobil">Mobil</label>
                                                </div>
                                            </div>                                        
                                            {{-- <div class="col-md-7">
                                                <div class="form-check mt-1 d-none" id="sopirCheck">
                                                    <input type="checkbox" class="form-check-input shadow-none" id="sopir" name="driver" value="sopir">
                                                    <label class="form-check-label float-start ms-1" for="sopir">Sopir</label>
                                                </div>
                                                <div class="form-check mt-1 d-none" id="lepasKunciCheck">
                                                    <input type="checkbox" class="form-check-input shadow-none" id="lepasKunci" name="driver" value="lepasKunci">
                                                    <label class="form-check-label float-start ms-1" for="lepasKunci">Lepas Kunci</label>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion mb-2" id="accordionCategory">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header all">
                                    <button class="accordion-button title2 bg-transparent collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#filter-category" aria-expanded="true" aria-controls="filter-category">
                                        Kategori Kendaraan
                                    </button>
                                </h2>
                                <div id="filter-category" class="accordion-collapse collapse" data-bs-parent="#accordionCategory">
                                    <div class="accordion-body accordion-title">
                                        <div class="row">
                                            <div class="col-md-5">
                                                @foreach($categories as $category)
                                                    <div class="form-check mt-1">
                                                        <input type="checkbox" class="form-check-input shadow-none" id="tipe-{{ strtolower($category->name) }}" name="vehicle[]" value="{{ strtolower($category->name) }}" {{ in_array(strtolower($category->name), request('vehicle', [])) ? 'checked' : '' }}>
                                                        <label class="form-check-label float-start ms-1" for="tipe-{{ strtolower($category->name) }}">
                                                            {{ ucfirst($category->name) }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion mb-2" id="accordionJenis">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header all">
                                    <button class="accordion-button title2 bg-transparent collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#filter-jenis" aria-expanded="true" aria-controls="filter-jenis">
                                        Jenis
                                    </button>
                                </h2>
                                <div id="filter-jenis" class="accordion-collapse collapse" data-bs-parent="#accordionJenis">
                                    <div class="accordion-body accordion-title">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-check mt-1">
                                                    <input type="checkbox" class="form-check-input shadow-none" id="jenis-manual" name="jenis" value="manual">
                                                    <label class="form-check-label float-start ms-1" for="jenis-manual">Manual</label>
                                                </div>
                                                <div class="form-check mt-1">
                                                    <input type="checkbox" class="form-check-input shadow-none" id="jenis-matic" name="jenis" value="matic">
                                                    <label class="form-check-label float-start ms-1" for="jenis-matic">Matic</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="accordion mb-2" id="accordionRating">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header all">
                                    <button class="accordion-button title2 bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#filter-rating" aria-expanded="true" aria-controls="filter-rating">
                                        Rating
                                    </button>
                                </h2>
                                <div id="filter-rating" class="accordion-collapse collapse show" data-bs-parent="#accordionRating">
                                    <div class="accordion-body accordion-title">
                                        <div class="form-check text-start">
                                            <input type="checkbox" class="form-check-input shadow-none" id="star-five" name="star-five" value="" style="cursor: pointer;">
                                            <label class="form-check-label float-start" for="check1" style="cursor: pointer;">
                                                <i class="fas fa-star" style="color: #FFD43B;"></i>
                                                <i class="fas fa-star" style="color: #FFD43B;"></i>
                                                <i class="fas fa-star" style="color: #FFD43B;"></i>
                                                <i class="fas fa-star" style="color: #FFD43B;"></i>
                                                <i class="fas fa-star" style="color: #FFD43B;"></i>
                                            </label>
                                        </div>
                                        <div class="form-check text-start">
                                            <input type="checkbox" class="form-check-input shadow-none" id="star-four" name="star-four" value="" style="cursor: pointer;">
                                            <label class="form-check-label float-start" for="check1" style="cursor: pointer;">
                                                <i class="fas fa-star" style="color: #FFD43B;"></i>
                                                <i class="fas fa-star" style="color: #FFD43B;"></i>
                                                <i class="fas fa-star" style="color: #FFD43B;"></i>
                                                <i class="fas fa-star" style="color: #FFD43B;"></i>
                                            </label>
                                        </div>
                                        <div class="form-check text-start">
                                            <input type="checkbox" class="form-check-input shadow-none" id="star-three" name="star-three" value="" style="cursor: pointer;">
                                            <label class="form-check-label float-start" for="check1" style="cursor: pointer;">
                                                <i class="fas fa-star" style="color: #FFD43B;"></i>
                                                <i class="fas fa-star" style="color: #FFD43B;"></i>
                                                <i class="fas fa-star" style="color: #FFD43B;"></i>
                                            </label>
                                        </div>
                                        <div class="form-check text-start">
                                            <input type="checkbox" class="form-check-input shadow-none" id="star-two" name="star-two" value="" style="cursor: pointer;">
                                            <label class="form-check-label float-start" for="check1" style="cursor: pointer;">
                                                <i class="fas fa-star" style="color: #FFD43B;"></i>
                                                <i class="fas fa-star" style="color: #FFD43B;"></i>
                                            </label>
                                        </div>
                                        <div class="form-check text-start">
                                            <input type="checkbox" class="form-check-input shadow-none" id="star-one" name="star-one" value="" style="cursor: pointer;">
                                            <label class="form-check-label float-start" for="check1" style="cursor: pointer;">
                                                <i class="fas fa-star" style="color: #FFD43B;"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-9 mb-4">
                    <div class="row mb-3 justify-content-between align-items-center">
                        <div class="col-md-6">
                            <h5 class="title1">Available di Surabaya</h5>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end align-items-center">
                            <label for="sortBy" class="form-label me-2 mb-0 title-secondary">Urutkan</label>
                            <select class="form-select w-50 title-secondary" id="sortBy" aria-label="Default select example" onchange="sortPerjalanan()">
                                <option value="all" {{ request('sortBy') == 'all' ? 'selected' : '' }}>Semua</option>
                                <option value="populer" {{ request('sortBy') == 'populer' ? 'selected' : '' }}>Populer</option>
                                <option value="termurah" {{ request('sortBy') == 'termurah' ? 'selected' : '' }}>Harga Termurah</option>
                                <option value="termahal" {{ request('sortBy') == 'termahal' ? 'selected' : '' }}>Harga Termahal</option>
                            </select>
                        </div>
                    </div>
                    <div class="row g-3">
                        @forelse($vehicles as $vehicle)
                            @php
                                $mitraJenis = $vehicle->mitra->jenis ?? ''; 
                            @endphp
                            @if ($vehicle->qty > 0)
                                <div class="col-md-6 vehicle-card" data-jenis="{{ $mitraJenis }}">
                                    <div class="card shadow-sm border-0 p-2">
                                        @if($mitraJenis == 'transportasi motor')
                                            <a href="{{ route('user.motor.detail', ['motorId' => $vehicle->id]) }}">
                                        @elseif($mitraJenis == 'transportasi mobil')
                                            <a href="{{ route('user.mobil.detail', ['mobilId' => $vehicle->id]) }}">
                                        @else
                                            <a href="#">
                                        @endif
                                        <div class="ket-kendaraan">
                                            @if ($vehicle->price_discount)
                                                <h3>{{ $vehicle->price_discount }}%&nbsp;Off</h3>
                                            @else
                                                <h3 class="text-capitalize">{{ $vehicle->category->name }}</h3>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 d-flex align-items-center justify-content-center">
                                                @if ($vehicle->image)
                                                    <img src="{{ asset('img/' . $vehicle->image) }}" alt="Vehicle Image" class="rounded-2" width="100">
                                                @else
                                                    <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image" class="" width="100">
                                                @endif
                                            </div>
                                            <div class="col-md-8 p-2">
                                                <div class="title-paket">
                                                    <h3>{{ $vehicle->title }}</h3>
                                                </div>
                                                <div class="col-md-auto mt-2 ms-1 all">
                                                    <div class="d-flex align-items-center my-1">
                                                        <i class="fas fa-steering-wheel me-2" style="color: #012970"></i>
                                                        <p class="mb-0 text-uppercase">{{ $vehicle->jenis }}</p>
                                                    </div>
                                                    <div class="d-flex align-items-center my-1">
                                                        <i class="far fa-check me-2" style="color: #012970"></i>
                                                        @if ($vehicle->layanan === 'Semua')
                                                            <p class="mb-0 text-capitalize">Layanan Sopir & Lepas Kunci</p>
                                                        @elseif ($vehicle->layanan === 'Lepas Kunci')
                                                            <p class="mb-0 text-capitalize">Lepas Kunci</p>
                                                        @elseif ($vehicle->layanan === 'Sopir')
                                                            <p class="mb-0 text-capitalize">Layanan Sopir</p>
                                                        @else
                                                            <p class="mb-0 text-capitalize">Jas Hujan & Helm</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="price d-flex align-items-center justify-content-end">
                                                    @if ($vehicle->price_discount !== null)
                                                        <p class="my-0 me-2 text-decoration-line-through">Rp {{ $vehicle->final_price }}</p>
                                                        <h4 class="me-2 my-0">Rp {{ $vehicle->final_price }}</h4>
                                                    @else
                                                        <h4 class="me-2 my-0">Rp {{ $vehicle->price }}</h4>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                </div>
                            @endif
                            @empty
                                <div class="col-md-12 text-center">
                                    <h3 class="mb-0 text-center">-- Belum Ada Kendaraan --</h3>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

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
</script>
@endsection