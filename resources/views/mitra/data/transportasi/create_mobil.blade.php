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
            <a href="{{ route('mitra.transportasi.index') }}">
              <span class="text-muted fw-light">Transportasi /</span>
            </a>
            <a href="{{ route('mitra.transportasi.index') }}">
              <span class="text-muted fw-light">Add /</span>
            </a>Mobil
          </h4>

          <div class="row">
            <div class="col-md-12">
              <div class="card mb-4">
                <h5 class="card-header">Tambahkan Data Mobil</h5>
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

                  <form action="{{ route('mitra.transportasi.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="mitra_id" value="{{ Session::get('mitra_id') }}">
                    <div class="row">
                      <div class="mb-3 col-md-6">
                        <label for="title" class="form-label">Nama Kendaraan</label>
                        <input class="form-control" type="text" id="title" name="title" value="{{ old('title') }}" autofocus oninput="generateSlug()" />
                      </div>
                      <div class="mb-3 col-md-6">
                        <label for="jenis" class="form-label">Jenis Kendaraan</label>
                        <select class="form-select" name="jenis" id="jenis">
                          <option value="Manual" {{ old('jenis') == 'Manual' ? 'selected' : '' }}>Manual</option>
                          <option value="Matic" {{ old('jenis') == 'Matic' ? 'selected' : '' }}>Matic</option>
                        </select>
                      </div>
                      <div class="mb-3 col-md-6">
                        <label for="category" class="form-label">Kategori</label>
                        <select class="form-select" name="category_id" id="category">
                          @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="mb-3 col-md-6">
                        <label for="qty" class="form-label">Stok</label>
                        <input class="form-control" type="text" id="qty" name="qty" value="{{ old('qty') }}" placeholder="" />
                      </div>
                      <div class="mb-3 col-md-6">
                        <label for="bbm" class="form-label">Include BBM</label>
                        <select class="form-select" name="bbm" id="bbm">
                          <option value="1" {{ old('bbm') == '1' ? 'selected' : '' }}>Ya</option>
                          <option value="0" {{ old('bbm') == '0' ? 'selected' : '' }}>Tidak</option>
                        </select>
                      </div>                    
                      <div class="mb-3 col-md-6">
                        <label for="layanan" class="form-label">Layanan</label>
                        <select class="form-select" name="layanan" id="layanan">
                          <option value="Semua" {{ old('layanan') == 'Semua' ? 'selected' : '' }}>Semua</option>
                          <option value="Sopir" {{ old('layanan') == 'Sopir' ? 'selected' : '' }}>Sopir</option>
                          <option value="Lepas Kunci" {{ old('layanan') == 'Lepas Kunci' ? 'selected' : '' }}>Lepas Kunci</option>
                        </select>
                      </div>
                      <div class="mb-3 col-md-6">
                        <label for="seat" class="form-label">Jumlah Seat <small>(kursi)</small></label>
                        <input class="form-control" type="text" id="seat" name="seat" value="{{ old('seat') }}" placeholder="" />
                      </div>
                      <div class="mb-3 col-md-6">
                        <label for="refund" class="form-label">Refund</label>
                        <select class="form-select" name="refund" id="refund">
                          <option value="Ya" {{ old('refund') == 'Ya' ? 'selected' : '' }}>Ya</option>
                          <option value="Tidak" {{ old('refund') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                        </select>
                      </div>
                      <div class="mb-3 col-md-6">
                        <label for="formFile" class="form-label">Foto</label>
                        <div id="dropzone" class="border border-2 rounded p-3 d-flex align-items-center justify-content-center flex-column" style="min-height: 150px; cursor: pointer; position: relative;">
                          <span id="dropzoneText">Drag & Drop Image</span>
                          <input class="form-control" type="file" id="formFile" name="image" accept="image/*" style="display:none;" />
                          <img id="imagePreview" src="" alt="Image Preview" class="d-none" width="50%">
                        </div>
                        <button type="button" id="deleteImgPreview" class="btn btn-outline-danger btn-sm mt-2 float-end d-none" onclick="deleteImage()">Hapus</button>
                      </div>
                      <div class="mb-3 col-md-6">
                        <label for="deskripsi" class="form-label">Deskripsi <small>(Opsional)</small></label>
                        <textarea class="form-control" type="text" id="deskripsi" name="deskripsi" value="{{ old('deskripsi') }}" placeholder=""></textarea>
                      </div>
                      <div class="mb-3 col-md-6">
                        <label for="alamat" class="form-label">Link Alamat </label>
                        <input type="text" class="form-control" id="alamat" name="alamat">
                        <p class="float-end"><small>salin link alamat dari google maps<span class="text-danger">*</span></small></p>
                      </div>
                      <div class="mb-3 col-md-6">
                        <label for="price" class="form-label">Harga</label>
                        <input type="text" class="form-control" id="price" name="price" value="{{ old('price', isset($transportasi) ? number_format($transportasi->price, 0, ',', '.') : '') }}" placeholder="" oninput="formatNumberInput(this); calculateDiscount()" />
                      </div>
                    </div>
                    <div class="row">
                      <div class="mb-3 col-md-6">
                        <label for="price_discount" class="form-label">Diskon (%)</label>
                        <input type="text" class="form-control" id="price_discount" name="price_discount" value="{{ old('price_discount', isset($transportasi) ? $transportasi->price_discount : '') }}" placeholder="" oninput="calculateDiscount()" />
                      </div>
                      <div class="mb-3 col-md-6">
                        <label for="final_price" class="form-label">Harga Diskon</label>
                        <input readonly type="text" class="form-control" id="final_price" name="final_price" value="{{ old('final_price', isset($transportasi) ? number_format($transportasi->final_price, 0, ',', '.') : '') }}" placeholder="" />
                      </div>
                    </div>
                    {{-- <div class="row">
                      <div class="mb-3 col-md-6">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" name="status" id="status">
                          <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Publish</option>
                          <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Non Publish</option>
                        </select>
                      </div>
                      <div class="mb-3 col-md-6">
                        <label for="featured" class="form-label">Rekomendasi</label>
                        <select class="form-select" name="featured" id="featured">
                          <option value="1" {{ old('featured') == '1' ? 'selected' : '' }}>Ya</option>
                          <option value="0" {{ old('featured') == '0' ? 'selected' : '' }}>Tidak</option>
                        </select>
                      </div>
                    </div> --}}
                    <div class="col-md-6 mt-2 d-flex justify-content-end">
                      <button type="submit" class="btn btn-primary me-2 w-25">Add</button>
                      <a href="{{ route('mitra.transportasi.index') }}" class="btn btn-outline-secondary">Cancel</a>
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

// Image Preview For Foto 
// function previewImage() {
//     const input = document.getElementById('formFile');
//     const preview = document.getElementById('imagePreview');
//     const deleteButton = document.getElementById('deleteImgPreview');

//     if (input.files && input.files[0]) {
//         const reader = new FileReader();
        
//         reader.onload = function(e) {
//             preview.src = e.target.result;
//             preview.style.display = 'block';
//             deleteButton.classList.remove('d-none');
//         };
        
//         reader.readAsDataURL(input.files[0]);
//     } else {
//         preview.style.display = 'none';
//         deleteButton.classList.add('d-none');
//     }
// }

// function deleteImage() {
//     const input = document.getElementById('formFile');
//     const preview = document.getElementById('imagePreview');
//     const deleteButton = document.getElementById('deleteImgPreview');

//     input.value = '';
//     preview.src = '';
//     preview.style.display = 'none';
//     deleteButton.classList.add('d-none');
// }


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




  // document.getElementById('cancelButton').addEventListener('click', function() {
  //   const preview = document.getElementById('imagePreview');
  //   const cancelButton = document.getElementById('cancelButton');

  //   preview.src = '';
  //   preview.style.display = 'none';
  //   cancelButton.style.display = 'none';

  //   document.getElementById('formFile').value = '';
  // });

 // Hide Include BBM and include Sopir Form
 document.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.getElementById('category');
    const bbmDiv = document.getElementById('bbmDiv');
    const sopirDiv = document.getElementById('sopirDiv');

    // Function to show/hide Include BBM and Include Sopir based on selected category
    function toggleVisibility() {
        const selectedCategory = categorySelect.options[categorySelect.selectedIndex].text.toLowerCase();
        if (selectedCategory === 'mobil') {
            bbmDiv.classList.remove('d-none');
            sopirDiv.classList.remove('d-none');
        } else {
            bbmDiv.classList.add('d-none');
            sopirDiv.classList.add('d-none');
        }
    }

    // Event listener for category select change
    categorySelect.addEventListener('change', toggleVisibility);
    
    // Check the initial state
    toggleVisibility();
});



</script>

@endsection