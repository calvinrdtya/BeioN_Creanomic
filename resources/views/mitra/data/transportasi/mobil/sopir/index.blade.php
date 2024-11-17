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
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <!-- Basic Bootstrap Table -->
                    @include('mitra.message')
                    <div class="card">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="card-header mb-0">Data Sopir</h5>
                            <div class="d-flex align-items-center">
                                <a href="{{ route('mitra.sopir.create') }}" class="btn btn-sm btn-primary me-3">
                                    Tambah Sopir
                                </a>
                                <div class="nav-item d-flex align-items-center">
                                    <i class="bx bx-search fs-4 lh-0 me-2"></i>
                                    <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..." />
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Foto</th>
                                        <th>Alamat</th>
                                        <th>Usia</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse($sopirs as $index => $sopir)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $sopir->name }}</td>
                                        <td>
                                            @if ($sopir->foto)
                                                <img src="{{ asset('img/' . $sopir->foto) }}" alt="Sopir Image" width="30%">
                                            @else
                                                No Image Available
                                            @endif
                                        </td>
                                        {{-- <td>
                                            @if ($sopir->ktp)
                                                <img src="{{ asset('img/' . $sopir->ktp) }}" alt="Sopir Image" width="100">
                                            @else
                                                No Image Available
                                            @endif
                                        </td>
                                        <td>
                                            @if ($sopir->sim)
                                                <img src="{{ asset('img/' . $sopir->sim) }}" alt="Sopir Image" width="100">
                                            @else
                                                No Image Available
                                            @endif
                                        </td> --}}
                                        <td>{{ $sopir->alamat }}</td>
                                        <td>{{ $sopir->usia }}</td>
                                        <td>
                                            @if ($sopir->status == 1)
                                            <span class="badge bg-label-success me-1">Available</span>
                                            @else
                                            <span class="badge bg-label-warning me-1">No Available</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('mitra.sopir.detail', ['sopirId' => $sopir->id]) }}" type="button" class="btn btn-sm btn-outline-primary me-2">
                                                    <i class='bx bx-search-alt-2'></i>
                                                </a>
                                                <button data-bs-toggle="modal" data-bs-target="#editSopirModal{{ $sopir->id }}" type="button" class="btn btn-sm btn-outline-primary me-2">
                                                    <span class="bx bx-edit-alt"></span>&nbsp; Edit
                                                </button>
                                                <form action="{{ route('mitra.sopir.delete', $sopir->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"><span class="bx bx-trash"></span>&nbsp;Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="text-center" colspan="9">Tidak Ada Data</td>
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

    <!-- Modal Tambah Sopir -->
    <div class="modal fade" id="addSopirModal" tabindex="-1" aria-labelledby="addSopirModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSopirModalLabel">Tambah Sopir</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('mitra.sopir.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="formFile" class="form-label">Foto</label>
                                <input class="form-control" type="file" id="formFile" name="foto">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="ktp" class="form-label">KTP</label>
                                <input type="file" class="form-control" id="ktp" name="ktp" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="sim" class="form-label">SIM</label>
                                <input type="file" class="form-control" id="sim" name="sim" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="usia" class="form-label">Usia</label>
                                <input type="number" class="form-control" id="usia" name="usia" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="1">Available</option>
                                    <option value="0">No Available</option>
                                </select>
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

    <!-- Modal Edit Sopir -->
    @foreach($sopirs as $sopir)
    <div class="modal fade" id="editSopirModal{{ $sopir->id }}" tabindex="-1" aria-labelledby="editSopirModalLabel{{ $sopir->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSopirModalLabel{{ $sopir->id }}">Edit Sopir</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('mitra.sopir.edit', $sopir->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="editName{{ $sopir->id }}" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="editName{{ $sopir->id }}" name="name" value="{{ $sopir->name }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="editFormFile{{ $sopir->id }}" class="form-label">Foto</label>
                                <input class="form-control" type="file" id="editFormFile{{ $sopir->id }}" name="foto">
                                <img id="editImagePreview{{ $sopir->id }}" src="{{ asset('img/' . $sopir->foto) }}" alt="Image Preview" style="width:100px; margin-top:10px;" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="editKtp{{ $sopir->id }}" class="form-label">KTP</label>
                                <input type="file" class="form-control" id="editKtp{{ $sopir->id }}" name="ktp">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="editSim{{ $sopir->id }}" class="form-label">SIM</label>
                                <input type="file" class="form-control" id="editSim{{ $sopir->id }}" name="sim">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="editAlamat{{ $sopir->id }}" class="form-label">Alamat</label>
                                <textarea class="form-control" id="editAlamat{{ $sopir->id }}" name="alamat" required>{{ $sopir->alamat }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="editUsia{{ $sopir->id }}" class="form-label">Usia</label>
                                <input type="number" class="form-control" id="editUsia{{ $sopir->id }}" name="usia" value="{{ $sopir->usia }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="editStatus{{ $sopir->id }}" class="form-label">Status</label>
                                <select class="form-control" id="editStatus{{ $sopir->id }}" name="status" required>
                                    <option value="1" {{ $sopir->status == 1 ? 'selected' : '' }}>Available</option>
                                    <option value="0" {{ $sopir->status == 0 ? 'selected' : '' }}>No Available</option>
                                </select>
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
    @endforeach

    <script>
        function previewImage(inputId, imagePreviewId) {
            const fileInput = document.getElementById(inputId);
            const preview = document.getElementById(imagePreviewId);

            const file = fileInput.files[0];
            const reader = new FileReader();

            reader.addEventListener('load', function() {
                preview.src = reader.result;
                preview.style.display = 'block';
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const sopirs = @json($sopirs);
            sopirs.forEach(sopir => {
                const fileInput = document.getElementById(`editFormFile${sopir.id}`);
                const imagePreview = document.getElementById(`editImagePreview${sopir.id}`);
                if (fileInput && imagePreview) {
                    fileInput.addEventListener('change', function() {
                        previewImage(`editFormFile${sopir.id}`, `editImagePreview${sopir.id}`);
                    });
                }
            });
        });
    </script>

    @endsection