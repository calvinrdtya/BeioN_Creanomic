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
                    <h4 class="fw-bold"><a href="{{ route('mitra.motor.order') }}"><span class="text-muted fw-light">Order / </span></a>Detail</h4>

                    <!-- Basic Bootstrap Table -->
                    @include('mitra.message')
                    <div class="card mb-4">
                        <h5 class="card-header d-flex align-items-center">{{ $order_motor->invoice_number }}</h5>
                        <!-- Account -->
                        <div class="card-body">
                            @if ($order_motor->motor->image)
                                <img src="{{ asset('img/' . $order_motor->motor->image) }}" alt="Order motor Image" class="img-fluid">
                            @else
                                <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Order motor Image" class="img-fluid">
                            @endif
                        </div>
                        <hr class="my-0" />
                        <div class="card-body">
                            <h5 class="m-0">Informasi Pemesan</h5>
                            <div class="p-2">
                                <div class="col-md-12">
                                    <dl class="row my-2">
                                        <dd class="col-sm-4">Nama</dd>
                                        <dd class="col-sm-8">{{ $order_motor->title }}&nbsp;{{ $order_motor->first_name }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-12">
                                    <dl class="row my-2">
                                        <dd class="col-sm-4">No. Handphone</dd>
                                        <dd class="col-sm-8">{{ $order_motor->no_handphone }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-12">
                                    <dl class="row my-2">
                                        <dd class="col-sm-4">Email</dd>
                                        <dd class="col-sm-8">{{ $order_motor->email }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-12">
                                    <dl class="row my-2">
                                        <dd class="col-sm-4">Alamat</dd>
                                        <dd class="col-sm-8">{{ $order_motor->alamat_lengkap }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-12">
                                    <dl class="row my-2">
                                        <dd class="col-sm-4">Keterangan</dd>
                                        <dd class="col-sm-8">Ambil di tempat</dd>
                                    </dl>
                                </div>
                            </div>
                            <h5 class="m-0">Informasi Kendaraan</h5>
                                <div class="p-2">
                                    <div class="col-md-12">
                                        <dl class="row my-2">
                                            <dd class="col-sm-4">Nama Paket</dd>
                                            <dd class="col-sm-8">{{ $order_motor->motor->title }}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-12">
                                        <dl class="row my-2">
                                            <dd class="col-sm-4">Jenis Motor</dd>
                                            <dd class="col-sm-8">{{ $order_motor->motor->jenis }}</dd>
                                        </dl>                                    
                                    </div>
                                    <div class="col-md-12">
                                        <dl class="row my-2">
                                            <dd class="col-sm-4">Tanggal Pinjam</dd>
                                            <dd class="col-sm-8">{{ \Carbon\Carbon::parse($order_motor->motor->tgl_pinjam)->translatedFormat('d F Y') }}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-12">
                                        <dl class="row my-2">
                                            <dd class="col-sm-4">Durasi Pinjam</dd>
                                            <dd class="col-sm-8">{{ $order_motor->durasi_pinjam }} Hari</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-12">
                                        <dl class="row my-2">
                                            <dd class="col-sm-4">Kota</dd>
                                            <dd class="col-sm-8">{{ $order_motor->motor->kota }}</dd>
                                        </dl>
                                    </div>
                                    {{-- <div class="col-md-12">
                                        <dl class="row my-2">
                                            <dd class="col-sm-4">Deskripsi</dd>
                                            <dd class="col-sm-8">{{ $order_motor->motor->deskripsi }}</dd>
                                        </dl>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection