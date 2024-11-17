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
                    <h4 class="fw-bold"><a href="{{ route('mitra.sopir') }}"><span class="text-muted fw-light">Sopir / </span></a>Biodata Sopir</h4>

                    <!-- Basic Bootstrap Table -->
                    @include('mitra.message')
                    <div class="card mb-4">
                        <h5 class="card-header">{{ $sopir->mitra->name }}</h5>
                        <!-- Account -->
                        {{-- <div class="card-body">
                          <div class="d-flex align-items-start align-items-sm-center gap-4">
                            @if ($sopir->foto)
                                <img src="{{ asset('img/' . $sopir->foto) }}" alt="sopir foto" width="100">
                            @else
                                Tidak ada Thumbnails
                            @endif
                          </div>
                        </div> --}}
                        <hr class="my-0" />
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <dl class="row mt-2">
                                        <dd class="col-sm-4">Nama</dd>
                                        <dd class="col-sm-8">{{ $sopir->name }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row mt-2">
                                        <dd class="col-sm-4">Usia</dd>
                                        <dd class="col-sm-8">{{ $sopir->usia }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row mt-2">
                                        <dd class="col-sm-4">Foto</dd>
                                        <dd class="col-sm-8">
                                            @if ($sopir->foto)
                                                <img src="{{ asset('img/' . $sopir->foto) }}" alt="sopir foto" width="100">
                                            @else
                                                Tidak ada Thumbnails
                                            @endif
                                        </dd>
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row mt-2">
                                        <dd class="col-sm-4">Status</dd>
                                        <dd class="col-sm-8">
                                            @if ($sopir->status == 1)
                                                <span class="badge bg-label-success me-1">Publish</span>
                                            @else
                                                <span class="badge bg-label-warning me-1">Non Publish</span>
                                            @endif
                                        </dd>
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row mt-2">
                                        <dd class="col-sm-4">KTP</dd>
                                        <dd class="col-sm-8">
                                            @if ($sopir->ktp)
                                                <img src="{{ asset('img/' . $sopir->ktp) }}" alt="sopir foto" width="100">
                                            @else
                                                Tidak ada Thumbnails
                                            @endif
                                        </dd>
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row mt-2">
                                        <dd class="col-sm-4">Alamat</dd>
                                        <dd class="col-sm-8">{{ $sopir->alamat }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row mt-2">
                                        <dd class="col-sm-4">SIM</dd>
                                        <dd class="col-sm-8">
                                            @if ($sopir->sim)
                                                <img src="{{ asset('img/' . $sopir->sim) }}" alt="sopir foto" width="100">
                                            @else
                                                Tidak ada Thumbnails
                                            @endif
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection