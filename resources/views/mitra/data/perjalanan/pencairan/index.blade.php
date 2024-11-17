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
                    <h4 class="fw-bold">Pencairan Dana</h4>

                    <!-- Basic Bootstrap Table -->
                    @include('mitra.message')
                        <div class="card">
                            {{-- <div class="d-flex align-items-center">
                                <h5 class="card-header">Data Perjalanan</h5>
                                <a href="{{ route('mitra.perjalanan.create') }}" class="btn btn-sm btn-primary">
                                    Add Perjalanan
                                </a>
                            </div> --}}
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="card-header mb-0">Data Pencairan</h5>
                                <div class="d-flex align-items-center">
                                    {{-- <a href="" class="btn btn-sm btn-primary me-3">
                                        Tambah Perjalanan
                                    </a> --}}
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
                                            <th>No</th>
                                            <th>Produk</th>
                                            <th>Hari Tanggal</th>
                                            <th>Nominal</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <tr>
                                            <td></td>
                                        </tr>
                                        {{-- @forelse($perjalanans as $index => $perjalanan)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                @if ($perjalanan->thumbnail)
                                                    <img src="{{ asset('img/' . $perjalanan->thumbnail) }}" alt="Perjalanan Image" width="100">
                                                @else
                                                    No Image Available
                                                @endif
                                            </td>
                                            <td>{{ $perjalanan->title }}</td>
                                            <td>{{ $perjalanan->category->name }}</td>
                                            <td>{{ $perjalanan->durasi }}</td>
                                            <td>{{ $perjalanan->final_price }}</td>
                                            <td>{{ $perjalanan->price_discount }}%</td>
                                            <td>
                                                @if ($perjalanan->shipping_return == 1)
                                                    <span class="badge bg-label-success">Ya</span>
                                                @else
                                                    <span class="badge bg-label-danger">Tidak</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($perjalanan->status == 1)
                                                    <span class="badge bg-label-success">Publish</span>
                                                @else
                                                    <span class="badge bg-label-danger">Non Publish</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('mitra.perjalanan.detail', ['perjalananId' => $perjalanan->id]) }}" type="button" class="btn btn-sm btn-outline-primary me-2">
                                                        <i class='bx bx-search-alt-2'></i>
                                                    </a>
                                                    <button data-bs-toggle="modal" data-bs-target="#editPerjalanan{{ $perjalanan->id }}" type="button" class="btn btn-sm btn-outline-primary me-2" data-perjalanan-id="{{ $perjalanan->id }}">
                                                        <span class="bx bx-edit-alt"></span>&nbsp; Edit
                                                    </button>
                                                    <form id="delete-form-{{ $perjalanan->id }}" action="{{ route('mitra.perjalanan.destroy', $perjalanan->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger"><span class="bx bx-trash"></span>&nbsp; Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="9">Data Tidak Ada</td>
                                        </tr>
                                        @endforelse --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="content-backdrop fade"></div>
</div>

@endsection