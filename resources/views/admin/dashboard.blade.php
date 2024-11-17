@extends('admin.layouts.app')

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
            @include('admin.layouts.sidebar')
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
            @include('admin.layouts.navbar')
          </nav>
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

      <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
          <div class="col-lg-8">
            <div class="row">
              <div class="col-md-6 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-column">
                      <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-nowrap mb-2">Perjalanan</h5>
                        <span class="badge bg-label-primary rounded-pill">Tahun 2024</span>
                      </div>
                      <small class="text-success text-nowrap fw-semibold mb-2">
                        <i class="bx bx-chevron-up"></i> 68.2%
                      </small>
                      <div class="mt-sm-auto">
                        <h4 class="mb-0">Total {{ $mitra['perjalanan'] }}</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-column">
                      <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-nowrap mb-2">Motor</h5>
                        {{-- <span class="badge bg-label-primary rounded-pill">Tahun 2024</span> --}}
                      </div>
                      <small class="text-success text-nowrap fw-semibold mb-2">
                        <i class="bx bx-chevron-up"></i> 68.2%
                      </small>
                      <div class="mt-sm-auto">
                        <h4 class="mb-0">Total {{ $mitra['motor'] }}</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-column">
                      <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-nowrap mb-2">Mobil</h5>
                        {{-- <span class="badge bg-label-primary rounded-pill">Tahun 2024</span> --}}
                      </div>
                      <small class="text-success text-nowrap fw-semibold mb-2">
                        <i class="bx bx-chevron-up"></i> 68.2%
                      </small>
                      <div class="mt-sm-auto">
                        <h4 class="mb-0">Total {{ $mitra['mobil'] }}</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-column">
                      <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-nowrap mb-2">Homestay</h5>
                        <span class="badge bg-label-primary rounded-pill">Tahun 2024</span>
                      </div>
                      <small class="text-success text-nowrap fw-semibold mb-2">
                        <i class="bx bx-chevron-up"></i> 50%</small>
                      <div class="mt-sm-auto">
                        <h4 class="mb-0">Total {{ $mitra['homestay'] }}</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-column">
                      <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-nowrap mb-2">Perlengkapan</h5>
                        <span class="badge bg-label-primary rounded-pill">Tahun 2024</span>
                      </div>
                      <small class="text-success text-nowrap fw-semibold mb-2">
                        <i class="bx bx-chevron-up"></i> 30%</small>
                      <div class="mt-sm-auto">
                        <h4 class="mb-0">Total {{ $mitra['perlengkapan'] }}</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 order-2 order-md-3 order-lg-2 mb-4">
              <div class="card">
                <div class="row row-bordered g-0">
                  <div class="col-md-8">
                    <h5 class="card-header m-0 me-2 pb-3">Total Profit</h5>
                    <div id="totalRevenueChart" class="px-2"></div>
                  </div>
                  <div class="col-md-4">
                    <div class="card-body">
                      <div class="text-center">
                        <div class="dropdown">
                          <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="growthReportId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 2024
                          </button>
                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                            <a class="dropdown-item" href="javascript:void(0);">2023</a>
                            <a class="dropdown-item" href="javascript:void(0);">2022</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div id="growthChart"></div>
                    <div class="text-center fw-semibold pt-3 mb-2">62% Company Growth</div>
                    <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                      <div class="d-flex">
                        <div class="me-2">
                          <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
                        </div>
                        <div class="d-flex flex-column">
                          <small>2022</small>
                          <h6 class="mb-0">$32.5k</h6>
                        </div>
                      </div>
                      <div class="d-flex">
                        <div class="me-2">
                          <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
                        </div>
                        <div class="d-flex flex-column">
                          <small>2021</small>
                          <h6 class="mb-0">$41.2k</h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-lg-4">
            <div class="card h-100">
              <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                  <h5 class="m-0 me-2">Rata Rata Order Mitra</h5>
                  <small class="text-muted">{{ $user }} Orang Menggunakan BeioN</small>
                </div>
                <div class="dropdown">
                  <button class="btn p-0" type="button" id="orderStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orderStatistics">
                    <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <div class="d-flex flex-column align-items-center gap-1">
                    <h2 class="mb-2">8,258</h2>
                    <span>Total Orders</span>
                  </div>
                  <div id="orderStatisticsChart"></div>
                </div>
                <ul class="p-0 m-0">
                  <li class="d-flex mb-4 pb-1">
                    <div class="avatar flex-shrink-0 me-3">
                      <span class="avatar-initial rounded bg-label-primary">
                        <i class="bx bx-mobile-alt"></i>
                      </span>
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                      <div class="me-2">
                        <h6 class="mb-0">Perjalanan</h6>
                        <small class="text-muted">Total</small>
                      </div>
                      <div class="user-progress">
                        <small class="fw-semibold">40k</small>
                      </div>
                    </div>
                  </li>
                  <li class="d-flex mb-4 pb-1">
                    <div class="avatar flex-shrink-0 me-3">
                      <span class="avatar-initial rounded bg-label-success">
                        <i class="bx bx-closet"></i>
                      </span>
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                      <div class="me-2">
                        <h6 class="mb-0">Transportasi</h6>
                      </div>
                      <div class="user-progress">
                        <small class="fw-semibold">70</small>
                      </div>
                    </div>
                  </li>
                  <li class="d-flex mb-4 pb-1">
                    <div class="avatar flex-shrink-0 me-3">
                      <span class="avatar-initial rounded bg-label-info">
                        <i class="bx bx-home-alt"></i>
                      </span>
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                      <div class="me-2">
                        <h6 class="mb-0">Homestay</h6>
                      </div>
                      <div class="user-progress">
                        <small class="fw-semibold">25</small>
                      </div>
                    </div>
                  </li>
                  <li class="d-flex">
                    <div class="avatar flex-shrink-0 me-3">
                      <span class="avatar-initial rounded bg-label-secondary">
                        <i class="bx bx-football"></i>
                      </span>
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                      <div class="me-2">
                        <h6 class="mb-0">Perlengkapan</h6>
                      </div>
                      <div class="user-progress">
                        <small class="fw-semibold">99</small>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        
            
              
            </div>
          </div>
            <!-- / Content -->

        </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>
    </div>

@endsection