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
            {{-- <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                @include('mitra.layouts.navbar')
            </nav> --}}

            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold"><a href="{{ route('mitra.perjalanan.order') }}"><span class="text-muted fw-light">Order / </span></a>Detail</h4>

                    <!-- Basic Bootstrap Table -->
                    @include('mitra.message')
                    <div class="card mb-4">
                        <h5 class="card-header d-flex align-items-center">{{ $order_perjalanan->invoice_number }}</h5>
                        <!-- Account -->
                        <div class="card-body">
                            @if ($order_perjalanan->perjalanan->thumbnail)
                                <img src="{{ asset('img/' . $order_perjalanan->perjalanan->thumbnail) }}" alt="Order Perjalanan Image" class="img-fluid" width="30%">
                            @else
                                <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Order Perjalanan Image" class="img-fluid">
                            @endif
                        </div>
                        <hr class="my-0" />
                        <div class="card-body">
                            <h5 class="m-0">Informasi Pemesan</h5>
                            <div class="p-2">
                                <div class="col-md-12">
                                    <dl class="row my-2">
                                        <dd class="col-sm-4">Nama</dd>
                                        <dd class="col-sm-8">{{ $order_perjalanan->title }}&nbsp;{{ $order_perjalanan->first_name }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-12">
                                    <dl class="row my-2">
                                        <dd class="col-sm-4">No. Handphone</dd>
                                        <dd class="col-sm-8">{{ $order_perjalanan->no_handphone }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-12">
                                    <dl class="row my-2">
                                        <dd class="col-sm-4">Email</dd>
                                        <dd class="col-sm-8">{{ $order_perjalanan->email }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-12">
                                    <dl class="row my-2">
                                        <dd class="col-sm-4">Alamat</dd>
                                        <dd class="col-sm-8">{{ $order_perjalanan->alamat_lengkap }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-12">
                                    <dl class="row my-2">
                                        <dd class="col-sm-4">Titik Penjemputan</dd>
                                        <dd class="col-sm-8">{{ $order_perjalanan->meeting_points }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-12">
                                    <dl class="row my-2">
                                        <dd class="col-sm-4">Jenis Paket</dd>
                                        <dd class="col-sm-8">
                                            @if ($order_perjalanan->perjalanan->jenis === 'ya')
                                                <span class="badge bg-label-primary">Open</span>
                                            @else
                                                <span class="badge bg-label-dark">Private</span>
                                            @endif
                                        </dd>
                                    </dl>                                    
                                </div>
                            </div>
                            <h5 class="m-0">Informasi Paket</h5>
                                <div class="p-2">
                                    <div class="col-md-12">
                                        <dl class="row my-2">
                                            <dd class="col-sm-4">Nama Paket</dd>
                                            <dd class="col-sm-8">{{ $order_perjalanan->perjalanan->title }}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-12">
                                        <dl class="row my-2">
                                            <dd class="col-sm-4">Tanggal Perjalanan</dd>
                                            <dd class="col-sm-8">{{ \Carbon\Carbon::parse($order_perjalanan->perjalanan->tgl_perjalanan)->translatedFormat('d F Y') }}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-12">
                                        <dl class="row my-2">
                                            <dd class="col-sm-4">Durasi Perjalanan</dd>
                                            <dd class="col-sm-8">{{ $order_perjalanan->perjalanan->durasi }}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-12">
                                        <dl class="row my-2">
                                            <dd class="col-sm-4">Kota</dd>
                                            <dd class="col-sm-8">{{ $order_perjalanan->perjalanan->kota }}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-12">
                                        <dl class="row my-2">
                                            <dd class="col-sm-4">Deskripsi</dd>
                                            <dd class="col-sm-8">{{ $order_perjalanan->perjalanan->deskripsi }}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-12">
                                        <dl class="row my-2">
                                            <dd class="col-sm-4">Fasilitas</dd>
                                            <dd class="col-sm-8">{{ $order_perjalanan->perjalanan->fasilitas }}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-12">
                                        <dl class="row my-2">
                                            <dd class="col-sm-4">Include (Paket Sudah Termasuk)</dd>
                                            @php
                                                $items = explode(',', $order_perjalanan->perjalanan->include);
                                            @endphp
                                            <dd class="col-sm-8">
                                                @foreach($items as $item)
                                                    <li>{{ trim($item) }}</li>
                                                @endforeach
                                            </dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-12">
                                        <dl class="row my-2">
                                            <dd class="col-sm-4">Exclude (Paket Belum Termasuk)</dd>
                                            @php
                                                $items = explode(',', $order_perjalanan->perjalanan->exclude);
                                            @endphp
                                            <dd class="col-sm-8">
                                                @foreach($items as $item)
                                                    <li>{{ trim($item) }}</li>
                                                @endforeach
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            {{-- <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Status</dt>
                                    <dd class="col-sm-9">
                                        @if ($order_perjalanan->status == 1)
                                        <span class="badge bg-label-success me-1">Publish</span>
                                        @else
                                        <span class="badge bg-label-warning me-1">Non Publish</span>
                                        @endif
                                    </dd>
                                </dl>
                            </div> --}}
                            {{-- <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Kategori</dt>
                                    <dd class="col-sm-9">{{ $order_perjalanan->category->name }}</dd>
                                </dl>
                            </div> --}}
                            {{-- <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Refund</dt>
                                    <dd class="col-sm-9">
                                        @if ($order_perjalanan->shipping_return == 1)
                                            <span class="badge bg-label-success me-1">Tersedia</span>
                                        @else
                                            <span class="badge bg-label-danger me-1">Tidak</span>
                                        @endif
                                    </dd>
                                </dl>
                            </div> --}}
                            {{-- <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Durasi order_perjalanan</dt>
                                    <dd class="col-sm-9">{{ $order_perjalanan->durasi }}</dd>
                                </dl>
                            </div> --}}
                            {{-- <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Minimal Keberangkatan</dt>
                                    <dd class="col-sm-9">{{ $order_perjalanan->qty }} Orang</dd>
                                </dl>
                            </div> --}}
                            {{-- <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Diskon</dt>
                                    <dd class="col-sm-9">
                                        @if ($order_perjalanan->price_discount == null || $order_perjalanan->price_discount == 0)
                                            Tidak ada diskon
                                        @else
                                            {{ $order_perjalanan->price_discount  }}%
                                        @endif
                                    </dd>
                                </dl>
                            </div> --}}
                            {{-- <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Harga</dt>
                                    <dd class="col-sm-9">Rp {{ $order_perjalanan->price }}</dd>
                                </dl>
                            </div> --}}
                            {{-- <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Harga Setelah Diskon</dt>
                                    <dd class="col-sm-9">Rp {{ $order_perjalanan->final_price }}</dd>
                                </dl>
                            </div> --}}
                            {{-- <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Tanggal order_perjalanan</dt>
                                    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($order_perjalanan->tgl_order_perjalanan)->translatedFormat('d F Y') }}</dd>
                                </dl>
                            </div> --}}
                            {{-- <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Titik Penjemputan</dt>
                                    @php
                                        $items = explode(',', $order_perjalanan->titik);
                                    @endphp
                                    <dd class="col-sm-9">
                                        @foreach($items as $item)
                                            <li>{{ trim($item) }}</li>
                                        @endforeach
                                    </dd>
                                    <dd class="col-sm-9">{{ $order_perjalanan->titik }}</dd>
                                </dl>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection