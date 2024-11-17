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
                    <h4 class="fw-bold"><a href="{{ route('mitra.motor') }}"><span class="text-muted fw-light">Motor / </span></a>Detail</h4>

                    <!-- Basic Bootstrap Table -->
                    @include('mitra.message')
                    <div class="card mb-4">
                        <h5 class="card-header">{{ $motor->mitra->name }}</h5>
                        <!-- Account -->
                        <div class="card-body">
                          <div class="d-flex align-items-start align-items-sm-center gap-4">
                            @if ($motor->image)
                                <img src="{{ asset('img/' . $motor->image) }}" alt="motor Image" width="100">
                            @else
                                Tidak ada Thumbnails
                            @endif
                          </div>
                        </div>
                        <hr class="my-0" />
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <dl class="row mt-2">
                                        <dd class="col-sm-4">Title</dd>
                                        <dd class="col-sm-8">{{ $motor->title }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row mt-2">
                                        <dd class="col-sm-4">Status</dd>
                                        <dd class="col-sm-8">
                                            @if ($motor->status == 1)
                                                <span class="badge bg-label-success me-1">Publish</span>
                                            @else
                                                <span class="badge bg-label-warning me-1">Non Publish</span>
                                            @endif
                                        </dd>
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row mt-2">
                                        <dd class="col-sm-4">Kategori</dd>
                                        <dd class="col-sm-8">{{ $motor->category->name }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row mt-2">
                                        <dd class="col-sm-4">Jenis</dd>
                                        <dd class="col-sm-8">{{ $motor->jenis }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row mt-2">
                                        <dd class="col-sm-4">Stok</dd>
                                        <dd class="col-sm-8">
                                            @if($motor->qty)
                                                {{ $motor->qty }}
                                            @else
                                                <span class="badge bg-label-warning me-1">Kosong</span>
                                            @endif
                                        </dd>
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row mt-2">
                                        <dd class="col-sm-4">Diskon</dd>
                                        <dd class="col-sm-8">
                                            @if ($motor->price_discount == null || $motor->price_discount == 0)
                                                <span class="badge bg-label-warning me-1">Tidak Ada Diskon</span>
                                            @else
                                                <span class="badge bg-label-success me-1">{{ $motor->price_discount  }}%</span>
                                            @endif
                                        </dd>
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row mt-2">
                                        <dd class="col-sm-4">Harga</dd>
                                        <dd class="col-sm-8">{{ $motor->final_price }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row mt-2">
                                        <dd class="col-sm-4">Harga Asli</dd>
                                        <dd class="col-sm-8">{{ $motor->price }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row mt-2">
                                        <dd class="col-sm-4">Alamat</dd>
                                        <dd class="col-sm-8">{{ $motor->mitra->alamat }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row mt-2">
                                        <dd class="col-sm-4">Deskripsi</dd>
                                        <dd class="col-sm-8">{{ $motor->deskripsi }}</dd>
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