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
                    <h4 class="fw-bold py-3 mb-4"><a href="{{ route('mitra.transportasi.motor') }}"><span class="text-muted fw-light">Transportasi / </span></a>Detail</h4>

                    <!-- Basic Bootstrap Table -->
                    @include('mitra.message')
                    <div class="card mb-4">
                        <h5 class="card-header">{{ $transportasi->mitra->name }}</h5>
                        <!-- Account -->
                        <div class="card-body">
                          <div class="d-flex align-items-start align-items-sm-center gap-4">
                            @if ($transportasi->image)
                                <img src="{{ asset('img/' . $transportasi->image) }}" alt="Transportasi Image" width="100">
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
                                        <dt class="col-sm-4">Title</dt>
                                        <dd class="col-sm-8">{{ $transportasi->title }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row mt-2">
                                        <dt class="col-sm-4">Status</dt>
                                        <dd class="col-sm-8">
                                            @if ($transportasi->status == 1)
                                            <span class="badge bg-label-success me-1">Publish</span>
                                            @else
                                            <span class="badge bg-label-warning me-1">Non Publish</span>
                                            @endif
                                        </dd>
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row mt-2">
                                        <dt class="col-sm-4">Kategori</dt>
                                        <dd class="col-sm-8">{{ $transportasi->category->name }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row mt-2">
                                        <dt class="col-sm-4">Layanan</dt>
                                        <dd class="col-sm-8">{{ $transportasi->layanan }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row mt-2">
                                        <dt class="col-sm-4">Jenis</dt>
                                        <dd class="col-sm-8">{{ $transportasi->jenis }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row mt-2">
                                        <dt class="col-sm-4">Stok</dt>
                                        <dd class="col-sm-8">{{ $transportasi->qty }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row mt-2">
                                        <dt class="col-sm-4">Diskon</dt>
                                        <dd class="col-sm-8">
                                            @if ($transportasi->price_discount == null || $transportasi->price_discount == 0)
                                                Tidak ada diskon
                                            @else
                                                {{ $transportasi->price_discount  }}%
                                            @endif
                                        </dd>
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row mt-2">
                                        <dt class="col-sm-4">Harga</dt>
                                        <dd class="col-sm-8">{{ $transportasi->final_price }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row mt-2">
                                        <dt class="col-sm-4">Deskripsi</dt>
                                        <dd class="col-sm-8">{{ $transportasi->deskripsi }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row mt-2">
                                        <dt class="col-sm-4">Harga Asli</dt>
                                        <dd class="col-sm-8">{{ $transportasi->price }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <!-- /Account -->
                    </div>
                    {{-- <div class="card">
                        <div class="d-flex align-items-center">
                            <h5 class="card-header">Data Transportasi</h5>
                            <a href="{{ route('transportasi.create') }}" class="btn btn-sm btn-primary">
                                Add Transportasi
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
                                    @forelse($transportasis as $transportasi)
                                    <tr>
                                        <td>
                                            @if ($transportasi->image)
                                            <img src="{{ asset('img/' . $transportasi->image) }}" alt="Transportasi Image" width="100">
                                            @else
                                            No Image Available
                                            @endif
                                        </td>
                                        <td>{{ $transportasi->title }}</td>
                                        <td>{{ $transportasi->price }}</td>
                                        <td>{{ $transportasi->price_discount }}</td>
                                        <td>{{ $transportasi->final_price }}</td>
                                        <td>{{ $transportasi->qty }}</td>
                                        <td>{{ $transportasi->category->name }}</td>
                                        <td>{{ $transportasi->jenis }}</td>
                                        <td>
                                            @if ($transportasi->status == 1)
                                            <span class="badge bg-label-success me-1">Publish</span>
                                            @else
                                            <span class="badge bg-label-warning me-1">Non Publish</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($transportasi->featured == 1)
                                            <span class="badge bg-label-success me-1">Ya</span>
                                            @else
                                            <span class="badge bg-label-warning me-1">Tidak</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="10">Tidak ada data transportasi yang tersedia.</td>
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

        @foreach($transportasis as $transportasi)
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