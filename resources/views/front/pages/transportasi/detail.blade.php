@extends('front.layouts.apps')

@section('content')

@include('front.pages.transportasi.layouts.navbar')

<style>
    .card-info {
        background-color: rgb(236, 248, 255);
        border-color: rgb(1, 148, 243);
    }
    .text-card-info li {
        color: rgb(1, 148, 243);
    }
</style>

<div class="container pb-5">
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <ol class="all mt-3">
                <li><a href="{{ route('front.home') }}" class="title3">Home</a></li>
                <li class="title2">Transportasi</li>
                <li class="title2">Data Diri</li>
                <li class="title2">Review</li>
            </ol>
        </div>
    </section>
    <!-- End Breadcrumbs -->
        
            <div class="container" style="width: 90%;">
                <form action="" method="POST">
                    <input type="hidden" name="" value="">
                        <div class="row">
                            <div class="col-lg-8 mb-4">
                                {{-- <h4 class="title-booking">Pemesanaan Anda</h4>
                                <p class="title-booking-secondary">Isi Data Anda</p>
                                <div class="card p-3 mb-4">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="https://i.ibb.co.com/rmJvBb1/why-1.png" alt="" width="100">
                                        </div>
                                        <div class="col-md-10">
                                            <h5 class="titles ms-3">Masuk / Daftar dan nikmati fitur khusus untuk member BeioN</h5>
                                            <h5 class="titles ms-3">Banyak Promo</h5>
                                        </div>
                                    </div>
                                </div> --}}
                            {{-- <hr class="mt-4 mb-4"> --}}
                        <div class="container pb-3">
                            <h5 class="title-booking">Data Pemesan</h5>
                            <div class="card p-3">
                                <div class="mb-3">
                                    <h6 class="mb-0 ket-booking">Nama</h6>
                                    <span class="title-booking-secondary">Chrislin</span>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="mb-3">
                                            <h6 class="mb-0 ket-booking">No. Handphone</h6>
                                            <span class="title-booking-secondary">+6283834573789</span>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="mb-3">
                                            <h6 class="mb-0 ket-booking">Email</h6>
                                            <span class="title-booking-secondary">zeelink99@gmail.com</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container pb-3">
                            <h5 class="titles">Detail Pengemudi</h5>
                            <div class="card p-3">
                                <div class="mb-3">
                                    <h6 class="mb-0 ket-booking">Nama</h6>
                                    <span class="title-booking-secondary">Tuan Jesi</span>
                                </div>
                                <div class="mb-3">
                                    <h6 class="mb-0 ket-booking">No. Handphone</h6>
                                    <span class="title-booking-secondary">+6283834573789</span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="container pb-3">
                                    <h5 class="titles">Pengambilan</h5>
                                    <div class="card p-3">
                                        <div class="mb-3">
                                            <h6 class="mb-0 ket-booking">Lokasi Ambil</h6>
                                            <span class="title-booking-secondary">Rental X Mexico Surabaya</span>
                                        </div>
                                        <div class="date">
                                            <h6 class="mb-0 ket-booking">Tanggal & Waktu Ambil</h6>
                                            <span class="title-booking-secondary">25 Juni 2024 - 09:00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="container pb-3">
                                    <h5 class="titles">Pengembalian</h5>
                                    <div class="card p-3">
                                        <div class="mb-3">
                                            <h6 class="mb-0 ket-booking">Lokasi Pengembalian</h6>
                                            <span class="title-booking-secondary">Rental X Mexico Surabaya</span>
                                        </div>
                                        <div class="date">
                                            <h6 class="mb-0 ket-booking">Tanggal & Waktu Selesai</h6>
                                            <span class="title-booking-secondary">27 Juni 2024 - 09:00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="container mt-3 mb-3">
                            <h4 class="title-booking">Permintaan Peminjam</h4>
                            <div class="card p-3">
                                <div class="mb-3 form-group-transportasi">
                                    <label for="exampleFormControlTextarea1" class="form-label title-booking-three">Catatan <small>(opsional)</small></label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="charger mobil dll."></textarea>
                                </div>
                            </div>
                        </div> --}}
                        <div class="container mb-3">
                            <h4 class="title-booking">Syarat Rental</h4>
                            <div class="card p-3">
                                <h6 class="mb-0 ket-booking">Centang Semua Syarat Rental</h6>
                                <div class="form-check my-1">
                                    <input type="checkbox" class="form-check-input shadow-none" id="semua" name="semua">
                                    <label class="form-check-label float-start ms-1" for="semua">Pilih Semua</label>
                                </div>
                                <div class="form-check my-1">
                                    <input type="checkbox" class="form-check-input shadow-none" id="semua" name="semua">
                                    <label class="form-check-label float-start ms-1" for="semua">e-KTP/paspor</label><br>
                                    <span class="ms-1 mt-0"><small>Pengemudi harus membagikan kepada penyedia foto e-KTP/paspor mereka.</small></span>
                                </div>
                                <div class="form-check my-1">
                                    <input type="checkbox" class="form-check-input shadow-none" id="semua" name="semua">
                                    <label class="form-check-label float-start ms-1" for="semua">SIM</label><br>
                                    <span class="ms-1 mt-0"><small>Pengemudi harus membagikan kepada penyedia foto SIM mereka. </small></span>
                                    <span class="ms-1 mt-0">
                                        <small>
                                            <ul>
                                                <li>Pengemudi harus berusia antara 18 – 75 tahun.</li>
                                                <li>Pengemudi harus sudah memiliki SIM tersebut selama minimal 1 tahun.</li>
                                            </ul>
                                        </small>
                                    </span>
                                </div>
                                <div class="card p-3 my-3 card-info">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-info-circle"></i>
                                        <h6 class="mb-0 ket-booking ms-2">Informasi Penting</h6>
                                    </div>
                                    <ul class="text-card-info">
                                        <li>Setelah pesanan selesai, penyedia akan menghubungi pengemudi lewat WhatsApp untuk meminta foto dari dokumen di atas.</li>
                                        <li>Penyedia rental dapat meminta syarat tambahan jika penyedia membutuhkan verifikasi tambahan.</li>
                                        <li>Pengemudi harus memenuhi syarat paling lambat 2 jam setelah pemesanan. - Jika tidak, pesanan tidak bisa di-refund jika pengemudi tidak dapat memenuhi syarat.</li>
                                        <li>Pengemudi harus membawa beberapa dokumen asli di atas pada hari pengambilan (tanya penyedia langsung untuk detail lebih lanjut).</li>
                                        <li>Penyedia memiliki hak untuk menolak pesanan jika pengemudi tidak dapat memenuhi persyaratan di atas.</li>
                                    </ul>
                                </div>
                            <h6 class="mb-0 ket-booking">Dengan mengklik semua centang yang ada, saya setuju dengan Syarat & Ketentuan Rental Mobil BeioN.</h6>
                            </div>
                        </div>
                    </div>
                        <div class="col-lg-4">
                            <h4 class="title-booking">Detail Rental</h4>
                            <div class="card p-1">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-car fa-lg" style="color: #012970;"></i>
                                        <h6 class="titles ms-2 mb-0">Rental Mobil Tanpa Sopir</h6>
                                    </div>
                                    <hr class="mb-4 mt-4">
                                    <h6 class="title-book">Honda Brio New</h6>
                                    <div class="mt-1">
                                        <span class="title-booking-three">Manual</span>
                                    </div>
                                    <div class="mt-1">
                                        <span class="title-booking-three">Rental X Mexico Surabaya</span>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-harga p-1 mt-3">
                                <h4 class="titles mb-0">Rincian Harga</h4>
                                    <div class="accordion mt-2" id="accordionExample">
                                        <div class="card accordion-item active">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button type="button" class="accordion-button bg-transparent" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
                                                Harga yang harus dibayar
                                            </button>
                                        </h2>
                                        <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <span>Harga</span>
                                                    <div class="price mt-2 d-flex align-items-center">
                                                        <h4 class="mb-0">Rp 450.000</h4>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <h6 class="mb-0">Total</h6>
                                                    <span id="total">Rp 450.000</span>
                                                </div>
                                                <button href="" class="button-booking border-0 w-100 mt-3 mb-2">Booking Sekarang</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

@endsection