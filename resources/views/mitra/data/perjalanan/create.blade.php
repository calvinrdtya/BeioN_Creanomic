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
                    <h4 class="fw-bold my-3">Perjalanan</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <h5 class="card-header">Tambah Perjalanan</h5>
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
                                    <form action="{{ route('mitra.perjalanan.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="mitra_id" value="{{ Session::get('mitra_id') }}">
                                        <div class="row">
                                            <div class="col-md-6 my-2">
                                                <label for="title" class="form-label">Destinasi</label>
                                                <input class="form-control" type="text" id="title" name="title" value="{{ old('title') }}" autofocus >
                                            </div>
                                            <div class="col-md-6 my-2">
                                                <label for="tgl_perjalanan" class="form-label">Tanggal Perjalanan</label>
                                                <input class="form-control" type="date" id="tgl_perjalanan" name="tgl_perjalanan" value="{{ old('tgl_perjalanan') }}" />
                                            </div>
                                            {{-- <div class="col-md-6 my-2">
                                                <label for="tgl_perjalanan" class="form-label">Date</label>
                                                <input class="form-control" type="date" id="tgl_perjalanan" value="{{ old('tgl_perjalanan') }}">
                                            </div> --}}
                                            <div class="col-md-6 my-2">
                                                <label for="titik" class="form-label">Meeting Points <small>(Pisahkan dengan Koma ",")</small></label>
                                                <input class="form-control" type="text" id="titik" name="titik" value="{{ old('titik') }}" placeholder="Bandara/Stasiun/Terminal" />
                                                <p class="my-1 float-end"><small>Contoh: Bandara Juanda (09.00), Stasiun Pasar Turi (07.00)<span class="text-danger">*</span></small></p>
                                            </div>
                                            <div class="col-md-6 my-2">
                                                <label for="qty" class="form-label">Minimal Orang</label>
                                                <input class="form-control" type="text" id="qty" name="qty" value="{{ old('qty') }}" placeholder="">
                                            </div>
                                            <div class="col-md-6 my-2">
                                            <label for="hightlight" class="form-label">Highlight</label>
                                                <input class="form-control" type="text" id="hightlight" name="hightlight" value="{{ old('hightlight') }}" placeholder="">
                                            </div>
                                            <div class="col-md-6 my-2">
                                                <label for="kota" class="form-label">Kota</label>
                                                <input class="form-control" type="text" id="kota" name="kota" value="{{ old('kota') }}" placeholder="">
                                            </div>
                                            <div class="col-md-6 my-2">
                                                <label for="category" class="form-label">Kategori</label>
                                                <select class="form-select" name="category_id" id="category">
                                                    @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 my-2">
                                                <label for="durasi" class="form-label">Durasi</label>
                                                <input type="text" class="form-control" id="durasi" name="durasi" value="{{ old('durasi') }}">
                                                <p class="my-1 float-end">Contoh:<small>&nbsp;2 Hari 1 Malam</small></p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="formFile" class="form-label">Thumbnails</label>
                                                    <div id="dropzone" class="border border-2 rounded p-3 d-flex align-items-center justify-content-center flex-column" style="min-height: 100px; cursor: pointer; position: relative;">
                                                    <span id="dropzoneText">Drag & Drop Thumbnails</span>
                                                    <input class="form-control" type="file" id="thumbnail" name="thumbnail" accept="image" style="display:none;" />
                                                    <img id="imagePreview" src="" alt="Image Preview" class="d-none" width="50%">
                                                </div>
                                                <button type="button" id="deleteImgPreview" class="btn btn-outline-danger btn-sm mt-2 float-end d-none" onclick="deleteImage()">Ganti</button>
                                                <button type="button" class="btn btn-outline-primary my-3" onclick="addImageInput()">Tambah Foto</button>
                                            </div>
                                            <!-- Additional Images Container -->
                                            <div class="col-md-6" id="additionalImagesContainer"></div>
                                            <div class="col-md-6 my-2">
                                                <label for="price" class="form-label">Harga</label>
                                                <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}">
                                            </div>
                                            <div class="col-md-6 my-2">
                                                <label for="price_discount" class="form-label">Diskon (Opsional)</label>
                                                <input type="text" class="form-control" id="price_discount" name="price_discount" value="{{ old('price_discount') }}">
                                            </div>
                                            <div class="col-md-6 my-2">
                                                <label for="final_price" class="form-label">Harga Setelah Diskon</label>
                                                <input readonly type="text" class="form-control" id="final_price" name="final_price" value="{{ old('final_price') }}">
                                            </div>
                                            <div class="col-md-6 my-2">
                                                <label for="shipping_return" class="form-label">Return</label>
                                                <select class="form-select" id="shipping_return" name="shipping_return">
                                                    <option value="1" {{ old('shipping_return') == '1' ? 'selected' : '' }}>Ya</option>
                                                    <option value="0" {{ old('shipping_return') == '0' ? 'selected' : '' }}>Tidak</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 my-2">
                                                <label for="jenis" class="form-label">Jenis Perjalanan</label>
                                                <select class="form-select" id="jenis" name="jenis">
                                                    <option value="1" {{ old('jenis') == '1' ? 'selected' : '' }}>Open</option>
                                                    <option value="0" {{ old('jenis') == '0' ? 'selected' : '' }}>Private</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 my-2">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select" id="status" name="status">
                                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Aktif</option>
                                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 my-2">
                                                <label for="include" class="form-label">Include <small>(Paket sudah termasuk)</small></label>
                                                <textarea class="form-control" id="include" name="include" rows="4">{{ old('include') }}</textarea>
                                                <p class="my-1 float-end"><small>Pisahkan dengan koma</small></p>
                                            </div>
                                            <div class="col-md-6 my-2">
                                                <label for="exclude" class="form-label">Exclude <small>(Paket belum termasuk)</small></label>
                                                <textarea class="form-control" id="exclude" name="exclude" rows="4">{{ old('exclude') }}</textarea>
                                                <p class="my-1 float-end"><small>Pisahkan dengan koma</small></p>
                                            </div>
                                            <div class="col-md-6 my-2">
                                                <label for="fasilitas" class="form-label">Fasilitas</label>
                                                <textarea class="form-control" id="fasilitas" name="fasilitas" rows="4">{{ old('fasilitas') }}</textarea>
                                                <p class="my-1 float-end"><small>Pisahkan dengan koma</small></p>
                                            </div>
                                            <div class="col-md-6 my-2">
                                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>
                                            </div>
                                        </div>
                                
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5 class="card-header">Tambah Itinerary</h5>
                                    <button type="button" class="btn btn-sm btn-outline-info align-items-center d-flex me-4" id="btnTambahItinerary">
                                        <i class='bx bx-sm bx-list-plus me-1'></i>Tambah Itinerary
                                    </button>                                 
                                </div>
                                    <div class="card-body">
                                        <div id="itineraryContainer">
                                            <!-- Form Itinerary Utama -->
                                            <div class="itinerary-form row">
                                                <div class="col-md-4">
                                                    <label for="title_itinerary" class="form-label">Title Itinerary</label>
                                                    <input type="text" class="form-control" name="title_itinerary[]" value="{{ old('title_itinerary') }}">
                                                    <p class="my-1 float-end"><small>Judul Itinerary</small></p>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="jam" class="form-label">Jam</label>
                                                    <input class="form-control" type="time" name="jam[]" value="{{ old('jam') }}">
                                                </div>                    
                                                <div class="col-md-4">
                                                    <label for="deskripsi_itinerary" class="form-label">Deskripsi <small>Opsional</small></label>
                                                    <textarea class="form-control" name="deskripsi_itinerary[]">{{ old('deskripsi_itinerary') }}</textarea>
                                                </div>
                                            </div>
                                        </div>  
                                        {{-- <div id="additionalItineraryForms"></div>                                                                                                                                                                                                                                                            --}}
                                    </div>
                                    <div class="p-3">
                                        <button type="submit" class="btn btn-primary float-end">Tambah Perjalanan</button>
                                    </div>
                                </form>
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
//  let itineraryCounter = 1;

// function addItinerary() {
//     itineraryCounter++;
//     const container = document.getElementById('itineraryForms');

//     // Buat div utama untuk form baru
//     const newFormDiv = document.createElement('div');
//     newFormDiv.classList.add('itinerary-form', 'row');

//     // Buat input untuk title itinerary
//     const newTitleInput = document.createElement('input');
//     newTitleInput.setAttribute('type', 'text');
//     newTitleInput.classList.add('form-control');
//     newTitleInput.setAttribute('name', 'title_itinerary[]');
//     newTitleInput.setAttribute('placeholder', 'Title Itinerary');

//     // Buat input untuk jam
//     const newJamInput = document.createElement('input');
//     newJamInput.setAttribute('type', 'time');
//     newJamInput.classList.add('form-control');
//     newJamInput.setAttribute('name', 'jam[]');

//     // Buat textarea untuk deskripsi itinerary
//     const newDeskripsiTextarea = document.createElement('textarea');
//     newDeskripsiTextarea.classList.add('form-control');
//     newDeskripsiTextarea.setAttribute('name', 'deskripsi_itinerary[]');
//     newDeskripsiTextarea.setAttribute('placeholder', 'Deskripsi');

//     // Button untuk menghapus itinerary
//     const deleteButton = document.createElement('button');
//     deleteButton.setAttribute('type', 'button');
//     deleteButton.classList.add('btn', 'btn-danger', 'btn-sm', 'ms-2');
//     deleteButton.textContent = 'Hapus';
//     deleteButton.addEventListener('click', function() {
//         container.removeChild(newFormDiv); // Hapus form jika tombol delete ditekan
//     });

//     // Append input, textarea, dan button delete ke dalam div form
//     newFormDiv.appendChild(newTitleInput);
//     newFormDiv.appendChild(newJamInput);
//     newFormDiv.appendChild(newDeskripsiTextarea);
//     newFormDiv.appendChild(deleteButton);

//     // Append form baru ke dalam container itineraryForms
//     container.appendChild(newFormDiv);
// }
</script>

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
// Foto Upload Dropzone
document.addEventListener('DOMContentLoaded', function() {
    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('thumbnail');
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


//     function previewImage(inputId) {
//     const input = document.getElementById(inputId);
//     const preview = document.getElementById('imagePreview_' + inputId);
//     const cancelButton = document.getElementById('cancelButton_' + inputId);

//     if (input.files && input.files[0]) {
//         const reader = new FileReader();
//         reader.onload = function(e) {
//             preview.src = e.target.result;
//             preview.style.display = 'block';
//             cancelButton.style.display = 'inline-block';
//         }
//         reader.readAsDataURL(input.files[0]);
//     } else {
//         clearPreview(inputId);
//     }
// }

// function clearPreview(inputId) {
//     const input = document.getElementById(inputId);
//     const preview = document.getElementById('imagePreview_' + inputId);
//     const cancelButton = document.getElementById('cancelButton_' + inputId);

//     input.value = '';
//     preview.src = '';
//     preview.style.display = 'none';
//     cancelButton.style.display = 'none';
// }

// Dropzone Image
let imageCounter = 1;
function addImageInput() {
    imageCounter++;
    const container = document.getElementById('additionalImagesContainer');

    const newInputDiv = document.createElement('div','col-md-6', 'mb-3');

    const newLabel = document.createElement('label');
    newLabel.setAttribute('for', 'image' + imageCounter);
    newLabel.classList.add('form-label');
    newLabel.textContent = 'Foto ' + imageCounter;

    const newInput = document.createElement('input');
    newInput.classList.add('form-control');
    newInput.setAttribute('type', 'file');
    newInput.setAttribute('id', 'image' + imageCounter);
    newInput.setAttribute('name', 'image[]'); // Perubahan di sini menjadi image[] agar Laravel dapat memprosesnya sebagai array
    newInput.setAttribute('accept', 'image/*');
    newInput.setAttribute('onchange', 'previewImage("image' + imageCounter + '")');

    const newPreviewDiv = document.createElement('div');
    newPreviewDiv.classList.add('mt-2');

    const newImg = document.createElement('img');
    newImg.setAttribute('id', 'imagePreview_image' + imageCounter);
    newImg.setAttribute('src', '');
    newImg.setAttribute('alt', 'Image ' + imageCounter + ' Preview');
    newImg.style.display = 'none';
    newImg.style.width = '100px';

    const newButtonDiv = document.createElement('div');
    newButtonDiv.classList.add('mb-3', 'mt-3');

    const newCancelButton = document.createElement('button');
    newCancelButton.setAttribute('type', 'button');
    newCancelButton.classList.add('btn', 'btn-outline-danger', 'btn-sm');
    newCancelButton.setAttribute('id', 'cancelButton_image' + imageCounter);
    newCancelButton.setAttribute('onclick', 'clearPreview("image' + imageCounter + '")');
    newCancelButton.style.display = 'none';
    newCancelButton.textContent = 'Ganti';

    newPreviewDiv.appendChild(newImg);
    newButtonDiv.appendChild(newCancelButton);
    newInputDiv.appendChild(newLabel);
    newInputDiv.appendChild(newInput);
    newInputDiv.appendChild(newPreviewDiv);
    newInputDiv.appendChild(newButtonDiv);

    container.appendChild(newInputDiv);
}

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