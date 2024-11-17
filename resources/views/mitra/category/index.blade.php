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
                        {{-- <div class="d-flex align-items-center">
                            <h5 class="card-header">Category</h5>
                            <a href="{{ route('mitra.category.create') }}" class="btn btn-sm btn-primary">
                                Add Kategori
                            </a>
                        </div> --}}
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="card-header mb-0">Data Kategori</h5>
                            <div class="d-flex align-items-center">
                                <a href="{{ route('mitra.category.create') }}" class="btn btn-sm btn-primary me-3">
                                    Tambah Kategori
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
                                        <th>Status</th>
                                        <th>Dibuat Pada</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse ($categories as $index => $category)
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
                                            <div class="d-flex">
                                                <button data-bs-toggle="modal" data-bs-target="#editCategory{{ $category->id }}" type="button" class="btn btn-sm btn-outline-primary me-2" data-category-id="{{ $category->id }}">
                                                    <span class="bx bx-edit-alt"></span>&nbsp; Edit
                                                </button>
                                                <form id="delete-form-{{ $category->id }}" action="{{ route('mitra.category.destroy', $category->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-outline-danger delete-button" data-form-id="{{ $category->id }}"><span class="bx bx-trash"></span>&nbsp;Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="text-center" colspan="5">Tidak ada Data</td>
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

    <!-- Modal Edit Category -->
    @foreach ($categories as $category)
    <div class="modal fade" id="editCategory{{ $category->id }}" tabindex="-1" aria-labelledby="editCategoryLabel{{ $category->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryLabel{{ $category->id }}">Edit Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editCategoryForm{{ $category->id }}" action="{{ route('mitra.category.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                            <div class="col mb-3">
                                <label for="editName" class="form-label">Nama Kategori</label>
                                <input type="text" name="name" id="editName{{ $category->id }}" class="form-control" value="{{ $category->name }}">
                            </div>
                            <div class="col mb-3">
                                <label for="editStatus" class="form-label">Status</label>
                                <select name="status" id="editStatus{{ $category->id }}" class="form-select">
                                    <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Publish</option>
                                    <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Hide</option>
                                </select>
                            </div>
                        <div class="modal-footer p-0">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="history.back()">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <script>
       document.addEventListener('DOMContentLoaded', function () {
        var deleteButtons = document.querySelectorAll('.delete-button');

        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function (event) {
                var formId = this.getAttribute('data-form-id');
                var form = document.getElementById('delete-form-' + formId);

                swal({
                    title: "Apakah Anda Yakin?",
                    text: "Jika anda maenghapus kategori yang aktif maka kategori yang ada di produk anda akan hilang!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                        swal("Kategori Berhasil di Hapus!", {
                            icon: "success",
                        });
                    } else {
                        swal("Kategori Anda Masih Tersimpan!");
                    }
                });
            });
        });
    });
    </script>

    <!-- {{-- Modal Add Category --}}
    <div class="modal fade" id="addCategory" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('mitra.category.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col mb-3">
                                <label for="name" class="form-label">Nama Category</label>
                                <input type="text" name="name" id="name" class="form-control" value="" />
                            </div>
                            <div class="col mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="showHome" class="form-label">Tampilkan di Web</label>
                                <select name="showHome" id="showHome" class="form-select">
                                    <option value="Yes">Ya</option>
                                    <option value="No">Tidak</option>
                                </select>
                            </div>
                            <div class="col mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="1">Publish</option>
                                    <option value="0">Hide</option>
                                </select>   
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div> -->

{{-- <div class="modal fade" id="modalKategori" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalToggleLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('mitra.category.create.motor') }}">
                            <div class="card d-flex">
                                <h5 class="card-header mb-0">Motor</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('mitra.category.create.mobil') }}">
                            <div class="card">
                                <h5 class="card-header mb-0">Mobil</h5>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<script>
    $(document).ready(function(){
    // Ensure that the script runs after the modal is opened
    $('#addCategory').on('shown.bs.modal', function () {
        $('#name').change(function(){
            var element = $(this);
            $("button[type=submit]").prop('disabled', true);
            $.ajax({
                url: '{{ route("getSlug") }}',
                type: 'get',
                data: {title: element.val()},
                dataType: 'json',
                success: function(response){
                    $("button[type=submit]").prop('disabled', false);
                    if(response["status"] == true) {
                        $("#slug").val(response["slug"]);
                    } else {
                        // Handle case where status is false
                        console.log("Error: ", response["message"]);
                    }
                },
                error: function(xhr, status, error){
                    $("button[type=submit]").prop('disabled', false);
                    console.log("AJAX error: ", status, error);
                }
            });
        });
    });
});
</script>

@endsection