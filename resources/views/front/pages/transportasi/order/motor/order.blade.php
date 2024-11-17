@extends('front.layouts.apps')

@section('content')

<div class="container pb-5">
    <section class="breadcrumbs" style="margin-top: 30px !important">
        <div class="container">
            <a href="{{ route('front.home') }}" class="logo">
                <img src="https://i.ibb.co.com/zHsZVdf/logo-hitam.png" alt="logo" width="10%">
            </a>
            <ol class="all mt-3">
                <li><a href="{{ route('front.home') }}" class="title3">Home</a></li>
                <li class="title2">Transportasi</li>
                <li class="title2">Data Diri</li>
            </ol>
        </div>
    </section>
    <div class="container" style="width: 90%;">
        <form action="" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="container">
                        <h4 class="title-booking">Data Diri Pemesan</h4>
                        <div class="card p-3">
                            <h5 class="titles">Data Pemesan (untuk E-tiket/Voucher)</h5>
                            <hr class="mt-3 mb-3">
                            <div class="form-group form-group-transportasi mb-3">
                                <label for="nama" class="float-start mb-2 title-booking-three">Nama Lengkap<span class="text-danger">*</span><small>&nbsp;(tanpa gelar dan tanda baca)</small></label>
                                {{-- <input readonly type="text" id="nama" name="nama_pemesan" class="form-control form-control-lg fs-6 mt-1" value="{{ auth()->user()->name }}" required> --}}
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-transportasi mb-3">
                                        <label for="no_telp" class="float-start mb-2 title-booking-three">Nomer Telepon<span class="text-danger">*</span></label>
                                        {{-- <input readonly type="text" id="no_telp" name="no_telp" class="form-control form-control-lg fs-6 mt-1" value="{{ auth()->user()->phone }}" placeholder="+62" required> --}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-transportasi mb-3">
                                        <label for="email" class="float-start mb-2 title-booking-three">Email<span class="text-danger">*</span></label>
                                        {{-- <input readonly type="email" id="email" name="email" class="form-control form-control-lg fs-6 mt-1" value="{{ auth()->user()->email }}" required> --}}
                                    </div>
                                    <hr class="mb-4 mt-4">
                                    <h6 class="title-book">Honda Brio New</h6>
                                    <div class="my-1">
                                        <span class="title-booking-three">Manual</span>
                                    </div>
                                    <div class="my-1">
                                        <span class="title-booking-three">Rental X Mexico Surabaya</span>
                                    </div>
                                    <div class="my-1">
                                        <span class="title-booking-three">Pilih<span class="text-danger">*</span></span>
                                    </div>
                                    <div class="row my-1">
                                        <div class="col-md-6">
                                            <div class="form-check form-group-transportasi">
                                                <input name="transportasi" class="form-check-input" type="radio" value="tanpa_sopir" id="tanpa_sopir" required>
                                                <label class="form-check-label title-booking-three" for="tanpa_sopir">Tanpa Sopir</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-group-transportasi">
                                                <input name="transportasi" class="form-check-input" type="radio" value="lepas_kunci" id="lepas_kunci" required>
                                                <label class="form-check-label title-booking-three" for="lepas_kunci">Lepas Kunci</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="card p-1 mt-4">
                                <div class="card-body">
                                    <h6 class="title-book">Keterangan</h6>
                                    <hr class="mb-3 mt-3">
                                    <div class="mt-3">
                                        <span class="mt-0 mb-0 title-booking-three d-block">Kota/Lokasi Rental</span>
                                        <span class="title-booking-secondary d-block">Surabaya</span>
                                    </div>                                    
                                    <div class="mt-3">
                                        <span class="mb-0 title-booking-three d-block">Tanggal & Waktu Mulai</span>
                                        <span class="title-booking-secondary d-block">25 Juni 2024 - 09:00</span>
                                    </div>
                                    <div class="mt-3">
                                        <span class="mb-0 title-booking-three d-block">Lokasi Ambil</span>
                                        <span class="title-booking-secondary d-block">Rental X Mexico Surabaya</span>
                                    </div>
                                    <div class="mt-3">
                                        <span class="mb-0 title-booking-three d-block">Tanggal & Waktu Selesai</span>
                                        <span class="title-booking-secondary d-block">27 Juni 2024 - 09:00</span>
                                    </div>
                                    <div class="mt-3">
                                        <span class="mb-0 title-booking-three d-block">Lokasi Kembali</span>
                                        <span class="title-booking-secondary d-block">Rental X Mexico Surabaya</span>
                                    </div>
                                    <hr class="mb-3 mt-3">
                                    <a href="" class="button-booking border-0 w-100">Lanjutkan</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container mt-4 mb-4">
                        <h4 class="title-booking">Detail Pengemudi</h4>
                        <div class="card p-3">
                            <div class="form-group-title">
                                <label for="" class="form-label title-booking-three">Title</label>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <div class="form-check form-group-transportasi">
                                        <input name="title_pengemudi" class="form-check-input" type="radio" value="Tuan" id="tuan">
                                        <label class="form-check-label title-booking-three" for="tuan">Tuan</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check form-group-transportasi">
                                        <input name="title_pengemudi" class="form-check-input" type="radio" value="Nyonya" id="nyonya">
                                        <label class="form-check-label title-booking-three" for="nyonya">Nyonya</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check form-group-transportasi">
                                        <input name="title_pengemudi" class="form-check-input" type="radio" value="Nona" id="nona">
                                        <label class="form-check-label title-booking-three" for="nona">Nona</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-transportasi mb-3">
                                <label for="nama_pengemudi" class="float-start mb-2 title-booking-three">Nama Lengkap<span class="text-danger">*</span><small>&nbsp;(tanpa gelar dan tanda baca)</small></label>
                                <input type="text" id="nama_pengemudi" name="nama_pengemudi" class="form-control form-control-lg fs-6 mt-1">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-transportasi mb-3">
                                        <label for="no_telp_pengemudi" class="float-start mb-2 title-booking-three">Nomer Telepon<span class="text-danger">*</span></label>
                                        <input type="text" id="no_telp_pengemudi" name="no_telp_pengemudi" class="form-control form-control-lg fs-6 mt-1" placeholder="+62">
                                        <p><small>Contoh: 812345678 dan No. Handphone 0812345678</small></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-transportasi mb-3">
                                        <label for="email_pengemudi" class="float-start mb-2 title-booking-three">Email<span class="text-danger">*</span></label>
                                        <input type="email" id="email_pengemudi" name="email_pengemudi" class="form-control form-control-lg fs-6 mt-1">
                                        <p><small>Contoh: email@example.com</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <h4 class="title-booking">Detail Rental</h4>
                    {{-- @php
                        $motor = stripos($category->name, 'motor') !== false;
                    @endphp --}}
                    <div class="card p-1">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                {{-- @if ($motor)
                                <i class="fas fa-motorcycle fa-lg" style="color: #012970;"></i>
                                <h6 class="titles ms-2 mb-0">Rental Motor</h6>
                                @else
                                <i class="fas fa-car fa-lg" style="color: #012970;"></i>
                                <h6 class="titles ms-2 mb-0">Rental Mobil</h6>
                                @endif --}}
                            </div>
                            <hr class="mb-4 mt-4">
                            {{-- <h6 class="title-book">{{ $transportasi->title }}</h6> --}}
                            <h6 class="title-book">Title</h6>
                            <div class="my-1">
                                {{-- <span class="title-booking-three">{{ $transportasi->jenis }}</span> --}}
                                <span class="title-booking-three">Jenis</span>
                            </div>

                            {{-- @if (!$motor)
                            <div class="my-1">
                                <span class="title-booking-three">{{ $transportasi->layanan }}</span>
                            </div>
                            @if ($transportasi->layanan !== 'Sopir') --}}
                            <div class="my-1">
                                <span class="title-booking-three">Pilih<span class="text-danger">*</span></span>
                            </div>
                            {{-- <div class="row my-1">
                                <div class="col-md-6">
                                    <div class="form-check form-group-transportasi">
                                        <input name="jenis_pemesanan" class="form-check-input" type="radio" value="tanpa_sopir" id="tanpa_sopir" @if ($transportasi->layanan == 'Semua') checked @endif
                                        @if ($transportasi->layanan !== 'Sopir') @endif
                                        required>
                                        <label class="form-check-label title-booking-three" for="tanpa_sopir">Tanpa Sopir</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check form-group-transportasi">
                                        <input name="jenis_pemesanan" class="form-check-input" type="radio" value="lepas_kunci" id="lepas_kunci" @if ($transportasi->layanan == 'Lepas Kunci') checked @endif
                                        @if ($transportasi->layanan !== 'Lepas Kunci') @endif
                                        required>
                                        <label class="form-check-label title-booking-three" for="lepas_kunci">Lepas Kunci</label>
                                    </div>
                                </div>
                            </div> --}}
                            {{-- @endif --}}
                        </div>
                    </div>
                    <div class="card p-1 mt-4">
                        <div class="card-body">
                            <h6 class="title-book">Keterangan</h6>
                            <hr class="mb-3 mt-3">
                            <div class="mt-3">
                                <h6 class="mb-0 ket-booking">Kota/Lokasi Rental</h6>
                                {{-- <span class="title-booking-secondary">{{ $transportasi->alamat }}</span> --}}
                            </div>
                            <div class="mt-3">
                                <h6 class="mb-0 ket-booking">Tanggal & Waktu Mulai</h6>
                                {{-- <span class="title-booking-secondary">{{ \Carbon\Carbon::parse(now())->format('d F Y - H:i') }}</span> --}}
                            </div>
                            <div class="mt-3">
                                <h6 class="mb-0 ket-booking">Lokasi Ambil</h6>
                                {{-- <span class="title-booking-secondary">{{ $transportasi->alamat }}</span> --}}
                            </div>
                            <div class="mt-3">
                                <h6 class="mb-0 ket-booking">Tanggal & Waktu Selesai</h6>
                                {{-- <span class="title-booking-secondary">{{ \Carbon\Carbon::parse(now()->addDays(2))->format('d F Y - H:i') }}</span> --}}
                            </div>
                            <div class="mt-3">
                                <h6 class="mb-0 ket-booking">Lokasi Kembali</h6>
                                {{-- <span class="title-booking-secondary">{{ $transportasi->alamat }}</span> --}}
                            </div>
                            <hr class="mb-3 mt-3">
                            <button type="submit" class="button-booking border-0 w-100">Lanjutkan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection