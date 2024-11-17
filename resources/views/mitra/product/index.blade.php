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
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Produk</span></h4>

                    <!-- Basic Bootstrap Table -->
                    @include('mitra.message')
                    <div class="card">
                        <div class="d-flex align-items-center">
                            <h5 class="card-header">List Produk</h5>
                            <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary">
                                Add Produk
                            </a>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Produk</th>
                                        <th></th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>SKU</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @if ($products->isNotEmpty())
                                        @foreach ($products as $product)
                                        @php
                                            $productImage = $product->product_images->first();
                                        @endphp
                                            <tr>
                                                <td>{{ $product->id }}</td>
                                                <td>
                                                    @if (!empty($productImage->image))
                                                        <img src="{{ asset('uploads/product/small/'.$productImage->image) }}" class="img-thumbnail" width="50" >
                                                    @else
                                                        <img src="{{ asset('admin-assets/img/default-150x150.png') }}" class="img-thumbnail" width="50">
                                                    @endif
                                                </td>
                                                <td><a href="#">{{ $product->title }}</a></td>
                                                <td>Rp {{ number_format($product->price,2) }}</td>
                                                <td>{{ $product->qty }} Left in Stock</td>
                                                <td>{{ $product->sku }}</td>
                                                <td>
                                                    @if ($product->status == 1)
                                                    <span class="badge bg-label-success me-1">Publish</span>
                                                    @else
                                                    <span class="badge bg-label-warning me-1">Hide</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('products.edit',$product->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                                        <span class="bx bx-edit-alt"></span>&nbsp; Edit
                                                    </a>
                                                    {{-- <a href="{{ route('products.edit',$product->id) }}">
                                                        <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                                        </svg>
                                                    </a> --}}
                                                    <a href="#" onclick="deleteProduct({{ $product->id }})" class="btn btn-sm btn-outline-danger">
                                                        <span class="bx bx-trash"></span>&nbsp; Hapus
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                            <tr>
                                                <td>Records Not Found</td>
                                            </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Category -->
    {{-- @foreach ($categories as $category)
    <div class="modal fade" id="editCategory{{ $category->id }}" tabindex="-1" aria-labelledby="editCategoryLabel{{ $category->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryLabel{{ $category->id }}">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editCategoryForm{{ $category->id }}" action="{{ route('mitra.category.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col mb-3">
                                <label for="editName" class="form-label">Nama Category</label>
                                <input type="text" name="name" id="editName{{ $category->id }}" class="form-control" value="{{ $category->name }}">
                            </div>
                            <div class="col mb-3">
                                <label for="editSlug" class="form-label">Slug</label>
                                <input type="text" readonly name="slug" id="editSlug{{ $category->id }}" class="form-control" value="{{ $category->slug }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="editShowHome" class="form-label">Tampilkan di Web</label>
                                <select name="showHome" id="editShowHome{{ $category->id }}" class="form-select">
                                    <option value="Yes" {{ $category->showHome == 'Yes' ? 'selected' : '' }}>Ya</option>
                                    <option value="No" {{ $category->showHome == 'No' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                            <div class="col mb-3">
                                <label for="editStatus" class="form-label">Status</label>
                                <select name="status" id="editStatus{{ $category->id }}" class="form-select">
                                    <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Publish</option>
                                    <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Hide</option>
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
    @endforeach --}}

    {{-- Modal Add Category --}}
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
                        <div class="row g-2">
                            <div class="col mb-3">
                                <label for="name" class="form-label">Nama Category</label>
                                <input type="text" name="name" id="name" class="form-control" value="" />
                            </div>
                            <div class="col mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control">
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="mb-3">
                                <label for="showHome" class="form-label">Tampilkan di Web</label>
                                <select name="showHome" id="showHome" class="form-select">
                                    <option value="Yes">Ya</option>
                                    <option value="No">Tidak</option>
                                </select>
                            </div>
                            <div class="mb-3">
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
</div>

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