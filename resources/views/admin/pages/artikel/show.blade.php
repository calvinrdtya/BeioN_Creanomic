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
            {{-- <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                @include('admin.layouts.navbar')
            </nav> --}}

            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold"><a href="{{ route('admin.artikel') }}"><span class="text-muted fw-light">Artikel / </span></a>Detail</h4>

                    <!-- Basic Bootstrap Table -->
                    @include('admin.message')
                    <div class="card mb-4">
                        {{-- <h5 class="card-header">Tes</h5> --}}
                        <!-- Account -->
                        <div class="card-body">
                          <div class="d-flex align-items-start align-items-sm-center gap-3">
                            @if ($artikel->thumbnails)
                                <img src="{{ asset($artikel->thumbnails) }}" alt="Artikel Image" width="100">
                            @else
                                No Image Available
                            @endif
                            {{-- @php
                                $images = ['thumbnail', 'image', 'image2', 'image3', 'image4'];
                            @endphp
                            @foreach ($images as $image)
                                @if ($artikel->$image)
                                    <img src="{{ asset('img/' . $artikel->$image) }}" alt="artikel Image" width="100">
                                @else
                                    Tidak ada {{ $image == 'thumbnail' ? 'Thumbnails' : 'images' }}
                                @endif
                             @endforeach --}}
                          </div>
                        </div>
                        <hr class="my-0" />
                            <div class="card-body">
                                <div class="col-md-12">
                                    <dl class="row mt-2">
                                        <dt class="col-sm-3">Judul</dt>
                                        <dd class="col-sm-9">{{ $artikel->title }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-12">
                                    <dl class="row mt-2">
                                        <dt class="col-sm-3">Status</dt>
                                        <dd class="col-sm-9">
                                            @if ($artikel->status == 1)
                                            <span class="badge bg-label-success me-1">Publish</span>
                                            @else
                                            <span class="badge bg-label-warning me-1">Non Publish</span>
                                            @endif
                                        </dd>
                                    </dl>
                                </div>
                                <div class="col-md-12">
                                    <dl class="row mt-2">
                                        <dt class="col-sm-3">Kota</dt>
                                        <dd class="col-sm-9">{{ $artikel->kota }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-12">
                                    <dl class="row mt-2">
                                        <dt class="col-sm-3">Tag</dt>
                                        <dd class="col-sm-9">{{ $artikel->tag }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-12">
                                    <dl class="row mt-2">
                                        <dt class="col-sm-3">Tanggal Upload</dt>
                                        <dd class="col-sm-9">{{ \Carbon\Carbon::parse($artikel->created_at)->translatedFormat('d F Y') }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-12">
                                    <dl class="row mt-2">
                                        <dt class="col-sm-3">Deskripsi</dt>
                                        <dd class="col-sm-9">{{ $artikel->deskripsi }}</dd>
                                    </dl>
                                </div>
                            </div>
                    <!-- /Account -->
                </div>
                    {{-- <div class="card">
                        <div class="d-flex align-items-center">
                            <h5 class="card-header">Data artikel</h5>
                            <a href="{{ route('artikel.create') }}" class="btn btn-sm btn-primary">
                                Add artikel
                            </a>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Thumbnail</th>
                                        <th>Title</th>
                                        <th>Harga</th>
                                        <th>Discount (%)</th>
                                        <th>Harga Discount</th>
                                        <th>Stok</th>
                                        <th>Kategori</th>
                                        <th>Jenis</th>
                                        <th>Status</th>
                                        <th>Rekomendasi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse($artikels as $artikel)
                                    <tr>
                                        <td>
                                            @if ($artikel->image)
                                            <img src="{{ asset('img/' . $artikel->image) }}" alt="artikel Image" width="100">
                                            @else
                                            No Image Available
                                            @endif
                                        </td>
                                        <td>{{ $artikel->title }}</td>
                                        <td>{{ $artikel->price }}</td>
                                        <td>{{ $artikel->price_discount }}</td>
                                        <td>{{ $artikel->final_price }}</td>
                                        <td>{{ $artikel->qty }}</td>
                                        <td>{{ $artikel->category->name }}</td>
                                        <td>{{ $artikel->jenis }}</td>
                                        <td>
                                            @if ($artikel->status == 1)
                                            <span class="badge bg-label-success me-1">Publish</span>
                                            @else
                                            <span class="badge bg-label-warning me-1">Non Publish</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($artikel->featured == 1)
                                            <span class="badge bg-label-success me-1">Ya</span>
                                            @else
                                            <span class="badge bg-label-warning me-1">Tidak</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="10">Tidak ada data artikel yang tersedia.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                

                            </table>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    @endsection