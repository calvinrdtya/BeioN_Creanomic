<!-- nav.blade.php -->
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="https://i.ibb.co.com/zHsZVdf/logo-hitam.png" alt="logo" width="100%">
      </a>
      <nav id="navbar" class="navbar">
        <ul>
          @if (Route::is('transportasi'))
            <!-- Navbar for Transportasi -->
            <div class="card p-1 rounded-pill card-group-homestay">
              <div class="input-group align-items-center rounded-3">
                <div class="nav-item dropdown">
                  <input type="text" class="form-control rounded-4 border-0 nav-group-transportasi" id="idSearch" placeholder="Pilih Kota" readonly aria-label="Pilih Kota" style="cursor: pointer; width: 120px;">
                  <ul class="dropdown-menu mt-2" aria-labelledby="searchInput" style="max-height: 200px; width: 300px; overflow-y: auto; overflow-x: hidden;">
                    <div class="row p-2">
                      <p class="title-city ms-2 m-0">Pilih Kota</p>
                      <li>
                        <a class="dropdown-item" href="#">
                          <div class="d-flex align-items-center">
                            <i class="fas fa-map-marker-alt me-3"></i>
                            <div>
                              <span>Surabaya</span>
                              <span>(50)</span>
                            </div>
                          </div>
                        </a>
                      </li>
                    </div>
                  </ul>
                </div>
                <div style="border-left: 1px solid #bfbfbf; height: 27px; margin: 0 10px;"></div>
                <input type="text" class="form-control nav-group-homestay border-0" id="checkin" placeholder="Pinjam" readonly aria-label="Check-In" style="cursor: pointer; width: 120px;">
                <span class="badge bg-first-transparent rounded-3" style="background-color: #4154f1; color: white; margin: 0 10px;">1 Hari</span>
                <input type="text" class="form-control nav-group-homestay border-0" id="checkout" placeholder="Pengembalian" readonly aria-label="Check-Out" style="cursor: pointer; width: 120px;">
                <div style="border-left: 1px solid #bfbfbf; height: 27px; margin: 0 10px;"></div>
                <div class="nav-item dropdown">
                  <div class="input-group">
                    <div class="form-control d-flex align-items-center border-0 rounded-5" id="searchInput-adult" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer; ">
                      <i class="fal fa-user-friends me-3"></i>
                      <span id="adultCount">1</span>&nbsp; Orang
                    </div>
                    <div class="dropdown-menu dropdown-menu-start mt-2" aria-labelledby="searchInput-adult" style="width: 320px;">
                      <div class="p-2">
                        <div class="d-flex align-items-center justify-content-between">
                          <span class="m-0"><strong>Dewasa</strong></span>
                          <div class="d-flex align-items-center">
                            <button type="button" onclick="updateCount('adult', -1, event)" class="btn btn-number" style="background-color: #4154f1;">
                              <i class="fas fa-minus" style="color: #FFF;"></i>
                            </button>
                            <span id="adultCountDropdown" class="mx-3">1</span>
                            <button type="button" onclick="updateCount('adult', 1, event)" class="btn btn-number" style="background-color: #4154f1;">
                              <i class="fas fa-plus" style="color: #FFF;"></i>
                            </button>
                          </div>
                        </div>
                        <small class="text-muted m-0">Usia 17 tahun keatas</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @elseif (Route::is('homestay'))
            <!-- Navbar for Homestay -->
            <div class="card p-1 rounded-pill card-group-homestay">
              <div class="input-group align-items-center rounded-3">
                <div class="nav-item dropdown">
                  <input type="text" class="form-control rounded-4 border-0 nav-group-transportasi" id="idSearch" placeholder="Pilih Kota" readonly aria-label="Pilih Kota" style="cursor: pointer; width: 120px;">
                  <ul class="dropdown-menu mt-2" aria-labelledby="searchInput" style="max-height: 200px; width: 300px; overflow-y: auto; overflow-x: hidden;">
                    <div class="row p-2">
                      <p class="title-city ms-2 m-0">Pilih Kota</p>
                      <li>
                        <a class="dropdown-item" href="#">
                          <div class="d-flex align-items-center">
                            <i class="fas fa-map-marker-alt me-3"></i>
                            <div>
                              <span>Surabaya</span>
                              <span>(50)</span>
                            </div>
                          </div>
                        </a>
                      </li>
                    </div>
                  </ul>
                </div>
                <div style="border-left: 1px solid #bfbfbf; height: 27px; margin: 0 10px;"></div>
                <input type="text" class="form-control nav-group-homestay border-0" id="checkin" placeholder="Check-In" readonly aria-label="Check-In" style="cursor: pointer; width: 120px;">
                <span class="badge bg-first-transparent rounded-3" style="background-color: #4154f1; color: white; margin: 0 10px;">1 Malam</span>
                <input type="text" class="form-control nav-group-homestay border-0" id="checkout" placeholder="Check-Out" readonly aria-label="Check-Out" style="cursor: pointer; width: 120px;">
                <div style="border-left: 1px solid #bfbfbf; height: 27px; margin: 0 10px;"></div>
                <div class="nav-item dropdown">
                  <div class="input-group">
                    <div class="form-control d-flex align-items-center border-0 rounded-5" id="searchInput-adult" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer; ">
                      <i class="fal fa-user-friends me-3"></i>
                      <span id="adultCount">1</span>&nbsp; Orang
                    </div>
                    <div class="dropdown-menu dropdown-menu-start mt-2" aria-labelledby="searchInput-adult" style="width: 320px;">
                      <div class="p-2">
                        <div class="d-flex align-items-center justify-content-between">
                          <span class="m-0"><strong>Dewasa</strong></span>
                          <div class="d-flex align-items-center">
                            <button type="button" onclick="updateCount('adult', -1, event)" class="btn btn-number" style="background-color: #4154f1;">
                              <i class="fas fa-minus" style="color: #FFF;"></i>
                            </button>
                            <span id="adultCountDropdown" class="mx-3">1</span>
                            <button type="button" onclick="updateCount('adult', 1, event)" class="btn btn-number" style="background-color: #4154f1;">
                              <i class="fas fa-plus" style="color: #FFF;"></i>
                            </button>
                          </div>
                        </div>
                        <small class="text-muted m-0">Usia 17 tahun keatas</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endif
          <li><a class="getsignin" href="#">Login</a></li>
          <li><a class="getsignup ms-3" href="#">Sign Up</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
  </header>
  <!-- End Header -->
  