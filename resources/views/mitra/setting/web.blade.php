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

        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar" >
            @include('mitra.layouts.navbar')
        </nav>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Akun /</span> Akun Setting</h4>

            <div class="row">
              <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                  <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Akun</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href=""><i class="bx bx-receipt me-1"></i> Biodata</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href=""><i class="bx bx-globe me-1"></i> Web App</a>
                  </li>
                </ul>
                <div class="card mb-4">
                  <h5 class="card-header">Web App</h5>
                  <!-- Account -->
                  <div class="card-body">
                    <form id="formAccountSettings" method="POST" onsubmit="return false">
                        <div class="mb-3">
                          <label for="first_name" class="form-label">Nama Web</label>
                          <input class="form-control" type="text" id="name_web" name="name_web" autofocus/>
                        </div>
                    <div class="row">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Logo</label>
                            <input class="form-control" type="file" id="formFile" accept="image/*" onchange="previewImage()" />
                        </div>
                    </div>
                    <div class="mb-3">
                        <img id="imagePreview" src="" alt="Image Preview" style="display:none; width:100%; max-width:300px;" />
                    </div>
                    <div class="mb-3 mt-3">
                        <button id="cancelButton" type="reset" class="btn btn-outline-danger" style="display:none;">Ganti</button>
                    </div>
                      <div class="mt-2 float-end">
                        <button type="submit" class="btn btn-primary me-2">Save</button>
                        {{-- <button type="reset" class="btn btn-outline-secondary">Cancel</button> --}}
                      </div>
                    </form>
                  </div>
                  <!-- /Account -->
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
    function previewImage() {
        const fileInput = document.getElementById('formFile');
        const preview = document.getElementById('imagePreview');
        const cancelButton = document.getElementById('cancelButton');
        
        const file = fileInput.files[0];
        const reader = new FileReader();
        
        reader.addEventListener('load', function () {
            preview.src = reader.result;
            preview.style.display = 'block';
            cancelButton.style.display = 'inline-block';
        }, false);
        
        if (file) {
            reader.readAsDataURL(file);
        }
    }

    // Menambahkan event listener untuk tombol Cancel
    document.getElementById('cancelButton').addEventListener('click', function() {
        const preview = document.getElementById('imagePreview');
        const cancelButton = document.getElementById('cancelButton');
        
        preview.src = '';
        preview.style.display = 'none';
        cancelButton.style.display = 'none';
        
        document.getElementById('formFile').value = '';
    });
</script>


@endsection