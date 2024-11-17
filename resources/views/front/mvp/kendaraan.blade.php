<style>
.form-md::placeholder {
  font-weight: 400 !important;
  color: #000 !important;
}

.form-md::-webkit-input-placeholder { /* WebKit, Blink, Edge */
  font-weight: 400 !important;
  color: #000 !important;
}
.form-md:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
  font-weight: 400 !important;
  color: #000 !important;
}
.form-md::-moz-placeholder { /* Mozilla Firefox 19+ */
  font-weight: 400 !important;
  color: #000 !important;
}
.form-md:-ms-input-placeholder { /* Internet Explorer 10-11 */
  font-weight: 400 !important;
  color: #000 !important;
}
</style>

<div class="tab-pane fade" id="kendaraan-tab-pane" role="tabpanel" aria-labelledby="kendaraan-tab" tabindex="0">
    <div class="card mt-3 p-5 rounded-4 card-mvp">
      <div class="row">
        <div class="col-md-12">
          <div class="nav-item dropdown position-relative">
            <select id="city" class="form-select form-md nav-group-mvp">
              <option value="">Pilih Kota</option>
              <option value="surabaya">Surabaya</option>
              <option value="malang">Malang</option>
              <option value="banyuwangi">Banyuwangi</option>
              <option value="pasuruan">Pasuruan</option>
            </select>
          </div>
        </div>
      </div>
        <div class="col-md-12 mt-4">
          <div class="card rounded-3">
            <div class="input-group align-items-center">
              <input type="text" class="form-control form-md border-0" id="tgl_mulai" placeholder="Tanggal Pinjam" readonly aria-label="mulai" style="cursor: pointer; width: 120px; box-shadow: none !important">
              <span class="badge bg-first rounded-2" style="background-color: #4154f1; color: white; margin: 0 10px;">1 Hari</span>
              <input type="text" class="form-control form-md border-0" id="tgl_selesai" placeholder="Tanggal Selesai" readonly aria-label="selesai" style="cursor: pointer; width: 120px; box-shadow: none !important">
            </div>             
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mt-4">
            <div class="nav-item dropdown position-relative">
              <select id="city" class="form-select form-md nav-group-mvp">
                <option value="">Pilih Kendaraan</option>
                <option value="motor">Motor</option>
                <option value="mobil">Mobil</option>
              </select>
            </div>
          </div>
          <div class="col-md-6 mt-4 btn-search-custom">
            <button class="btn-search w-100" onclick="window.location.href='{{ route('transportasi') }}'">Cari</button>
          </div>   
        </div>
      </div>
    </div>

    