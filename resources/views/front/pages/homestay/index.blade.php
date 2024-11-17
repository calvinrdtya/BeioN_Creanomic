@extends('front.layouts.apps')

@section('content')

@include('front.pages.homestay.layouts.navbar')

<style>
    .thumbnail-homestay {
        width: 270px !important;
        height: 160px !important;
        object-fit: cover !important;
    }
</style>

    <div class="container" style="padding-top: 7rem">
        {{-- <form action="" class="" method="POST"> --}}
            <input type="hidden" name="_token" value="">
            <div class="row">
                <div class="col-lg-3">
                    <div class="mb-3">
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
                                        <label class="form-check-label float-start" for="lokasi-all">All</label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" class="form-check-input shadow-none" id="lokasi-surabaya" name="lokasi" value="surabaya">
                                        <label class="form-check-label float-start" for="lokasi-surabaya">Surabaya</label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" class="form-check-input shadow-none" id="lokasi-malang" name="lokasi" value="malang">
                                        <label class="form-check-label float-start" for="lokasi-malang">Malang</label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" class="form-check-input shadow-none" id="lokasi-pasuruan" name="lokasi" value="pasuruan">
                                        <label class="form-check-label float-start" for="lokasi-pasuruan">Pasuruan</label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" class="form-check-input shadow-none" id="lokasi-banyuwangi" name="lokasi" value="banyuwangi">
                                        <label class="form-check-label float-start" for="lokasi-banyuwangi">Banyuwangi</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion mb-2" id="accordionTipe">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header all">
                                    <button class="accordion-button title2 bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#filter-tipe" aria-expanded="true" aria-controls="filter-tipe">
                                        Fasilitas
                                    </button>
                                </h2>
                                <div id="filter-tipe" class="accordion-collapse collapse show" data-bs-parent="#accordionTipe">
                                    <div class="accordion-body accordion-title">
                                        <div class="form-check mt-1">
                                            <input type="checkbox" class="form-check-input shadow-none" id="tipe-motor" name="vehicle" value="motor">
                                            <label class="form-check-label float-start ms-1" for="tipe-motor">Wifi</label>
                                        </div>
                                        <div class="form-check mt-1">
                                            <input type="checkbox" class="form-check-input shadow-none" id="tipe-mobil" name="vehicle" value="mobil">
                                            <label class="form-check-label float-start ms-1" for="tipe-mobil">AC</label>
                                        </div>
                                        <div class="form-check mt-1">
                                            <input type="checkbox" class="form-check-input shadow-none" id="tipe-mobil" name="vehicle" value="mobil">
                                            <label class="form-check-label float-start ms-1" for="tipe-mobil">TV</label>
                                        </div>
                                        <div class="form-check mt-1">
                                            <input type="checkbox" class="form-check-input shadow-none" id="tipe-mobil" name="vehicle" value="mobil">
                                            <label class="form-check-label float-start ms-1" for="tipe-mobil">Parkir</label>
                                        </div>
                                        <div class="form-check mt-1">
                                            <input type="checkbox" class="form-check-input shadow-none" id="tipe-mobil" name="vehicle" value="mobil">
                                            <label class="form-check-label float-start ms-1" for="tipe-mobil">Resepsionis 24 Jam</label>
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
                    <div class="row mb-3 justify-content-between align-items-center justify-content-center">
                        <div class="col-md-6">
                            <h5 class="title1">Tersedia</h5>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end align-items-center">
                            <label for="sortBy" class="form-label me-2 mb-0 title-secondary">Sort By</label>
                            <select class="form-select w-50 title-secondary" id="sortBy" aria-label="Default select example" onchange="sortHomestay()">
                                <option value="all" {{ request('sortBy') == 'all' ? 'selected' : '' }}>All</option>
                                <option value="populer" {{ request('sortBy') == 'populer' ? 'selected' : '' }}>Populer</option>
                                <option value="termurah" {{ request('sortBy') == 'termurah' ? 'selected' : '' }}>Harga Termurah</option>
                                <option value="termahal" {{ request('sortBy') == 'termahal' ? 'selected' : '' }}>Harga Termahal</option>
                            </select>
                        </div>
                    </div>
                        @forelse($homestays as $homestay)
                            @if($homestay->qty > 0)
                                <div class="card my-3 border-0">
                                    <div class="ket-homestay">
                                        @if ($homestay->price_discount)
                                            <h3>{{ $homestay->price_discount }}%&nbsp;Off</h3>
                                        @else
                                            <h3>Terbaru</h3>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="d-flex">
                                                @if ($homestay->thumbnail)
                                                    <img src="{{ asset('img/' . $homestay->thumbnail) }}" class="img-fluid rounded-3" alt="Thumbnails">
                                                @else
                                                    <img src="{{ asset('front-assets/img_blank.jpg') }}" class="img-fluid rounded-3" alt="Default Thumbnails">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 p-2">
                                            <div class="card-body p-1">
                                                <div>
                                                    <h5 class="title-booking">{{ $homestay->title }}</h5>
                                                    <div class="alamat d-flex align-items-center">
                                                        <i class="fas fa-map-marker-alt" style="color: #012970"></i>
                                                        <p class="mb-0 ms-2 title-sub">{{ $homestay->alamat }}</p>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-check" style="color: #012970"></i>
                                                        @php
                                                            $items = explode(',', $homestay->higlight);
                                                        @endphp
                                                        @foreach($items as $index => $item)
                                                            @if ($index < 3)
                                                                <span class="badge bg-two ms-2 my-2 text-capitalize">{{ trim($item) }}</span>
                                                            @else
                                                                @break
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 p-2">
                                            <div class="card-body p-1">
                                                <div class="p-2 mt-2">
                                                    @if ($homestay->shipping_return)
                                                        <span class="badge bg-first-transparent mb-0 ms-2 float-end">
                                                            <i class="fas fa-money-bill-wave me-1 fa-xs"></i>Refund Tersedia
                                                        </span>
                                                    @else
                                                        <span class="badge bg-first-transparent mb-0 ms-2 float-end">
                                                            <i class="fas fa-money-bill-wave me-1 fa-xs"></i>Termurah
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="p-2 mt-3 text-end">
                                                    @if($homestay->price_discount !== null)
                                                        <div class="price-sub d-flex justify-content-end">
                                                            <p class="title-sub m-0">Rp&nbsp;</p>
                                                            <p class="title-sub m-0 text-decoration-line-through">{{ $homestay->price }}</p>
                                                        </div>
                                                    @endif
                                                    <h3 class="price-transportasi">Rp {{ $homestay->final_price }}</h3>
                                                    <button class="button-booking w-100 border-0" onclick="window.location.href='{{ route('homestay.detail', ['uniq_id' => $homestay->uniq_id]) }}'">Booking</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <h3 class="mb-0 text-center">-- Belum Ada Homestay --</h3>
                        @endforelse
                </div>
            </div>
        </div>

{{-- @include('front.pages.transportasi.layouts.footer') --}}
    <script>
        // Sort Homestay
        function sortHomestay() {
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