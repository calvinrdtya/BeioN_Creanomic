@extends('front.layouts.apps')

@section('content')

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
    <section class="breadcrumbs" style="margin-top: 30px !important">
        <div class="container">
            <a href="{{ route('front.home') }}" class="logo">
                <img src="https://i.ibb.co.com/zHsZVdf/logo-hitam.png" alt="logo" width="10%">
            </a>
            <ol class="all mt-3">
                <li><a href="{{ route('front.home') }}" class="ket-booking">Home</a></li>
                <li class="ket-booking">Transportasi</li>
                <li class="ket-booking">Booking</li>
                <li class="ket-booking">Data Diri</li>
                <li class="title3">Review</li>
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
                                    <h6 class="mb-0 title-book">Nama</h6>
                                    <span class="title-booking-secondary">Chrislin</span>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="mb-3">
                                            <h6 class="mb-0 title-book">No. Handphone</h6>
                                            <span class="title-booking-secondary">+6283834573789</span>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="mb-3">
                                            <h6 class="mb-0 title-book">Email</h6>
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
                                    <h6 class="mb-0 title-book">Nama</h6>
                                    <span class="title-booking-secondary">Tuan Jesi</span>
                                </div>
                                <div class="mb-3">
                                    <h6 class="mb-0 title-book">No. Handphone</h6>
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
                                            <h6 class="mb-0 title-book">Lokasi Ambil</h6>
                                            <span class="title-booking-secondary">Rental X Mexico Surabaya</span>
                                        </div>
                                        <div class="date">
                                            <h6 class="mb-0 title-book">Tanggal & Waktu Ambil</h6>
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
                                            <h6 class="mb-0 title-book">Lokasi Pengembalian</h6>
                                            <span class="title-booking-secondary">Rental X Mexico Surabaya</span>
                                        </div>
                                        <div class="date">
                                            <h6 class="mb-0 title-book">Tanggal & Waktu Selesai</h6>
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
                                    <label class="form-check-label float-start ms-1" for="semua">e-KTP/paspor<span class="text-danger">*</span></label><br>
                                    <span class="ms-1 mt-0"><small>Pengemudi memiliki dokumen identitas berupa KTP/SIM/PASPOR untuk proses verifikasi.</small></span>
                                </div>
                                <div class="form-check my-1">
                                    <input type="checkbox" class="form-check-input shadow-none" id="semua" name="semua">
                                    <label class="form-check-label float-start ms-1" for="semua">SIM<span class="text-danger">*</span></label><br>
                                    <span class="ms-1 mt-0"><small>Pengemudi harus membagikan kepada penyedia foto SIM mereka. </small></span>
                                    <span class="ms-1 mt-0 mb-0">
                                        <small>
                                            <ul class="mb-0">
                                                <li>Pengemudi berusia minimal 18 tahun dan memiliki SIM yang masih berlaku.</li>
                                                <li>Pengemudi harus sudah memiliki SIM tersebut selama minimal 1 tahun.</li>
                                            </ul>
                                        </small>
                                    </span>
                                </div>
                                <div class="form-check my-1">
                                    <input type="checkbox" class="form-check-input shadow-none" id="semua" name="semua">
                                    <label class="form-check-label float-start ms-1" for="semua">Pengemudi tidak sedang dalam pengaruh alkohol/narkoba.<span class="text-danger">*</span></label>
                                </div>
                                <div class="form-check my-1">
                                    <input type="checkbox" class="form-check-input shadow-none" id="semua" name="semua">
                                    <label class="form-check-label float-start ms-1" for="semua">Pengemudi bertanggung jawab atas segala pelanggaran lalu lintas dan denda yang terjadi selama masa sewa.<span class="text-danger">*</span></label>
                                </div>
                                <div class="card p-3 my-3 card-info">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-info-circle"></i>
                                        <h6 class="mb-0 ket-booking ms-2">Informasi Penting</h6>
                                    </div>
                                    <ul class="text-card-info">
                                        <li>Saat transaksi selesai, pihak penyedia layanan akan menghubungi Anda melalui pesan WhatsApp.</li>
                                        <li>Penyedia jasa akan meminta dokumen diatas untuk proses verifikasi.</li>
                                        <li>Syarat tambahan akan di informasikan oleh penyedia layanan.</li>
                                        <li>Dokumen (asli) di atas harus dibawa saat pengambilan kendaraan (hubungi penyedia lebih lanjut untuk detail informasi lebih lanjut</li>
                                        <li>Batas toleransi untuk memenuhi syarat diatas paling lambat 2 jam setelah waktu yang Anda tentukan dalam proses pemesanan. Jika tidak, pesanan tidak bisa di refund apabila syarat diatas tidak terpenuhi.</li>
                                        <li>Penyedia layanan berhak membatalkan pesanan, apabila syarat dan ketentuan di atas tidak terpenuhi.</li>
                                    </ul>
                                </div>
                                <h6 class="mb-0 ket-booking">Dengan menekan tombol konfirmasi, saya setuju dengan Syarat & Ketentuan di atas.</h6>
                                <button href="" class="button-booking border-0 w-100 mt-3 mb-2">Konfirmasi</button>
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
                                                    <span class="ket-booking">Harga</span>
                                                    <div class="price mt-2 d-flex align-items-center">
                                                        <h4 class="mb-0">Rp 450.000</h4>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <h6 class="mb-0 title-booking-three">Total</h6>
                                                    <span id="total">Rp 450.000</span>
                                                </div>
                                                <button href="" class="button-booking border-0 w-100 mt-3 mb-2">Bayar</button>
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