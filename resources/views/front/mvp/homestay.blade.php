<div class="tab-pane fade" id="homestay-tab-pane" role="tabpanel" aria-labelledby="homestay-tab" tabindex="0">
    <div class="card mt-3 p-5 rounded-3 card-mvp">
      <div class="nav-item dropdown position-relative">
        <select id="city" class="form-select form-md nav-group-mvp">
          <option value="">Pilih Kota</option>
          <option value="surabaya">Surabaya</option>
          <option value="malang">Malang</option>
          <option value="banyuwangi">Banyuwangi</option>
          <option value="pasuruan">Pasuruan</option>
        </select>
      </div>
        <div class="col-md-12 mt-4">
          <div class="card rounded-3">
            <div class="input-group align-items-center">
              <input type="text" class="form-control form-md border-0" id="checkin" placeholder="Tanggal Check-In" readonly aria-label="checkin" style="cursor: pointer; width: 120px; box-shadow: none !important">
              <span class="badge bg-first rounded-2" style="background-color: #4154f1; color: white; margin: 0 10px;">1 Malam</span>
              <input type="text" class="form-control form-md border-0" id="checkout" placeholder="Tanggal Check-Out" readonly aria-label="checkout" style="cursor: pointer; width: 120px; box-shadow: none !important">
            </div>             
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mt-4">
            <div class="input-group">
              <div class="form-control form-control-lg d-flex align-items-center" id="searchInput-adult" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
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
                      <div class="d-flex align-items-center justify-content-between">
                        <span class="m-0"><strong>Anak-anak</strong></span>
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
                      <div class="d-flex align-items-center justify-content-between">
                        <span class="m-0"><strong>Jumlah Kamar</strong></span>
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
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mt-4 btn-search-custom">
                  <button class="btn-search w-100" onclick="window.location.href='{{ route('homestay') }}'">Cari</button>
                </div>   
              </div>
            </div>
          </div>