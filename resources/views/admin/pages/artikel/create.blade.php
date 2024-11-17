@extends('admin.layouts.app')

@section('content')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        <!-- Menu -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            @include('admin.layouts.sidebar')
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->
            <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                @include('admin.layouts.navbar')
            </nav>

            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold"><a href="{{ route('admin.artikel') }}"><span class="text-muted fw-light">Artikel / </span></a>Tambah Artikel</h4>

                    <!-- Basic Bootstrap Table -->
                    @include('admin.message')
                        <div class="card">
                            <div class="d-flex align-items-center">
                                <h5 class="card-header">Data Artikel</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 my-2">
                                            <label for="judul" class="form-label">Judul Artikel</label>
                                            <input type="text" class="form-control" name="title" id="title" placeholder="title" value="{{ old('title') }}">
                                        </div>
                                        <div class="col-md-6 my-2">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select" name="status" id="status">
                                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Publish</option>
                                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Hide</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 my-2">
                                            <label for="category_admin_id" class="form-label">Kategori</label>
                                            <select name="category_admin_id" class="form-select" id="category_admin_id">
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 my-2">
                                            <label for="kota" class="form-label">Kota</label>
                                            <input type="text" class="form-control" name="kota" id="kota" placeholder="kota" value="{{ old('kota') }}">
                                        </div>                         
                                        <div class="col-md-6 my-2">
                                            <label for="formFile" class="form-label">Thumbnail</label>
                                            <div id="dropzone" class="border border-2 rounded p-3 d-flex align-items-center justify-content-center flex-column" style="min-height: 150px; cursor: pointer; position: relative;">
                                                <span id="dropzoneText">Drag & Drop Image</span>
                                                <input class="form-control" type="file" id="formFile" name="thumbnails" style="display:none;" />
                                                <img id="imagePreview" src="" alt="Image Preview" class="d-none" width="50%">
                                            </div>
                                            <button type="button" id="deleteImgPreview" class="btn btn-outline-danger btn-sm mt-2 float-end d-none" onclick="deleteImage()">Hapus</button>
                                        </div>
                                        <div class="col-md-6 my-2">
                                            <div class="col-md-12 my-2">
                                                <label for="tag" class="form-label">Tag</label>
                                                <input type="text" class="form-control" name="tag" id="tag" placeholder="tag" value="{{ old('tag') }}">
                                            </div>         
                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                            <textarea class="form-control" type="text" id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2 float-end text-end">
                                        <button type="button" class="btn btn-outline-secondary me-2" onclick="history.back()">Cancel</button>
                                        <button type="submit" class="btn btn-primary w-25">Tambah</button>
                                    </div>
                                </form>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<script>
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

{{-- @extends('admin.layouts.app')

@section('content')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            @include('admin.layouts.sidebar')
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->
            <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                @include('admin.layouts.navbar')
            </nav>

            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold"><a href="{{ route('admin.artikel') }}"><span class="text-muted fw-light">Artikel /</span></a> Tambah Artikel</h4>
                    <div class="row">
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="mitra_id" value="{{ Session::get('mitra_id') }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="judul" class="form-label">Judul Artikel</label>
                                                <input type="text" class="form-control" name="title" id="title" placeholder="title" value="{{ old('title') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select" name="status" id="status">
                                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Publish</option>
                                                <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Hide</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="formFile" class="form-label">Foto</label>
                                            <div id="dropzone" class="border border-2 rounded p-3 d-flex align-items-center justify-content-center flex-column" style="min-height: 150px; cursor: pointer; position: relative;">
                                              <span id="dropzoneText">Drag & Drop Image</span>
                                              <input class="form-control" type="file" id="formFile" name="image" accept="image" style="display:none;" />
                                              <img id="imagePreview" src="" alt="Image Preview" class="d-none" width="50%">
                                            </div>
                                            <button type="button" id="deleteImgPreview" class="btn btn-outline-danger btn-sm mt-2 float-end d-none" onclick="deleteImage()">Hapus</button>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                            <textarea class="form-control" type="text" id="deskripsi" name="deskripsi" value="{{ old('deskripsi') }}" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2 float-end text-end">
                                        <button type="button" class="btn btn-outline-secondary me-2" onclick="history.back()">Cancel</button>
                                        <button type="submit" class="btn btn-primary w-25">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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

@endsection --}}