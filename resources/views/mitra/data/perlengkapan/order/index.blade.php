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
                    {{-- <h4 class="fw-bold">Order</h4> --}}

                    <!-- Basic Bootstrap Table -->
                    @include('mitra.message')
                    <div class="card">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="card-header mb-0">Order Perlengkapan</h5>
                            <div class="d-flex align-items-center">
                                {{-- <a href="" class="btn btn-sm btn-primary me-3">
                                    Add Kategori
                                </a> --}}
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
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Invoice</th>
                                        <th>Status</th>
                                        <th>Harga Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->first_name }}</td>
                                        <td>{{ $order->invoice_number }}</td>
                                        <td>
                                            @if ($order->payment_status == 1)
                                                <span class="badge bg-label-warning">Menunggu Pembayaran</span>
                                            @elseif ($order->payment_status == 2)
                                                <span class="badge bg-label-success">Pembayaran Berhasil</span>
                                            @elseif ($order->payment_status == 3)
                                                <span class="badge bg-label-secondary">Expired</span>
                                            @elseif ($order->payment_status == 4)
                                                <span class="badge bg-label-danger">Pembayaran Gagal</span>
                                            @endif
                                        </td>
                                        <td>{{ formatRupiah($order->grand_total) }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <form id="moveToHistoryForm" action="{{ route('mitra.order.perlengkapan.movetoHistory', $order->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-primary me-2" id="moveToHistoryButton">
                                                        Selesai
                                                    </button>
                                                </form>                                                            
                                                <a href="{{ route('mitra.perlengkapan.order.detail', $order->id) }}" type="button" class="btn btn-sm btn-outline-secondary me-2">
                                                    <i class='bx bx-search-alt-2'></i>
                                                </a>
                                                {{-- <form id="" action="" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"><span class="bx bx-trash"></span></button>
                                                </form> --}}
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('moveToHistoryButton').addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah pengiriman form otomatis

            swal({
                title: "Selesaikan Order?",
                text: "Jika anda mengklik tombol YA maka order akan dianggap selesai",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    // Jika pengguna mengkonfirmasi, kirimkan form
                    document.getElementById('moveToHistoryForm').submit();
                } else {
                    swal("Order kamu tetap aman!");
                }
            });
        });
    </script>

    <!-- Modal Edit Category -->
    {{-- @foreach ($categories as $category)
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
@endforeach --}}

@endsection