@extends('front.layouts.apps')

@section('content')

<div class="container pb-5">
    <section class="breadcrumbs" style="margin-top: 30px !important">
        <div class="container">
            <a href="{{ route('front.home') }}" class="logo">
                <img src="https://i.ibb.co.com/zHsZVdf/logo-hitam.png" alt="logo" width="10%">
            </a>
            <ol class="all mt-3">
                <li><a href="{{ route('front.home') }}" class="title3">Home</a></li>
                <li class="title2">Transportasi</li>
                <li class="title2">Data Diri</li>
            </ol>
        </div>
    </section>

    <div class="container" style="width: 90%;">
        <form action="{{ route('homestay.booking.store', $homestay->uniq_id) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <h4 class="title-booking mb-3">Detail Pemesan</h4>
                        <div class="card p-3 my-2">
                            <div class="form-group-title">
                                <label for="" class="form-label title-booking-three">Title</label>
                            </div>
                            <div class="row my-1">
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                <input type="hidden" name="grand_total" value="{{ $homestay->final_price }}">
                                <div class="col-md-2">
                                    <div class="form-check form-group-perjalanan">
                                        <input name="title" class="form-check-input nav-group-mvp" type="radio" value="Tuan" id="tuan">
                                        <label class="form-check-label title-booking-three" for="tuan">Tuan</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check form-group-perjalanan">
                                        <input name="title" class="form-check-input nav-group-mvp" type="radio" value="Nyonya" id="nyonya">
                                        <label class="form-check-label title-booking-three" for="nyonya">Nyonya</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check form-group-perjalanan">
                                        <input name="title" class="form-check-input nav-group-mvp" type="radio" value="Nona" id="nona">
                                        <label class="form-check-label title-booking-three" for="nona">Nona</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-md-6">
                                    <div class="form-group form-group-perjalanan my-2">
                                        <label for="first_name" class="float-start mb-2 title-booking-three">Nama Lengkap<span class="text-danger">*</span><small>&nbsp;(tanpa gelar dan tanda baca)</small></label>
                                        <input type="text" id="first_name" name="first_name" class="form-control nav-group-mvp" required value="{{ auth()->user()->name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-perjalanan my-2">
                                        <label for="last_name" class="float-start mb-2 title-booking-three">Nama Belakang<span class="text-danger">*</span></label>
                                        <input type="text" id="last_name" name="last_name" class="form-control nav-group-mvp" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-md-6">
                                    <div class="form-group form-group-perjalanan my-2">
                                        <label for="nomer" class="float-start mb-2 title-booking-three">Nomer Handphone<span class="text-danger">*</span></label>
                                        <input type="text" id="no_handphone" name="no_handphone" class="form-control nav-group-mvp" placeholder="+62" required value="{{ auth()->user()->phone }}">
                                        <p><small>Contoh: 812345678 dan No. Handphone 0812345678</small></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-perjalanan my-2">
                                        <label for="email" class="float-start mb-2 title-booking-three">Email<span class="text-danger">*</span></label>
                                        <input type="email" id="email" name="email" class="form-control nav-group-mvp" required value="{{ auth()->user()->email }}">
                                        <p><small>Contoh: email@example.com</small></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="provinsi" class="form-label title-booking-three">Provinsi<span class="text-danger">*</span></label>
                                    <select id="provinsi" name="provinsi" class="form-select nav-group-mvp">
                                        <option>Pilih Provinsi</option>
                                        @foreach ($provinces as $provinsi)
                                            <option value="{{ $provinsi->id }}" class="text-capitalize">{{ $provinsi->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="kota" class="form-label title-booking-three">Kota<span class="text-danger">*</span></label>
                                    <select id="kota" name="kota" class="form-select nav-group-mvp"></select>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-md-6">
                                    <label for="kecamatan" class="form-label title-booking-three">Kecamatan<span class="text-danger">*</span></label>
                                    <select id="kecamatan" name="kecamatan" class="form-select nav-group-mvp"></select>
                                </div>
                                <div class="col-md-6">
                                    <label for="desa" class="form-label title-booking-three">Desa<span class="text-danger">*</span></label>
                                    <select id="desa" name="desa" class="form-select nav-group-mvp"></select>
                                </div>
                            </div>
                            <div class="form-group my-2">
                                <label for="alamat" class="float-start mb-2 title-booking-three">Alamat Lengkap<span class="text-danger">*</span></label>
                                <textarea class="form-control nav-group-mvp" id="exampleFormControlTextarea1" name="alamat_lengkap" rows="3" placeholder="Rt/Rw/Nama Jalan" required></textarea>
                            </div>
                        </div>
                    </div>

                <div class="col-lg-4">
                    <h4 class="title-booking mb-3">Rincian Pesanan</h4>
                    <div class="card p-1 rounded-2">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center">
                                @if ($homestay->image)
                                    <img src="{{ asset('img/' . $homestay->image) }}" alt="homestay Image" class="rounded-2" width="50%">
                                @else
                                    <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image"/>
                                @endif
                            </div>
                            <div class="my-2">
                                <span class="title-booking-three d-block">Perlengkapan</span>
                                <span class="title-booking-secondary d-block text-capitalize">{{ $homestay->title }}</span>
                            </div>
                            <div class="my-2">
                                <span class="title-booking-three d-block">Disediakan oleh {{ $homestay->mitra->name }}</span>
                                {{-- <span class="title-booking-secondary d-block text-capitalize">{{ $homestay->title }}</span> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card p-1 my-4">
                        <div class="card-body">
                            <h6 class="title-book">Durasi Peminjaman</h6>
                            <hr class="my-3">
                            <div class="form-group form-group-perjalanan my-2">
                                <label for="tgl_booking" class="float-start mb-2 title-booking-three">Tanggal Pinjam<span class="text-danger">*</span></label>
                                <input type="text" id="tgl_booking_homestay" name="tgl_booking" class="form-control nav-group-mvp" required>
                            </div>
                            <div class="form-group form-group-perjalanan my-2">
                                <label for="tgl_selesai" class="float-start mb-2 title-booking-three">Tanggal Pengembalian<span class="text-danger">*</span></label>
                                <input type="text" id="tgl_selesai_homestay" name="tgl_selesai" class="form-control nav-group-mvp" required>
                            </div>
                            <div class="form-group form-group-perjalanan my-2">
                                <label for="note" class="float-start mb-2 title-booking-three">Catatan Pemesan<span class="text-danger">*</span><small>&nbsp;(Opsional)</small></label>
                                <input type="text" id="note" name="note" class="form-control nav-group-mvp" placeholder="Pesan" required>
                            </div>
                        </div>
                    </div>
                    <div class="card p-1">
                        <div class="card-body">
                            <h6 class="title-book">Rincian Harga</h6>
                            <hr class="my-3">
                            <div class="my-2">
                                <h6 class="title-book">1x {{ $homestay->title }}</h6>
                            </div>
                            <div class="my-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="title-booking-three d-block">Diskon</span>
                                    @if ($homestay->price_discount === null)
                                        <h6 class="title-book">-</h6>
                                    @else
                                        <span class="title-booking-three d-block">{{ $homestay->price_discount }}%</span>
                                    @endif
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="title-booking-three d-block">Durasi Pinjam</span>
                                    <span class="badge bg-two mb-0 mr-auto">0 Hari</span>
                                    <input type="hidden" id="durasi_booking" name="durasi_booking" value="0">
                                </div>
                            </div>
                            @if ($homestay->price_discount === null)
                                <div class="text-end d-none">
                                    <h5 class="price-sub text-decoration-line-through mb-0">-</h5>
                                </div>
                            @else
                                <div class="text-end">
                                    <h5 class="price-sub text-decoration-line-through mb-0">Rp {{ $homestay->price }}</h5>
                                </div>
                            @endif
                            <div class="d-flex justify-content-between align-items-center my-2">
                                <h5 class="titles mb-0">Harga Total</h5>
                                <div class="price-end text-end">
                                    <h4 class="mb-0">Rp {{ $homestay->final_price }}</h4>
                                </div>
                            </div>
                            <hr class="my-3">
                            <button type="submit" class="button-booking border-0 w-100">Lanjutkan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(function () {
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $(function () {
            $('#provinsi').on('change', function() {
                let id_provinsi = $('#provinsi').val();

            $.ajax({
                type : 'POST',
                url : "{{ route('getkota') }}",
                data : {id_provinsi:id_provinsi},
                cache : false,

                    success: function(message) {
                        $('#kota').html(message);
                        $('#kecamatan').html('');
                        $('#desa').html('');
                    },
                    error: function(data) {
                        console.log('error', data);
                    },
                })
            })
        })
        $(function () {
            $('#kota').on('change', function() {
                let id_kota = $('#kota').val();

            $.ajax({
                type : 'POST',
                url : "{{ route('getkecamatan') }}",
                data : {id_kota:id_kota},
                cache : false,

                    success: function(message) {
                        $('#kecamatan').html(message);
                        $('#desa').html('');
                    },
                    error: function(data) {
                        console.log('error', data);
                    },
                })
            })
        })
        $(function () {
            $('#kecamatan').on('change', function() {
                let id_kecamatan = $('#kecamatan').val();

            $.ajax({
                type : 'POST',
                url : "{{ route('getdesa') }}",
                data : {id_kecamatan:id_kecamatan},
                cache : false,

                    success: function(message) {
                        $('#desa').html(message);
                    },
                    error: function(data) {
                        console.log('error', data);
                    },
                })
            })
        })
    });

    // Date Range Tanggal Pinjam dan Pengembalian Perlengkapan
    $(function() {
        // Fungsi untuk memformat tanggal dalam bahasa Indonesia
        function formatDate(date) {
            const months = [
                "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];
            let d = new Date(date);
            let day = d.getDate();
            let month = months[d.getMonth()];
            let year = d.getFullYear();
            return `${day} ${month} ${year}`;
        }

        // Inisialisasi date range picker
        $('input[id="tgl_booking_homestay"], input[id="tgl_selesai_homestay"]').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear',
                format: 'DD/MM/YYYY'
            }
        });

        // Event listener untuk update input tgl_booking_homestay dan tgl_selesai_homestay
        $('input[id="tgl_booking_homestay"], input[id="tgl_selesai_homestay"]').on('apply.daterangepicker', function(ev, picker) {
            var startDate = formatDate(picker.startDate.format('YYYY-MM-DD'));
            var endDate = formatDate(picker.endDate.format('YYYY-MM-DD'));
            
            $('#tgl_booking_homestay').val(startDate);
            $('#tgl_selesai_homestay').val(endDate);

            // Menghitung jumlah malam
            var start = new Date(picker.startDate.format('YYYY-MM-DD'));
            var end = new Date(picker.endDate.format('YYYY-MM-DD'));
            var nights = Math.round((end - start) / (1000 * 60 * 60 * 24));
            
            $('.badge').text(nights + ' Hari');
            $('#durasi_booking').val(nights); // Mengisi input tersembunyi dengan nilai durasi
        });

        // Event listener untuk clear input
        $('input[id="tgl_booking_homestay"], input[id="tgl_selesai_homestay"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            $('.badge').text('0 Hari');
            $('#durasi_booking').val(0); // Mengisi input tersembunyi dengan nilai 0
        });
    });


</script>
@endsection