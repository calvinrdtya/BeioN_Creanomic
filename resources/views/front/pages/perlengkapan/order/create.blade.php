@extends('front.layouts.front-no-sidebar')

@section('title', $title)

@section('breadcrumb')
    <p class="breadcrumbs">
        <span class="mr-2"><a href="index.html">Beranda <i class="fa fa-chevron-right"></i></a></span>
        <span class="mr-2"><a href="{{ route('perlengkapan') }}">Perlengkapan <i class="fa fa-chevron-right"></i></a></span>
        <span>@yield('title')</span>
    </p>
@endsection

@section('content')
    <form action="{{ route('perlengkapan.booking.store', $perlengkapan->id) }}" method="POST">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-7 ftco-animate fadeInUp ftco-animated">
                <div class="mb-5">
                    <h4 class="font-weight-bold mb-4">Data Diri</h4>
                    <div class="card card-body">
                        <form action="">
                            <div>
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                <input type="hidden" name="mitra_id" value="{{ $perlengkapan->mitra_id }}">
                                <input type="hidden" step=".01" name="grand_total" value="" id="inputGrandTotal">
                                <input type="hidden" name="durasi_pinjam" id="inputDurasi">
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="inputFirstName" class="d-block">Gelar<span
                                                class="text-danger">*</span></label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="title" id="radioTuan"
                                                value="Tuan" @if (old('title') === 'Tuan') checked @endif>
                                            <label class="form-check-label" for="radioTuan">Tuan</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="title" id="radioNyonya"
                                                value="Nyonya" @if (old('title') === 'Nyonya') checked @endif>
                                            <label class="form-check-label" for="radioNyonya">Nyonya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="title" id="radioNona"
                                                value="Nona" @if (old('title') === 'Nona    ') checked @endif>
                                            <label class="form-check-label" for="radioNona">Nona</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputFirstName">Nama Depan<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="inputFirstName" name="first_name"
                                            value="{{ old('first_name') }}" required>
                                        <small class="form-text text-muted">Tanpa gelar dan tanda baca</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputLastName">Nama Belakang<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="inputLastName" name="last_name"
                                            value="{{ old('last_name') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputPhoneNumber">Nomor Handphone<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="inputPhoneNumber" name="no_handphone"
                                            value="{{ old('no_handphone') }}" required>
                                        <small class="form-text text-muted">Contoh: 812345678 dan No. Handphone
                                            0812345678</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputEmail">Email<span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="inputEmail" name="email"
                                            value="{{ old('email') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="selectProvinsi">Provinsi<span class="text-danger">*</span></label>
                                        <select class="custom-select" id="selectProvinsi" name="provinsi" required>
                                            <option value="" selected>Pilih Provinsi:</option>
                                            @foreach ($provinces as $provinsi)
                                                <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="selectKota">Kota<span class="text-danger">*</span></label>
                                        <select class="custom-select" id="selectKota" name="kota" required disabled>
                                            <option value="" selected>Pilih Kota/Kabupaten:</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="selectKecamatan">Kecamatan<span class="text-danger">*</span></label>
                                        <select class="custom-select" id="selectKecamatan" name="kecamatan" required
                                            disabled>
                                            <option selected>Pilih Kecamatan:</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="selectDesa">Desa<span class="text-danger">*</span></label>
                                        <select class="custom-select" id="selectDesa" name="desa" required disabled>
                                            <option selected>Pilih Desa:</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="inputAddress">Alamat Lengkap<span class="text-danger">*</span></label>
                                        <textarea name="alamat_lengkap" id="" rows="5" class="form-control" id="inputAddress" required>{{ old('alamat_lengkap') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="mb-5">
                    <h4 class="font-weight-bold mb-4">Durasi Peminjaman</h4>
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="datePeminjaman">Tanggal Peminjaman s.d. pengembalian<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="rangePeminjaman" value=""
                                        required />
                                    <input type="date" class="form-control" id="datePeminjaman" name="tgl_pinjam"
                                        hidden>
                                    <input type="date" class="form-control" id="datePengembalian"
                                        name="tgl_pengembalian" hidden>
                                </div>
                            </div>

                            <div class="col-12">
                                <p class="text-danger mb-0" id="peringatan"></p>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="inputNote">Catatan<span class="text-danger">*</span></label>
                                    <textarea name="note" id="inputNote" rows="5" class="form-control w-100" required>{{ old('note') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 d-flex ftco-animate fadeInUp ftco-animated">
                <div class="mb-5">
                    <h4 class="font-weight-bold mb-4">Rincian Pesanan</h4>
                    <div class="card card-body">
                        <div class="d-flex align-items-center">
                            <div style="width: 100px">
                                @if ($perlengkapan->image)
                                    <img src="{{ asset('img/' . $perlengkapan->image) }}" alt="perlengkapan Image"
                                        class="img-fluid">
                                @else
                                    <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image"
                                        class="img-fluid" />
                                @endif
                            </div>

                            <div class="pl-3">
                                <h3 class="mb-0">{{ $perlengkapan->title }}</h3>

                                <p class="small mb-0">
                                    Disediakan oleh <b>{{ $perlengkapan->mitra->name }}</b>
                                </p>

                                <p class="font-weight-bold text-dark mb-0">
                                    {{ $perlengkapan->final_price_text }}
                                </p>
                            </div>
                        </div>

                        <div class="border-top mt-4 pt-4">
                            <div class="d-flex justify-content-between mb-2">
                                <p class="text-muted mb-0">Durasi Peminjaman</p>
                                <p class="text-dark mb-0" id="durasi">0 Hari</p>
                            </div>

                            <div class="d-flex justify-content-between">
                                <p class="text-muted mb-0">Subtotal</p>
                                <p class="text-dark mb-0" id="subtotal">0</p>
                            </div>
                        </div>

                        <div class="border-top mt-4 pt-4">
                            {{-- <div class="d-flex justify-content-between mb-2">
                                <p class="text-muted mb-0">Diskon</p>
                                <p class="text-dark mb-0">
                                    {{ $perlengkapan->price_discount ? $perlengkapan->price_discount : '-' }}</p>
                            </div> --}}

                            @if ($point > 0)
                                <div class="d-flex justify-content-between mb-2">
                                    <h6>{{ $point }} B-Poin</h6>
                                    <input type="checkbox" name="is_use_point" id="inputUsePoin">
                                </div>
                            @endif

                            <div class="d-flex justify-content-between mb-4">
                                <h6>Total</h6>
                                <h5 class="text-dark mb-0" id="total">0</h5>
                            </div>

                            <button type="submit" class="w-100 btn btn-primary">Lanjutkan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('js')
    <script>
        const clearDates = () => {
            localStorage.removeItem('startDate');
            localStorage.removeItem('endDate');
        };

        clearDates();

        const datePeminjaman = document.getElementById('datePeminjaman');
        const datePengembalian = document.getElementById('datePengembalian');
        const durasiText = document.getElementById('durasi');
        const inputDurasi = document.getElementById('inputDurasi');
        const inputGrandTotal = document.getElementById('inputGrandTotal');
        const subtotal = document.getElementById('subtotal');
        const total = document.getElementById('total');

        const price = parseFloat("{{ $perlengkapan->final_price }}");
        let point = parseInt("{{ $point }}".replace(/[^0-9]/g, ''), 10);

        const formatRupiah = (angka) => new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(angka);

        const calculateDurasi = (userPoint = 0) => {
            durasiText.textContent = '';

            const start = localStorage.getItem('startDate');
            const end = localStorage.getItem('endDate');

            if (!start || !end) {
                durasiText.textContent = '0 Hari';
                return;
            }

            const startDate = new Date(start);
            const endDate = new Date(end);

            const diffDays = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24)) + 1;
            durasiText.textContent = `${diffDays} Hari`;
            inputDurasi.value = diffDays;

            const usePointCheckbox = document.getElementById('inputUsePoin');
            const userPoints = (usePointCheckbox?.checked) ? point : 0;

            let totalPrice = diffDays * price;
            totalPrice -= userPoints;

            if (totalPrice < 0) {
                totalPrice = 0;
            }

            inputGrandTotal.value = diffDays * price;
            subtotal.textContent = formatRupiah(diffDays * price);
            total.textContent = formatRupiah(totalPrice);
        };

        const usePointCheckbox = document.getElementById('inputUsePoin');

        if (usePointCheckbox) {
            usePointCheckbox.addEventListener('change', function() {
                calculateDurasi(this.checked ? point : 0);
            });
        }

        $(function() {
            const today = moment().startOf('day');

            $('input[name="rangePeminjaman"]').daterangepicker({
                opens: 'left',
                minDate: today,
            }, function(start, end) {
                clearDates();
                localStorage.setItem('startDate', start.format('YYYY-MM-DD'));
                localStorage.setItem('endDate', end.format('YYYY-MM-DD'));

                calculateDurasi();
                $('input[name="tgl_pinjam"]').val(start.format('YYYY-MM-DD'));
                $('input[name="tgl_pengembalian"]').val(end.format('YYYY-MM-DD'));
            });

            $('input[name="rangePeminjaman"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(
                    `${picker.startDate.format('MM/DD/YYYY')} - ${picker.endDate.format('MM/DD/YYYY')}`);
            });

            $('input[name="rangePeminjaman"]').on('cancel.daterangepicker', function() {
                $(this).val('');
                clearDates();
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const selectProvinsi = document.getElementById('selectProvinsi');
            selectProvinsi.selectedIndex = 0;

            const selectKota = document.getElementById('selectKota');
            selectKota.disabled = true;

            const selectKecamatan = document.getElementById('selectKecamatan');
            selectKecamatan.disabled = true;

            const selectDesa = document.getElementById('selectDesa');
            selectDesa.disabled = true;
        });

        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(function() {
                $('#selectProvinsi').on('change', function() {
                    let id_provinsi = $('#selectProvinsi').val();

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('getkota') }}",
                        data: {
                            id_provinsi: id_provinsi
                        },
                        cache: false,

                        success: function(message) {
                            $('#selectKota').html(message).prop('disabled', false);
                            $('#selectKecamatan').html(
                                '<option selected>Pilih Kecamatan:</option>').prop(
                                'disabled', true);
                            $('#selectDesa').html(
                                '<option selected>Pilih Desa:</option>').prop(
                                'disabled', true);
                        },
                        error: function(data) {
                            console.log('error', data);
                        },
                    })
                })
            })
            $(function() {
                $('#selectKota').on('change', function() {
                    let id_kota = $('#selectKota').val();

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('getkecamatan') }}",
                        data: {
                            id_kota: id_kota
                        },
                        cache: false,

                        success: function(message) {
                            $('#selectKecamatan').html(message).prop('disabled', false);
                            $('#selectDesa').html(
                                '<option selected>Pilih Desa:</option>').prop(
                                'disabled', true);
                        },
                        error: function(data) {
                            console.log('error', data);
                        },
                    })
                })
            })
            $(function() {
                $('#selectKecamatan').on('change', function() {
                    let id_kecamatan = $('#selectKecamatan').val();

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('getdesa') }}",
                        data: {
                            id_kecamatan: id_kecamatan
                        },
                        cache: false,

                        success: function(message) {
                            $('#selectDesa').html(message).prop('disabled', false);
                        },
                        error: function(data) {
                            console.log('error', data);
                        },
                    })
                })
            })
        });
    </script>
@endsection
