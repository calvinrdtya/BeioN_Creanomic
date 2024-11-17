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
                        {{-- <h4 class="fw-bold">Perlengkapan</h4> --}}

                        <!-- Basic Bootstrap Table -->
                        @include('mitra.message')
                        <div class="card">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="card-header mb-0">Data Perlengkapan</h5>
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('mitra.perlengkapan.create') }}" class="btn btn-sm btn-primary me-3">
                                        Tambah Perlengkapan
                                    </a>
                                    <div class="nav-item d-flex align-items-center">
                                        <i class="bx bx-search fs-4 lh-0 me-2"></i>
                                        <input type="text" class="form-control border-0 shadow-none"
                                            placeholder="Search..." aria-label="Search..." />
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Produk</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @forelse($perlengkapans as $index => $perlengkapan)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    @if ($perlengkapan->image)
                                                        <img src="{{ asset('img/' . $perlengkapan->image) }}"
                                                            alt="perlengkapan Image" width="70">
                                                    @else
                                                        No Image Available
                                                    @endif
                                                </td>
                                                <td>{{ $perlengkapan->title }}</td>
                                                <td>{{ $perlengkapan->final_price_text }}</td>
                                                <td>
                                                    @if ($perlengkapan->qty)
                                                        {{ $perlengkapan->qty }}
                                                    @else
                                                        <span class="badge bg-label-warning me-1">Kosong</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($perlengkapan->status == 1)
                                                        <span class="badge bg-label-success me-1">Publish</span>
                                                    @else
                                                        <span class="badge bg-label-warning me-1">Non Publish</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('mitra.perlengkapan.detail', ['perlengkapanId' => $perlengkapan->id]) }}"
                                                            type="button" class="btn btn-sm btn-outline-primary me-2">
                                                            <i class='bx bx-search-alt-2'></i>
                                                        </a>
                                                        <button data-bs-toggle="modal"
                                                            data-bs-target="#editperlengkapan{{ $perlengkapan->id }}"
                                                            type="button" class="btn btn-sm btn-outline-primary me-2"
                                                            data-perlengkapan-id="{{ $perlengkapan->id }}"
                                                            onclick="formatPrice{{ $perlengkapan->id }}()">
                                                            <span class="bx bx-edit-alt"></span>&nbsp; Edit
                                                        </button>
                                                        <form id="delete-form-{{ $perlengkapan->id }}"
                                                            action="{{ route('mitra.perlengkapan.destroy', $perlengkapan->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-outline-danger"><span
                                                                    class="bx bx-trash"></span>&nbsp;Hapus</button>
                                                        </form>
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

        <!-- Modal Edit perlengkapan -->
        @foreach ($perlengkapans as $perlengkapan)
            <div class="modal fade" id="editperlengkapan{{ $perlengkapan->id }}" tabindex="-1"
                aria-labelledby="editperlengkapanLabel{{ $perlengkapan->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editperlengkapanLabel{{ $perlengkapan->id }}">Edit Perlengkapan
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editperlengkapanForm{{ $perlengkapan->id }}"
                                action="{{ route('mitra.perlengkapan.update', $perlengkapan->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <input type="hidden" id="inputPrice{{ $perlengkapan->id }}" name="price">
                                <input type="hidden" id="inputFinalPrice{{ $perlengkapan->id }}" name="final_price">

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="editTitle{{ $perlengkapan->id }}" class="form-label">Nama
                                            Perlengkapan</label>
                                        <input type="text" name="title" id="editTitle{{ $perlengkapan->id }}"
                                            class="form-control" value="{{ $perlengkapan->title }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="category_id{{ $perlengkapan->id }}" class="form-label">Kategori</label>
                                        <select class="form-select" name="category_id"
                                            id="category_id{{ $perlengkapan->id }}" required>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $perlengkapan->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="qty{{ $perlengkapan->id }}" class="form-label">Stok</label>
                                        <input type="number" class="form-control" id="qty{{ $perlengkapan->id }}"
                                            name="qty" value="{{ $perlengkapan->qty }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="kota{{ $perlengkapan->id }}" class="form-label">Kota</label>
                                        <input type="text" class="form-control" id="kota{{ $perlengkapan->id }}"
                                            name="kota" value="{{ $perlengkapan->kota }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="price{{ $perlengkapan->id }}" class="form-label">Harga</label>
                                        <input type="text" class="form-control"
                                            id="start_price{{ $perlengkapan->id }}" value="{{ $perlengkapan->price }}"
                                            placeholder="" min="0" required />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="price_discount{{ $perlengkapan->id }}" class="form-label">Diskon
                                            (%)
                                        </label>
                                        <input type="number" class="form-control"
                                            id="price_discount{{ $perlengkapan->id }}" name="price_discount"
                                            value="{{ $perlengkapan->price_discount }}" placeholder="" min="0"
                                            max="100" required />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="deskripsi{{ $perlengkapan->id }}"
                                            class="form-label">Deskripsi</label>
                                        <textarea class="form-control" id="deskripsi{{ $perlengkapan->id }}" name="deskripsi" required rows="6">{{ $perlengkapan->deskripsi }}</textarea>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="formFile{{ $perlengkapan->id }}" class="form-label">Foto
                                            Perlengkapan</label>
                                        <div id="dropzone{{ $perlengkapan->id }}"
                                            class="border border-2 rounded p-3 d-flex align-items-center justify-content-center flex-column"
                                            style="min-height: 150px; cursor: pointer; position: relative;">
                                            <span id="dropzoneText{{ $perlengkapan->id }}">Drag & Drop Image</span>
                                            <input class="form-control" type="file"
                                                id="formFile{{ $perlengkapan->id }}" name="image"
                                                style="display:none;" onchange="previewImage({{ $perlengkapan->id }})" />
                                            <img id="imagePreview{{ $perlengkapan->id }}"
                                                src="{{ asset($perlengkapan->image) }}" alt="Image Preview"
                                                class="d-none" width="50%">
                                        </div>
                                        <button type="button" id="deleteImgPreview{{ $perlengkapan->id }}"
                                            class="btn btn-outline-danger btn-sm mt-2 float-end d-none"
                                            onclick="deleteImage({{ $perlengkapan->id }})">Hapus</button>
                                    </div>

                                    {{-- <div class="col-md-6 mb-3">
                                    <label for="formFile{{ $perlengkapan->id }}" class="form-label">Foto</label>
                                    <input class="form-control" type="file" id="formFile{{ $perlengkapan->id }}" name="image" accept="image/*" onchange="previewImage({{ $perlengkapan->id }})" />
                                    <div class="mt-2">
                                        <img id="imagePreview{{ $perlengkapan->id }}" src="{{ asset('img/' . $perlengkapan->image) }}" alt="Image Preview" style="width:100px;" />
                                    </div>
                                </div> --}}
                                    <div class="col-md-6 mb-3">
                                        <label for="final_price{{ $perlengkapan->id }}" class="form-label">Harga Setelah
                                            Diskon</label>
                                        <input readonly type="text" class="form-control"
                                            id="final_price{{ $perlengkapan->id }}"
                                            value="{{ $perlengkapan->final_price }}" placeholder="">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="editStatus{{ $perlengkapan->id }}" class="form-label">Status</label>
                                        <select name="status" id="editStatus{{ $perlengkapan->id }}"
                                            class="form-select" required>
                                            <option value="1" {{ $perlengkapan->status == 1 ? 'selected' : '' }}>
                                                Publish</option>
                                            <option value="0" {{ $perlengkapan->status == 0 ? 'selected' : '' }}>Hide
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                const priceElement{{ $perlengkapan->id }} = document.getElementById('start_price{{ $perlengkapan->id }}');
                const discountElement{{ $perlengkapan->id }} = document.getElementById('price_discount{{ $perlengkapan->id }}');
                const finalPriceElement{{ $perlengkapan->id }} = document.getElementById('final_price{{ $perlengkapan->id }}');

                const inputPrice{{ $perlengkapan->id }} = document.getElementById('inputPrice{{ $perlengkapan->id }}');
                const inputFinalPrice{{ $perlengkapan->id }} = document.getElementById('inputFinalPrice{{ $perlengkapan->id }}');

                function formatToIDR{{ $perlengkapan->id }}(value) {
                    return new Intl.NumberFormat('id-ID').format(value);
                }

                function calculateFinalPrice{{ $perlengkapan->id }}() {
                    var price = parseFloat(priceElement{{ $perlengkapan->id }}.value.replace(/[^\d]/g, '')) || 0;
                    const discount = parseFloat(discountElement{{ $perlengkapan->id }}.value) || 0;

                    const finalPrice = price - (price * (discount / 100));
                    inputFinalPrice{{ $perlengkapan->id }}.value = finalPrice;

                    const formattedFinalPrice = formatToIDR{{ $perlengkapan->id }}(finalPrice);

                    finalPriceElement{{ $perlengkapan->id }}.value = formattedFinalPrice;
                }

                function formatPriceInput{{ $perlengkapan->id }}() {
                    var price = parseFloat(priceElement{{ $perlengkapan->id }}.value.replace(/[^\d]/g, '')) || 0;
                    inputPrice{{ $perlengkapan->id }}.value = price;

                    priceElement{{ $perlengkapan->id }}.value = formatToIDR{{ $perlengkapan->id }}(price);

                    calculateFinalPrice{{ $perlengkapan->id }}();
                }

                function formatPrice{{ $perlengkapan->id }}() {
                    var price = parseFloat(priceElement{{ $perlengkapan->id }}.value) || 0;
                    inputPrice{{ $perlengkapan->id }}.value = price;

                    priceElement{{ $perlengkapan->id }}.value = formatToIDR{{ $perlengkapan->id }}(price);

                    calculateFinalPrice{{ $perlengkapan->id }}();
                }

                priceElement{{ $perlengkapan->id }}.addEventListener('input', formatPriceInput{{ $perlengkapan->id }});
                discountElement{{ $perlengkapan->id }}.addEventListener('input', calculateFinalPrice{{ $perlengkapan->id }});
            </script>
        @endforeach


        <script>
            // Fungsi untuk menangani preview image
            function previewImage(perlengkapanId) {
                const input = document.getElementById(`formFile${perlengkapanId}`);
                const preview = document.getElementById(`imagePreview${perlengkapanId}`);
                const deleteBtn = document.getElementById(`deleteImgPreview${perlengkapanId}`);
                const dropzoneText = document.getElementById(`dropzoneText${perlengkapanId}`);

                const file = input.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                    deleteBtn.classList.remove('d-none');
                    dropzoneText.style.display = 'none';
                };

                if (file) {
                    reader.readAsDataURL(file);
                }
            }

            // Fungsi untuk menghapus preview image
            function deleteImage(perlengkapanId) {
                const preview = document.getElementById(`imagePreview${perlengkapanId}`);
                const input = document.getElementById(`formFile${perlengkapanId}`);
                const deleteBtn = document.getElementById(`deleteImgPreview${perlengkapanId}`);
                const dropzoneText = document.getElementById(`dropzoneText${perlengkapanId}`);

                input.value = '';
                preview.src = '';
                preview.classList.add('d-none');
                deleteBtn.classList.add('d-none');
                dropzoneText.style.display = 'block';
            }

            // Fungsi untuk menangani event drag & drop
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

            // function previewImage(id) {
            //     const input = document.getElementById(`formFile${id}`);
            //     const preview = document.getElementById(`imagePreview${id}`);
            //     const file = input.files[0];

            //     if (file) {
            //         const reader = new FileReader();
            //         reader.onload = function(e) {
            //             preview.src = e.target.result;
            //             preview.style.display = "block";
            //         };
            //         reader.readAsDataURL(file);
            //     } else {
            //         preview.src = "";
            //         preview.style.display = "none";
            //     }
            // }

            // function calculateFinalPrice{{ $perlengkapan->id }}(id) {
            //     const price = parseFloat(document.getElementById(`price${id}`).value) || 0;
            //     const discount = parseFloat(document.getElementById(`price_discount${id}`).value) || 0;
            //     const finalPrice = price - (price * discount / 100);
            //     document.getElementById(`final_price${id}`).value = finalPrice.toFixed(2);
            // }
        </script>
    @endsection
