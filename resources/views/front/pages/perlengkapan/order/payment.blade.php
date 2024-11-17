@extends('front.layouts.front-no-sidebar')

@section('title', $title)

@section('breadcrumb')
    <p class="breadcrumbs">
        <span class="mr-2"><a href="index.html">Beranda <i class="fa fa-chevron-right"></i></a></span>
        <span class="mr-2"><a href="{{ route('user.order') }}">Order <i class="fa fa-chevron-right"></i></a></span>
        <span>@yield('title')</span>
    </p>
@endsection

@section('content')
    <div class="card card-body">
        <div class="row">
            <div class="col-lg-6">
                <div>
                    <h6 class="text-dark">Kepada</h6>
                    <p class="mb-0">{{ $order->title . ' ' . $order->first_name . ' ' . $order->last_name }}</p>
                    <p class="mb-0">{{ $order->address }}</p>
                    <p class="mb-0">{{ $order->email }}</p>
                    <p class="mb-0">{{ $order->no_handphone }}</p>
                </div>
            </div>

            <div class="col-lg-6 mt-4 mt-lg-0">
                <div class="mb-4">
                    <h6 class="text-dark">Invoice ID</h6>
                    <p class="mb-0">{{ $order->invoice_number }}</p>
                </div>
                <div class="mb-4">
                    <h6 class="text-dark">Status</h6>

                    @switch($order->payment_status)
                        @case(1)
                            <span class="badge bg-warning text-white">Menunggu Pembayaran</span>
                        @break

                        @case(2)
                            <span class="badge bg-success text-white">Pembayaran Berhasil</span>
                        @break

                        @case(3)
                            <span class="badge bg-secondary text-white">Transaksi Kadaluarsa</span>
                        @break

                        @case(4)
                            <span class="badge bg-danger text-white">Pembayaran Gagal</span>
                        @break

                        @default
                            <span class="badge bg-danger text-white">Order gagal</span>
                    @endswitch
                </div>
            </div>
        </div>

        <div class="mt-3 pt-3">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Durasi</th>
                            <th>Peminjaman</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if ($detail->image)
                                        <img src="{{ asset('img/' . $detail->image) }}" alt="" class="img-fluid"
                                            style="max-width: 50px">
                                    @else
                                        <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image"
                                            class="img-fluid" style="max-width: 50px" />
                                    @endif
                                    <span class="ml-2">{{ $detail->title }}</span>
                                </div>
                            </td>
                            <td>{{ $detail->final_price_text }}</td>
                            <td>{{ $order->durasi_pinjam }} Hari</td>
                            <td>{{ \Carbon\Carbon::parse($order->tgl_pinjam)->translatedFormat('d M, Y') }} s.d.
                                {{ \Carbon\Carbon::parse($order->tgl_pengembalian)->translatedFormat('d M, Y') }}</td>
                            <td>{{ $order->subtotal_text }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row border-top mt-3 pt-3">
            <div class="col-lg-8 mt-3 mb-4 mb-lg-0 ml-2 ml-lg-0">
                <h6 class="font-weight-bold text-dark">Catatan</h6>
                <p class="mb-0">{{ $order->note }}</p>
            </div>

            <div class="col">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td>Subtotal</td>
                            <td class="text-right">{{ $order->subtotal_text }}</td>
                        </tr>
                        <tr>
                            <td>Diskon</td>
                            <td class="text-right">{{ $order->discount }}</td>
                        </tr>
                        <tr class="border-top">
                            <td class="h5">Grand Total</td>
                            <td class="h5 font-weight-bold text-right">{{ $order->grand_total_text }}</td>
                        </tr>

                        @if ($order->payment_status == 1)
                            <tr>
                                <td colspan="2">
                                    <button class="w-100 btn btn-primary my-2" id="pay-button">Bayar</button>
                                    <form action="{{ route('user.perlengkapan.delete', ['order_id' => $order->id]) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin membatalkan order ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-100 btn btn-secondary">Batalkan Order</button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('user.order') }}" class="btn btn-secondary px-4">Kembali</a>
    </div>
@endsection

@section('js')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from previous step
            snap.pay('{{ $order->snap_token }}', {
                // Optional
                onSuccess: function(result) {
                    window.location.href =
                        '{{ route('payment.perlengkapan.success', ['order_id' => $order->id]) }}';
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };
    </script>
@endsection
