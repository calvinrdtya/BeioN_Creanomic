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
                  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Mitra /</span> Edit Data</h4>
    
                  <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills flex-column flex-md-row mb-3">
                            <li class="nav-item">
                              <a class="nav-link {{ request()->routeIs('mitra.transportasi.data') ? 'active' : '' }}" href=""><i class="bx bx-user me-1"></i>Data</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{ route('mitra.transportasi.akun') }}"><i class="bx bx-receipt me-1"></i>Akun</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href=""><i class="bx bx-globe me-1"></i> Web App</a>
                            </li>
                          </ul>
                      <div class="card mb-4">
                        <h5 class="card-header">Profile Details</h5>
                        <!-- Account -->
                        <div class="card-body">
                          <form id="formAccountSettings" method="POST" onsubmit="return false">
                            <div class="row">
                              <div class="mb-3 col-md-6">
                                <label for="mitra" class="form-label">Mitra</label>
                                <input class="form-control" type="text" id="name" name="name" value="">
                              </div>
                              <div class="mb-3 col-md-6">
                                <label for="owner" class="form-label">Owner</label>
                                <input class="form-control" type="text" name="owner" id="owner" value="">
                              </div>
                              <div class="mb-3 col-md-6">
                                <label for="pic" class="form-label">PIC</label>
                                <input class="form-control" type="text" id="pic" name="pic" value="">
                              </div>
                              <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input class="form-control" type="text" id="email" name="email" value="">
                              </div>
                              <div class="mb-3 col-md-6">
                                <label class="form-label" for="no_handphone">No. Handphone</label>
                                <div class="input-group input-group-merge">
                                  <span class="input-group-text">ID (+62)</span>
                                  <input type="text" id="phone" name="phone" class="form-control">
                                </div>
                              </div>
                              <div class="mb-3 col-md-6">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat">
                              </div>
                              <div class="mb-3 col-md-6">
                                <label for="jabatan" class="form-label">Jabatan PIC</label>
                                <input type="text" class="form-control" id="jabatan_pic" name="jabatan_pic">
                              </div>
                              <div class="mb-3 col-md-6">
                                {{-- <label for="jabatan" class="form-label">Status</label>
                                <input type="text" class="form-control" id="jabatan_pic" name="jabatan_pic"> --}}
                              </div>
                              <div class="mb-3 col-md-6">
                                <label for="formFile" class="form-label">Identitas</label>
                                <div id="dropzone" class="border border-2 rounded p-3 d-flex align-items-center justify-content-center flex-column" style="min-height: 100px; cursor: pointer; position: relative;">
                                  <span id="dropzoneText">Drag & Drop File</span>
                                  <input class="form-control" type="file" id="formFile" name="image" accept="image/*" style="display:none;" />
                                  <img id="imagePreview" src="" alt="Image Preview" class="d-none" width="50%">
                                </div>
                                <button type="button" id="deleteImageIdentitas" class="btn btn-danger float-end my-2 d-none" onclick="deleteImage()">Hapus</button>
                              </div>
                              <div class="mb-3 col-md-6">
                                <label for="legalitas" class="form-label">Legalitas</label>
                                <div id="file_legalitas" class="border border-2 rounded p-3 d-flex align-items-center justify-content-center flex-column" style="min-height: 100px; cursor: pointer; position: relative;">
                                    <span id="legalitasText">Drag & Drop File</span>
                                    <input class="form-control" type="file" id="fileLegalitas" name="file" style="display:none;" />
                                    <span id="nameLegalitas" class="d-none">Nama File</span>
                                </div>
                                <button type="button" id="deleteFileLegalitas" class="btn btn-danger float-end my-2 d-none" onclick="deleteLegalitas()">Hapus</button>
                              </div>
                              
                              {{-- <div class="mb-3 col-md-6">
                                <label class="form-label" for="country">Country</label>
                                <select id="country" class="select2 form-select">
                                  <option value="">Select</option>
                                  <option value="Australia">Australia</option>
                                  <option value="Bangladesh">Bangladesh</option>
                                  <option value="Belarus">Belarus</option>
                                  <option value="Brazil">Brazil</option>
                                  <option value="Canada">Canada</option>
                                  <option value="China">China</option>
                                  <option value="France">France</option>
                                  <option value="Germany">Germany</option>
                                  <option value="India">India</option>
                                  <option value="Indonesia">Indonesia</option>
                                  <option value="Israel">Israel</option>
                                  <option value="Italy">Italy</option>
                                  <option value="Japan">Japan</option>
                                  <option value="Korea">Korea, Republic of</option>
                                  <option value="Mexico">Mexico</option>
                                  <option value="Philippines">Philippines</option>
                                  <option value="Russia">Russian Federation</option>
                                  <option value="South Africa">South Africa</option>
                                  <option value="Thailand">Thailand</option>
                                  <option value="Turkey">Turkey</option>
                                  <option value="Ukraine">Ukraine</option>
                                  <option value="United Arab Emirates">United Arab Emirates</option>
                                  <option value="United Kingdom">United Kingdom</option>
                                  <option value="United States">United States</option>
                                </select>
                              </div> --}}
                            </div>
                            <div class="d-flex mt-2 justify-content-end">
                              <button type="submit" class="btn btn-primary me-2">Save changes</button>
                              <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            </div>
                          </form>
                        </div>
                        <!-- /Account -->
                      </div>
                      
                    </div>
                  </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>

// Function Image Identitas
document.getElementById('file_legalitas').addEventListener('click', function() {
    document.getElementById('fileLegalitas').click();
});

document.getElementById('fileLegalitas').addEventListener('change', function(event) {
    var fileInput = event.target;
    var file = fileInput.files[0];
    var nameLegalitasElement = document.getElementById('nameLegalitas');
    var legalitasText = document.getElementById('legalitasText');
    var deleteFileLegalitasButton = document.getElementById('deleteFileLegalitas');

    if (file) {
        nameLegalitasElement.textContent = file.name;
        nameLegalitasElement.classList.remove('d-none');
        legalitasText.classList.add('d-none');
        deleteFileLegalitasButton.classList.remove('d-none');
    } else {
        nameLegalitasElement.classList.add('d-none');
        legalitasText.classList.remove('d-none');
        deleteFileLegalitasButton.classList.add('d-none');
    }
});

function deleteLegalitas() {
    var fileInput = document.getElementById('fileLegalitas');
    var nameLegalitasElement = document.getElementById('nameLegalitas');
    var legalitasText = document.getElementById('legalitasText');
    var deleteFileLegalitasButton = document.getElementById('deleteFileLegalitas');

    fileInput.value = '';
    nameLegalitasElement.classList.add('d-none');
    legalitasText.classList.remove('d-none');
    deleteFileLegalitasButton.classList.add('d-none');
}

// Function Image Identitas
  document.addEventListener('DOMContentLoaded', function() {
    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('formFile');
    const preview = document.getElementById('imagePreview');
    const deleteButton = document.getElementById('deleteImageIdentitas');
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