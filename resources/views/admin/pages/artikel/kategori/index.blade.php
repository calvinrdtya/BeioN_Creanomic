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
                    <h4 class="fw-bold">Kategori</h4>

                    <!-- Basic Bootstrap Table -->
                    @include('admin.message')
                    <div class="card">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="card-header">Data Kategori Artikel</h5>
                            <a href="{{ route('admin.kategori.create') }}" class="btn btn-sm btn-primary me-3">
                                Tambahkan Kategori
                            </a>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($categoriesAdmin as $index => $category)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td> 
                                                @if ($category->status == 1)
                                                <span class="badge bg-label-success me-1">Publish</span>
                                                @else
                                                <span class="badge bg-label-warning me-1">Hide</span>
                                                @endif
                                            </td>
                                            <td>{{ $category->created_at }}</td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <form action="{{ route('admin.kategori.destroy', $category->id) }}" method="POST">
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
                                    {{-- @foreach ($artikels as $index => $artikel)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                @if ($artikel->thumbnails)
                                                    <img src="{{ asset($artikel->thumbnails) }}" alt="Artikel Image" width="80">
                                                @else
                                                    No Image Available
                                                @endif
                                            </td>
                                            <td>{{ $artikel->title }}</td>
                                            <td>{{ $artikel->created_at }}</td>
                                            <td> 
                                                @if ($artikel->status == 1)
                                                    <span class="badge bg-label-success me-1">Publish</span>
                                                @else
                                                    <span class="badge bg-label-warning me-1">Hide</span>
                                                @endif</td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <a href="" type="button" class="btn btn-sm btn-outline-primary">
                                                        <i class='bx bx-search-alt-2'></i>
                                                    </a>
                                                    <button data-bs-toggle="modal" data-bs-target="#editArtikel{{ $artikel->id }}" type="button" class="btn btn-sm btn-outline-primary" data-artikel-id="{{ $artikel->id }}">
                                                        <span class="bx bx-edit-alt"></span>&nbsp; Edit
                                                    </button>
                                                    <form id="" action="" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger"><span class="bx bx-trash"></span>&nbsp; Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{-- @foreach ($artikels as $artikel)
    <div class="modal fade" id="editArtikel{{ $artikel->id }}" tabindex="-1" aria-labelledby="editartikelLabel{{ $artikel->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editartikelLabel{{ $artikel->id }}">Edit artikel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editartikelForm{{ $artikel->id }}" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="editTitle{{ $artikel->id }}" class="form-label">Nama artikel</label>
                                <input type="text" name="title" id="editTitle{{ $artikel->id }}" class="form-control" value="{{ $artikel->title }}" oninput="generateSlug({{ $artikel->id }})">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status{{ $artikel->id }}" class="form-label">Status</label>
                                <select class="form-select" name="status" id="status{{ $artikel->id }}">
                                    <option value="1" {{ $artikel->status == 1 ? 'selected' : '' }}>Publish</option>
                                    <option value="0" {{ $artikel->status == 0 ? 'selected' : '' }}>Non Publish</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="formFile{{ $artikel->id }}" class="form-label">Thumbnail</label>
                                <div id="dropzone{{ $artikel->id }}" class="border border-2 rounded p-3 d-flex align-items-center justify-content-center flex-column" style="min-height: 150px; cursor: pointer; position: relative;">
                                    <span id="dropzoneText{{ $artikel->id }}">Drag & Drop Image</span>
                                    <input class="form-control" type="file" id="formFile{{ $artikel->id }}" name="thumbnail" onchange="previewImage({{ $artikel->id }})" style="display:none;" />
                                    <img id="imagePreview{{ $artikel->id }}" src="{{ asset($artikel->thumbnails) }}" alt="Image Preview" class="d-none" width="50%">
                                </div>
                                <button type="button" id="deleteImgPreview{{ $artikel->id }}" class="btn btn-outline-danger btn-sm mt-2 float-end d-none" onclick="deleteImage({{ $artikel->id }})">Hapus</button>
                            </div>                             --}}
                            {{-- <div class="mb-3 col-md-6">
                                <label for="formFile{{ $artikel->id }}" class="form-label">Foto</label>
                                <input class="form-control" type="file" id="formFile{{ $artikel->id }}" name="thumbnail" accept="image/*" onchange="previewImage({{ $artikel->id }})" />
                                <div class="mt-2">
                                    <img id="imagePreview{{ $artikel->id }}" src="{{ asset('img/' . $artikel->thumbnail) }}" alt="Image Preview" style="display:block; width:100px;" />
                                </div>
                            </div> --}}
                            {{-- <div class="col-md-6 mb-3">
                                <label for="description{{ $artikel->id }}" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="description{{ $artikel->id }}" name="description" rows="4">{{ $artikel->deskripsi }}</textarea>
                            </div>
                            
                            <div class="d-grid gap-2 col-lg-6 mx-auto">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach --}}

@endsection