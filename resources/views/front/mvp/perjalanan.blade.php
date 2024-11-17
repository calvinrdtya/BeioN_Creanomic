<div class="tab-pane fade show active" id="perjalanan-tab-pane" role="tabpanel" aria-labelledby="perjalanan-tab" tabindex="0">
    <div class="card mt-3 p-5 rounded-4 card-mvp">
      <div class="nav-item dropdown position-relative">
        <input type="search" class="form-control form-md nav-group-mvp" id="searchInput" aria-label="Search..." placeholder="Destinasi/Aktifitas" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
        <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="searchInput" style="max-height: 200px; overflow-y: auto; overflow-x: hidden;">
          <div class="container">
            <div class="row p-2">
              <div class="col-md-6">
                <p class="title-city ms-2 m-0">Destinasi</p>
                <li>
                  <a class="dropdown-item" href="#">
                    <div class="d-flex align-items-center">
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
                      <div class="m-0">
                        <span>Jakarta</span>
                        <span>(30)</span>
                      </div>
                    </div>
                  </a>
                </li>
              </div>
              <div class="col-md-6">
                <p class="title-city ms-2 m-0">Aktifitas</p>
                <li>
                  <a class="dropdown-item" href="#">
                    <div class="d-flex align-items-center">
                      <div class="m-0">
                        <span>Bersepeda</span>
                        <span>(80)</span>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="#">
                    <div class="d-flex align-items-center">
                      <div class="m-0">
                        <span>Jogging</span>
                        <span>(120)</span>
                      </div>
                    </div>
                  </a>
                </li>
              </div>
            </div>
          </div>
        </ul>
      </div>
      <div class="nav-item dropdown position-relative mt-4">
        <select id="city" class="form-select form-md nav-group-mvp">
          <option value="">Pilih Kota</option>
          @foreach ($kotas as $kota)
            <option option value="{{ $kota }}">{{ ucfirst($kota) }}</option>
          @endforeach
        </select>
      </div>    
          <div class="col-md-6 mt-4 btn-search-custom d-flex justify-content-center w-100">
            <button class="btn-search w-100" onclick="window.location.href='{{ route('perjalanan') }}'">Cari</button>
          </div>   
      </div>
    </div>