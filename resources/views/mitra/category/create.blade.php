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
                    <h4 class="fw-bold">Kategori</h4>

                    <!-- Basic Bootstrap Table -->
                    @include('mitra.message')
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('mitra.category.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="mitra_id" value="{{ Session::get('mitra_id') }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama Kategori</label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ old('name') }}" oninput="generateSlug()" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select" name="status" id="status">
                                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Publish</option>
                                            <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Hide</option>
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
</div>
@endsection