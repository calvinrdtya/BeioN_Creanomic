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
          <h4 class="fw-bold py- mb-4">
            <a href="{{ route('mitra.motor') }}">
              <span class="text-muted fw-light">Transportasi /</span>
            </a>Tambahkan Motor
          </h4>
          <div class="row">
            <div class="col-md-12">
              <div class="card mb-4">
                <h5 class="card-header">Tambahkan Data Motor</h5>
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

                  <form action="{{ route('mitra.motor.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="mitra_id" value="{{ Session::get('mitra_id') }}">
                    <div class="row">
                      <div class="mb-3 col-md-6">
                        <label for="title" class="form-label">Nama Kendaraan</label>
                        <input class="form-control" type="text" id="title" name="title" value="{{ old('title') }}" autofocus>
                      </div>
                    <div class="mb-3 col-md-6">
                      <label for="jenis" class="form-label">Jenis Kendaraan</label>
                      <select class="form-select" name="jenis" id="jenis">
                        <option value="Manual" {{ old('jenis') == 'Manual' ? 'selected' : '' }}>Manual</option>
                        <option value="Matic" {{ old('jenis') == 'Matic' ? 'selected' : '' }}>Matic</option>
                      </select>
                    </div>
                    <div class="mb-3 col-md-6">
                      <label for="slug" class="form-label">Kategori</label>
                      <select class="form-select" name="category_id" id="category">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                          {{ $category->name }}
                        </option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3 col-md-6">
                      <label for="qty" class="form-label">Stok</label>
                      <input class="form-control" type="text" id="qty" name="qty" value="{{ old('qty') }}" placeholder="" />
                    </div>
                    <div class="mb-3 col-md-6">
                      <label for="deskripsi" class="form-label">Deskripsi &nbsp<small>(Opsional)</small></label>
                      <textarea class="form-control" type="text" id="deskripsi" name="deskripsi" value="{{ old('deskripsi') }}" placeholder=""></textarea>
                    </div>
                    <div class="mb-3 col-md-6">
                      <label for="alamat" class="form-label">Alamat</label>
                      <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ old('alamat', $mitra->alamat) }}</textarea>
                    </div>
                </div>
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="formFile" class="form-label">Foto</label>
                    <input class="form-control" type="file" id="formFile" name="image" accept="image/*" onchange="previewImage()" />
                    <div class="mt-2">
                      <img id="imagePreview" src="" alt="Image Preview" style="display:none; width:100px;" />
                    </div>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="price" class="form-label">Harga</label>
                    <input type="text" class="form-control" id="price" name="price" value="{{ old('price', isset($transportasi) ? number_format($transportasi->price, 0, ',', '.') : '') }}" placeholder="" oninput="formatNumberInput(this); calculateDiscount()" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="price_discount" class="form-label">Diskon (%)</label>
                    <input type="text" class="form-control" id="price_discount" name="price_discount" value="{{ old('price_discount', isset($transportasi) ? $transportasi->price_discount : '') }}" placeholder="" oninput="calculateDiscount()" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="final_price" class="form-label">Harga Diskon</label>
                    <input readonly type="text" class="form-control" id="final_price" name="final_price" value="{{ old('final_price', isset($transportasi) ? number_format($transportasi->final_price, 0, ',', '.') : '') }}" placeholder="" />
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
              </div>
              <div class="col-md-6 mt-2 float-end text-end">
                <button type="submit" class="btn btn-primary me-2">Tambahkan</button>
                <a href="{{ route('mitra.motor') }}" class="btn btn-outline-secondary">Cancel</a>
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
</script>

@endsection