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
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    @include('mitra.layouts.navbar')
                </nav>

                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold">Profil</h4>
                        <div class="row">
                            <div class="col-md-12">
                                {{-- <ul class="nav nav-pills flex-column flex-md-row mb-3">
                                <li class="nav-item">
                                    <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="pages-account-settings-notifications.html"><i class="bx bx-bell me-1"></i> Notifications</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="pages-account-settings-connections.html"
                                    ><i class="bx bx-link-alt me-1"></i> Connections</a>
                                </li>
                                </ul> --}}
                                <div class="card mb-4">
                                    <h5 class="card-header">Profil</h5>
                                    <!-- Account -->
                                    <div class="card-body">

                                        @if (session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif

                                        @if (session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                        @endif

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <form id="formAccountSettings"
                                            action="{{ route('mitra.perlengkapan.profil.update', $user->id) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <input type="hidden" name="old_logo" value="{{ $user->logo }}">
                                            <input type="hidden" id="inputLogo" name="logo_name">

                                            <div class="d-flex align-items-start align-items-center gap-4">
                                                <div id="dropzone">
                                                    <div class="border border-2 rounded d-flex align-items-center justify-content-center flex-column"
                                                        style="width: 100px; height: 100px; cursor: pointer; position: relative;">
                                                        <span id="dropzoneText">Upload Logo</span>
                                                        <input class="form-control" type="file" id="formFile"
                                                            name="logo" style="display:none;"
                                                            onchange="previewImage()" />
                                                        <img id="imagePreview" alt="Upload Logo" class="d-none img-fluid"
                                                            src="{{ $user->logo_path }}">
                                                    </div>
                                                </div>
                                                <div>
                                                    <button type="button" id="deleteImgPreview"
                                                        class="btn btn-outline-secondary account-image-reset d-none"
                                                        onclick="deleteImage()">
                                                        <i class="bx bx-reset d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Reset</span>
                                                    </button>
                                                </div>
                                            </div>
                                            <hr class="my-4" />

                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label for="" class="form-label">Nama Mitra</label>
                                                    <input class="form-control" type="text" id="" name="name"
                                                        value="{{ $user->name }}" autofocus required />
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input class="form-control" type="email" id="email"
                                                        value="{{ $user->email }}" disabled />
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="" class="form-label">Owner</label>
                                                    <input class="form-control" type="text" name="owner" id=""
                                                        value="{{ $user->owner }}">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="" class="form-label">Jabatan Pic</label>
                                                    <input class="form-control" type="text" name="pic" id=""
                                                        value="{{ $user->pic }}">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label" for="">Nomer Handphone
                                                        (wa)</label>
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text">ID (+62)</span>
                                                        <input type="text" id="" name="phone"
                                                            class="form-control" value="{{ $user->phone }}" />
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="" class="form-label">Alamat</label>
                                                    <input type="text" class="form-control" id="" name="alamat"
                                                        value="{{ $user->alamat }}">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="" class="form-label">Latitude</label>
                                                    <input type="text" class="form-control" id=""
                                                        name="latitude" value="{{ $user->latitude }}">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="" class="form-label">Longitude</label>
                                                    <input type="text" class="form-control" id=""
                                                        name="longitude" value="{{ $user->longitude }}">
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                                <a href="{{ route('mitra.perlengkapan.profil') }}"
                                                    class="btn btn-outline-secondary">Kembali</a>
                                            </div>
                                            <!-- /Account -->
                                        </form>
                                    </div>
                                    {{-- <div class="card">
                              <h5 class="card-header">Delete Account</h5>
                              <div class="card-body">
                                <div class="mb-3 col-12 mb-0">
                                  <div class="alert alert-warning">
                                    <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                                    <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                                  </div>
                                </div>
                                <form id="formAccountDeactivation" onsubmit="return false">
                                  <div class="form-check mb-3">
                                    <input
                                      class="form-check-input"
                                      type="checkbox"
                                      name="accountActivation"
                                      id="accountActivation"
                                    />
                                    <label class="form-check-label" for="accountActivation"
                                      >I confirm my account deactivation</label
                                    >
                                  </div>
                                  <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                                </form>
                              </div>
                            </div> --}}
                                </div>
                            </div>
                            <!-- / Content -->

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const preview = document.getElementById('imagePreview');
                const deleteBtn = document.getElementById('deleteImgPreview');
                const dropzoneText = document.getElementById('dropzoneText');
                const inputLogo = document.getElementById('inputLogo');

                if (preview.src && preview.src.includes('http')) {
                    preview.classList.remove('d-none');
                    deleteBtn.classList.remove('d-none');
                    dropzoneText.style.display = 'none';


                    const filePath = preview.src;
                    const fileName = filePath.substring(filePath.lastIndexOf('/') + 1);
                    inputLogo.value = fileName;
                }
            });

            function previewImage(perlengkapanId) {
                const input = document.getElementById(`formFile`);
                const preview = document.getElementById(`imagePreview`);
                const deleteBtn = document.getElementById(`deleteImgPreview`);
                const dropzoneText = document.getElementById(`dropzoneText`);

                const file = input.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                    deleteBtn.classList.remove('d-none');
                    dropzoneText.style.display = 'none';

                    const filePath = preview.src;
                    const fileName = filePath.substring(filePath.lastIndexOf('/') + 1);
                    inputLogo.value = fileName;
                };

                if (file) {
                    reader.readAsDataURL(file);
                }
            }

            function deleteImage(perlengkapanId) {
                const preview = document.getElementById(`imagePreview`);
                const input = document.getElementById(`formFile`);
                const deleteBtn = document.getElementById(`deleteImgPreview`);
                const dropzoneText = document.getElementById(`dropzoneText`);

                input.value = '';
                preview.src = '';
                preview.classList.add('d-none');
                deleteBtn.classList.add('d-none');
                dropzoneText.style.display = 'block';

                const filePath = preview.src;
                const fileName = filePath.substring(filePath.lastIndexOf('/') + 1);
                inputLogo.value = fileName;
            }

            document.querySelectorAll('[id^="dropzone"]').forEach(dropzone => {
                const inputFile = dropzone.querySelector('input[type="file"]');
                const previewImg = dropzone.querySelector('img');

                dropzone.addEventListener('click', () => inputFile.click());

                dropzone.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    dropzone.classList.add('border-primary');
                });

                dropzone.addEventListener('dragleave', () => {
                    dropzone.classList.remove('border-primary');
                });

                dropzone.addEventListener('drop', (e) => {
                    e.preventDefault();
                    dropzone.classList.remove('border-primary');

                    if (e.dataTransfer.files.length) {
                        inputFile.files = e.dataTransfer.files;
                        previewImage(dropzone.id.replace('dropzone', ''));
                    }
                });
            });
        </script>
    @endsection
