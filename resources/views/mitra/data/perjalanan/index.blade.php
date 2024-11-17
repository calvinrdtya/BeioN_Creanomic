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
                    <h4 class="fw-bold">Perjalanan</h4>

                    <!-- Basic Bootstrap Table -->
                    @include('mitra.message')
                    <div class="card">
                        {{-- <div class="d-flex align-items-center">
                            <h5 class="card-header">Data Perjalanan</h5>
                            <a href="{{ route('mitra.perjalanan.create') }}" class="btn btn-sm btn-primary">
                                Add Perjalanan
                            </a>
                        </div> --}}
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="card-header mb-0">Data Perjalanan</h5>
                            <div class="d-flex align-items-center">
                                <a href="{{ route('mitra.perjalanan.create') }}" class="btn btn-sm btn-primary me-3">
                                    Tambah Perjalanan
                                </a>
                                <div class="nav-item d-flex align-items-center">
                                    <i class="bx bx-search fs-4 lh-0 me-2"></i>
                                    <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..." />
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Produk</th>
                                        <th></th>
                                        {{-- <th>Kategori</th> --}}
                                        <th>Durasi</th>
                                        <th>Harga</th>
                                        {{-- <th>Diskon</th> --}}
                                        {{-- <th>Refund</th>
                                        <th>Status</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse($perjalanans as $index => $perjalanan)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @if ($perjalanan->thumbnail)
                                                <img src="{{ asset('img/' . $perjalanan->thumbnail) }}" alt="Perjalanan Image" width="100">
                                            @else
                                                No Image Available
                                            @endif
                                        </td>
                                        <td>{{ $perjalanan->title }}</td>
                                        {{-- <td>{{ $perjalanan->category->name }}</td> --}}
                                        <td>{{ $perjalanan->durasi }}</td>
                                        <td>{{ $perjalanan->final_price }}</td>
                                        {{-- <td>{{ $perjalanan->price_discount }}%</td> --}}
                                        {{-- <td>
                                            @if ($perjalanan->shipping_return == 1)
                                                <span class="badge bg-label-success">Ya</span>
                                            @else
                                                <span class="badge bg-label-danger">Tidak</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($perjalanan->status == 1)
                                                <span class="badge bg-label-success">Publish</span>
                                            @else
                                                <span class="badge bg-label-danger">Non Publish</span>
                                            @endif
                                        </td> --}}
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('mitra.perjalanan.detail', ['perjalananId' => $perjalanan->id]) }}" type="button" class="btn btn-sm btn-outline-primary me-2">
                                                    <i class='bx bx-search-alt-2'></i>
                                                </a>
                                                <button data-bs-toggle="modal" data-bs-target="#editPerjalanan{{ $perjalanan->id }}" type="button" class="btn btn-sm btn-outline-primary me-2" data-perjalanan-id="{{ $perjalanan->id }}">
                                                    <span class="bx bx-edit-alt"></span>&nbsp; Edit
                                                </button>
                                                <form id="delete-form-{{ $perjalanan->id }}" action="{{ route('mitra.perjalanan.destroy', $perjalanan->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"><span class="bx bx-trash"></span>&nbsp; Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9">Data Tidak Ada</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal Edit Perjalanan -->
@foreach ($perjalanans as $perjalanan)
    <div class="modal fade" id="editPerjalanan{{ $perjalanan->id }}" tabindex="-1" aria-labelledby="editPerjalananLabel{{ $perjalanan->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPerjalananLabel{{ $perjalanan->id }}">Edit Perjalanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editPerjalananForm{{ $perjalanan->id }}" action="{{ route('mitra.perjalanan.update', $perjalanan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="editTitle{{ $perjalanan->id }}" class="form-label">Nama Perjalanan</label>
                                <input type="text" name="title" id="editTitle{{ $perjalanan->id }}" class="form-control" value="{{ $perjalanan->title }}" oninput="generateSlug({{ $perjalanan->id }})">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="editSlug{{ $perjalanan->id }}" class="form-label">Slug</label>
                                <input type="text" readonly name="slug" id="editSlug{{ $perjalanan->id }}" class="form-control" value="{{ $perjalanan->slug }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="category_id{{ $perjalanan->id }}" class="form-label">Kategori</label>
                                <select class="form-select" name="category_id" id="category_id{{ $perjalanan->id }}">
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $perjalanan->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="qty{{ $perjalanan->id }}" class="form-label">Stok</label>
                                <input type="text" class="form-control" id="qty{{ $perjalanan->id }}" name="qty" value="{{ $perjalanan->qty }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="formFile{{ $perjalanan->id }}" class="form-label">Foto</label>
                                <input class="form-control" type="file" id="formFile{{ $perjalanan->id }}" name="thumbnail" accept="image/*" onchange="previewImage({{ $perjalanan->id }})" />
                                <div class="mt-2">
                                    <img id="imagePreview{{ $perjalanan->id }}" src="{{ asset('img/' . $perjalanan->thumbnail) }}" alt="Image Preview" style="display:block; width:100px;" />
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="formFile{{ $perjalanan->id }}" class="form-label">Foto</label>
                                <input class="form-control" type="file" id="formFile{{ $perjalanan->id }}" name="image" accept="image/*" onchange="previewImage({{ $perjalanan->id }})" />
                                <div class="mt-2">
                                    <img id="imagePreview{{ $perjalanan->id }}" src="{{ asset('img/' . $perjalanan->image) }}" alt="Image Preview" style="display:block; width:100px;" />
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="formFile{{ $perjalanan->id }}" class="form-label">Foto</label>
                                <input class="form-control" type="file" id="formFile{{ $perjalanan->id }}" name="image2" accept="image/*" onchange="previewImage({{ $perjalanan->id }})" />
                                <div class="mt-2">
                                    <img id="imagePreview{{ $perjalanan->id }}" src="{{ asset('img/' . $perjalanan->image2) }}" alt="Image Preview" style="display:block; width:100px;" />
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="formFile{{ $perjalanan->id }}" class="form-label">Foto</label>
                                <input class="form-control" type="file" id="formFile{{ $perjalanan->id }}" name="image3" accept="image/*" onchange="previewImage({{ $perjalanan->id }})" />
                                <div class="mt-2">
                                    <img id="imagePreview{{ $perjalanan->id }}" src="{{ asset('img/' . $perjalanan->image3) }}" alt="Image Preview" style="display:block; width:100px;" />
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="formFile{{ $perjalanan->id }}" class="form-label">Foto</label>
                                <input class="form-control" type="file" id="formFile{{ $perjalanan->id }}" name="image4" accept="image/*" onchange="previewImage({{ $perjalanan->id }})" />
                                <div class="mt-2">
                                    <img id="imagePreview{{ $perjalanan->id }}" src="{{ asset('img/' . $perjalanan->image4) }}" alt="Image Preview" style="display:block; width:100px;" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="price{{ $perjalanan->id }}" class="form-label">Harga</label>
                                <input type="text" class="form-control" id="price{{ $perjalanan->id }}" name="price" value="{{ $perjalanan->price }}" oninput="calculateFinalPrice({{ $perjalanan->id }})">
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="price_discount{{ $perjalanan->id }}" class="form-label">Diskon (%)</label>
                                    <input type="text" class="form-control" id="price_discount{{ $perjalanan->id }}" name="price_discount" value="{{ $perjalanan->price_discount }}" oninput="calculateFinalPrice({{ $perjalanan->id }})">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="final_price{{ $perjalanan->id }}" class="form-label">Harga Setelah Diskon</label>
                                    <input type="text" class="form-control" id="final_price{{ $perjalanan->id }}" name="final_price" readonly value="{{ $perjalanan->final_price }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="durasi{{ $perjalanan->id }}" class="form-label">Durasi</label>
                                    <input type="text" class="form-control" id="durasi{{ $perjalanan->id }}" name="durasi" value="{{ $perjalanan->durasi }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="fasilitas{{ $perjalanan->id }}" class="form-label">Fasilitas</label>
                                    <textarea class="form-control" id="fasilitas{{ $perjalanan->id }}" name="fasilitas" rows="4">{{ $perjalanan->fasilitas }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="description{{ $perjalanan->id }}" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="description{{ $perjalanan->id }}" name="description" rows="4">{{ $perjalanan->description }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="shipping_return{{ $perjalanan->id }}" class="form-label">Refund</label>
                                    <select class="form-select" name="shipping_return" id="shipping_return{{ $perjalanan->id }}">
                                        <option value="1" {{ $perjalanan->shipping_return == 1 ? 'selected' : '' }}>Ya</option>
                                        <option value="0" {{ $perjalanan->shipping_return == 0 ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="status{{ $perjalanan->id }}" class="form-label">Status</label>
                                    <select class="form-select" name="status" id="status{{ $perjalanan->id }}">
                                        <option value="1" {{ $perjalanan->status == 1 ? 'selected' : '' }}>Publish</option>
                                        <option value="0" {{ $perjalanan->status == 0 ? 'selected' : '' }}>Non Publish</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-grid gap-2 col-lg-6 mx-auto">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

    <div class="content-backdrop fade"></div>
</div>

@endsection

@push('scripts')
<script>
    function calculateFinalPrice(id) {
        const price = parseFloat(document.getElementById('price' + id).value) || 0;
        const priceDiscount = parseFloat(document.getElementById('price_discount' + id).value) || 0;
        const finalPrice = price - (price * priceDiscount / 100);
        document.getElementById('final_price' + id).value = finalPrice.toFixed(2);
    }

    function generateSlug(id) {
        const title = document.getElementById('editTitle' + id).value;
        const slug = title.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');
        document.getElementById('editSlug' + id).value = slug;
    }

    function previewImage(id) {
        const file = document.getElementById('formFile' + id).files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview' + id).src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endpush