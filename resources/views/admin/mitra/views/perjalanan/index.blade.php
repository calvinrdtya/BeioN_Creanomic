@extends('admin.layouts.app')

@section('content')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        <!-- Menu -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            @include('admin.layouts.sidebar')
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->
            <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                @include('admin.layouts.navbar')
            </nav>

            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold"><span class="text-muted fw-light">Perjalanan / </span>Mitra</h4>

                    <!-- Basic Bootstrap Table -->
                    @include('admin.message')
                    <div class="card">
                        <div class="d-flex align-items-center">
                            <h5 class="card-header">Data Mitra</h5>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Thumbnail</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Nomer Telepon</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($mitras as $index => $mitra)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <img src="{{ asset('admin/img/logo-hitam.svg') }}" class="rounded-4" alt="{{ $mitra->name }}" width="70">
                                        </td>
                                        <td>{{ $mitra->name }}</td>
                                        <td>{{ $mitra->email }}</td>
                                        <td>{{ $mitra->phone }}</td>
                                        <td>
                                            <span class="badge bg-label-{{ $mitra->status == 1 ? 'success' : 'danger' }} rounded-pill">
                                                {{ $mitra->status == 1 ? 'Aktif' : 'Tidak Aktif' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.mitra.perjalanan.detail', $mitra->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                                <i class='bx bxs-user-detail'></i>&nbsp; Detail
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection