@extends('front.layouts.app')

@section('content')

<!-- main -->
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <ol class="all">
                <li><a href="{{ route("front.home") }}" class="title3">Home</a></li>
                <li class="title2">Keranjang</li>
            </ol>
        </div>
    </section>
    <!-- End Breadcrumbs -->

    <section class="inner-page">
        <div class="container w-75">
            {{-- <div class="row"> --}}
                @if (Session::has('success'))
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {!! Session::get('success') !!}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="col-md-12">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card p-3">
                                <div class="row justify-content-center align-items-center mb-2">
                                    <div class="col-md-12 text-center">
                                        <img src="{{ asset('front-assets/img/male.png') }}" alt="Profile" width="50" class="rounded-circle mb-3">
                                        <h6>{{ auth()->user()->name }}</h6>
                                        <h6>{{ auth()->user()->email }}</h6>
                                        <h6>{{ auth()->user()->phone }}</h6>
                                        {{-- <h6><strong>Chrislin</strong></h6> --}}
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <p class="mb-0">14</p>
                                        <h5 class="ket-booking">Review</h5>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <p class="mb-0">0</p>
                                        <h5 class="ket-booking">Foto</h5>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <p class="mb-0">2</p>
                                        <h5 class="ket-booking">Like</h5>
                                    </div>
                                </div>
                                <div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link text-start active" id="pesanan-saya-tab" data-bs-toggle="pill" href="#pesanan-saya" role="tab" aria-controls="pesanan-saya" aria-selected="true">
                                        Pesanan Saya
                                    </a>
                                    {{-- <a class="nav-link text-start" id="semua-tab" data-bs-toggle="pill" href="#semua" role="tab" aria-controls="semua" aria-selected="true">
                                        Semua
                                    </a>
                                    <a class="nav-link text-start" id="riwayat-tab" data-bs-toggle="pill" href="#riwayat" role="tab" aria-controls="riwayat" aria-selected="true">
                                        Riwayat
                                    </a>
                                    <a class="nav-link text-start" id="akun-tab" data-bs-toggle="pill" href="#akun" role="tab" aria-controls="akun" aria-selected="true">
                                        Akun
                                    </a> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            {{-- <div class="card p-3"> --}}
                                <div class="tab-content" id="tab-pesanan">
                                    <div class="tab-pane fade show active" id="semua" role="tabpanel" aria-labelledby="semua-tab">
                                        <div class="accordion accordion-flush" id="accordion-pesanan">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    @foreach($orders as $order)
                                                        <button class="accordion-button border-1" type="button" data-bs-toggle="collapse" data-bs-target="#flush-pesanan" aria-expanded="false" aria-controls="flush-pesanan">
                                                            Invoice<strong class="ms-1">{{ $order->invoice_number }}</strong>
                                                        </button>
                                                    @endforeach
                                                </h2>
                                                    <div id="flush-pesanan" class="accordion-collapse collapse" data-bs-parent="#accordion-pesanan">
                                                        @foreach($orders as $order)
                                                            <div class="accordion-body">
                                                                <div class="row">
                                                                    <div class="col-md-5">
                                                                        @if ($order->perjalanan->thumbnail)
                                                                            <img src="{{ asset('img/' . $order->perjalanan->thumbnail) }}" alt="Perjalanan Image" class="rounded-2 h-auto" width="95%">
                                                                        @else
                                                                            <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image"/>
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <h5 class="title-booking">{{ $order->perjalanan->title }}</h5>
                                                                        <div class="row mt-2 mb-2">
                                                                            <div class="col-sm-7">
                                                                                <div class="my-1">
                                                                                    <span class="title-booking-three d-block">Durasi Perjalanan</span>
                                                                                    <span class="title-booking-secondary d-block text-capitalize">{{ $order->perjalanan->durasi }}</span>
                                                                                </div>
                                                                                <div class="my-1">
                                                                                    <span class="title-booking-three d-block">Tanggal Perjalanan</span>
                                                                                    <span class="title-booking-secondary d-block text-capitalize">{{ \Carbon\Carbon::parse($order->perjalanan->tgl_perjalanan)->translatedFormat('d F Y') }}</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <div class="my-1">
                                                                                    <span class="title-booking-three d-block">Kota</span>
                                                                                    <span class="title-booking-secondary d-block text-capitalize">{{ $order->perjalanan->kota }}</span>
                                                                                </div>
                                                                                <div class="my-1">
                                                                                    <span class="title-booking-three d-block">Status</span>
                                                                                    @if ($order->perjalanan->status == 1)
                                                                                        <span class="badge bg-warning">Belum Dibayar</span>
                                                                                    @else
                                                                                        <span class="badge bg-first">Pembayaran Berhasil</span>
                                                                                    @endif
                                                                                </div>
                                                                                {{-- <span class="badge bg-warning ms-2">{{ $order->perjalanan->status }}</span> --}}
                                                                                {{-- <div class="my-1">
                                                                                    <span class="title-booking-three d-block">Qty</span>
                                                                                    <span class="title-booking-secondary d-block text-capitalize">1 Orang</span>
                                                                                </div> --}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-4">
                                                                    <h5 class="titles">Informasi Pemesan</h5>
                                                                    <div class="row p-2">
                                                                        <div class="col-md-6">
                                                                            <span class="title-booking-three d-block">Nama</span>
                                                                            <div class="d-flex align-items-center">
                                                                                <span class="title-booking-secondary d-block text-capitalize">{{ $order->title }}&nbsp;</span>
                                                                                <span class="title-booking-secondary d-block text-capitalize">{{ $order->first_name }}&nbsp;</span>
                                                                                {{-- <span class="title-booking-secondary d-block text-capitalize">{{ $order->last_name }}</span> --}}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 text-end">
                                                                            <span class="title-booking-three d-block">No. Handphone</span>
                                                                            <span class="title-booking-secondary d-block">{{ $order->no_handphone }}</span>
                                                                        </div>
                                                                        <div class="col-md-6 mt-2">
                                                                            <div class="my-1">
                                                                                <span class="title-booking-three d-block">Email</span>
                                                                                <span class="title-booking-secondary d-block">{{ $order->email }}</span>
                                                                            </div>
                                                                            <div class="my-1">
                                                                                <span class="title-booking-three d-block">Alamat</span>
                                                                                <span class="title-booking-secondary d-block">{{ $order->alamat }}</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 mt-2 text-end">
                                                                            <span class="title-booking-three d-block">Invoice</span>
                                                                            <span class="title-booking-secondary d-block">{{ $order->invoice_number }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="detail-pembayaran mt-4">
                                                                    <h5 class="titles">Rincian Pembayaran</h5>
                                                                    <div class="row p-2">
                                                                        <div class="col-md-6 my-1">
                                                                            <span class="title-booking-three d-block">Sub Total</span>
                                                                            <span class="title-booking-secondary d-block text-capitalize">1x {{ $order->perjalanan->title }}</span>
                                                                        </div>
                                                                        <div class="col-md-6 justify-content-center my-auto text-end my-1">
                                                                            <p class="ket-booking m-0">Rp {{ $order->subtotal }}</p>
                                                                        </div>
                                                                        <div class="col-md-6 my-1">
                                                                            <span class="title-booking-three d-block">Diskon</span>
                                                                        </div>
                                                                        <div class="col-md-6 justify-content-center my-auto text-end" my-1>
                                                                            <p class="ket-booking m-0">-</p>
                                                                            {{-- <h5 class="title-booking-secondary">IDR 144.000</h5> --}}
                                                                        </div>
                                                                        <div class="my-3">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    {{-- <h5 class="ket-booking m-0">Total</h5> --}}
                                                                                    <span class="title-booking-three d-block">Total</span>
                                                                                </div>
                                                                                <div class="col-md-6 text-end">
                                                                                    {{-- <h5 class="price-booking">Rp {{ number_format($order->grand_total, 2, ',', '.') }}</h5> --}}
                                                                                    <h5 class="price-booking">Rp {{ $order->grand_total }}</h5>
                                                                                </div>
                                                                            </div>
                                                                        </div>24
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <button class="button-booking w-100 border-0">Cancel</button>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <button class="button-booking w-100 border-0" onclick="window.location.href='{{ route('front.order.detail', ['order_id' => $order->id]) }}'">Lihat</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    {{-- <div class="tab-pane fade show" id="pesanan-saya" role="tabpanel" aria-labelledby="pesanan-saya-tab">
                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                        ID Pesanan<strong class="ms-1">3123500002</strong>
                                                    </button>
                                                </h2>
                                                    <div id="flush-collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <img src="../assets/img/homestay/1.svg" alt="" width="100%" class="rounded-3">
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <h5 class="titles">1x Kamar Hunian Single</h5>
                                                                <div class="row mt-2 mb-2">
                                                                    <div class="col-sm-6">
                                                                        <p class="ket-booking m-0">CHECK IN</p>
                                                                        <h5 class="title-booking-secondary">12-10-2024</h5>
                                                                        <p class="ket-booking m-0">EMAIL</p>
                                                                        <h5 class="title-booking-secondary">chrislin@gmail.com</h5>
                                                                        <p class="ket-booking m-0">KETERANGAN</p>
                                                                        <span class="badge text-bg-success">Selesai</span>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <p class="ket-booking m-0">CHECK OUT</p>
                                                                        <h5 class="title-booking-secondary">13-10-2024</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            <div class="mt-4">
                                                                <h5 class="titles">Informasi Tamu</h5>
                                                                <div class="row p-2">
                                                                    <div class="col-md-6">
                                                                        <p class="ket-booking m-0">NAMA TAMU</p>
                                                                        <h5 class="ket-booking">a.n Chrislin</h5>
                                                                    </div>
                                                                    <div class="col-md-6 text-end">
                                                                        <p class="ket-booking m-0">TAMU</p>
                                                                        <h5 class="ket-booking">2 Dewasa</h5>
                                                                    </div>
                                                                    <div class="col-md-6 mt-2">
                                                                        <p class="ket-booking m-0">NOMER KONTAK</p>
                                                                        <h5 class="ket-booking">083834573748</h5>
                                                                    </div>
                                                                    <div class="col-md-6 mt-2 text-end">
                                                                        <p class="ket-booking m-0">ID PEMESANAN</p>
                                                                        <h5 class="ket-booking">CHR00987</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="detail-pembayaran mt-4">
                                                                <h5 class="titles">Detail Pembayaran</h5>
                                                                <div class="row p-2">
                                                                    <div class="col-md-6">
                                                                        <p class="ket-booking m-0">TIPE</p>
                                                                        <h5 class="ket-booking">1x Kamar Hunian Single</h5>
                                                                    </div>
                                                                    <div class="col-md-6 text-end">
                                                                        <p class="ket-booking m-0">HARGA</p>
                                                                        <h5 class="ket-booking">IDR 144.000</h5>
                                                                    </div>
                                                                </div>
                                                                <div class="row p-2">
                                                                    <div class="col-md-6">
                                                                        <p class="ket-booking m-0">TANGGAL</p>
                                                                        <h5 class="ket-booking">29-05-2024</h5>
                                                                    </div>
                                                                    <div class="col-md-6 text-end">
                                                                        <p class="ket-booking m-0">SUB HARGA</p>
                                                                        <h5 class="ket-booking">IDR 144.000</h5>
                                                                        <h5 class="ket-booking">- </h5>
                                                                    </div>
                                                                    <div class="col-md-12 text-end">
                                                                        <h5 class="ket-booking m-0">TOTAL</h5>
                                                                        <h5 class="price-booking">IDR 144.000</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                    <div class="tab-pane fade show" id="riwayat" role="tabpanel" aria-labelledby="riwayat-tab">
                                        
                                    </div>
                                </div>
                            {{-- </div> --}}
                        </div>
                    </div>

        </div>
    </section>       

</main>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        const payButton = document.querySelector('#pay-button');
        payButton.addEventListener('click', function(e) {
            e.preventDefault();

            snap.pay('{{ $order_perjalanans->snap_token }}', {
                // Optional
                onSuccess: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                }
            });
        });
    </script>
<!-- End #main -->
@endsection

@section('scripts')
    
@endsection