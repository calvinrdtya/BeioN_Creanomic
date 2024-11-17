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
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('mitra.transportasi.setting.data.index') ? 'active' : '' }}" href=""><i class="bx bx-user me-1"></i>Data</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('mitra.transportasi.akun') }}"><i class="bx bx-receipt me-1"></i>Akun</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href=""><i class="bx bx-globe me-1"></i> Web App</a>
                                </li>
                            </ul>
                            <div class="card mb-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5 class="card-header mb-0">Data Mitra</h5>
                                    <h5 class="card-header mb-0"></h5>
                                    <div class="d-flex align-items-center">
                                        <!-- <a href="{{ route('mitra.transportasi.setting.data.create') }}" class="btn btn-sm btn-primary me-2">Create Data</a> -->
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#editDataMitra" class="btn btn-sm btn-info me-2">Edit Data</button>
                                    </div>
                                </div>
                                <!-- Account -->
                                <div class="card-body">
                                    @if(isset($mitra))
                                    <div class="row">
                                        <div class="col-md-6">
                                            <dl class="row mt-2">
                                                <dt class="col-sm-4">Mitra</dt>
                                                <dd class="col-sm-8">: {{ $mitra->name }}</dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-6">
                                            <dl class="row mt-2">
                                                <dt class="col-sm-4">Owner</dt>
                                                <dd class="col-sm-8">: {{ $mitra->owner }}</dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-6">
                                            <dl class="row mt-2">
                                                <dt class="col-sm-4">PIC</dt>
                                                <dd class="col-sm-8">: {{ $mitra->pic }}</dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-6">
                                            <dl class="row mt-2">
                                                <dt class="col-sm-4">Email</dt>
                                                <dd class="col-sm-8">: {{ $mitra->email }}</dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-6">
                                            <dl class="row mt-2">
                                                <dt class="col-sm-4">No. Handphone</dt>
                                                <dd class="col-sm-8">: {{ $mitra->phone }}</dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-6">
                                            <dl class="row mt-2">
                                                <dt class="col-sm-4">Jabatan PIC</dt>
                                                <dd class="col-sm-8">: {{ $mitra->jabatan }}</dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-6">
                                            <dl class="row mt-2">
                                                <dt class="col-sm-4">Legalitas</dt>
                                                @if(isset($mitra->legal))
                                                <dd class="col-sm-8">: {{ $mitra->legal['type'] }}</dd>
                                                <dd class="col-sm-8">
                                                    @if(isset($mitra->legal['photo']))
                                                    <img src="{{ asset('storage/' . $mitra->legal['photo']) }}" alt="Foto Legalitas" class="mt-2 rounded-3" style="max-width: 100%;">
                                                    @endif
                                                </dd>
                                                @endif
                                            </dl>
                                        </div>
                                        <div class="col-md-6">
                                            <dl class="row mt-2">
                                                <dt class="col-sm-4">Identitas</dt>
                                                @if(isset($mitra->identitas))
                                                <dd class="col-sm-8">: {{ $mitra->identitas['type'] }}</dd>
                                                <dd class="col-sm-8">
                                                    @if(isset($mitra->identitas['photo']))
                                                    <img src="{{ asset('storage/' . $mitra->identitas['photo']) }}" alt="Foto Identitas" class="mt-2 rounded-3" style="max-width: 100%;">
                                                    @endif
                                                </dd>
                                                @endif
                                            </dl>
                                        </div>
                                        <div class="col-md-6">
                                            <dl class="row mt-2">
                                                <dt class="col-sm-4">Alamat</dt>
                                                <dd class="col-sm-8">: {{ $mitra->alamat }}</dd>
                                            </dl>
                                        </div>
                                    </div>
                                    @endif
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


{{-- Modal Edit Data Mitra --}}
<div class="modal fade" id="editDataMitra" tabindex="-1" aria-labelledby="edithomestayLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edithomestayLabel">Edit Data Mitra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editDataMitraForm" action="{{ route('mitra.update-account') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 my-2">
                            <label for="name" class="form-label">Mitra</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $mitra->name }}" required>
                        </div>
                        <div class="col-md-6 my-2">
                            <label for="owner" class="form-label">Owner</label>
                            <input type="text" name="owner" id="owner" class="form-control" value="{{ $mitra->owner }}" required>
                        </div>
                        <div class="col-md-6 my-2">
                            <label for="pic" class="form-label">PIC</label>
                            <input type="text" name="pic" id="pic" class="form-control" value="{{ $mitra->pic }}" required>
                        </div>
                        <div class="col-md-6 my-2">
                            <label for="email" class="form-label">Email</label>
                            <input readonly type="email" name="email" id="email" class="form-control" value="{{ $mitra->email }}" required>
                        </div>
                        <div class="col-md-6 my-2">
                            <label class="form-label" for="phone">No. Handphone</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">ID (+62)</span>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ $mitra->phone }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" name="alamat" id="alamat" class="form-control" value="{{ $mitra->alamat }}" required>
                        </div>
                        <div class="col-md-6 my-2">
                            <label for="jabatan" class="form-label">Jabatan PIC</label>
                            <input type="text" name="jabatan" id="jabatan" class="form-control" value="{{ $mitra->jabatan }}" required>
                        </div>
                        <div class="col-md-6 my-2">
                            <label for="identitas_type">Tipe Identitas</label>
                            <select name="identitas_type" id="identitas_type" class="form-control" required>
                                <option value="KTP" {{ isset($mitra->identitas) && $mitra->identitas['type'] == 'KTP' ? 'selected' : '' }}>KTP</option>
                                <option value="Passport" {{ isset($mitra->identitas) && $mitra->identitas['type'] == 'Passport' ? 'selected' : '' }}>Passport</option>
                                <option value="SIM" {{ isset($mitra->identitas) && $mitra->identitas['type'] == 'SIM' ? 'selected' : '' }}>SIM</option>
                            </select>
                        </div>
                        <div class="col-md-6 my-2">
                            <label for="identitas_photo">Foto Identitas</label>
                            <div id="dropzoneIdentitas" class="dropzone border border-2 rounded p-3 d-flex align-items-center justify-content-center flex-column">
                                <span id="dropzoneTextIdentitas">Drag & Drop File atau Klik untuk Mengunggah</span>
                                <input class="form-control" type="file" id="formFileIdentitas" name="identitas_photo" accept="image/*" style="display:none;" />
                                @if(isset($mitra->identitas) && $mitra->identitas['img'])
                                <img id="imagePreviewIdentitas" src="{{ asset('storage/' . $mitra->identitas['img']) }}" alt="Foto Identitas" class="mt-2" style="max-width: 100%;">
                                <button type="button" id="deleteImageIdentitas" class="btn btn-danger float-end mt-2">Hapus</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 my-2">
                            <label for="legalitas_type">Tipe Legalitas</label>
                            <select name="legalitas_type" id="legalitas_type" class="form-control" required>
                                <option value="Belum Ada" {{ isset($mitra->legal) && $mitra->legal['type'] == 'Belum Ada' ? 'selected' : '' }}>Belum Ada</option>
                                <option value="NIB" {{ isset($mitra->legal) && $mitra->legal['type'] == 'NIB' ? 'selected' : '' }}>NIB</option>
                                <option value="SIUP" {{ isset($mitra->legal) && $mitra->legal['type'] == 'SIUP' ? 'selected' : '' }}>SIUP</option>
                                <option value="IUI" {{ isset($mitra->legal) && $mitra->legal['type'] == 'IUI' ? 'selected' : '' }}>IUI</option>
                                <option value="Lainnya" {{ isset($mitra->legal) && $mitra->legal['type'] == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-6 my-2" id="legalitas_photo_group" style="display: {{ isset($mitra->legal) && $mitra->legal['type'] == 'Belum Ada' ? 'none' : 'block' }}">
                            <label for="legalitas_photo">Foto Legalitas</label>
                            <div id="dropzoneLegalitas" class="dropzone border border-2 rounded p-3 d-flex align-items-center justify-content-center flex-column">
                                <span id="dropzoneTextLegalitas">Drag & Drop File atau Klik untuk Mengunggah</span>
                                <input class="form-control" type="file" id="formFileLegalitas" name="legalitas_photo" accept="image/*" style="display:none;" />
                                @if(isset($mitra->legal) && $mitra->legal['img'])
                                <img id="imagePreviewLegalitas" src="{{ asset('storage/' . $mitra->legal['img']) }}" alt="Foto Legalitas" class="mt-2" style="max-width: 100%;">
                                <button type="button" id="deleteImageLegalitas" class="btn btn-danger float-end mt-2">Hapus</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Identitas
        const dropzoneIdentitas = document.getElementById('dropzoneIdentitas');
        const fileInputIdentitas = document.getElementById('formFileIdentitas');
        const previewIdentitas = document.getElementById('imagePreviewIdentitas');
        const deleteButtonIdentitas = document.getElementById('deleteImageIdentitas');
        const dropzoneTextIdentitas = document.getElementById('dropzoneTextIdentitas');

        // Legalitas
        const dropzoneLegalitas = document.getElementById('dropzoneLegalitas');
        const fileInputLegalitas = document.getElementById('formFileLegalitas');
        const previewLegalitas = document.getElementById('imagePreviewLegalitas');
        const deleteButtonLegalitas = document.getElementById('deleteImageLegalitas');
        const dropzoneTextLegalitas = document.getElementById('dropzoneTextLegalitas');

        // Function to handle previewing images
        function previewImage(fileInput, preview, deleteButton, dropzoneText) {
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

        // Identitas
        fileInputIdentitas.addEventListener('change', function() {
            previewImage(fileInputIdentitas, previewIdentitas, deleteButtonIdentitas, dropzoneTextIdentitas);
        });

        deleteButtonIdentitas.addEventListener('click', function() {
            deleteImage(fileInputIdentitas, previewIdentitas, dropzoneTextIdentitas, deleteButtonIdentitas);
        });

        // Legalitas
        fileInputLegalitas.addEventListener('change', function() {
            previewImage(fileInputLegalitas, previewLegalitas, deleteButtonLegalitas, dropzoneTextLegalitas);
        });

        deleteButtonLegalitas.addEventListener('click', function() {
            deleteImage(fileInputLegalitas, previewLegalitas, dropzoneTextLegalitas, deleteButtonLegalitas);
        });

        // Function to delete image preview
        function deleteImage(fileInput, preview, dropzoneText, deleteButton) {
            fileInput.value = '';
            preview.src = '';
            preview.classList.add('d-none');
            dropzoneText.style.display = 'block';
            deleteButton.classList.add('d-none');
        }
    });
</script>

@endsection