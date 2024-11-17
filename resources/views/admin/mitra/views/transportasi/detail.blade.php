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
                    <h4 class="fw-bold py-2"><a href=""><span class="text-muted fw-light">Transportasi / Mitra / </span></a>Detail</h4>

                    <!-- Basic Bootstrap Table -->
                    @include('admin.message')

                    <div class="nav-align-top mb-4">
                        <ul class="nav nav-tabs nav-fill" role="tablist">
                            <li class="nav-item">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#data-mitra" aria-controls="data-mitra" aria-selected="true">
                                    Data Mitra
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#pencairan" aria-controls="pencairan" aria-selected="false">
                                    Pencairan
                                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger">2</span>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#riwayat" aria-controls="riwayat" aria-selected="false">
                                    Riwayat
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#produk" aria-controls="produk" aria-selected="true">
                                    Produk
                                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger">4</span>
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="data-mitra" role="tabpanel">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-0">
                                            <dl class="row">
                                                <dt class="col-sm-3">Nama</dt>
                                                <dd class="col-sm-9">{{ $mitras->name }}</dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-6">
                                            <dl class="row">
                                                <dt class="col-sm-4">Status</dt>
                                                <dd class="col-sm-8">
                                                    <span class="badge bg-label-{{ $mitras->status == 1 ? 'success' : 'danger' }} me-1">
                                                        {{ $mitras->status == 1 ? 'Aktif' : 'Tidak Aktif' }}
                                                    </span>
                                                </dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-6">
                                            <dl class="row">
                                                <dt class="col-sm-3">Email</dt>
                                                <dd class="col-sm-9">{{ $mitras->email }}</dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-6">
                                            <dl class="row">
                                                <dt class="col-sm-4">Nomer Telepon</dt>
                                                <dd class="col-sm-8">{{ $mitras->phone }}</dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-6">
                                            <dl class="row">
                                                <dt class="col-sm-3">Identitas</dt>
                                                <dd class="col-sm-9">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quibusdam repellat iusto distinctio. Amet doloribus ad sequi placeat corporis, a architecto odit cum ex. Nostrum quis laudantium ea officia aliquid quae!</dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-6">
                                            <dl class="row">
                                                <dt class="col-sm-4">Alamat</dt>
                                                <dd class="col-sm-8">Institut Teknologi Sepuluh Nopember, Kampus Jl. Raya ITS, Keputih, Kec. Sukolilo, Surabaya, Jawa Timur 60111</dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pencairan" role="tabpanel">
                                <h5 class="card-header">Informasi</h5>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Kategori</th>
                                                <th>Paket Perjalanan</th>
                                                <th>Hari Tanggal</th>
                                                <th>Nominal</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            <tr>
                                                <td>1</td>
                                                <td>Malang</td>
                                                <td>Paket Wisata Bromo</td>
                                                <td>Senin, 3 Juni 2024</td>
                                                <td>Rp 350.000</td>
                                                <td>
                                                    <span class="badge bg-label-warning rounded-pill">Proses</span>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#detailModalPencairan"><i class='bx bx-log-in-circle me-1'></i>Lihat</a>
                                                            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#detailModalPencairan"><i class="bx bx-edit-alt me-1"></i>Edit Status</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Fahril Rental</td>
                                                <td>Paket Wisata Bromo</td>
                                                <td>Senin, 3 Juni 2024</td>
                                                <td>Rp 350.000</td>
                                                <td>
                                                    <span class="badge bg-label-warning rounded-pill">Proses</span>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#detailModalPencairan"><i class="bx bx-edit-alt me-1"></i>Lihat</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="riwayat" role="tabpanel">
                                <h5 class="card-header">Informasi Riwayat Pencairan</h5>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Paket Perjalanan</th>
                                                <th>Hari Tanggal</th>
                                                <th>Nominal</th>
                                                <th>Status</th>
                                                <th>Tanggal Cair</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            <tr>
                                                <td>1</td>
                                                <td>Paket Wisata Bromo</td>
                                                <td>Senin, 3 Juni 2024</td>
                                                <td>Rp 350.000</td>
                                                <td>
                                                    <span class="badge bg-label-success rounded-pill">Selesai</span>
                                                </td>
                                                <td>03-06-2024 / 18.45</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="produk" role="tabpanel">
                                <div class="row pb-5">
                                    <div class="col-md-6 mb-4">
                                        <div class="card border-1">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#detailModalProduk">
                                                <div class="card-body p-3">
                                                    <div class="d-flex flex-column">
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{ asset('admin/img/sby.jpg') }}" class="rounded-4" alt="Surabaya" width="100">
                                                            <div class="ms-3">
                                                                <h5 class="card-title mb-0">Paket Wisata Malang</h5>
                                                                <p class="card-text mb-0">Rp 450.000</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="card border-1">
                                            <a href="" data-bs-toggle="modal" data-bs-target="#detailModalProduk">
                                                <div class="card-body p-3">
                                                    <div class="d-flex flex-column">
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{ asset('admin/img/sby.jpg') }}" class="rounded-4" alt="Surabaya" width="100">
                                                            <div class="ms-3">
                                                                <h5 class="card-title mb-0">Paket Wisata Malang</h5>
                                                                <p class="card-text mb-0">Rp 450.000</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="card border-1">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#detailModalProduk">
                                                <div class="card-body p-3">
                                                    <div class="d-flex flex-column">
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{ asset('admin/img/sby.jpg') }}" class="rounded-4" alt="Surabaya" width="100">
                                                            <div class="ms-3">
                                                                <h5 class="card-title mb-0">Paket Wisata Malang</h5>
                                                                <p class="card-text mb-0">Rp 450.000</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="card border-1">
                                            <a href="" data-bs-toggle="modal" data-bs-target="#detailModalProduk">
                                                <div class="card-body p-3">
                                                    <div class="d-flex flex-column">
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{ asset('admin/img/sby.jpg') }}" class="rounded-4" alt="Surabaya" width="100">
                                                            <div class="ms-3">
                                                                <h5 class="card-title mb-0">Paket Wisata Malang</h5>
                                                                <p class="card-text mb-0">Rp 450.000</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <nav aria-label="Page navigation mt-4">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item prev">
                                            <a class="page-link" href="">
                                                <i class="tf-icon bx bx-chevrons-left"></i>
                                            </a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="">2</a>
                                        </li>
                                        <li class="page-item active">
                                            <a class="page-link" href="">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="">4</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="">5</a>
                                        </li>
                                        <li class="page-item next">
                                            <a class="page-link" href="">
                                                <i class="tf-icon bx bx-chevrons-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>





                </div>
            </div>


        </div>
    </div>
</div>
</div>

{{-- Modal Detail Produk --}}
<div class="modal fade" id="detailModalProduk" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label">Name</label>
                        <input type="text" id="nameBasic" class="form-control" placeholder="Enter Name" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Detail Produk --}}

{{-- Modal Detail Pencairan --}}
<div class="modal fade" id="detailModalPencairan" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalToggleLabel">Modal 1</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Show a second modal and hide this one with the button below.</div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#modalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">
                    Open second modal
                </button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Detail Produk --}}

@endsection