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
                                    <a class="nav-link {{ request()->routeIs('mitra.perlengkapan.bank') ? 'active' : '' }}" href="">Bank</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link" href=""><i class="bx bx-receipt me-1"></i>Akun</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href=""><i class="bx bx-globe me-1"></i>Informasi dan Kebijakan</a>
                                </li> --}}
                            </ul>
                            <div class="card mb-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5 class="card-header mb-0">Informasi Bank</h5>
                                    <h5 class="card-header mb-0"></h5>
                                    <div class="d-flex align-items-center">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#addDataMitra" class="btn btn-sm btn-primary me-4">Tambah Bank</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive text-nowrap">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Bank</th>
                                                    <th>Rekening</th>
                                                    <th>Nama</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                @forelse($bankPerlengkapans as $bank)
                                                    <tr>
                                                        <td>{{ $bank->bank }}</td>
                                                        <td>{{ $bank->no_rekening }}</td>
                                                        <td>{{ $bank->nama_pemilik }}</td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <button data-bs-toggle="modal" data-bs-target="#editBank{{ $bank->id }}" type="button" class="btn btn-sm btn-outline-primary me-4" data-perlengkapan-id="{{ $bank->id }}">
                                                                    <span class="bx bx-edit-alt"></span>&nbsp; Edit
                                                                </button>
                                                                {{-- <form id="delete-form-{{ $perlengkapan->id }}" action="{{ route('mitra.perlengkapan.destroy', $perlengkapan->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-outline-danger"><span class="bx bx-trash"></span>&nbsp;Hapus</button>
                                                                </form> --}}
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="text-center" colspan="5">Tidak Ada Data</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Add Bank Mitra --}}
<div class="modal fade" id="addDataMitra" tabindex="-1" aria-labelledby="edithomestayLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edithomestayLabel">Tambahkan Bank</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editDataMitraForm" action="{{ route('mitra.perlengkapan.bank.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="my-3">
                        <label for="bank" class="form-label">Bank</label>
                        <input type="text" class="form-control" name="bank" id="bank" placeholder="masukkan bank" value="{{ old('bank') }}" required>
                    </div>
                    <div class="my-3">
                        <label for="no_rekening" class="form-label">Nomor Rekening</label>
                        <input type="number" class="form-control" name="no_rekening" id="no_rekening" placeholder="masukkan nomor rekening" value="{{ old('no_rekening') }}" required>
                    </div>
                    <div class="my-3">
                        <label for="nama_pemilik" class="form-label">Nama Pemilik</label>
                        <input type="text" class="form-control" name="nama_pemilik" id="nama_pemilik" placeholder="masukkan nama pemilik" value="{{ old('nama_pemilik') }}" required>
                    </div>
                </div>            
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit Bank Mitra --}}
@foreach ($bankPerlengkapans as $bank)
    <div class="modal fade" id="editBank{{ $bank->id }}" tabindex="-1" aria-labelledby="editBankLabel{{ $bank->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Bank</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editBankForm" action="{{ route('mitra.perlengkapan.bank.update', $bank->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="my-3">
                            <label for="editBankName" class="form-label">Bank</label>
                            <input type="text" name="bank" class="form-control" value="{{ old('bank', $bank->bank) }}" required>
                        </div>
                        <div class="my-3">
                            <label for="editBankNoRekening" class="form-label">Nomor Rekening</label>
                            <input type="number" name="no_rekening" class="form-control" value="{{ old('no_rekening', $bank->no_rekening) }}" required>
                        </div>
                        <div class="my-3">
                            <label for="editBankNamaPemilik" class="form-label">Nama Pemilik</label>
                            <input type="text" name="nama_pemilik" class="form-control" value="{{ old('nama_pemilik', $bank->nama_pemilik) }}" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach


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