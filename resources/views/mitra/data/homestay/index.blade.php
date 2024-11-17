@extends('mitra.layouts.app')

@section('content')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            @include('mitra.layouts.sidebar')
        </aside>
        <div class="layout-page">
            {{-- <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                @include('mitra.layouts.navbar')
            </nav> --}}
            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold">
                        Homestay
                        {{-- <span class="text-muted fw-light">homestay</span> --}}
                    </h4>
                    @include('mitra.message')
                    <div class="card">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="card-header mb-0">Data Booking</h5>
                            <div class="d-flex align-items-center">
                                <a href="{{ route('mitra.homestay.create') }}" class="btn btn-sm btn-primary me-3">Tambah homestay</a>
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
                                        <th>Foto</th>
                                        <th>Produk</th>
                                        <th>Higlight</th>
                                        <th>Harga</th>
                                        <th>Discount (%)</th>
                                        <th>Harga Discount</th>
                                        <th>Alamat</th>
                                        <th>Deskripsi</th>
                                        <th>Fasilitas</th>
                                        <th>Stok</th>
                                        <th>Status</th>
                                        <th>Rekomendasi</th>
                                        <th>Return</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse($homestays as $index => $homestay)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @if ($homestay->thumbnail)
                                            <img src="{{ asset('img/' . $homestay->image) }}" alt="homestay Image" width="100">
                                            @else
                                            No Image Available
                                            @endif
                                        </td>
                                        <td>{{ $homestay->title }}</td>
                                        <td>{{ $homestay->higlight }}</td>
                                        <td>{{ $homestay->price }}</td>
                                        <td>{{ $homestay->price_discount }}</td>
                                        <td>{{ $homestay->final_price }}</td>
                                        <td>{{ $homestay->alamat }}</td>
                                        <td>{{ $homestay->deskripsi }}</td>
                                        @foreach ($homestay->fasilitas as $fasilitas)
                                        <td>{{ $fasilitas->title }}</td>
                                        @endforeach
                                        <td>{{ $homestay->qty }}</td>
                                        <td>
                                            @if ($homestay->status == 1)
                                            <span class="badge bg-label-success me-1">Publish</span>
                                            @else
                                            <span class="badge bg-label-warning me-1">Non Publish</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($homestay->featured == 1)
                                            <span class="badge bg-label-success me-1">Ya</span>
                                            @else
                                            <span class="badge bg-label-warning me-1">Tidak</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($homestay->shipping_return == 1)
                                            <span class="badge bg-label-success me-1">Ya</span>
                                            @else
                                            <span class="badge bg-label-warning me-1">Tidak</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <button data-bs-toggle="modal" data-bs-target="#edithomestay{{ $homestay->id }}" type="button" class="btn btn-sm btn-outline-primary me-2" data-homestay-id="{{ $homestay->id }}">
                                                    <span class="bx bx-edit-alt"></span>&nbsp; Edit
                                                </button>
                                                <form id="delete-form-{{ $homestay->id }}" action="{{ route('mitra.homestay.destroy', $homestay->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"><span class="bx bx-trash"></span>&nbsp;Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="text-center" colspan="15">Tidak Ada Data</td>
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

    @foreach ($homestays as $homestay)
    <div class="modal fade" id="edithomestay{{ $homestay->id }}" tabindex="-1" aria-labelledby="edithomestayLabel{{ $homestay->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edithomestayLabel{{ $homestay->id }}">Edit homestay</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edithomestayForm{{ $homestay->id }}" action="{{ route('mitra.homestay.update', $homestay->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="editTitle{{ $homestay->id }}" class="form-label">Nama homestay</label>
                                <input type="text" name="title" id="editTitle{{ $homestay->id }}" class="form-control" value="{{ $homestay->title }}" oninput="generateSlug({{ $homestay->id }})">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="editSlug{{ $homestay->id }}" class="form-label">Slug</label>
                                <input type="text" readonly name="slug" id="editSlug{{ $homestay->id }}" class="form-control" value="{{ $homestay->slug }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="qty{{ $homestay->id }}" class="form-label">Stok</label>
                                <input type="text" class="form-control" id="qty{{ $homestay->id }}" name="qty" value="{{ $homestay->qty }}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="qty{{ $homestay->id }}" class="form-label">Higlight</label>
                                <textarea class="form-control" id="higlight{{ $homestay->id }}" name="higlight">{{ $homestay->higlight }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                        <div class="mb-3 col-md-6">
                                <label for="formFile{{ $homestay->id }}" class="form-label">Thumbnail</label>
                                <input class="form-control" type="file" id="formFile{{ $homestay->id }}" name="thumbnail" accept="image/*" onchange="previewImage({{ $homestay->id }})" />
                                <div class="mt-2">
                                    <img id="imagePreview{{ $homestay->id }}" src="" alt="Image Preview" style="display:none; width:100px;" />
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="formFile{{ $homestay->id }}" class="form-label">Foto 1</label>
                                <input class="form-control" type="file" id="formFile{{ $homestay->id }}" name="image[]" accept="image/*" onchange="previewImage({{ $homestay->id }})" />
                                <div class="mt-2">
                                    <img id="imagePreview{{ $homestay->id }}" src="" alt="Image Preview" style="display:none; width:100px;" />
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="formFile{{ $homestay->id }}" class="form-label">Foto 2</label>
                                <input class="form-control" type="file" id="formFile{{ $homestay->id }}" name="image[]" accept="image/*" onchange="previewImage({{ $homestay->id }})" />
                                <div class="mt-2">
                                    <img id="imagePreview{{ $homestay->id }}" src="" alt="Image Preview" style="display:none; width:100px;" />
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="formFile{{ $homestay->id }}" class="form-label">Foto 3</label>
                                <input class="form-control" type="file" id="formFile{{ $homestay->id }}" name="image[]" accept="image/*" onchange="previewImage({{ $homestay->id }})" />
                                <div class="mt-2">
                                    <img id="imagePreview{{ $homestay->id }}" src="" alt="Image Preview" style="display:none; width:100px;" />
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="formFile{{ $homestay->id }}" class="form-label">Foto 4</label>
                                <input class="form-control" type="file" id="formFile{{ $homestay->id }}" name="image[]" accept="image/*" onchange="previewImage({{ $homestay->id }})" />
                                <div class="mt-2">
                                    <img id="imagePreview{{ $homestay->id }}" src="" alt="Image Preview" style="display:none; width:100px;" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="price{{ $homestay->id }}" class="form-label">Harga</label>
                                <input type="text" class="form-control" id="price{{ $homestay->id }}" name="price" value="{{ $homestay->price }}" oninput="calculateFinalPrice({{ $homestay->id }})">
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="price_discount{{ $homestay->id }}" class="form-label">Diskon (%)</label>
                                    <input type="text" class="form-control" id="price_discount{{ $homestay->id }}" name="price_discount" value="{{ $homestay->price_discount }}" oninput="calculateFinalPrice({{ $homestay->id }})">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="final_price{{ $homestay->id }}" class="form-label">Harga Setelah Diskon</label>
                                    <input type="text" class="form-control" id="final_price{{ $homestay->id }}" name="final_price" readonly value="{{ $homestay->final_price }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="deskripsi{{ $homestay->id }}" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi{{ $homestay->id }}" name="deskripsi">{{ $homestay->deskripsi }}</textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="alamat{{ $homestay->id }}" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat{{ $homestay->id }}" name="alamat">{{ $homestay->alamat }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="editStatus{{ $homestay->id }}" class="form-label">Status</label>
                                    <select name="status" id="editStatus{{ $homestay->id }}" class="form-select">
                                        <option value="1" {{ $homestay->status == 1 ? 'selected' : '' }}>Publish</option>
                                        <option value="0" {{ $homestay->status == 0 ? 'selected' : '' }}>Hide</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="editFeatured{{ $homestay->id }}" class="form-label">Rekomendasi</label>
                                    <select name="featured" id="editFeatured{{ $homestay->id }}" class="form-select">
                                        <option value="1" {{ $homestay->featured == 1 ? 'selected' : '' }}>Ya</option>
                                        <option value="0" {{ $homestay->featured == 0 ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="shipping_return{{ $homestay->id }}" class="form-label">Refund</label>
                                    <select class="form-select" name="shipping_return" id="shipping_return{{ $homestay->id }}">
                                        <option value="0" {{ $homestay->shipping_return == '0' ? 'selected' : '' }}>Tidak</option>
                                        <option value="1" {{ $homestay->shipping_return == '1' ? 'selected' : '' }}>Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <script>
        function calculateFinalPrice(id) {
            var priceElement = document.getElementById('price' + id);
            var discountElement = document.getElementById('price_discount' + id);
            var finalPriceElement = document.getElementById('final_price' + id);

            // Remove any non-numeric characters and commas for parsing
            var price = parseFloat(priceElement.value.replace(/[^0-9.-]+/g, "")) || 0;
            var discountPercentage = parseFloat(discountElement.value.replace(/[^0-9.-]+/g, "")) || 0;

            if (isNaN(discountPercentage) || discountPercentage < 0) {
                discountPercentage = 0;
            }

            var discountAmount = (price * discountPercentage) / 100;
            var finalPrice = price - discountAmount;

            // Format the final price to include commas and two decimal places
            finalPriceElement.value = finalPrice.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        // Example usage to attach the function to all relevant elements
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('[id^="price"]').forEach(function(element) {
                element.addEventListener('input', function() {
                    var id = this.id.match(/\d+$/)[0];
                    calculateFinalPrice(id);
                });
            });

            document.querySelectorAll('[id^="price_discount"]').forEach(function(element) {
                element.addEventListener('input', function() {
                    var id = this.id.match(/\d+$/)[0];
                    calculateFinalPrice(id);
                });
            });
        });

        function generateSlug(id) {
            var name = document.getElementById('editTitle' + id).value;
            var slug = name.toLowerCase().replace(/\s+/g, '-').replace(/[^\w\-]+/g, '');
            document.getElementById('editSlug' + id).value = slug;
        }

        function previewImage(id) {
            const fileInput = document.getElementById('formFile' + id);
            const preview = document.getElementById('imagePreview' + id);
            const file = fileInput.files[0];
            const reader = new FileReader();
            reader.addEventListener('load', function() {
                preview.src = reader.result;
                preview.style.display = 'block';
            }, false);
            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
    @endsection