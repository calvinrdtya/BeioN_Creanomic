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
            <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                @include('mitra.layouts.navbar')
            </nav>

            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <!-- Basic Bootstrap Table -->
                    @include('mitra.message')
                    <div class="card">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="card-header mb-0">Data Pencairan</h5>
                            <div class="d-flex align-items-center">
                                <div class="nav-item d-flex align-items-center">
                                    <i class="bx bx-search fs-4 lh-0 me-2"></i>
                                    <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..." />
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Invoice</th>
                                        <th>Status</th>
                                        <th>Harga Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse($pencairanPerlengkapans as $perlengkapan)
                                    <tr>
                                        <td>{{ $perlengkapan->id }}</td>
                                        <td>{{ $perlengkapan->first_name }} {{ $perlengkapan->last_name }}</td> <!-- Nama peminjam -->
                                        <td>{{ $perlengkapan->invoice_number }}</td> <!-- Nomor Invoice -->
                                        <td>
                                            <span class="badge bg-label-success">
                                                {{ $perlengkapan->status_booking ?? 'Selesai' }}
                                            </span>
                                        </td>
                                        <td>{{ formatRupiah($perlengkapan->grand_total) }}</td> <!-- Jumlah total -->
                                        <td>
                                            <div class="d-flex">
                                                <!-- Tombol Cairkan -->
                                                {{-- <button id="deleteButton" data-uniq-perlengkapan="{{ $perlengkapan->uniq_perlengkapan }}" class="btn btn-sm btn-outline-primary me-2">
                                                    Cairkan
                                                </button> --}}
                                                <!-- Tombol Lihat Detail -->
                                                <a href="{{ route('mitra.perlengkapan.pencairan.show', $perlengkapan->id) }}" type="button" class="btn btn-sm btn-outline-primary me-2">
                                                    Upload Bukti
                                                </a>
                                                
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6">Tidak ada Data</td>
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
@endsection