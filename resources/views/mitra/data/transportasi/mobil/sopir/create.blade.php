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
            <a href="{{ route('mitra.mobil') }}">
                <span class="text-muted fw-light">Sopir /</span>
              </a>Tambah Sopir
          </h4>

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Tambah Data Sopir</h5>
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
                            <form action="{{ route('mitra.sopir.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="mitra_id" value="{{ Session::get('mitra_id') }}">
                                    <div class="row">
                                        <div class="col-md-6 my-2">
                                            <label for="name" class="form-label">Nama</label>
                                            <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}" autofocus>
                                        </div>
                                        <div class="col-md-6 my-2">
                                            <label for="usia" class="form-label">Usia</label>
                                            <input class="form-control" type="text" id="usia" name="usia" value="{{ old('usia') }}" autofocus>
                                        </div>
                                        <div class="col-md-6 my-2">
                                            <label for="formFileFoto" class="form-label">Pas Foto</label>
                                            <div id="dropzoneFoto" class="form-control p-3 d-flex align-items-center justify-content-center flex-column" style="min-height: 120px; cursor: pointer; position: relative;">
                                                <span id="dropzoneTextFoto">Drag & Drop Image</span>
                                                <input class="form-control" type="file" id="formFileFoto" name="foto" accept="image/*" style="display:none;" />
                                                <img id="fotoPreview" src="" alt="Foto Preview" class="d-none" width="50%">
                                            </div>
                                            <button type="button" id="deleteImgPreviewFoto" class="btn btn-outline-danger btn-sm mt-2 float-end d-none">Hapus</button>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select" name="status" id="status">
                                              <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Publish</option>
                                              <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Non Publish</option>
                                            </select>
                                          </div>
                                        <div class="col-md-6 my-2">
                                            <label for="formFileKTP" class="form-label">Foto KTP</label>
                                            <div id="dropzoneKTP" class="form-control p-3 d-flex align-items-center justify-content-center flex-column" style="min-height: 120px; cursor: pointer; position: relative;">
                                                <span id="dropzoneTextKTP">Drag & Drop Image</span>
                                                <input class="form-control" type="file" id="formFileKTP" name="ktp" accept="image/*" style="display:none;" />
                                                <img id="ktpPreview" src="" alt="KTP Preview" class="d-none" width="50%">
                                            </div>
                                            <button type="button" id="deleteImgPreviewKTP" class="btn btn-outline-danger btn-sm mt-2 float-end d-none">Hapus</button>
                                        </div>
                                        
                                        <div class="col-md-6 my-2">
                                            <label for="formFileSIM" class="form-label">Foto SIM</label>
                                            <div id="dropzoneSIM" class="form-control p-3 d-flex align-items-center justify-content-center flex-column" style="min-height: 120px; cursor: pointer; position: relative;">
                                                <span id="dropzoneTextSIM">Drag & Drop Image</span>
                                                <input class="form-control" type="file" id="formFileSIM" name="sim" accept="image/*" style="display:none;" />
                                                <img id="simPreview" src="" alt="SIM Preview" class="d-none" width="50%">
                                            </div>
                                            <button type="button" id="deleteImgPreviewSIM" class="btn btn-outline-danger btn-sm mt-2 float-end d-none">Hapus</button>
                                        </div>
                                        
                                        <div class="col-md-6 my-2">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ old('alamat') }}</textarea>
                                        </div>
                                        <div class="col-md-12 mt-2 d-flex justify-content-end">
                                            <a href="{{ route('mitra.mobil') }}" class="btn btn-outline-secondary me-2">Cancel</a>
                                            <button type="submit" class="btn btn-primary">Tambah</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
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


document.addEventListener('DOMContentLoaded', function() {
    setupDropzone('dropzoneFoto', 'formFileFoto', 'fotoPreview', 'deleteImgPreviewFoto', 'dropzoneTextFoto');
    setupDropzone('dropzoneKTP', 'formFileKTP', 'ktpPreview', 'deleteImgPreviewKTP', 'dropzoneTextKTP');
    setupDropzone('dropzoneSIM', 'formFileSIM', 'simPreview', 'deleteImgPreviewSIM', 'dropzoneTextSIM');
});

function setupDropzone(dropzoneId, fileInputId, previewId, deleteButtonId, dropzoneTextId) {
    const dropzone = document.getElementById(dropzoneId);
    const fileInput = document.getElementById(fileInputId);
    const preview = document.getElementById(previewId);
    const deleteButton = document.getElementById(deleteButtonId);
    const dropzoneText = document.getElementById(dropzoneTextId);

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
            previewImage(fileInput, preview, dropzoneText, deleteButton);
        }
    });

    fileInput.addEventListener('change', function() {
        previewImage(fileInput, preview, dropzoneText, deleteButton);
    });

    deleteButton.addEventListener('click', function() {
        deleteImage(fileInput, preview, dropzoneText, deleteButton);
    });
}

function previewImage(fileInput, preview, dropzoneText, deleteButton) {
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

function deleteImage(fileInput, preview, dropzoneText, deleteButton) {
    fileInput.value = '';
    preview.src = '';
    preview.classList.add('d-none');
    dropzoneText.style.display = 'block';
    deleteButton.classList.add('d-none');
}
</script>

@endsection