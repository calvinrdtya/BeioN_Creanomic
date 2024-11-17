@extends('front.layouts.front')

@section('title', $title)

@section('content')
    <div class="container">
        <div class="mb-3">
            @forelse ($orderTypes as $type)
                <a href="{{ route('user.order', ['type' => $type['type']]) }}"
                    class="btn btn-sm @if ($type['active']) btn-primary @else btn-light @endif rounded-pill mr-2 mb-2">
                    {{ $type['title'] }} ({{ $type['count'] }})
                </a>
            @empty
            @endforelse
        </div>

        <script>
            function startCountdown(id, seconds) {
                const countdownElement = document.getElementById(id);
                const statusElement = document.getElementById(`status-${id}`);

                function updateCountdown() {
                    const minutes = Math.floor(seconds / 60);
                    const remainingSeconds = seconds % 60;

                    const formattedSeconds = remainingSeconds < 10 ? `0${remainingSeconds}` : remainingSeconds;
                    const formattedMinutes = minutes < 10 ? `0${minutes}` : minutes;

                    const countdown = `${formattedMinutes} menit ${formattedSeconds} detik`;

                    countdownElement.textContent = countdown;

                    if (seconds > 0) {
                        seconds--;
                        countdownElement.style.display = 'block';
                    } else {
                        clearInterval(intervalId);
                        countdownElement.style.display = 'none';
                    }
                }

                const intervalId = setInterval(updateCountdown, 1000);
            }
        </script>

        <div class="card card-body bg-light border-0 p-0">
            <div class="table-responsive">
            <table class="table mb-0">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Invoice</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Status</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td scope="row">
                                <a href="{{ route('user.perlengkapan.payment', $order->uniq_perlengkapan) }}"
                                    class="font-weight-bold">{{ $order->invoice_number }}</a>
                            </td>
                            <td>{{ $order->perlengkapan->title }}</td>
                            <td>{{ $order->grand_total_text }}</td>
                            <td>
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
                                <span class="small" style="display: none"
                                    id="countdown{{ $order->uniq_perlengkapan }}">{{ $order->remaining_time }}</span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('d M, Y') }}</td>
                            <td>
                                <a href="{{ route('user.perlengkapan.payment', $order->uniq_perlengkapan) }}"
                                    class="btn btn-sm btn-primary">Detail</a>
                            </td>
                        </tr>

                        <script>
                            startCountdown(`countdown{{ $order->uniq_perlengkapan }}`, {{ $order->remaining_time }});
                        </script>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada orderan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div></div>
        </div>
    @endsection
