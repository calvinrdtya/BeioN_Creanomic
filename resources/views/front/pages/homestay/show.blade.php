@extends('front.layouts.app')

@section('content')

<style>

    .carousel-indicators img{
        display: block;
    }
    .carousel-indicators button{
        width: max-content !important;
    }
    .carousel-indicators{
        position: unset;
    }
    .carousel-item img {
        width: 100%;
        /* height: 160px; */
        object-fit: cover;
    }
    .carousel-indicators img {
        width: 55px;
        height: auto;
        cursor: pointer;
    }
   

</style>

{{-- @include('front.pages.perjalanan.layouts.nav') --}}

<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        {{-- <div class="container">
            <ol class="all">
                <li><a href="{{ route('front.home') }}" class="title3">Home</a></li>
                <li class="title2"><a href="javascript:void(0);" onclick="window.history.back()" class="title2">Perjalanan</a></li>
                <li class="title2">Detail</li>
            </ol>
        </div> --}}
    </section>
    <!-- End Breadcrumbs -->
    
    <section class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="carousel slide" id="carouselDemo" data-bs-wrap="true" data-bs-ride="carousel">
                        <div class="carousel-inner rounded-3">
                            <div class="carousel-item active">
                                @if ($homestay->thumbnail)
                                    <img src="{{ asset('img/' . $homestay->thumbnail) }}" alt="homestay Image" class="rounded-2 w-100" width="100%">
                                @else
                                    <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image" class="" width="70%">
                                @endif
                            </div>
                            <div class="carousel-item" data-bs-interval="2000">
                                @if ($homestay->image)
                                    <img src="{{ asset('img/' . $homestay->image) }}" alt="homestay Image" class="rounded-2" width="100%">
                                @else
                                    <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image" class="" width="70%">
                                @endif
                            </div>
                            <div class="carousel-item">
                                @if ($homestay->image2)
                                    <img src="{{ asset('img/' . $homestay->image2) }}" alt="homestay Image" class="rounded-2" width="100%">
                                @else
                                    <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image" class="" width="70%">
                                @endif
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselDemo" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselDemo" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                        <div class="carousel-indicators">
                            <button type="button" class="active" data-bs-target="#carouselDemo" data-bs-slide-to="0">
                                @if ($homestay->thumbnail)
                                    <img src="{{ asset('img/' . $homestay->thumbnail) }}" alt="homestay Image" class="rounded-2" width="100%">
                                @else
                                    <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image" class="" width="70%">
                                @endif
                            </button>
                            <button type="button" class="active" data-bs-target="#carouselDemo" data-bs-slide-to="1">
                                @if ($homestay->image)
                                    <img src="{{ asset('img/' . $homestay->image) }}" alt="homestay Image" class="rounded-2" width="100%">
                                @else
                                    <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image" class="" width="70%">
                                @endif
                            </button>
                            <button type="button" class="active" data-bs-target="#carouselDemo" data-bs-slide-to="2">
                                @if ($homestay->image2)
                                    <img src="{{ asset('img/' . $homestay->image2) }}" alt="homestay Image" class="rounded-2" width="100%">
                                @else
                                    <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image" class="" width="70%">
                                @endif
                            </button>
                            <button type="button" class="active" data-bs-target="#carouselDemo" data-bs-slide-to="2">
                                @if ($homestay->image3)
                                    <img src="{{ asset('img/' . $homestay->image3) }}" alt="homestay Image" class="rounded-2" width="100%">
                                @else
                                    <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image" class="" width="70%">
                                @endif
                            </button>
                            <button type="button" class="active" data-bs-target="#carouselDemo" data-bs-slide-to="2">
                                @if ($homestay->image4)
                                    <img src="{{ asset('img/' . $homestay->image4) }}" alt="homestay Image" class="rounded-2" width="100%">
                                @else
                                    <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image" class="" width="70%">
                                @endif
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-3">
                    <h5 class="title-booking">{{ $homestay->title }}</h5>
                       <p class="mb-0 title-sub">Disediakan oleh {{ $homestay->mitra->name }}</p>
                    <div class="my-2 d-flex align-items-center">
                        <i class="fas fa-map-marker-alt" style="color: #777777"></i>
                        <p class="title-sub mb-0 ms-2">{{ $homestay->alamat }}</p>
                    </div>
                    <div class="m-0 my-2">
                        <p class="mb-0 title-sub">Layanan</p>
                        @if ($homestay->refund == 'ya')
                            <span class="badge bg-two mb-0 mr-auto">Bisa Refund</span>
                        @else
                            <span class="badge bg-two mb-0">Tidak Bisa Refund</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-price border-0">
                        <div class="card-body my-2">
                            {{-- <h5 class="title-booking">{{ $homestay->mitra->name }}</h5> --}}
                            <div class="title-paket d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0 ket-booking">Mulai dari</h6>
                            </div>
                            <form action="{{ route('cart.store') }}" method="POST" id="cartForm">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                <input type="hidden" name="mitra_id" value="{{ $homestay->mitra_id }}">
                                <input type="hidden" name="product_id" value="{{ $homestay->id }}">
                                <input type="number" name="qty" value="1" class="d-none">
                                <div class="price align-items-center justify-content-end">
                                    @if ($homestay->price_discount === null)
                                        <div class="price-end d-flex align-items-center justify-content-end">
                                            <h4 class="mb-0">Rp {{ $homestay->final_price }}</h4>
                                            <p class="my-0 title-sub">&nbsp; / Malam</p>
                                        </div>
                                    @else
                                        <h5 class="price-sub mb-0 ms-auto text-decoration-line-through text-end">Rp {{ $homestay->price }}</h5>
                                        <div class="price-end d-flex align-items-center justify-content-end">
                                            <h4 class="mb-0">Rp {{ $homestay->final_price }}</h4>
                                            <p class="my-0 title-sub">&nbsp; / Malam</p>
                                        </div>
                                    @endif
                                </div>
                                <hr class="my-4">
                            <div class="row">
                                {{-- <div class="col-md-6">
                                    <button type="submit" class="button-booking w-100 border-0">Keranjang</button>
                                </div> --}}
                            </form>
                                <div class="col-md-12">
                                    <button class="button-booking w-100 border-0" id="bookingHomestay">Pesan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="col-md-8 py-3">
                        <div class="mb-4 p-2">
                            <p class="mb-0 title-sub">{{ $homestay->deskripsi }}</p>
                        </div>
                        {{-- <div class="mb-4 p-2">
                            <h5 class="title-booking">Fasilitas</h5>
                            <div class="row p-2">
                                <div class="col-6 subtitles">
                                    @if(in_array('wifi', $deskripsiArray))
                                        <p><i class="fas fa-wifi me-3 mt-0 mb-0"></i>Wifi</p>
                                    @endif
                                    @if(in_array('ac', $deskripsiArray))
                                        <p><i class="fas fa-air-conditioner me-3 mt-0 mb-0"></i>AC</p>
                                    @endif
                                    @if(in_array('parkir', $deskripsiArray))
                                        <p><i class="fas fa-car me-3 mt-0 mb-0"></i>Parkir</p>
                                    @endif
                                </div>
                                <div class="col-6 subtitles">
                                    @if(in_array('tv', $deskripsiArray))
                                        <p><i class="fas fa-tv me-2 mt-0 mb-0"></i>TV</p>
                                    @endif
                                    @if(in_array('receptionist', $deskripsiArray))
                                        <p><i class="far fa-check-circle me-2 mt-0 mb-0"></i>Resepsionis</p>
                                    @endif
                                    @if(in_array('24', $deskripsiArray))
                                        <p><i class="far fa-calendar-check me-2 mt-0 mb-0"></i>24/7 Check In</p>
                                    @endif
                                </div>
                            </div>                                                                                                  
                        </div> --}}
                        <div class="card p-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle" style="color: #012970"></i>
                                <h6 class="mb-0 ket-booking ms-2">Informasi Penting</h6>
                            </div>
                            <ul class="text-card-info">
                                <li>Saat transaksi selesai, pihak penyedia layanan akan menghubungi Anda melalui pesan WhatsApp.</li>
                                <li>Penyedia jasa akan meminta dokumen diatas untuk proses verifikasi.</li>
                                <li>Syarat tambahan akan di informasikan oleh penyedia layanan.</li>
                                <li>Dokumen (asli) di atas harus dibawa saat pengambilan kendaraan (hubungi penyedia lebih lanjut untuk detail informasi lebih lanjut)</li>
                                <li>Batas toleransi untuk memenuhi syarat diatas paling lambat 2 jam setelah waktu yang Anda tentukan dalam proses pemesanan. Jika tidak, pesanan tidak bisa di refund apabila syarat diatas tidak terpenuhi.</li>
                                <li>Penyedia layanan berhak membatalkan pesanan, apabila syarat dan ketentuan di atas tidak terpenuhi.</li>
                            </ul>
                        </div>
                        <div class="my-3">
                            <h6 class="title-book mb-0">Kebijakan Refund</h6>
                            <ul class="title-secondary m-0">
                                <li>Refund tidak tersedia untuk pembatalan kurang dari 24 jam sebelum waktu jemput.</li>
                                <li>Refund 100% untuk pembatalan 24 jam sebelum waktu jemput.</li>
                            </ul>
                            <h6 class="title-book mb-0 mt-3">Kebijakan Reschedule</h6>
                            <ul class="title-secondary m-0">
                                <li>Reschedule bisa dilakukan paling lambat 24 jam sebelum waktu pengambilan.</li>
                                <li>Pengajuan reschedule Anda bergantung pada ketersediaan perlengkapan.</li>
                                <li>Reschedule tidak dikenakan biaya. Namun, jika ada perbedaan harga rental di antara jadwal baru dan lama, selisih harganya akan ditanggung oleh penumpang.</li>
                            </ul> 
                        </div>
                    </div>
                    <div class="col-md-4 py-3">
                        <div class="card card-maps border-0 p-3">
                            <h6 class="title-book">Kantor {{ $homestay->mitra->name }}</h6>
                            <iframe src="{{ $homestay->mitra->alamat }}" 
                                width="auto" height="220" class="border-0 rounded-1" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
                    </div>
                </div>
            </div>
        </section>                  
    
<script>
    // Periksa User apakah sudah login atau belum
    document.getElementById('bookingHomestay').addEventListener('click', function(event) {
        event.preventDefault();
        @if (Auth::check())
            window.location.href = '{{ route('homestay.booking', $homestay->uniq_id) }}';
        @else
            window.location.href = '{{ route('account.login') }}';
        @endif
    });
</script>
@endsection


    <!-- <section class="pt-5">
        
    </section> -->
<!-- <div class="sticky-container pt-3">
    <div class="searching pt-5">
        <div class="card p-3">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-3">
                    <div class="dropdown megamenu">
                        <input type="text" class="form-control" id="searchInput" aria-label="Search" placeholder="Cari Kota" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="dropdown-menu dropdown-menu-start" aria-labelledby="searchInput">
                            <div class="align-items-center">
                                <div class="col-auto">
                                    <a href="#" class="dropdown-item d-flex align-items-center">
                                        <i class="fas fa-map-marker-alt me-3"></i>
                                        <span>Surabaya</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group" style="position: relative;">
                        <input type="text" id="daterange" class="form-control" placeholder="Select date range" aria-label="Date range" style="padding-left: 45px;" />
                        <span class="input-group-text position-absolute" style="left: 10px; top: 50%; transform: translateY(-50%); border: none; background: none; z-index: 99;">
                            <i class="far fa-calendar-alt"></i>
                        </span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dropdown megamenu">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fal fa-user-friends"></i></span>
                            <div class="form-control" id="searchInput" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                                <span id="adultCount">1</span> Orang
                            </div>
                            <div class="dropdown-menu dropdown-menu-start" aria-labelledby="searchInput" style="width: 280px;">
                                <div class="p-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span><strong>Dewasa</strong></span>
                                        <div class="d-flex">
                                            <a href="#" class="btn btn-sm btn-outline-primary" onclick="updateCount('adult', -1, event)"><i class="far fa-minus"></i></a>
                                            <span id="adultCountDropdown" class="mx-3">1</span>
                                            <a href="#" class="btn btn-sm btn-outline-primary" onclick="updateCount('adult', 1, event)"><i class="far fa-plus"></i></a>
                                        </div>
                                    </div>
                                    <small class="text-muted">Usia 17 tahun keatas</small>
                                </div>
                                <div class="p-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span>Anak Kecil</span>
                                        <div class="d-flex">
                                            <a href="#" class="btn btn-sm btn-outline-primary"><i class="far fa-minus"></i></a>
                                            <span class="mx-3">1</span>
                                            <a href="#" class="btn btn-sm btn-outline-primary"><i class="far fa-plus"></i></a>
                                        </div>
                                    </div>
                                    <small class="text-muted">Usia 0-17 tahun</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn w-75 btn-md btn-outline-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</div> -->

    {{-- <div class="homestay pt-5">
        <div class="container pt-5 p-5">
            <div class="nav-align-top mb-5">
                <ul class="nav nav-underline" role="tablist">
                  <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#overview" aria-controls="overview" aria-selected="true">
                        Overview
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#kegiatan" aria-controls="kegiatan" aria-selected="false">
                          Kegiatan
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#rekomendasi-lainnya" aria-controls="rekomendasi-lainnya" aria-selected="false">
                            Rekomendasi Lainnya
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel">
                        @if($homestay->count()) --}}
                            {{-- @foreach($homestays as $homestay) --}}
                                {{-- <div class="container">
                                    <div class="row">
                                        <div class="col-md-8 p-4">
                                            <header class="section-header">
                                                <h2>{{ $homestay->title }}</h2>
                                                <div class="star mt-1 mb-1">
                                                    <i class="fas fa-star" style="color: #FFD43B;"></i>
                                                    <i class="fas fa-star" style="color: #FFD43B;"></i>
                                                    <i class="fas fa-star" style="color: #FFD43B;"></i>
                                                </div>
                                                <p class="text-secondary">
                                                    <i class="fas fa-map-marker-alt me-2" style="color: #8a8a8a;"></i>
                                                    {{ $homestay->alamat }}
                                                </p>
                                            </header>
                                        </div>
                                        <div class="col-md-4 p-3 d-flex align-items-center justify-content-end">
                                            <header class="section-subheader text-end">
                                                <p class="text-secondary">
                                                    Harga/room/malam mulai dari
                                                </p>
                                                <div class="price mt-0">
                                                    <h3 class="m-0">Rp {{ $homestay->final_price }}</h3>
                                                    <button class="w-100 button-booking" id="bookingHomestay">Pilih Room</button>
                                                </div>
                                            </header>
                                        </div>
                                    </div>
                                    <div class="container-fluid">
                                        <div class="card border-0">
                                            <div class="ket-homestay" style="z-index: 999;">
                                                <h3>Diskon {{ $homestay->price_discount }}%</h3>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col-md-6">
                                                    <img src="{{ asset('img/' . $homestay->image) }}" class="rounded-3" alt="homestay Image" width="100%">
                                                </div>
                                                <div class="col-md-3">
                                                    <img src="{{ asset('img/' . $homestay->image) }}" class="h-auto mb-2 rounded-3" alt="homestay Image" width="100%">
                                                    <img src="{{ asset('img/' . $homestay->image) }}" class="h-auto mb-2 rounded-3" alt="homestay Image" width="100%">
                                                </div>
                                                <div class="col-md-3">
                                                    <img src="{{ asset('img/' . $homestay->image) }}" class="h-auto mb-2 rounded-3" alt="homestay Image" width="100%">
                                                    <img src="{{ asset('img/' . $homestay->image) }}" class="h-auto mb-2 rounded-3" alt="homestay Image" width="100%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            {{-- @endforeach --}}
                        {{-- @else
                            <p>Tidak ada homestay ditemukan.</p>
                        @endif
                    </div>
                </div>
                
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show" id="kegiatan" role="tabpanel">
                       <div class="container">
                        <p>
                            Donut dragée jelly pie halvah. Danish gingerbread bonbon cookie wafer candy oat cake ice
                            cream. Gummies halvah tootsie roll muffin biscuit icing dessert gingerbread. Pastry ice cream
                            cheesecake fruitcake.
                            </p>
                       </div>
                    </div>
                </div>
            </div>
                <div class="container p-4">
                    <div class="nav-align-top mb-5">
                        <ul class="nav nav-underline" role="tablist">
                            <li class="nav-item">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#about" aria-controls="about" aria-selected="true">
                                    <h5 class="titles">Tentang Homestay</h5>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#rooms" aria-controls="rooms" aria-selected="true">
                                    <h5 class="titles">Room</h5>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#privacy-policy" aria-controls="privacy-policy" aria-selected="false">
                                    <h5 class="titles">Privacy Policy</h5>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#review" aria-controls="review" aria-selected="false">
                                    <h5 class="titles">Review</h5>
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="about" role="about">
                                <div class="container">
                                    <div class="row mt-3">
                                        <div class="col-8">
                                            <div class="about subtitles">
                                                <p id="about-text-p">
                                                    {{ $homestay->higlight }}
                                                </p>
                                                <ul>
                                                    @php
                                                    $items = explode(',', $homestay->deskripsi);
                                                    @endphp
                                                    @foreach($items as $item)
                                                        <li>{{ trim($item) }}</li>
                                                    @endforeach
                                                </ul>                                                
                                            </div>
                                            <div class="fasilitas mt-2 mb-2">
                                                <h5 class="titles"><strong>Fasilitas</strong></h5>
                                                <div class="row p-2">
                                                    <div class="col-6 subtitles">
                                                        <p><i class="fas fa-wifi me-3 mt-0 mb-0"></i>Free Wifi</p>
                                                        <p><i class="fas fa-car me-3 mt-0 mb-0"></i>Parkir Mobil</p>
                                                        <p><i class="fas fa-air-conditioner me-3 mt-0 mb-0"></i>AC</p>
                                                    </div>
                                                    <div class="col-6 subtitles">
                                                        <p><i class="fas fa-tv me-2 mt-0 mb-0"></i>TV</p>
                                                        <p><i class="far fa-check-circle me-2 mt-0 mb-0"></i>Resepsionis</p>
                                                        <p><i class="far fa-calendar-check me-2 mt-0 mb-0"></i>24/7 Check In</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="lok-strategis mt-2 mb-2">
                                                <h5 class="titles"><strong>Lokasi Strategis</strong></h5>
                                                <div class="row p-2">
                                                    <div class="col-6 subtitles">
                                                        <p><i class="fas fa-map-marker-alt me-3 mt-0 mb-0"></i>Tunjungan Plaza</p>
                                                        <p><i class="fas fa-map-marker-alt me-3 mt-0 mb-0"></i>Universitas Airlangga</p>
                                                        <p><i class="fas fa-map-marker-alt me-3 mt-0 mb-0"></i>Stasiun Pasar Turi</p>
                                                    </div>
                                                    <div class="col-6 subtitles">
                                                        <p><i class="fas fa-shopping-bag me-2 mt-0 mb-0"></i>Pusat perbelanjaan</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d38139.31047052549!2d112.74818217780228!3d-7.289883397606624!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb038a6d8acb%3A0xfe54730c5eaca980!2sOYO%201091%20Ace%20Business%20Hotel%20Galaxy%20Syariah!5e1!3m2!1sid!2sid!4v1716901786036!5m2!1sid!2sid" 
                                                width="100%" height="60%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                                            </iframe>
                                        </div>
                                    </div>
                                    <div class="col-7"> --}}

                                        <!-- <h6><strong>Lokasi Strategis</strong></h6>
                                        <div class="row p-2">
                                            <div class="col-6">
                                                <p><i class="fas fa-map-marker-alt me-3 mt-0 mb-0"></i>Tunjungan Plaza</p>
                                                <p><i class="fas fa-map-marker-alt me-3 mt-0 mb-0"></i>Universitas Airlangga</p>
                                                <p><i class="fas fa-map-marker-alt me-3 mt-0 mb-0"></i>Stasiun Pasar Turi</p>
                                            </div>
                                            <div class="col-6">
                                                <p><i class="fas fa-shopping-bag me-2 mt-0 mb-0"></i>Pusat area perbelanjaan</p>
                                            </div>
                                        </div> -->

                                    {{-- </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show mt-4" id="rooms" role="rooms">
                                <div class="container">
                                    <h2>Rooms</h2>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show mt-4" id="lokasi" role="lokasi">
                                <div class="container">
                                    <h2>Lokasi</h2>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show mt-4" id="privacy-policy" role="privacy-policy">
                                <div class="container">
                                    <h2>Privasi</h2>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show mt-4" id="review" role="review">
                                <div class="container">
                                    <h6><strong>Foto Terbaru di OYO Gubeng Kertajaya</strong></h6>
                                    <div class="row mt-3 mb-3">
                                        <div class="col-md-3">
                                            <img src="../assets/img/homestay/1.svg" alt="" width="100%" class="rounded-3">
                                        </div>
                                        <div class="col-md-3">
                                            <img src="../assets/img/homestay/1.svg" alt="" width="100%" class="rounded-3">
                                        </div>
                                        <div class="col-md-3">
                                            <img src="../assets/img/homestay/1.svg" alt="" width="100%" class="rounded-3">
                                        </div>
                                        <div class="col-md-3">
                                            <img src="../assets/img/homestay/1.svg" alt="" width="100%" class="rounded-3">
                                        </div>
                                    </div>
                                </div>
                                <div class="container pt-5 pb-5">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                <a class="nav-link active" id="semua-tab" data-bs-toggle="pill" href="#semua" role="tab" aria-controls="semua" aria-selected="true">
                                                    Semua
                                                </a>
                                                <a class="nav-link" id="lokasi-strategis-tab" data-bs-toggle="pill" href="#lokasi-strategis" role="tab" aria-controls="lokasi-strategis" aria-selected="true">
                                                    Lokasi Strategis
                                                </a>
                                            </div>
                                        </div>
                                
                                        <div class="col-md-9">
                                            <div class="tab-content" id="v-pills-tabContent">
                                                <div class="tab-pane fade show active" id="semua" role="tabpanel" aria-labelledby="semua-tab">
                                                    <div class="col-md-12">
                                                        <div class="card p-4 rounded-4">
                                                            <div class="row justify-content-center align-items-center">
                                                                <div class="col-md-12 d-flex justify-content-between align-items-center">
                                                                    <div class="d-flex align-items-center">
                                                                        <img src="../assets/img/user.jpg" alt="" width="50" class="rounded-circle me-3">
                                                                        <h6><strong>Chrislin</strong></h6>
                                                                    </div>
                                                                    <div class="ml-auto d-flex align-items-center">
                                                                        <p class="align-items-center mb-0 me-3">
                                                                            <small>
                                                                                <img src="../assets/img/logo-.svg" alt="logo-beion"  width="25">
                                                                                9.7 <span class="text-secondary"> /10</span>
                                                                            </small>
                                                                        </p>
                                                                        <i class="fal fa-heart"></i>
                                                                    </div>
                                                                </div>                                                                        
                                                            </div>
                                                            <div class="mt-2 mb-2">
                                                                <p class="text-secondary mb-0">
                                                                    <small>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis maxime delectus rerum? Quibusdam quo eius libero doloribus nulla voluptates? Sapiente cupiditate illo maxime illum distinctio quibusdam? Unde animi eligendi nesciunt.</small>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade show" id="lokasi-strategis" role="tabpanel" aria-labelledby="lokasi-strategis-tab">
                                                    <div class="col-md-12">
                                                        <div class="card p-4 rounded-4">
                                                            <div class="row justify-content-center align-items-center">
                                                                <div class="col-md-12 d-flex justify-content-between align-items-center">
                                                                    <div class="d-flex align-items-center">
                                                                        <img src="../assets/img/user.jpg" alt="" width="50" class="rounded-circle me-3">
                                                                        <h6><strong>Pragos</strong></h6>
                                                                    </div>
                                                                    <div class="ml-auto d-flex align-items-center">
                                                                        <p class="align-items-center mb-0 me-3">
                                                                            <small>
                                                                                <img src="../assets/img/logo-.svg" alt="logo-beion"  width="25">
                                                                                9.7 <span class="text-secondary"> /10</span>
                                                                            </small>
                                                                        </p>
                                                                        <i class="fal fa-heart"></i>
                                                                    </div>
                                                                </div>                                                                        
                                                            </div>
                                                            <div class="mt-2 mb-2">
                                                                <p class="text-secondary mb-0">
                                                                    <small>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis maxime delectus rerum? Quibusdam quo eius libero doloribus nulla voluptates? Sapiente cupiditate illo maxime illum distinctio quibusdam? Unde animi eligendi nesciunt.</small>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!-- Tab content -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
  </main>

{{-- <script>
    // Periksa User apakah sudah login atau belum
    document.getElementById('bookingHomestay').addEventListener('click', function(event) {
        event.preventDefault();
        @if (Auth::check())
            window.location.href = '{{ route('homestay.booking', ['uniq_id' => $homestay->uniq_id]) }}';
        @else
            window.location.href = '{{ route('account.login') }}';
        @endif
    });
</script>
@endsection --}}