@extends('mitra.layouts.app')

{{-- @include('admin.layouts.sidebar')
@include('admin.data.mitra-overview')
@include('admin.data.card') --}}

@section('content')

  <body>
    <!-- Layout wrapper -->
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
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
          {{-- <div class="col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                  <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                    <div class="card-title">
                      <h5 class="text-nowrap mb-2">Transaksi</h5>
                      <span class="badge bg-label-warning rounded-pill">Tahun 2024</span>
                    </div>
                    <div class="mt-sm-auto">
                      <small class="text-success text-nowrap fw-semibold"><i class="bx bx-chevron-up"></i> 68.2%</small>
                      <h3 class="mb-0">IDR 1.300.000</h3>
                    </div>
                  </div>
                  <div id="profileReportChart"></div>
                </div>
              </div>
            </div>
          </div> --}}
          {{-- <div class="col-4 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                  <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                    <div class="card-title">
                      <h5 class="text-nowrap mb-2">Mobil</h5>
                      <span class="badge bg-label-warning rounded-pill">Tahun 2024</span>
                    </div>
                    <div class="mt-sm-auto">
                      <small class="text-success text-nowrap fw-semibold"><i class="bx bx-chevron-up"></i> 68.2%</small>
                      <h3 class="mb-0">IDR 890.000</h3>
                    </div>
                  </div>
                  <div id="profileReportChart"></div>
                </div>
              </div>
            </div>
          </div> --}}
          <div class="col-lg-7 mb-4 order-0">
            <div class="card">
              <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                  <div class="card-body">
                    <h5 class="card-title text-primary">Selamat Datang!</h5>
                    <p class="mb-4">
                      Anda memiliki <span class="fw-bold">{{ $data['orderPerlengkapanCount'] }}</span> order terbaru
                    </p>
                    <a href="{{ route('mitra.perlengkapan.order') }}" class="btn btn-sm btn-outline-primary">Lihat Order</a>
                  </div>
                </div>
                {{-- <div class="col-sm-5 text-center text-sm-left">
                  <div class="card-body pb-0 px-0 px-md-4">
                    <img
                      src="../assets/img/illustrations/man-with-laptop-light.png"
                      height="140"
                      alt="View Badge User"
                      data-app-dark-img="illustrations/man-with-laptop-dark.png"
                      data-app-light-img="illustrations/man-with-laptop-light.png"
                    />
                  </div>
                </div> --}}
              </div>
            </div>
          </div>
          <div class="col-5 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                  <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                    <div class="card-title mb-1">
                      <h5 class="text-nowrap mb-2">Perlengkapan</h5>
                      <span class="badge bg-label-warning rounded-pill">Total Pendapatan</span>
                    </div>
                    <div class="mt-sm-auto">
                      <small class="text-success text-nowrap fw-semibold">
                        <i class="bx bx-chevron-up"></i> 
                      </small>
                      <small class="text-success text-nowrap fw-semibold" id="persentaseKenaikan">
                          <i class="bx bx-chevron-up"></i>
                      </small>
                      <p id="orderBulanLalu" style="display:none;">10</p>
                      <p id="orderBulanIni" style="display:none;">11</p>
                      <h3 class="mb-0">Rp. {{ number_format($data['totalPendapatanPerlengkapan'], 0, ',', '.') }}</h3>
                    </div>
                  </div>
                  {{-- <div id="profileReportChart"></div> --}}
                </div>
              </div>
            </div>
          </div>
          <!-- Total Revenue -->
          <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card">
              <div class="row row-bordered g-0">
                <div class="col-md-8">
                  <h5 class="card-header m-0 me-2 pb-3">Total Transaksi</h5>
                  <div id="totalRevenueChart" class="px-2"></div>
                </div>
                <div class="col-md-4">
                  <div class="card-body">
                    <div class="text-center">
                      <div class="dropdown">
                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                          id="growthReportId"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false">
                          2024
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                          <a class="dropdown-item" href="javascript:void(0);">2022</a>
                          <a class="dropdown-item" href="javascript:void(0);">2021</a>
                          <a class="dropdown-item" href="javascript:void(0);">2020</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="growthChart"></div>
                  <div class="text-center fw-semibold pt-3 mb-2">62% Kenaikan</div>
                  <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                    <div class="d-flex">
                      <div class="me-2">
                        <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
                      </div>
                      <div class="d-flex flex-column">
                        <small>2023</small>
                        <h6 class="mb-0">$32.5k</h6>
                      </div>
                    </div>
                    <div class="d-flex">
                      <div class="me-2">
                        <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
                      </div>
                      <div class="d-flex flex-column">
                        <small>2022</small>
                        <h6 class="mb-0">$41.2k</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Transactions -->
          {{-- <div class="col-md-6 col-lg-4 order-2 mb-4">
            <div class="card h-100">
              <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0 me-2">Pembayaran</h5>
                <div class="dropdown">
                  <button
                    class="btn p-0"
                    type="button"
                    id="transactionID"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                    <a class="dropdown-item" href="">30 Hari Terakhir</a>
                    <a class="dropdown-item" href="">Bulan Lalu</a>
                    <a class="dropdown-item" href="">Tahun Lalu</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <ul class="p-0 m-0">
                  <li class="d-flex mb-4 pb-1">
                    <div class="avatar flex-shrink-0 me-3">
                      <img src="../unicons/paypal.png" alt="User" class="rounded" />
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                      <div class="me-2">
                        <small class="text-muted d-block mb-1">Transfer Bank</small>
                        <h6 class="mb-0">Uang Masuk</h6>
                      </div>
                      <div class="user-progress d-flex align-items-center gap-1">
                        <h6 class="mb-0">+190.000</h6>
                        <span class="text-muted">IDR</span>
                      </div>
                    </div>
                  </li>
                  <li class="d-flex mb-4 pb-1">
                    <div class="avatar flex-shrink-0 me-3">
                      <img src="../unicons/wallet.png" alt="User" class="rounded" />
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                      <div class="me-2">
                        <small class="text-muted d-block mb-1">E-Wallet</small>
                        <h6 class="mb-0">Mac'D</h6>
                      </div>
                      <div class="user-progress d-flex align-items-center gap-1">
                        <h6 class="mb-0">+190.000</h6>
                        <span class="text-muted">IDR</span>
                      </div>
                    </div>
                  </li>
                  <li class="d-flex mb-4 pb-1">
                    <div class="avatar flex-shrink-0 me-3">
                      <img src="../unicons/chart.png" alt="User" class="rounded" />
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                      <div class="me-2">
                        <small class="text-muted d-block mb-1">Transfer</small>
                        <h6 class="mb-0">Refund</h6>
                      </div>
                      <div class="user-progress d-flex align-items-center gap-1">
                        <h6 class="mb-0">+190.000</h6>
                        <span class="text-muted">IDR</span>
                      </div>
                    </div>
                  </li>
                  <li class="d-flex">
                    <div class="avatar flex-shrink-0 me-3">
                      <img src="../unicons/cc-warning.png" alt="User" class="rounded" />
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                      <div class="me-2">
                        <small class="text-muted d-block mb-1">Mastercard</small>
                        <h6 class="mb-0">Ordered Food</h6>
                      </div>
                      <div class="user-progress d-flex align-items-center gap-1">
                        <h6 class="mb-0">+190.000</h6>
                        <span class="text-muted">IDR</span>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div> --}}
          <!--/ Transactions -->
        </div>
        

            </div>
            <!-- / Content -->
            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Ambil data order bulan lalu dan bulan ini dari elemen data-attributes atau variabel
      var orderBulanLalu = parseInt(document.getElementById('orderBulanLalu').textContent);
      var orderBulanIni = parseInt(document.getElementById('orderBulanIni').textContent);

      // Hitung persentase kenaikan
      var persentaseKenaikan = 0;
      if (orderBulanLalu > 0) {
          persentaseKenaikan = ((orderBulanIni - orderBulanLalu) / orderBulanLalu) * 100;
      }

      // Format persentase dengan 2 desimal dan tambahkan simbol persen
      var formattedPersentase = persentaseKenaikan.toFixed(2) + '%';

      // Tampilkan hasil di elemen yang sesuai
      document.getElementById('persentaseKenaikan').textContent = formattedPersentase;
  });

  </script>

@endsection