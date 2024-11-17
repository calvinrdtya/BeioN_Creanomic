@extends('mitra.layouts.app')

@section('content')
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                @include('mitra.layouts.sidebar')
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    @include('mitra.layouts.navbar')
                </nav>

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h4 class="fw-bold">Drop Off</h4>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalScan">Scan</button>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="card-header mb-0">Informasi Drop Off</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="nav-item d-flex align-items-center">
                                                <i class="bx bx-search fs-4 lh-0 me-2"></i>
                                                <input type="text" class="form-control border-0 shadow-none"
                                                    placeholder="Search..." aria-label="Search..." />
                                            </div>
                                        </div>
                                    </div>

                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <div class="table-responsive text-nowrap">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>Jenis Sampah</th>
                                                        <th>Quantity</th>
                                                        <th>Point</th>
                                                        <th>Tanggal</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                    @forelse ($histories as $history)
                                                        <tr>
                                                            <td>{{ $history->invoice_id }}</td>
                                                            <td>{{ $history->user->name }}</td>
                                                            <td>{{ $history->title }}</td>
                                                            <td>{{ $history->quantity_text }}</td>
                                                            <td>{{ $history->point_text }}</td>
                                                            <td>{{ $history->created_at }}</td>
                                                            <td>{!! $history->status_badge !!}</td>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalScan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalScanLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalScanLabel">Arahkan Kamera ke QR Code</h1>
                </div>
                <div class="modal-body">
                    <div id="reader" class="w-100"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            const userConfirmed = confirm("Permintaan dropoff ditemukan, lanjutkan?");

            if (userConfirmed) {
                window.location.href = decodedText;
            }
        }

        function onScanError(errorMessage) {
            console.log("Scan error:", errorMessage);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: 350,
            });

        html5QrcodeScanner.render(onScanSuccess, onScanError);
    </script>
@endsection
