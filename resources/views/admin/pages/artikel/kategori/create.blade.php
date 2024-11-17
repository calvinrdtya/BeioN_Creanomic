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
                    <h4 class="fw-bold"><a href="{{ route('admin.kategori') }}"><span class="text-muted fw-light">Kategori / </span></a>Tambah Kategori</h4>

                    <!-- Basic Bootstrap Table -->
                    @include('admin.message')
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.kategori.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="judul" class="form-label">Kategori</label>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="name" value="{{ old('name') }}">
                                            </div>
                                        </div>
                                        <input type="hidden" name="role" value="admin">
                                        <div class="col-md-6">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select" name="status" id="status">
                                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Publish</option>
                                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Hide</option>
                                            </select>
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
@endsection