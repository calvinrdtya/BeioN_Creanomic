@extends('admin.layouts.app')

@section('content')

<style>
    .image-sidebar {
        width: 80px !important;
        height: 60px !important;
        object-fit: cover !important;
    }
</style>

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
            {{-- <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                @include('admin.layouts.navbar')
            </nav> --}}

            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold">Artikel</h4>

                    <!-- Basic Bootstrap Table -->
                    @include('admin.message')
                    <div class="card">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="card-header">Data Artikel</h5>
                            <a href="{{ route('admin.artikel.create') }}" class="btn btn-sm btn-primary me-3">
                                Tambahkan Artikel
                            </a>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Thumbnail</th>
                                        <th>Kota</th>
                                        <th>Kategori</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($artikels as $index => $artikel)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                @if ($artikel->thumbnails)
                                                    <img src="{{ asset($artikel->thumbnails) }}" alt="Artikel Image" class="image-sidebar" width="80">
                                                @else
                                                    No Image Available
                                                @endif
                                            </td>
                                            @php
                                                $kotas = explode(',', $artikel->kota);
                                                $duaKota = array_slice($kotas, 0, 1); // Ambil dua kota pertama
                                            @endphp

                                            <td>{{ implode(', ', $duaKota) }}</td>
                                            <td>{{ $artikel->categoryAdmin->name }}</td>
                                            <td> 
                                                @if ($artikel->status == 1)
                                                    <span class="badge bg-label-success me-1">Publish</span>
                                                @else
                                                    <span class="badge bg-label-warning me-1">Hide</span>
                                                @endif</td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <a href="{{ route('admin.artikel.show', ['id' => $artikel->id]) }}" type="button" class="btn btn-sm btn-outline-secondary">
                                                        <i class='bx bx-search-alt-2'></i>
                                                    </a>
                                                    <button data-bs-toggle="modal" data-bs-target="#editArtikel{{ $artikel->id }}" type="button" class="btn btn-sm btn-outline-primary" data-artikel-id="{{ $artikel->id }}">
                                                        <span class="bx bx-edit-alt"></span>&nbsp; Edit
                                                    </button>
                                                    <form id="delete-artikel-{{ $artikel->id }}" action="{{ route('admin.artikel.delete', ['id' => $artikel->id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                                            <span class="bx bx-trash"></span>&nbsp; Hapus
                                                        </button>
                                                    </form>                                                    
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@foreach ($artikels as $artikel)
    <div class="modal fade" id="editArtikel{{ $artikel->id }}" tabindex="-1" aria-labelledby="editartikelLabel{{ $artikel->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editartikelLabel{{ $artikel->id }}">Edit artikel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editartikelForm{{ $artikel->id }}" action="{{ route('admin.artikel.update', ['id' => $artikel->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="editTitle{{ $artikel->id }}" class="form-label">Title</label>
                                <input type="text" name="title" id="editTitle{{ $artikel->id }}" class="form-control" value="{{ $artikel->title }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status{{ $artikel->id }}" class="form-label">Status</label>
                                <select class="form-select" name="status" id="status{{ $artikel->id }}">
                                    <option value="1" {{ $artikel->status == 1 ? 'selected' : '' }}>Publish</option>
                                    <option value="0" {{ $artikel->status == 0 ? 'selected' : '' }}>Hide</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="editKota{{ $artikel->id }}" class="form-label">Kota</label>
                                <input type="text" name="kota" id="editKota{{ $artikel->id }}" class="form-control" value="{{ $artikel->kota }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="editTag{{ $artikel->id }}" class="form-label">Tag</label>
                                <input type="text" name="tag" id="editTag{{ $artikel->id }}" class="form-control" value="{{ $artikel->tag }}">
                            </div>
                            {{-- <div class="col-md-6 my-2">
                                <label for="formFile" class="form-label">Thumbnail</label>
                                <div id="dropzone" class="border border-2 rounded p-3 d-flex align-items-center justify-content-center flex-column" style="min-height: 150px; cursor: pointer; position: relative;">
                                    <span id="dropzoneText">Drag & Drop Image</span>
                                    <input class="form-control" type="file" id="formFile" name="thumbnails" style="display:none;" />
                                    <img id="imagePreview" src="{{ asset($artikel->thumbnails) }}" alt="Image Preview" class="d-none" width="50%">
                                </div>
                                <button type="button" id="deleteImgPreview" class="btn btn-outline-danger btn-sm mt-2 float-end d-none" onclick="deleteImage()">Hapus</button>
                            </div> --}}
                            <div class="col-md-6 my-2">
                                <label for="formFile" class="form-label">Thumbnail</label>
                                <input class="form-control" type="file" id="formFile" name="thumbnails" accept="image/*" onchange="validateFileSize()" />
                                <img id="imagePreview" src="{{ asset($artikel->thumbnails) }}" alt="Image Preview" class="d-none mt-2" width="50%">
                                <button type="button" id="deleteImgPreview" class="btn btn-outline-danger btn-sm mt-2 float-end d-none" onclick="deleteImage()">Hapus</button>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="description{{ $artikel->id }}" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="description{{ $artikel->id }}" name="description" rows="4">{{ $artikel->deskripsi }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 float-end text-end">
                            <button type="button" class="btn btn-outline-secondary me-2" onclick="history.back()">Cancel</button>
                            <button type="submit" class="btn btn-primary w-25">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

<script>
    function validateFileSize() {
        const fileInput = document.getElementById('formFile');
        const imagePreview = document.getElementById('imagePreview');
        const deleteButton = document.getElementById('deleteImgPreview');
        
        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            const maxSize = 1 * 1024 * 1024; // 1MB
            
            if (file.size > maxSize) {
                alert('File size must not exceed 1MB');
                fileInput.value = ''; // Clear the input
                imagePreview.classList.add('d-none');
                deleteButton.classList.add('d-none');
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove('d-none');
                deleteButton.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.classList.add('d-none');
            deleteButton.classList.add('d-none');
        }
    }

    function deleteImage() {
        const fileInput = document.getElementById('formFile');
        const imagePreview = document.getElementById('imagePreview');
        const deleteButton = document.getElementById('deleteImgPreview');
        
        fileInput.value = '';
        imagePreview.classList.add('d-none');
        deleteButton.classList.add('d-none');
    }

    // Foto Upload Dropzone
    // document.addEventListener('DOMContentLoaded', function() {
    //     const dropzone = document.getElementById('dropzone');
    //     const fileInput = document.getElementById('formFile');
    //     const preview = document.getElementById('imagePreview');
    //     const deleteButton = document.getElementById('deleteImgPreview');
    //     const dropzoneText = document.getElementById('dropzoneText');

    //     // Cek apakah ada thumbnail dari database saat halaman dimuat
    //     if (preview.src && preview.src !== window.location.href) {
    //         preview.classList.remove('d-none');
    //         dropzoneText.style.display = 'none';
    //         deleteButton.classList.remove('d-none');
    //     }

    //     dropzone.addEventListener('click', function() {
    //         fileInput.click();
    //     });

    //     dropzone.addEventListener('dragover', function(e) {
    //         e.preventDefault();
    //         dropzone.classList.add('bg-light');
    //     });

    //     dropzone.addEventListener('dragleave', function() {
    //         dropzone.classList.remove('bg-light');
    //     });

    //     dropzone.addEventListener('drop', function(e) {
    //         e.preventDefault();
    //         dropzone.classList.remove('bg-light');
    //         if (e.dataTransfer.files.length) {
    //             fileInput.files = e.dataTransfer.files;
    //             previewImage();
    //         }
    //     });

    //     fileInput.addEventListener('change', function() {
    //         previewImage();
    //     });

    //     function previewImage() {
    //         const file = fileInput.files[0];
    //         if (file) {
    //             const reader = new FileReader();
    //             reader.onload = function(e) {
    //                 preview.src = e.target.result;
    //                 preview.classList.remove('d-none');
    //                 dropzoneText.style.display = 'none';
    //                 deleteButton.classList.remove('d-none');
    //             };
    //             reader.readAsDataURL(file);
    //         }
    //     }

    //     deleteButton.addEventListener('click', function() {
    //         deleteImage();
    //     });

    //     function deleteImage() {
    //         fileInput.value = '';
    //         preview.src = '';
    //         preview.classList.add('d-none');
    //         dropzoneText.style.display = 'block';
    //         deleteButton.classList.add('d-none');
    //     }
    // });

    
//     function previewImage(id) {
//     const fileInput = document.getElementById(`formFile${id}`);
//     const imagePreview = document.getElementById(`imagePreview${id}`);
//     const deleteButton = document.getElementById(`deleteImgPreview${id}`);
//     const dropzoneText = document.getElementById(`dropzoneText${id}`);

//     const file = fileInput.files[0];
//     const reader = new FileReader();

//     reader.onload = function (e) {
//         imagePreview.src = e.target.result;
//         imagePreview.classList.remove('d-none');
//         deleteButton.classList.remove('d-none');
//         dropzoneText.style.display = 'none';
//     }

//     if (file) {
//         reader.readAsDataURL(file);
//     } else {
//         imagePreview.src = '';
//         imagePreview.classList.add('d-none');
//         deleteButton.classList.add('d-none');
//         dropzoneText.style.display = 'block';
//     }
// }

// function previewImage(id) {
//     const fileInput = document.getElementById(`formFile${id}`);
//     const imagePreview = document.getElementById(`imagePreview${id}`);
//     const deleteButton = document.getElementById(`deleteImgPreview${id}`);
//     const dropzoneText = document.getElementById(`dropzoneText${id}`);

//     const file = fileInput.files[0];
//     if (file) {
//         const reader = new FileReader();
//         reader.onload = function(e) {
//             imagePreview.src = e.target.result;
//             imagePreview.classList.remove('d-none');
//             deleteButton.classList.remove('d-none');
//             dropzoneText.style.display = 'none';
//         }
//         reader.readAsDataURL(file);
//     }
// }

// function previewImage(id) {
//     const fileInput = document.getElementById(`formFile${id}`);
//     const imagePreview = document.getElementById(`imagePreview${id}`);
//     const deleteButton = document.getElementById(`deleteImgPreview${id}`);
//     const dropzoneText = document.getElementById(`dropzoneText${id}`);

//     const file = fileInput.files[0];
//     if (file) {
//         const reader = new FileReader();
//         reader.onload = function(e) {
//             imagePreview.src = e.target.result;
//             imagePreview.classList.remove('d-none');
//             deleteButton.classList.remove('d-none');
//             dropzoneText.classList.add('d-none');
//         }
//         reader.readAsDataURL(file);
//     }
// }

// function deleteImage(id) {
//     const fileInput = document.getElementById(`formFile${id}`);
//     const imagePreview = document.getElementById(`imagePreview${id}`);
//     const deleteButton = document.getElementById(`deleteImgPreview${id}`);
//     const dropzoneText = document.getElementById(`dropzoneText${id}`);

//     fileInput.value = '';
//     imagePreview.src = '';
//     imagePreview.classList.add('d-none');
//     deleteButton.classList.add('d-none');
//     dropzoneText.classList.remove('d-none');
// }
</script>

@endsection