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
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tambahkan Data Homestay</h4>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <h5 class="card-header">Tambahkan Data Homestay</h5>
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

                                    <form action="{{ route('mitra.homestay.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="mitra_id" value="{{ Session::get('mitra_id') }}">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="title" class="form-label">Nama Homestay</label>
                                                <input class="form-control" type="text" id="title" name="title" value="{{ old('title') }}" autofocus>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="qty" class="form-label">Kamar Yang Tersedia</label>
                                                <input class="form-control" type="text" id="qty" name="qty" value="{{ old('qty') }}" placeholder="" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="higlight" class="form-label">Fasilitas Kamar</label>
                                                <textarea class="form-control" id="higlight" name="higlight" placeholder="">{{ old('higlight') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="thumbnail" class="form-label">Thumbnail</label>
                                                <input class="form-control" type="file" id="thumbnail" name="thumbnail" accept="image/*" onchange="previewImage('thumbnail')" />
                                                <div class="mt-2">
                                                    <img id="imagePreview_thumbnail" src="" alt="Thumbnail Preview" style="display:none; width:100px;" />
                                                </div>
                                                <div class="mb-3 mt-3">
                                                    <button id="cancelButton_thumbnail" type="button" class="btn btn-outline-danger" style="display:none;" onclick="clearPreview('thumbnail')">Ganti</button>
                                                </div>
                                            </div>

                                            <!-- Image 1 -->
                                            <div class="col-md-6 mb-3">
                                                <label for="image" class="form-label">Foto 1</label>
                                                <input class="form-control" type="file" id="image" name="image" accept="image/*" onchange="previewImage('image')" />
                                                <div class="mt-2">
                                                    <img id="imagePreview_image" src="" alt="Image 1 Preview" style="display:none; width:100px;" />
                                                </div>
                                                <div class="mb-3 mt-3">
                                                    <button id="cancelButton_image" type="button" class="btn btn-outline-danger" style="display:none;" onclick="clearPreview('image')">Ganti</button>
                                                </div>
                                            </div>

                                            <!-- Image 2 -->
                                            <div class="col-md-6 mb-3">
                                                <label for="image2" class="form-label">Foto 2</label>
                                                <input class="form-control" type="file" id="image2" name="image2" accept="image/*" onchange="previewImage('image2')" />
                                                <div class="mt-2">
                                                    <img id="imagePreview_image2" src="" alt="Image 2 Preview" style="display:none; width:100px;" />
                                                </div>
                                                <div class="mb-3 mt-3">
                                                    <button id="cancelButton_image2" type="button" class="btn btn-outline-danger" style="display:none;" onclick="clearPreview('image2')">Ganti</button>
                                                </div>
                                            </div>

                                            <!-- Image 3 -->
                                            <div class="col-md-6 mb-3">
                                                <label for="image3" class="form-label">Foto 3</label>
                                                <input class="form-control" type="file" id="image3" name="image3" accept="image/*" onchange="previewImage('image3')" />
                                                <div class="mt-2">
                                                    <img id="imagePreview_image3" src="" alt="Image 3 Preview" style="display:none; width:100px;" />
                                                </div>
                                                <div class="mb-3 mt-3">
                                                    <button id="cancelButton_image3" type="button" class="btn btn-outline-danger" style="display:none;" onclick="clearPreview('image3')">Ganti</button>
                                                </div>
                                            </div>

                                            <!-- Image 4 -->
                                            <div class="col-md-6 mb-3">
                                                <label for="image4" class="form-label">Foto 4</label>
                                                <input class="form-control" type="file" id="image4" name="image4" accept="image/*" onchange="previewImage('image4')" />
                                                <div class="mt-2">
                                                    <img id="imagePreview_image4" src="" alt="Image 4 Preview" style="display:none; width:100px;" />
                                                </div>
                                                <div class="mb-3 mt-3">
                                                    <button id="cancelButton_image4" type="button" class="btn btn-outline-danger" style="display:none;" onclick="clearPreview('image4')">Ganti</button>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="price" class="form-label">Harga</label>
                                                <input type="text" class="form-control" id="price" name="price" value="{{ old('price', isset($homestay) ? number_format($homestay->price, 0, ',', '.') : '') }}" placeholder="" oninput="formatNumberInput(this); calculateDiscount()" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="price_discount" class="form-label">Diskon (%)</label>
                                                <input type="text" class="form-control" id="price_discount" name="price_discount" value="{{ old('price_discount', isset($homestay) ? $homestay->price_discount : '') }}" placeholder="" oninput="calculateDiscount()" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="final_price" class="form-label">Harga Diskon</label>
                                                <input readonly type="text" class="form-control" id="final_price" name="final_price" value="{{ old('final_price', isset($homestay) ? number_format($homestay->final_price, 0, ',', '.') : '') }}" placeholder="" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                                <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="">{{ old('deskripsi') }}</textarea>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select" name="status" id="status">
                                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Publish</option>
                                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Non Publish</option>
                                                </select>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="shipping_return" class="form-label">Refund</label>
                                                <select class="form-select" name="shipping_return" id="shipping_return">
                                                    <option value="0" {{ old('shipping_return') == '0' ? 'selected' : '' }}>Tidak</option>
                                                    <option value="1" {{ old('shipping_return') == '1' ? 'selected' : '' }}>Ya</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mt-2 float-end">
                                            <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                            <a href="{{ route('mitra.homestay.index') }}" class="btn btn-outline-secondary">Cancel</a>
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
    }

    function calculateDiscount() {
        var priceElement = document.getElementById('price');
        var discountElement = document.getElementById('price_discount');
        var finalPriceElement = document.getElementById('final_price');

        var price = parseFloat(priceElement.value.replace(/\./g, '')) || 0;
        var discountPercentage = parseFloat(discountElement.value) || 0;

        var finalPrice = price - (price * (discountPercentage / 100));
        finalPriceElement.value = new Intl.NumberFormat('id-ID').format(finalPrice);
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('[id^="price"]').forEach(function(element) {
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

    function previewImage(elementId) {
        const fileInput = document.getElementById(elementId);
        const preview = document.getElementById('imagePreview_' + elementId);
        const cancelButton = document.getElementById('cancelButton_' + elementId);

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

    function clearPreview(elementId) {
        const preview = document.getElementById('imagePreview_' + elementId);
        const cancelButton = document.getElementById('cancelButton_' + elementId);

        preview.src = '';
        preview.style.display = 'none';
        cancelButton.style.display = 'none';

        document.getElementById(elementId).value = '';
    }
</script>
@endsection