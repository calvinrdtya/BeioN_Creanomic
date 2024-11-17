<div class="tab-pane fade" id="perlengkapan-tab-pane" role="tabpanel" aria-labelledby="perlengkapan-tab" tabindex="0">
    <div class="card mt-3 p-5 rounded-3 card-mvp">
      <div class="row">
        <div class="col-md-6 mb-4">
          <div class="nav-item dropdown position-relative">
            <select id="city" class="form-select form-md nav-group-mvp">
              <option value="">Pilih Kota</option>
              <option value="surabaya">Surabaya</option>
              <option value="malang">Malang</option>
              <option value="banyuwangi">Banyuwangi</option>
              <option value="pasuruan">Pasuruan</option>
            </select>
          </div>
          {{-- <div class="nav-item dropdown position-relative">
            <input type="search" class="form-control form-control-lg" id="searchInput" aria-label="Search..." placeholder="Pilih Kota/Lokasi" data-bs-toggle="dropdown" aria-expanded="false">
            <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="searchInput" style="max-height: 200px; width: 150% !important; overflow-y: auto; overflow-x: hidden;">
              <div class="row p-2">
                <div class="col-md-6">
                  <p class="title-city ms-2 mb-2">Kota</p>
                  <li>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex align-items-center">
                        <i class="fas fa-map-marker-alt me-3"></i>
                        <div class="m-0">
                          <span>Malang</span>
                          <span>(70)</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex align-items-center">
                        <i class="fas fa-map-marker-alt me-3"></i>
                        <div class="m-0">
                          <span>Surabaya</span>
                          <span>(50)</span>
                        </div>
                      </div>
                    </a>
                  </li>
                </div>
                <div class="col-md-6">
                  <p class="title-city ms-2 mb-2">Populer</p>
                  <li>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex align-items-center">
                        <i class="fas fa-map-marker-alt me-3"></i>
                        <div class="m-0">
                          <span>Surabaya</span>
                          <span>(50)</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex align-items-center">
                        <i class="fas fa-map-marker-alt me-3"></i>
                        <div class="m-0">
                          <span>Malang</span>
                          <span>(70)</span>
                        </div>
                      </div>
                    </a>
                  </li>
                </div>
              </div>
            </ul>
          </div> --}}
        </div>
        <div class="col-md-6 mb-4">
          <div class="nav-item dropdown position-relative">
            <select id="city" class="form-select form-md nav-group-mvp">
              <option value="">Pilih Aktifitas</option>
              <option value="camping">Camping</option>
              <option value="hiking">Hiking</option>
            </select>
          </div>
          {{-- <div class="nav-item dropdown position-relative">
            <input type="search" class="form-control form-control-lg" id="searchInput2" aria-label="Search..." placeholder="Aktifitas" data-bs-toggle="dropdown" aria-expanded="false">
            <ul class="dropdown-menu dropdown-menu-start mt-2" aria-labelledby="searchInput2" style="max-height: 200px; overflow-y: auto; overflow-x: hidden; width: 150% !important;">
              <div class="row p-2">
                <div class="col-md-6">
                  <p class="title-city ms-2 m-0">Kota</p>
                  <li>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex align-items-center">
                        <img src="" alt="" class="rounded-2 me-2 my-1" width="60" height="50">
                        <div class="m-0">
                          <span>Surabaya</span><br>
                          <span>(50)</span>
                        </div>
                      </div>
                    </a>
                  </li>
                </div>
                <div class="col-md-6">
                  <p class="title-city ms-2 m-0">Populer</p>
                  <li>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex align-items-center">
                        <img src="" alt="" class="rounded-2 me-2 my-1" width="60" height="50">
                        <div class="m-0">
                          <span>Surabaya</span><br>
                          <span>(50)</span>
                        </div>
                      </div>
                    </a>
                  </li>
                </div>
              </div>
            </ul>
          </div> --}}
        </div>   
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card rounded-3">
            <div class="input-group align-items-center">
              <input type="text" class="form-control form-md border-0" id="tgl_pinjam" placeholder="Tanggal Pinjam" readonly aria-label="pinjam" style="cursor: pointer; width: 120px; box-shadow: none !important">
              <span class="badge bg-first rounded-2" style="background-color: #4154f1; color: white; margin: 0 10px;">1 Hari</span>
              <input type="text" class="form-control form-md border-0" id="tgl_pengembalian" placeholder="Tanggal Pengembalian" readonly aria-label="pengembalian" style="cursor: pointer; width: 120px; box-shadow: none !important">
            </div>             
          </div>
        </div>
      </div>
        <div class="col-md-12 mt-4">
          <div class="col-md-12 btn-search-custom d-flex justify-content-center">
            <button class="btn-search w-100" onclick="window.location.href='{{ route('perlengkapan') }}'">Cari</button>
          </div>  
        </div>
      </div>
    </div>