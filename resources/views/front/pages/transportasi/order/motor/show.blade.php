@extends('front.layouts.apps')

@section('content')

@include('front.pages.perjalanan.layouts.nav')

<style>
    /* .carousel-indicators img{
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
            height: 300px;
            object-fit: cover;
        }
        .carousel-indicators img {
            width: 55px;
            height: auto;
            cursor: pointer;
        }

        ul.timeline-itinerary {
        list-style-type: none;
        position: relative;
        }
        ul.timeline-itinerary:before {
            content: "";
            background: #4154f1;
            display: inline-block;
            position: absolute;
            left: 29px;
            width: 2px;
            height: 100%;
            z-index: 400;
        }
        ul.timeline-itinerary > li {
        margin: 20px 0;
        padding-left: 20px;
        }
        ul.timeline-itinerary > li:before {
            content: " ";
            background: white;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            border: 5px solid #4154f1;
            left: 23px;
            width: 15px;
            height: 15px;
            z-index: 400;
        }
        .carousel-item img {
        width: 100% !important;
        height: auto !important;
        object-fit: cover !important;
    } */
</style>

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
    <div class="container w-75">
        <div class="row">
            <div class="col-md-4 d-flex align-items-center justify-content-center">
                @if ($motor->image)
                    <img src="{{ asset('img/' . $motor->image) }}" alt="motor Image" class="rounded-2" width="70%">
                @else
                    <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image" class="" width="70%">
                @endif
            </div>
            <div class="col-md-4 p-3">
                <h5 class="title-booking">{{ $motor->title }}</h5>
                   <p class="mb-0 title-sub">Disediakan oleh {{ $motor->mitra->name }}</p>
                {{-- <div class="my-2 d-flex align-items-center">
                    <i class="fas fa-map-marker-alt" style="color: #777777"></i>
                    <p class="title-sub mb-0 ms-2 text-capitalize">{{ $motor->mitra->alamat }}</p>
                </div> --}}
                <div class="my-2 d-flex align-items-center">
                    <i class="fas fa-steering-wheel" style="color: #777777"></i>
                    <p class="title-sub mb-0 ms-2">{{ $motor->jenis }}</p>
                </div>
                <div class="m-0 my-2">
                    <p class="mb-0 title-sub">Layanan</p>
                    <span class="badge bg-two mb-0 mr-auto">Jas Hujan & Helm</span>
                    {{-- @if ($vehicle->layanan === 'Semua')
                        <span class="badge bg-two mb-0 mr-auto">Jas Hujan & Helm</span>
                    @elseif ($vehicle->layanan === 'Lepas Kunci')
                        <span class="badge bg-two mb-0 mr-auto">Lepas Kunci</span>
                    @elseif ($vehicle->layanan === 'Sopir')
                        <span class="badge bg-two mb-0 mr-auto">Layanan Sopir</span>
                    @else
                        <span class="badge bg-two mb-0 mr-auto">Layanan Sopir & Lepas Kunci</span>
                    @endif --}}
                    
                    {{-- @if ($motor->refund == 'ya')
                        <span class="badge bg-two mb-0 mr-auto">Bisa Refund</span>
                    @else
                        <span class="badge bg-two mb-0">Tidak Bisa Refund</span>
                    @endif --}}
                </div>
              </div>
                <div class="col-md-4">
                    <div class="card card-price border-0">
                        <div class="card-body my-2">
                            {{-- <h5 class="title-booking">{{ $motor->mitra->name }}</h5> --}}
                            <div class="title-paket d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0 ket-booking">Mulai dari</h6>
                            </div>
                            <form action="{{ route('cart.store') }}" method="POST" id="cartForm">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                <input type="hidden" name="mitra_id" value="{{ $motor->mitra_id }}">
                                <input type="hidden" name="product_id" value="{{ $motor->id }}">
                                <input type="number" name="qty" value="1" class="d-none">
                                <div class="price align-items-center justify-content-end">
                                    @if ($motor->price_discount === null)
                                        <div class="price-end d-flex align-items-center justify-content-end">
                                            <h4 class="mb-0">Rp {{ $motor->final_price }}</h4>
                                            <p class="my-0 title-sub">&nbsp; / Hari</p>
                                        </div>
                                    @else
                                        <h5 class="price-sub mb-0 ms-auto text-decoration-line-through text-end">Rp {{ $motor->price }}</h5>
                                        <div class="price-end d-flex align-items-center justify-content-end">
                                            <h4 class="mb-0">Rp {{ $motor->final_price }}</h4>
                                            <p class="my-0 title-sub">&nbsp; / Hari</p>
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
                                        <button class="button-booking w-100 border-0" id="orderMotor">Pesan</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="my-4 p-2">
                        <p class="mb-0 title-sub">{{ $motor->deskripsi }}</p>
                    </div>
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
                    <div class="mitra-location my-4">
                        <div class="card p-3">
                            <h6 class="title-book">Kantor {{ $motor->mitra->name }}</h6>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3011.296224538637!2d112.19099577357986!3d-7.758882376941602!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e785db731a513df%3A0x653c69574aee55a7!2sQueen%20Rental%20Motor!5e1!3m2!1sid!2sid!4v1722607577548!5m2!1sid!2sid" 
                                width="auto" height="250" class="border-0 rounded-1" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
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
                            <li>Pengajuan reschedule Anda bergantung pada ketersediaan motor.</li>
                            <li>Reschedule tidak dikenakan biaya. Namun, jika ada perbedaan harga rental di antara jadwal baru dan lama, selisih harganya akan ditanggung oleh penumpang.</li>
                        </ul> 
                    </div>
                </div>
            </div>
                </div>
            </div>
        </div>
    </section>

                                

<script>
    // Periksa User apakah sudah login atau belum
    document.getElementById('orderMotor').addEventListener('click', function(event) {
        event.preventDefault();
        @if (Auth::check())
            window.location.href = '{{ route('motor.booking', $motor->id) }}';
        @else
            window.location.href = '{{ route('account.login') }}';
        @endif
    });
</script>
@endsection