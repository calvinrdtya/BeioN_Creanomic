@extends('front.layouts.apps')

@section('content')

<div class="container w-50 py-5">
    <div class="card p-3">
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
                            @switch($order->payment_status)
                                @case(1)
                                    <span class="badge bg-warning">Menunggu Pembayaran</span>
                                    @break
                                @case(2)
                                    <span class="badge bg-success">Pembayaran Berhasil</span>
                                    @break
                                @case(3)
                                    <span class="badge bg-danger">Transaksi Kadaluarsa</span>
                                    @break
                                @case(4)
                                    Pembayaran Gagal
                                    @break
                                @default
                                    Order gagal
                            @endswitch
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-3">
            <h5 class="titles mb-0">Informasi Pemesan</h5>
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
        <div class="my-2">
            <h5 class="titles">Rincian Pembayaran</h5>
            <div class="row p-2">
                <div class="col-md-6 my-1">
                    <span class="title-booking-three d-block">Sub Total</span>
                    <span class="title-booking-secondary d-block text-capitalize">1x {{ $order->perjalanan->title }}</span>
                </div>
                <div class="col-md-6 justify-content-center my-auto text-end my-1">
                    {{-- <p class="ket-booking m-0"></p> --}}
                    {{-- <span class="title-booking-three d-block">Rp {{ number_format($order->subtotal, 2, ',', '.') }}</span> --}}
                    <span class="title-booking-three d-block">Rp {{ number_format($order->subtotal, 0, '.', ',') }}</span>
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
                            <h5 class="price-booking">Rp {{ number_format($order->grand_total, 0, '.', ',') }}</h5>
                            {{-- <h5 class="price-booking">Rp {{ $order->grand_total }}</h5> --}}
                        </div>
                    </div>
                </div>
            </div>
            @if ($order->payment_status == 1)
                <div class="row">
                    <div class="col-md-6">
                        <button class="button-booking w-100 border-0" onclick="window.location.href='{{ route('user.order') }}'">Kembali</button>
                    </div>
                    <div class="col-md-6">
                        <button class="button-booking w-100 border-0" id="pay-button">Bayar</button>
                    </div>
                </div>
            @else
                <div class="col-md-12">
                    <button class="button-booking w-100 border-0" onclick="window.location.href='{{ route('user.order') }}'">Kembali</button>
                </div>
            @endif
        </div>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from previous step
            snap.pay('{{ $order->snap_token }}', {
                // Optional
                onSuccess: function(result) {
                    window.location.href = '{{ route('payment.perjalanan.success', ['perjalanan_id' => $order->id]) }}';
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                // Optional
                onError: function(result) {
                    window.location.href = '{{ route('payment.perjalanan.error', ['perjalanan_id' => $order->id]) }}';
                }
            });
        };
    </script>
@endsection