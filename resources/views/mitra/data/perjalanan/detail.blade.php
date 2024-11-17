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
                    <h4 class="fw-bold"><a href="{{ route('mitra.perjalanan.index') }}"><span class="text-muted fw-light">Perjalanan / </span></a>Detail</h4>

                    <!-- Basic Bootstrap Table -->
                    @include('mitra.message')
                    <div class="card mb-4">
                        <h5 class="card-header">{{ $perjalanan->mitra->name }}</h5>
                        <!-- Account -->
                        <div class="card-body">
                          <div class="d-flex align-items-start align-items-sm-center gap-3">
                            @php
                                $images = ['thumbnail', 'image'];
                            @endphp

                            @foreach ($images as $image)
                                @if ($perjalanan->$image)
                                    @php
                                        $imageArray = explode(',', $perjalanan->$image);
                                    @endphp

                                    @foreach ($imageArray as $imageName)
                                        <img src="{{ asset('img/' . $imageName) }}" alt="Perjalanan Image" width="100">
                                    @endforeach

                                @else
                                    Tidak ada {{ $image == 'thumbnail' ? : 'image' }}
                                @endif
                            @endforeach

                            {{-- @php
                                $images = ['thumbnail', 'image', 'image2', 'image3', 'image4'];
                            @endphp
                            @foreach ($images as $image)
                                @if ($perjalanan->$image)
                                    <img src="{{ asset('img/' . $perjalanan->$image) }}" alt="Perjalanan Image" width="100">
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
                                    <dt class="col-sm-3">Nama Paket</dt>
                                    <dd class="col-sm-9">{{ $perjalanan->title }}</dd>
                                </dl>
                            </div>
                            <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Status</dt>
                                    <dd class="col-sm-9">
                                        @if ($perjalanan->status == 1)
                                        <span class="badge bg-label-success me-1">Publish</span>
                                        @else
                                        <span class="badge bg-label-warning me-1">Non Publish</span>
                                        @endif
                                    </dd>
                                </dl>
                            </div>
                            <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Kategori</dt>
                                    <dd class="col-sm-9">{{ $perjalanan->category->name }}</dd>
                                </dl>
                            </div>
                            <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Refund</dt>
                                    <dd class="col-sm-9">
                                        @if ($perjalanan->shipping_return == 1)
                                            <span class="badge bg-label-success me-1">Tersedia</span>
                                        @else
                                            <span class="badge bg-label-danger me-1">Tidak</span>
                                        @endif
                                    </dd>
                                </dl>
                            </div>
                            <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Durasi Perjalanan</dt>
                                    <dd class="col-sm-9">{{ $perjalanan->durasi }}</dd>
                                </dl>
                            </div>
                            <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Minimal Keberangkatan</dt>
                                    <dd class="col-sm-9">{{ $perjalanan->qty }} Orang</dd>
                                </dl>
                            </div>
                            <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Diskon</dt>
                                    <dd class="col-sm-9">
                                        @if ($perjalanan->price_discount == null || $perjalanan->price_discount == 0)
                                            Tidak ada diskon
                                        @else
                                            {{ $perjalanan->price_discount  }}%
                                        @endif
                                    </dd>
                                </dl>
                            </div>
                            <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Harga</dt>
                                    <dd class="col-sm-9">Rp {{ $perjalanan->price }}</dd>
                                </dl>
                            </div>
                            <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Harga Setelah Diskon</dt>
                                    <dd class="col-sm-9">Rp {{ $perjalanan->final_price }}</dd>
                                </dl>
                            </div>
                            <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Tanggal Perjalanan</dt>
                                    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($perjalanan->tgl_perjalanan)->translatedFormat('d F Y') }}</dd>
                                </dl>
                            </div>
                            <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Titik Penjemputan</dt>
                                    @php
                                        $items = explode(',', $perjalanan->titik);
                                    @endphp
                                    <dd class="col-sm-9">
                                        @foreach($items as $item)
                                            <li>{{ trim($item) }}</li>
                                        @endforeach
                                    </dd>
                                    {{-- <dd class="col-sm-9">{{ $perjalanan->titik }}</dd> --}}
                                </dl>
                            </div>
                            <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Deskripsi</dt>
                                    <dd class="col-sm-9">{{ $perjalanan->deskripsi }}</dd>
                                </dl>
                                {{-- <dl class="row mt-2">
                                    <dt class="col-sm-3">Deskripsi</dt>
                                    @php
                                        $items = explode(',', $perjalanan->deskripsi);
                                    @endphp
                                    <dd class="col-sm-9">
                                        @foreach($items as $item)
                                        <li><i class="menu-icon tf-icons bx bx-map-pin"></i> {{ trim($item) }}</li>
                                        @endforeach
                                    </dd>
                                </dl> --}}
                            </div>
                            <div class="col-md-12">
                                <dl class="row mt-2">
                                    <dt class="col-sm-3">Fasilitas</dt>
                                    @php
                                        $items = explode(',', $perjalanan->fasilitas);
                                    @endphp
                                    <dd class="col-sm-9">
                                        @foreach($items as $item)
                                        <li>{{ trim($item) }}</li>
                                        @endforeach
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    <!-- /Account -->
                </div>
                    {{-- <div class="card">
                        <div class="d-flex align-items-center">
                            <h5 class="card-header">Data perjalanan</h5>
                            <a href="{{ route('perjalanan.create') }}" class="btn btn-sm btn-primary">
                                Add perjalanan
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
                                    @forelse($perjalanans as $perjalanan)
                                    <tr>
                                        <td>
                                            @if ($perjalanan->image)
                                            <img src="{{ asset('img/' . $perjalanan->image) }}" alt="perjalanan Image" width="100">
                                            @else
                                            No Image Available
                                            @endif
                                        </td>
                                        <td>{{ $perjalanan->title }}</td>
                                        <td>{{ $perjalanan->price }}</td>
                                        <td>{{ $perjalanan->price_discount }}</td>
                                        <td>{{ $perjalanan->final_price }}</td>
                                        <td>{{ $perjalanan->qty }}</td>
                                        <td>{{ $perjalanan->category->name }}</td>
                                        <td>{{ $perjalanan->jenis }}</td>
                                        <td>
                                            @if ($perjalanan->status == 1)
                                            <span class="badge bg-label-success me-1">Publish</span>
                                            @else
                                            <span class="badge bg-label-warning me-1">Non Publish</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($perjalanan->featured == 1)
                                            <span class="badge bg-label-success me-1">Ya</span>
                                            @else
                                            <span class="badge bg-label-warning me-1">Tidak</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="10">Tidak ada data perjalanan yang tersedia.</td>
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

    <script>
        function calculateFinalPrice(id) {
            var price = parseFloat(document.getElementById('price' + id).value) || 0;
            var discountPercentage = parseFloat(document.getElementById('price_discount' + id).value) || 0;
            var discountAmount = (price * discountPercentage) / 100;
            var finalPrice = price - discountAmount;

            document.getElementById('final_price' + id).value = finalPrice.toFixed(2);
        }

        @foreach($perjalanans as $transportasi)
        document.getElementById('price{{ $transportasi->id }}').addEventListener('input', function() {
            calculateFinalPrice('{{ $transportasi->id }}');
        });

        document.getElementById('price_discount{{ $transportasi->id }}').addEventListener('input', function() {
            calculateFinalPrice('{{ $transportasi->id }}');
        });
        @endforeach

        function generateSlug(id) {
            var name = document.getElementById('editTitle' + id).value;
            var slug = name.toLowerCase().replace(/\s+/g, '-').replace(/[^\w\-]+/g, '');
            document.getElementById('editSlug' + id).value = slug;
        }

        function previewImage() {
            const fileInput = document.getElementById('formFile');
            const preview = document.getElementById('imagePreview');
            const cancelButton = document.getElementById('cancelButton');

            const file = fileInput.files[0];
            const reader = new FileReader();

            reader.addEventListener('load', function() {
                preview.src = reader.result;
                preview.style.display = 'block';
                cancelButton.style.display = 'inline-block';
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        document.getElementById('cancelButton').addEventListener('click', function() {
            const preview = document.getElementById('imagePreview');
            const cancelButton = document.getElementById('cancelButton');

            preview.src = '';
            preview.style.display = 'none';
            cancelButton.style.display = 'none';

            document.getElementById('formFile').value = '';
        });
    </script>

    @endsection