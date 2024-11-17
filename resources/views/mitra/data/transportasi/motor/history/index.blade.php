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
                            <h5 class="card-header mb-0">Data History Booking</h5>
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
                                    @forelse($historyMotors as $history)
                                    <tr>
                                        <td>{{ $history->id }}</td>
                                        <td>{{ $history->first_name }}</td>
                                        <td>{{ $history->invoice_number }}</td>
                                        <td>
                                            <span class="badge bg-label-success">Selesai</span>
                                        </td>
                                        <td>{{ formatRupiah($history->grand_total) }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <button id="deleteButton" data-uniq-motor="{{ $history->uniq_motor }}" class="btn btn-sm btn-outline-primary me-2">
                                                    Cairkan
                                                </button>                                               
                                                <a href="{{ route('mitra.motor.history.booking.detail', $history->id) }}" type="button" class="btn btn-sm btn-outline-primary me-2">
                                                    <i class='bx bx-search-alt-2'></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>   
                                    @empty
                                        <tr>
                                            <td>
                                                Tidak ada Data
                                            </td>
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