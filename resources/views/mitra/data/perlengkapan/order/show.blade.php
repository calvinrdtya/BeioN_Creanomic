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
                    <h4 class="fw-bold"><a href="{{ route('mitra.perlengkapan.order') }}"><span class="text-muted fw-light">Order / </span></a>Detail</h4>

                    <!-- Basic Bootstrap Table -->
                    @include('mitra.message')
                    <div class="card mb-4">
                        <h5 class="card-header d-flex align-items-center">{{ $order_perlengkapan->invoice_number }}</h5>
                        <!-- Account -->
                        <div class="card-body">
                            @if ($order_perlengkapan->perlengkapan->image)
                                <img src="{{ asset('img/' . $order_perlengkapan->perlengkapan->image) }}" alt="Order Perjalanan Image" class="img-fluid" width="100">
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
                                        <dd class="col-sm-8">{{ $order_perlengkapan->title }}&nbsp;{{ $order_perlengkapan->first_name }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-12">
                                    <dl class="row my-2">
                                        <dd class="col-sm-4">No. Handphone</dd>
                                        <dd class="col-sm-8">{{ $order_perlengkapan->no_handphone }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-12">
                                    <dl class="row my-2">
                                        <dd class="col-sm-4">Email</dd>
                                        <dd class="col-sm-8">{{ $order_perlengkapan->email }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-12">
                                    <dl class="row my-2">
                                        <dd class="col-sm-4">Alamat</dd>
                                        <dd class="col-sm-8">{{ $order_perlengkapan->alamat_lengkap }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-12">
                                    <dl class="row my-2">
                                        <dd class="col-sm-4">Nomer Handphone</dd>
                                        <dd class="col-sm-8">{{ $order_perlengkapan->no_handphone }}</dd>
                                    </dl>
                                </div>
                            </div>
                            <h5 class="m-0">Informasi Paket</h5>
                                <div class="p-2">
                                    <div class="col-md-12">
                                        <dl class="row my-2">
                                            <dd class="col-sm-4">Nama Paket</dd>
                                            <dd class="col-sm-8">{{ $order_perlengkapan->perlengkapan->title }}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-12">
                                        <dl class="row my-2">
                                            <dd class="col-sm-4">Tanggal Peminjaman</dd>
                                            <dd class="col-sm-8">{{ \Carbon\Carbon::parse($order_perlengkapan->tgl_pinjam)->translatedFormat('d F Y') }}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-12">
                                        <dl class="row my-2">
                                            <dd class="col-sm-4">Tanggal Selesai</dd>
                                            <dd class="col-sm-8">{{ \Carbon\Carbon::parse($order_perlengkapan->tgl_pengembalian)->translatedFormat('d F Y') }}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-12">
                                        <dl class="row my-2">
                                            <dd class="col-sm-4">Kota</dd>
                                            <dd class="col-sm-8">{{ $order_perlengkapan->perlengkapan->kota }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            {{-- <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Status</dt>
                                    <dd class="col-sm-9">
                                        @if ($order_perlengkapan->status == 1)
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
                                    <dd class="col-sm-9">{{ $order_perlengkapan->category->name }}</dd>
                                </dl>
                            </div> --}}
                            {{-- <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Refund</dt>
                                    <dd class="col-sm-9">
                                        @if ($order_perlengkapan->shipping_return == 1)
                                            <span class="badge bg-label-success me-1">Tersedia</span>
                                        @else
                                            <span class="badge bg-label-danger me-1">Tidak</span>
                                        @endif
                                    </dd>
                                </dl>
                            </div> --}}
                            {{-- <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Durasi order_perlengkapan</dt>
                                    <dd class="col-sm-9">{{ $order_perlengkapan->durasi }}</dd>
                                </dl>
                            </div> --}}
                            {{-- <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Minimal Keberangkatan</dt>
                                    <dd class="col-sm-9">{{ $order_perlengkapan->qty }} Orang</dd>
                                </dl>
                            </div> --}}
                            {{-- <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Diskon</dt>
                                    <dd class="col-sm-9">
                                        @if ($order_perlengkapan->price_discount == null || $order_perlengkapan->price_discount == 0)
                                            Tidak ada diskon
                                        @else
                                            {{ $order_perlengkapan->price_discount  }}%
                                        @endif
                                    </dd>
                                </dl>
                            </div> --}}
                            {{-- <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Harga</dt>
                                    <dd class="col-sm-9">Rp {{ $order_perlengkapan->price }}</dd>
                                </dl>
                            </div> --}}
                            {{-- <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Harga Setelah Diskon</dt>
                                    <dd class="col-sm-9">Rp {{ $order_perlengkapan->final_price }}</dd>
                                </dl>
                            </div> --}}
                            {{-- <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Tanggal order_perlengkapan</dt>
                                    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($order_perlengkapan->tgl_order_perlengkapan)->translatedFormat('d F Y') }}</dd>
                                </dl>
                            </div> --}}
                            {{-- <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Titik Penjemputan</dt>
                                    @php
                                        $items = explode(',', $order_perlengkapan->titik);
                                    @endphp
                                    <dd class="col-sm-9">
                                        @foreach($items as $item)
                                            <li>{{ trim($item) }}</li>
                                        @endforeach
                                    </dd>
                                    <dd class="col-sm-9">{{ $order_perlengkapan->titik }}</dd>
                                </dl>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection