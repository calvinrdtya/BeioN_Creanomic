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
                  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Produk /</span> Add Produk</h4>
    
                  <div class="row">
                    <div class="col-md-7">
                      <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="defaultFormControlInput" class="form-label"><strong>Title</strong></label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Title" aria-describedby="defaultFormControlHelp"/>
                            </div>
                            <div class="mb-3">
                                <label for="slug">Slug</label>
                                <input type="text" readonly name="slug" id="slug" class="form-control" placeholder="Slug">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Deskripsi Tagline</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" class="summernote"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" class="summernote"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Return Produk</label>
                                <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                                    <option value="1">Ya</option>
                                    <option value="2">Tidak</option>
                                </select>
                            </div>
                        </div>
                    </div>
                        <div class="card mb-4">
                            <h5 class="card-header">Harga</h5>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="defaultFormControlInput" class="form-label"><strong>Harga</strong></label>
                                    <input type="number" class="form-control" name="title" id="title" placeholder="Title" aria-describedby="defaultFormControlHelp"/>
                                </div>
                                <div class="mb-3">
                                    <label for="defaultFormControlInput" class="form-label"><strong>Harga Diskon</strong></label>
                                    <input type="number" class="form-control" name="title" id="title" placeholder="Title" aria-describedby="defaultFormControlHelp"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                      <div class="card mb-4">
                        <h5 class="card-header">Produk</h5>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Status Produk</label>
                                <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                                    <option selected>Pilih Status</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Kategori</label>
                                <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                                    <option selected>Pilih Kategori</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Sub Kategori</label>
                                <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                                    <option selected>Pilih Sub Kategori</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <h5 class="card-header">Masukkan ke Produk Unggulan</h5>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Produk Unggulan</label>
                                <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                                    <option value="1">Ya</option>
                                    <option value="2">Tidak</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Image</label>
                                <input class="form-control" type="file" id="formFile" />
                            </div>
                        </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>

<script>

</script>

@endsection