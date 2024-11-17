@extends('mitra.layouts.app')

@section('content')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            @include('mitra.layouts.sidebar')
        </aside>
            <div class="layout-page">
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    @include('mitra.layouts.navbar')
                </nav>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold"><a href="{{ route('mitra.homestay.order') }}"><span class="text-muted fw-light">Order / </span></a>Detail</h4>
                        @include('mitra.message')
                        <div class="card mb-4">
                            <h5 class="card-header d-flex align-items-center">{{ $order_homestay->invoice_number }}</h5>
                            <div class="card-body d-flex gap-1">
                                @foreach (['thumbnail', 'image', 'image2', 'image3', 'image4'] as $imageField)
                                    @php
                                        $imagePath = $order_homestay->homestay->$imageField;
                                        $imageSrc = $imagePath ? asset('img/' . $imagePath) : asset('front-assets/img_blank.jpg');
                                    @endphp
                                    <img src="{{ $imageSrc }}" alt="Order Perjalanan Image" width="90" class="mx-1">
                                @endforeach
                            </div>                                                      
                            <hr class="my-0" />
                            <div class="card-body">
                                <h5 class="m-0">Informasi Pemesan</h5>
                                <div class="p-2">
                                    <div class="col-md-12">
                                        <dl class="row my-2">
                                            <dd class="col-sm-4">Nama</dd>
                                            <dd class="col-sm-8">{{ $order_homestay->title }}&nbsp;{{ $order_homestay->first_name }}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-12">
                                        <dl class="row my-2">
                                            <dd class="col-sm-4">No. Handphone</dd>
                                            <dd class="col-sm-8">{{ $order_homestay->no_handphone }}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-12">
                                        <dl class="row my-2">
                                            <dd class="col-sm-4">Email</dd>
                                            <dd class="col-sm-8">{{ $order_homestay->email }}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-12">
                                        <dl class="row my-2">
                                            <dd class="col-sm-4">Alamat</dd>
                                            <dd class="col-sm-8">{{ $order_homestay->alamat_lengkap }}</dd>
                                        </dl>
                                    </div>                             
                                </div>
                                <h5 class="m-0">Informasi Paket</h5>
                                <div class="p-2">
                                    <div class="col-md-12">
                                        <dl class="row my-2">
                                            <dd class="col-sm-4">Nama Paket</dd>
                                            <dd class="col-sm-8">{{ $order_homestay->homestay->title }}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-12">
                                        <dl class="row my-2">
                                            <dd class="col-sm-4">Tanggal Booking</dd>
                                            <dd class="col-sm-8">{{ \Carbon\Carbon::parse($order_homestay->tgl_booking)->translatedFormat('d F Y') }}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-12">
                                        <dl class="row my-2">
                                            <dd class="col-sm-4">Selesai Booking</dd>
                                            <dd class="col-sm-8">{{ \Carbon\Carbon::parse($order_homestay->tgl_selesai)->translatedFormat('d F Y') }}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-12">
                                        <dl class="row my-2">
                                            <dd class="col-sm-4">Durasi Booking</dd>
                                            <dd class="col-sm-8">{{ $order_homestay->durasi_booking }} Hari</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-12">
                                        <dl class="row my-2">
                                            <dd class="col-sm-4">Deskripsi</dd>
                                            <dd class="col-sm-8">{{ $order_homestay->homestay->deskripsi }}</dd>
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