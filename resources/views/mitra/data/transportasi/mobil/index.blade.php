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
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    @include('mitra.message')
                    <div class="card">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="card-header mb-0">Data Mobil</h5>
                            <div class="d-flex align-items-center">
                                <a href="{{ route('mitra.mobil.create') }}" class="btn btn-sm btn-primary me-3">
                                    Tambahkan Mobil
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
                                        <th>Thumbnail</th>
                                        <th>Title</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse($mobils as $index => $mobil)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                @if ($mobil->image)
                                                <img src="{{ asset('img/' . $mobil->image) }}" alt="mobil Image" width="80">
                                                @else
                                                No Image Available
                                                @endif
                                            </td>
                                            <td>{{ $mobil->title }}</td>
                                            <td>{{ $mobil->price }}</td>
                                            <td>{{ $mobil->qty }}</td>
                                            <td>
                                                @if ($mobil->status == 1)
                                                <span class="badge bg-label-success me-1">Publish</span>
                                                @else
                                                <span class="badge bg-label-warning me-1">Non Publish</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('mitra.mobil.detail', ['mobilId' => $mobil->id]) }}" type="button" class="btn btn-sm btn-outline-primary me-2">
                                                        <i class='bx bx-search-alt-2'></i>
                                                    </a>
                                                    {{-- <button data-bs-toggle="modal" data-bs-target="#edittransportasi{{ $transportasi->id }}" type="button" class="btn btn-sm btn-outline-primary me-2" data-transportasi-id="{{ $transportasi->id }}">
                                                        <span class="bx bx-edit-alt"></span>&nbsp; Edit
                                                    </button> --}}
                                                    <form id="delete-form-{{ $mobil->id }}" action="{{ route('mitra.mobil.destroy', $mobil->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger"><span class="bx bx-trash"></span>&nbsp;Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="11">Tidak ada Data</td>
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

    <!-- Modal Edit Transportasi -->
    {{-- @foreach ($motors as $motor)
    <div class="modal fade" id="edittransportasi{{ $transportasi->id }}" tabindex="-1" aria-labelledby="edittransportasiLabel{{ $transportasi->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edittransportasiLabel{{ $transportasi->id }}">Edit Transportasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edittransportasiForm{{ $transportasi->id }}" action="{{ route('mitra.transportasi.update', $transportasi->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="editTitle{{ $transportasi->id }}" class="form-label">Nama Transportasi</label>
                                <input type="text" name="title" id="editTitle{{ $transportasi->id }}" class="form-control" value="{{ $transportasi->title }}" oninput="generateSlug({{ $transportasi->id }})">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="editStatus{{ $transportasi->id }}" class="form-label">Status</label>
                                <select name="status" id="editStatus{{ $transportasi->id }}" class="form-select">
                                    <option value="1" {{ $transportasi->status == 1 ? 'selected' : '' }}>Publish</option>
                                    <option value="0" {{ $transportasi->status == 0 ? 'selected' : '' }}>Hide</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="editjenis_kendaraan{{ $transportasi->id }}" class="form-label">Jenis Kendaraan</label>
                                <select class="form-select" name="jenis_kendaraan" id="jenis_kendaraan{{ $transportasi->id }}">
                                    <option value="Manual" {{ $transportasi->jenis_kendaraan == 'Manual' ? 'selected' : '' }}>Manual</option>
                                    <option value="Matic" {{ $transportasi->jenis_kendaraan == 'Matic' ? 'selected' : '' }}>Matic</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="category_id{{ $transportasi->id }}" class="form-label">Kategori</label>
                                <select class="form-select" name="category_id" id="category_id{{ $transportasi->id }}">
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $transportasi->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="deskripsi{{ $transportasi->id }}" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi{{ $transportasi->id }}" name="deskripsi">{{ $transportasi->deskripsi }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="alamat{{ $transportasi->id }}" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat{{ $transportasi->id }}" name="alamat">{{ $transportasi->alamat }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="qty{{ $transportasi->id }}" class="form-label">Stok</label>
                                <input type="number" class="form-control" id="qty{{ $transportasi->id }}" name="qty" value="{{ $transportasi->qty }}">
                            </div>
                            @if($mitra->jenis == 'transportasi mobil')
                            <div class="col-md-6 mb-3">
                                <label for="editbbm{{ $transportasi->id }}" class="form-label">BBM</label>
                                <select name="bbm" id="editbbm{{ $transportasi->id }}" class="form-select">
                                    <option value="1" {{ $transportasi->bbm == 1 ? 'selected' : '' }}>Iya</option>
                                    <option value="0" {{ $transportasi->bbm == 0 ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="layanan{{ $transportasi->id }}" class="form-label">Layanan</label>
                                <input type="text" class="form-control" id="layanan{{ $transportasi->id }}" name="layanan" value="{{ $transportasi->layanan }}">
                            </div>
                            @endif
                            <div class="col-md-6 mb-3">
                                <label for="jenis{{ $transportasi->id }}" class="form-label">Jenis</label>
                                <input type="text" class="form-control" id="jenis{{ $transportasi->id }}" name="jenis" value="{{ $transportasi->jenis }}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="formFile{{ $transportasi->id }}" class="form-label">Foto</label>
                                <div id="dropzone{{ $transportasi->id }}" class="border border-2 rounded p-3 d-flex align-items-center justify-content-center flex-column" style="min-height: 150px; cursor: pointer; position: relative;">
                                    <span id="dropzoneText{{ $transportasi->id }}">Drag & Drop Image</span>
                                    <input class="form-control" type="file" id="formFile{{ $transportasi->id }}" name="image" accept="image/*" style="display:none;" onchange="previewImage({{ $transportasi->id }})">
                                    <img id="imagePreview{{ $transportasi->id }}" src="{{ asset('img/' . $transportasi->image) }}" alt="Image Preview" class="{{ $transportasi->image ? '' : 'd-none' }}" width="50%">
                                </div>
                                <button type="button" id="deleteImgPreview{{ $transportasi->id }}" class="btn btn-outline-danger btn-sm mt-2 float-end {{ $transportasi->image ? '' : 'd-none' }}" onclick="deleteImage({{ $transportasi->id }})">Hapus</button>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="price{{ $transportasi->id }}" class="form-label">Harga</label>
                                <input type="text" class="form-control" id="price{{ $transportasi->id }}" name="price" value="{{ $transportasi->price }}" oninput="calculateFinalPrice({{ $transportasi->id }})">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="price_discount{{ $transportasi->id }}" class="form-label">Diskon (%)</label>
                                <input type="number" class="form-control" id="price_discount{{ $transportasi->id }}" name="price_discount" value="{{ $transportasi->price_discount }}" oninput="calculateFinalPrice({{ $transportasi->id }})">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="final_price{{ $transportasi->id }}" class="form-label">Harga Setelah Diskon</label>
                                <input type="text" class="form-control" id="final_price{{ $transportasi->id }}" name="final_price" readonly value="{{ $transportasi->final_price }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach --}}


    <script>
        function formatNumberInput(input) {
            var value = input.value.replace(/[^0-9]/g, '');
            input.value = new Intl.NumberFormat('id-ID').format(value);
        }

        function calculateFinalPrice(transportasiId) {
            var priceElement = document.getElementById('price' + transportasiId);
            var discountElement = document.getElementById('price_discount' + transportasiId);
            var finalPriceElement = document.getElementById('final_price' + transportasiId);

            var price = parseFloat(priceElement.value.replace(/\./g, '').replace(',', '.')) || 0;
            var discountPercentage = parseFloat(discountElement.value.replace(',', '.')) || 0;

            var finalPrice = price - (price * (discountPercentage / 100));

            finalPriceElement.value = new Intl.NumberFormat('id-ID').format(finalPrice);
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('[id^="price"]').forEach(function(element) {
                var transportasiId = element.id.replace('price', '');
                element.addEventListener('input', function() {
                    formatNumberInput(this);
                    calculateFinalPrice(transportasiId);
                });
            });

            document.querySelectorAll('[id^="price_discount"]').forEach(function(element) {
                var transportasiId = element.id.replace('price_discount', '');
                element.addEventListener('input', function() {
                    calculateFinalPrice(transportasiId);
                });
            });
        });

        function previewImage(id) {
            const fileInput = document.getElementById(`formFile${id}`);
            const imagePreview = document.getElementById(`imagePreview${id}`);
            const dropzoneText = document.getElementById(`dropzoneText${id}`);
            const deleteButton = document.getElementById(`deleteImgPreview${id}`);

            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('d-none');
                    dropzoneText.style.display = 'none';
                    deleteButton.classList.remove('d-none');
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        }

        function deleteImage(id) {
            const fileInput = document.getElementById(`formFile${id}`);
            const imagePreview = document.getElementById(`imagePreview${id}`);
            const dropzoneText = document.getElementById(`dropzoneText${id}`);
            const deleteButton = document.getElementById(`deleteImgPreview${id}`);

            fileInput.value = '';
            imagePreview.src = '';
            imagePreview.classList.add('d-none');
            dropzoneText.style.display = 'block';
            deleteButton.classList.add('d-none');
        }

        document.querySelectorAll('[id^="dropzone"]').forEach(dropzone => {
            dropzone.addEventListener('click', function() {
                const id = this.id.replace('dropzone', '');
                document.getElementById(`formFile${id}`).click();
            });
        });

        function calculateFinalPrice(id) {
            const price = parseFloat(document.getElementById(`price${id}`).value) || 0;
            const discount = parseFloat(document.getElementById(`price_discount${id}`).value) || 0;
            const finalPrice = price - (price * (discount / 100));
            document.getElementById(`final_price${id}`).value = finalPrice.toFixed(2);
        }
    </script>

    @endsection