@extends('front.layouts.front-no-sidebar')

@section('title', 'Ecotourism')

@section('content')
    <section class="ftco-section">
        <div class="container px-0">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-3 sidebar">
                        @auth
                            <div>
                                <div class="sidebar-box pt-0">
                                    <div class="categories d-flex align-items-center">
                                        <i class="fa-solid fa-user" style="font-size: 3rem; margin-right: 15px;"></i>
                                        <div>
                                            <h3 class="mb-0">{{ auth()->user()->name }}</h3>
                                            <p class="mb-0">{{ auth()->user()->email }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="sidebar-box pt-0">
                                    <div class="categories">
                                        <li>
                                            <div class="sidebar-box p-0">
                                                <div class="categories d-flex align-items-center">
                                                    <img src="images/bpoin.png" width="60"></img>
                                                    <div class="ml-3 b-point">
                                                        <h3 class="mb-0">B-poin</h3>
                                                        <span>{{ $totalPoint }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="sidebar-box p-0">
                                                <div class="categories d-flex align-items-center">
                                                    <img src="images/recycle.png" width="60"></img>
                                                    <div class="ml-3 b-recycle">
                                                        <h3 class="mb-0">Recycle</h3>
                                                        <span>{{ $totalQty }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </div>
                                </div>
                                <div class="sidebar-box pt-0">
                                    <div class="categories">
                                        <li>
                                            <p class="mb-0">
                                                <a class="btn btn-dropoff px-3 py-3 border-0" data-toggle="modal"
                                                    data-target="#exampleModal" style="cursor: pointer !important;">
                                                    Tukarkan Sampahmu
                                                </a>
                                            </p>
                                        </li>
                                    </div>
                                </div>
                            </div>
                        @endauth

                        @guest
                            <div class="sidebar-box pt-0">
                                <h4 class="font-weight-bold">Sudah punya akun?</h4>
                                <p>Silahkan masuk terlebih dahulu.</p>
                                <a href="{{ route('account.login') }}" class="btn btn-primary">Masuk</a>
                                <a href="{{ route('account.register') }}" class="btn btn-link">Daftar</a>
                            </div>
                        @endguest
                    </div>
                    <div class="col-lg-9">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 px-0">
                                    <div class="about-author d-flex p-2">
                                        <div class="desc">
                                            <h3>Drop-off Sampah</h3>
                                            <p>Gunakan tempat drop-off sampah yang tersedia, dan setiap kali Anda membuang
                                                sampah dengan benar, Anda akan mendapatkan poin tambahan. Jadikan aksi
                                                sederhana ini lebih bermanfaat!</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 px-0">
                                    <div class="about-author d-flex p-2">
                                        <div class="desc">
                                            <h3>Pickup Sampah</h3>
                                            <p>Manfaatkan layanan pickup sampah kami. Setiap kontribusi untuk menjaga
                                                kebersihan akan memberi Anda poin ekstra yang bisa dikumpulkan dan ditukar
                                                dengan hadiah.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 px-0">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Jenis Sampah</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Point</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Plastik</td>
                                                <td>1kg</td>
                                                <td>100</td>
                                            </tr>
                                            <tr>
                                                <td>Kertas</td>
                                                <td>1kg</td>
                                                <td>100</td>
                                            </tr>
                                            <tr>
                                                <td>Botol Plastik</td>
                                                <td>1kg</td>
                                                <td>150</td>
                                            </tr>
                                            <tr>
                                                <td>Logam</td>
                                                <td>1kg</td>
                                                <td>250</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12 px-0">
                                    <div class="about-author d-flex p-2">
                                        <div class="desc">
                                            <h3>Jenis sampah yang bisa di tukar</h3>
                                            <p>Kami menerima berbagai jenis sampah yang dapat didaur ulang.</p>
                                        </div>
                                    </div>
                                    <div class="row p-2">
                                        <div class="col-md-12 col-lg-4 d-flex align-self-stretch pt-0">
                                            <div class="services services-1 color-5 d-block img"
                                                style="background-image: url(images/botol-kaleng.jpg);">
                                                <div class="media-body">
                                                    <h3 class="heading mb-3">Plastik</h3>
                                                    <p>Sampah dari botol, kantong, dan kemasan yang memerlukan daur ulang
                                                        untuk mengurangi polusi.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-4 d-flex align-self-stretch pt-0">
                                            <div class="services services-1 color-5 d-block img"
                                                style="background-image: url(images/botol-kaleng.jpg);">
                                                <div class="media-body">
                                                    <h3 class="heading mb-3">Kertas</h3>
                                                    <p>Limbah dari produk berbahan kertas (koran, HVS, karton) yang dapat
                                                        didaur ulang menjadi kertas baru.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-4 d-flex align-self-stretch pt-0">
                                            <div class="services services-1 color-5 d-block img"
                                                style="background-image: url(images/botol-kaleng.jpg);">
                                                <div class="media-body">
                                                    <h3 class="heading mb-3">Kaleng</h3>
                                                    <p>Sampah logam seperti bekas minuman kaleng.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-4 d-flex align-self-stretch pt-0">
                                            <div class="services services-1 color-5 d-block img"
                                                style="background-image: url(images/botol-kaleng.jpg);">
                                                <div class="media-body mt-5">
                                                    <h3 class="heading mb-3">Botol Plastik</h3>
                                                    <p>Sampah botol/wadah plastik yang bisa didaur ulang berulang kali.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-4 d-flex align-self-stretch pt-0">
                                            <div class="services services-1 color-5 d-block img"
                                                style="background-image: url(images/botol-kaleng.jpg);">
                                                <div class="media-body">
                                                    <h3 class="heading mb-3">Besi</h3>
                                                    <p>Sampah logam seperti pipa atau peralatan yang bisa didaur ulang
                                                        menjadi baja.</p>
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
        </div>
    </section>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('front.ecotourism.store') }}" method="post" enctype="multipart/form-data"
                    id="form-dropoff">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Dropoff Sampah</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 my-2">
                                <label for="formFile" class="form-label">Foto</label>
                                <div id="dropzone"
                                    class="border rounded p-3 d-flex align-items-center justify-content-center flex-column"
                                    style="min-height: 130px; cursor: pointer; position: relative;">
                                    <span id="dropzoneText">Drag & Drop Image</span>
                                    <input class="form-control" type="file" id="formFile" name="image"
                                        style="display:none;" />
                                    <img id="imagePreview" src="" alt="Image Preview" class="d-none"
                                        width="50%">
                                </div>
                                <button type="button" id="deleteImgPreview"
                                    class="btn btn-outline-danger btn-sm mt-2 float-end d-none"
                                    onclick="deleteImage()">Hapus</button>
                            </div>
                            <div class="col-md-12 my-2">
                                <label class="form-label">Berat (Kg)</label>
                                <input id="qty" class="form-control" type="number" name="qty" step="0.01"
                                    required>
                            </div>
                            <div class="col-md-12 my-2">
                                <label class="form-label">Jenis Sampah</label>
                                <select class="form-control form-select" name="title" required>
                                    <option value="" disabled selected>Pilih Sampah:</option>
                                    @foreach ($wasteCategories as $category)
                                        <option value="{{ $category }}">{{ $category }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 my-2">
                                <label class="form-label">Tempat</label>
                                <select class="form-control form-select" name="mitra_id" required>
                                    <option value="" disabled selected>Pilih Tempat:</option>
                                    @foreach ($mitras as $mitra)
                                        <option value="{{ $mitra->id }}">{{ $mitra->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Dropoff</but>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'Pilih Tempat:',
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const dropzone = document.getElementById('dropzone');
            const fileInput = document.getElementById('formFile');
            const preview = document.getElementById('imagePreview');
            const deleteButton = document.getElementById('deleteImgPreview');
            const dropzoneText = document.getElementById('dropzoneText');
            const form = document.getElementById('form-dropoff');

            const allowedFileTypes = ['image/png', 'image/jpeg', 'image/jpg'];

            dropzone.addEventListener('click', function() {
                fileInput.click();
            });

            dropzone.addEventListener('dragover', function(e) {
                e.preventDefault();
                dropzone.classList.add('bg-light');
            });

            dropzone.addEventListener('dragleave', function() {
                dropzone.classList.remove('bg-light');
            });

            dropzone.addEventListener('drop', function(e) {
                e.preventDefault();
                dropzone.classList.remove('bg-light');
                if (e.dataTransfer.files.length) {
                    fileInput.files = e.dataTransfer.files;
                    previewImage();
                }
            });

            fileInput.addEventListener('change', function() {
                previewImage();
            });

            function previewImage() {
                const file = fileInput.files[0];
                if (file) {
                    if (!allowedFileTypes.includes(file.type)) {
                        alert('Hanya file dengan format PNG, JPG dan JPEG yang diizinkan.');
                        deleteImage(); // Hapus file jika tipe tidak valid
                        return;
                    }

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

            deleteButton.addEventListener('click', function() {
                deleteImage();
            });

            function deleteImage() {
                fileInput.value = '';
                preview.src = '';
                preview.classList.add('d-none');
                dropzoneText.style.display = 'block';
                deleteButton.classList.add('d-none');
            }

            // Handle form submission
            form.addEventListener('submit', function(e) {
                const file = fileInput.files[0];
                if (!file) {
                    e.preventDefault(); // Prevent form submission
                    alert('Harap unggah gambar sebelum mengirim form.');
                } else if (!allowedFileTypes.includes(file.type)) {
                    e.preventDefault(); // Prevent form submission
                    alert('Hanya file dengan format PNG, JPG dan JPEG yang diizinkan.');
                }
            });
        });
    </script>
@endsection
