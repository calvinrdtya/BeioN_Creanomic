@extends('front.layouts.front-no-sidebar')

@section('title', $title)

@section('breadcrumb')
    <p class="breadcrumbs">
        <span class="mr-2"><a href="index.html">Beranda <i class="fa fa-chevron-right"></i></a></span>
        <span class="mr-2"><a href="{{ route('front.ecotourism') }}">Ecotourism <i
                    class="fa fa-chevron-right"></i></a></span>
        <span>@yield('title')</span>
    </p>
@endsection

@section('content')
    <div>
        <div class="heading-section ftco-animate d-flex align-items-center fadeInUp ftco-animated mb-4">
            <div>
                <h2>@yield('title')</h2>
            </div>
        </div>

        <div class="card card-body pb-0">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive text-nowrap">
                <table class="table table-borderless">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Jenis Sampah</th>
                            <th>Quantity</th>
                            <th>Point</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($histories as $history)
                            <tr>
                                <td>{{ $history->invoice_id }}</td>
                                <td>{{ $history->title }}</td>
                                <td>{{ $history->quantity_text }}</td>
                                <td>{{ $history->point_text }}</td>
                                <td>{{ $history->created_at }}</td>
                                <td>{!! $history->status_badge !!}</td>
                                <td>
                                    @if ($history->qr_code)
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#modalQrCode{{ $history->id }}">
                                            Lihat QR Code
                                        </button>

                                        <div class="modal fade" id="modalQrCode{{ $history->id }}" tabindex="-1"
                                            aria-labelledby="modalQrCodeLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalQrCodeLabel">Tunjukkan QR Code
                                                            Kepada
                                                            Mitra</h5>
                                                    </div>
                                                    <div class="modal-body p-5">
                                                        {!! $history->qr_code !!}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .modal-body svg {
            width: 100% !important;
            height: auto !important;
        }
    </style>
@endsection

@section('js')
    <script>
        function getQueryParameter(param) {
            var urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        function updateQueryStringParameterAndReload(key, value) {
            var url = new URL(window.location.href);
            url.searchParams.set(key, value);
            window.location.href = url.toString();
        }

        var method = getQueryParameter('method');
        var category = getQueryParameter('category');

        if (method) {
            document.getElementById('method-select').value = method;
        }

        document.getElementById('method-select').addEventListener('change', function() {
            var selectedMethod = this.value;
            updateQueryStringParameterAndReload('method', selectedMethod);
        });

        document.querySelectorAll('a[href^="?category"]').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                var selectedCategory = this.getAttribute('href').split('=')[1];
                updateQueryStringParameterAndReload('category', selectedCategory);
            });
        });
    </script>
@endsection
