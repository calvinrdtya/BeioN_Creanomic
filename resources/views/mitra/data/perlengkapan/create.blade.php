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
            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold"><span class="text-muted fw-light">Perlengkapan /</span> Tambah Data</h4>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <h5 class="card-header">Tambahkan Data Perlengkapan</h5>
                                <div class="card-body">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form action="{{ route('mitra.perlengkapan.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="mitra_id" value="{{ Session::get('mitra_id') }}">
                                        <input type="hidden" id="inputPrice" name="price">
                                        <input type="hidden" id="inputFinalPrice" name="final_price">
                                        <div class="row">
                                            <div class="col-md-6 my-2">
                                                <label for="title" class="form-label">Nama Perlengkapan</label>
                                                <input class="form-control" type="text" id="title" name="title" value="{{ old('title') }}" autofocus required>
                                            </div>
                                            <div class="col-md-6 my-2">
                                                <label for="category" class="form-label">Kategori</label>
                                                <select class="form-select" name="category_id" id="category" required>
                                                    @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 my-2">
                                                <label for="qty" class="form-label">Stok</label>
                                                <input class="form-control" type="number" id="qty" name="qty" value="{{ old('qty') }}" placeholder="" min="0" required />
                                            </div>
                                            <div class="col-md-6 my-2">
                                                <label for="kota" class="form-label">Kota</label>
                                                <input class="form-control" type="text" id="kota" name="kota" value="{{ old('kota') }}" required>
                                            </div>
                                            <div class="col-md-6 my-2">
                                                <label for="formFile" class="form-label">Foto</label>
                                                <div id="dropzone" class="border rounded p-3 d-flex align-items-center justify-content-center flex-column" style="min-height: 150px; cursor: pointer; position: relative;">
                                                    <span id="dropzoneText">Drag & Drop Image</span>
                                                    <input class="form-control" type="file" id="formFile" name="image" style="display:none;" />
                                                    <img id="imagePreview" src="" alt="Image Preview" class="d-none" width="50%">
                                                </div>
                                                <button type="button" id="deleteImgPreview" class="btn btn-outline-danger btn-sm mt-2 float-end d-none" onclick="deleteImage()">Hapus</button>
                                            </div>
                                            <div class="col-md-6 my-2">
                                                <label for="start_price" class="form-label">Harga</label>
                                                <input type="text" class="form-control" id="start_price" value="{{ old('price', isset($perlengkapan) ? number_format($perlengkapan->price, 0, ',', '.') : '') }}" placeholder="" oninput="formatNumberInput(this); calculateDiscount()" min="0" required />
                                                <div class="col-md-12 my-2">
                                                    <label for="price_discount" class="form-label">Diskon (%) (Opsional)</label>
                                                    <input type="number" class="form-control" id="price_discount" name="price_discount" value="{{ old('price_discount', isset($perlengkapan) ? $perlengkapan->price_discount : '') }}" placeholder="" oninput="calculateDiscount()" min="0" max="100" required />
                                                </div>
                                                <div class="col-md-12 my-2">
                                                    <label for="final_price" class="form-label">Harga Diskon</label>
                                                    <input readonly type="text" class="form-control" id="final_price" value="{{ old('final_price') }}" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required>{{ old('deskripsi') }}</textarea>
                                            </div>
                                            <div class="col-md-6 my-2">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select" name="status" id="status" required>
                                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Publish</option>
                                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Non Publish</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mt-2 float-end">
                                            <a href="{{ route('mitra.perlengkapan.index') }}" class="btn btn-outline-secondary">Cancel</a>
                                            <button type="submit" class="btn btn-primary me-2">Tambah</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / Content -->
                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>

<script>
    function formatNumberInput(input) {        
        var value = input.value.replace(/[^0-9]/g, '');
        input.value = new Intl.NumberFormat('id-ID').format(value);

        const inputPrice = document.getElementById('inputPrice');
        inputPrice.value = value;
    }

    function calculateDiscount() {
        var priceElement = document.getElementById('start_price');
        var discountElement = document.getElementById('price_discount');
        var finalPriceElement = document.getElementById('final_price');

        var price = parseFloat(priceElement.value.replace(/\./g, '')) || 0;
        var discountPercentage = parseFloat(discountElement.value) || 0;

        var finalPrice = price - (price * (discountPercentage / 100));
        finalPriceElement.value = new Intl.NumberFormat('id-ID').format(finalPrice);

        const inputFinalPrice = document.getElementById('inputFinalPrice');
        inputFinalPrice.value = finalPrice;
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('[id^="start_price"]').forEach(function(element) {
            element.addEventListener('input', function() {
                formatNumberInput(this);
                calculateDiscount();
            });
        });

        document.querySelectorAll('[id^="price_discount"]').forEach(function(element) {
            element.addEventListener('input', function() {
                calculateDiscount();
            });
        });
    });

        // Foto Upload Dropzone
        document.addEventListener('DOMContentLoaded', function() {
            const dropzone = document.getElementById('dropzone');
            const fileInput = document.getElementById('formFile');
            const preview = document.getElementById('imagePreview');
            const deleteButton = document.getElementById('deleteImgPreview');
            const dropzoneText = document.getElementById('dropzoneText');
        
            dropzone.addEventListener('click', function() {
                fileInput.click();
            });
        
            dropzone.addEventListener('dragover', function(e) {
                e.preventDefault();
                dropzone.classList.add('bg-light');
            });
        
            dropzone.addEventListener('dragleave', function() {
                dropzone.classList.remove('bg-light');
            });
        
            dropzone.addEventListener('drop', function(e) {
                e.preventDefault();
                dropzone.classList.remove('bg-light');
                if (e.dataTransfer.files.length) {
                    fileInput.files = e.dataTransfer.files;
                    previewImage();
                }
            });
        
            fileInput.addEventListener('change', function() {
                previewImage();
            });
        
            function previewImage() {
                const file = fileInput.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('d-none');
                        dropzoneText.style.display = 'none';
                        deleteButton.classList.remove('d-none');
                    };
                    reader.readAsDataURL(file);
                }
            }
        
            deleteButton.addEventListener('click', function() {
                deleteImage();
            });
        
            function deleteImage() {
                fileInput.value = '';
                preview.src = '';
                preview.classList.add('d-none');
                dropzoneText.style.display = 'block';
                deleteButton.classList.add('d-none');
            }
        });
</script>
@endsection