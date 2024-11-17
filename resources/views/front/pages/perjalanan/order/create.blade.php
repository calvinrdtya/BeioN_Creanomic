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
                <li class="title2">Perjalanan</li>
                <li class="title2">Data Diri</li>
            </ol>
        </div>
    </section>
    <div class="container" style="width: 90%;">
        <form action="{{ route('perjalanan.booking.store', $perjalanan->id) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="container">
                        <h4 class="title-booking mb-3">Detail Pemesan</h4>
                            <div class="card p-3 rounded-2">
                                <div class="form-group-title">
                                    <label for="" class="form-label title-booking-three">Title</label>
                                </div>
                                <div class="row my-3">
                                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                    <input type="hidden" name="grand_total" value="{{ str_replace('.', '', $perjalanan->final_price) }}">
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
                                <div class="form-group form-group-perjalanan my-2">
                                    <label for="first_name" class="float-start mb-2 title-booking-three">Nama Lengkap<span class="text-danger">*</span><small>&nbsp;(tanpa gelar dan tanda baca)</small></label>
                                    <input type="text" id="first_name" name="first_name" class="form-control nav-group-mvp" required value="{{ auth()->user()->name }}">
                                </div>
                                <div class="form-group form-group-perjalanan my-2">
                                    <label for="last_name" class="float-start mb-2 title-booking-three">Nama Belakang<span class="text-danger">*</span></label>
                                    <input type="text" id="last_name" name="last_name" class="form-control nav-group-mvp" required>
                                </div>
                                <div class="row my-2">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-perjalanan my-2">
                                            <label for="no_handphone" class="float-start mb-2 title-booking-three">Nomer Handphone<span class="text-danger">*</span></label>
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
                                            <option value="">Pilih Provinsi</option>
                                            @foreach ($provinces as $provinsi)
                                                <option value="{{ $provinsi->id }}" class="text-capitalize">{{ $provinsi->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="kota" class="form-label title-booking-three">Kota<span class="text-danger">*</span></label>
                                        <select id="kota" name="kota" class="form-select nav-group-mvp">
                                        </select>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-md-6">
                                        <label for="kecamatan" class="form-label title-booking-three">Kecamatan<span class="text-danger">*</span></label>
                                        <select id="kecamatan" name="kecamatan" class="form-select nav-group-mvp">
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="desa" class="form-label title-booking-three">Desa<span class="text-danger">*</span></label>
                                        <select id="desa" name="desa" class="form-select nav-group-mvp">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-group-perjalanan my-2">
                                    <label for="alamat_lengkap" class="float-start mb-2 title-booking-three">Alamat Lengkap<span class="text-danger">*</span></label>
                                    <textarea class="form-control nav-group-mvp" id="alamat_lengkap" name="alamat_lengkap" rows="3" placeholder="Rt/Rw/Nama Jalan" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="col-lg-4">
                    <h4 class="title-booking mb-3">Rincian Pesanan</h4>
                    <div class="card p-1 rounded-2">
                        <div class="card-body">
                            @if ($perjalanan->thumbnail)
                                <img src="{{ asset('img/' . $perjalanan->thumbnail) }}" alt="Perjalanan Image" class="rounded-2" width="100%">
                            @else
                                <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image"/>
                            @endif
                            <div class="my-2">
                                <span class="title-booking-three d-block">Nama Paket</span>
                                <span class="title-booking-secondary d-block text-capitalize">{{ $perjalanan->title }}</span>
                            </div>
                            <div class="my-2">
                                <span class="title-booking-three d-block">Jenis Perjalanan</span>
                                @if ($perjalanan->jenis == 'ya')
                                    <span class="badge bg-two mb-0 mr-auto">Open</span>
                                @else
                                    <span class="badge bg-two mb-0 mr-auto">Private</span>
                                @endif
                            </div>
                            <div class="my-2">
                                <span class="title-booking-three d-block">Durasi Perjalanan</span>
                                <span class="title-booking-secondary d-block text-capitalize">{{ $perjalanan->durasi }}</span>
                            </div>
                            <div class="my-2">
                                <label for="defaultSelect" class="form-label">Meeting Points</label>
                                <select id="defaultSelect" class="form-select" name="meeting_points" required>
                                    <option value="">Pilih Meeting Point</option>
                                    @php
                                        $meetingPoints = explode(',', $perjalanan->titik);
                                    @endphp
                                    @foreach ($meetingPoints as $point)
                                        <option value="{{ $point }}">{{ $point }}</option>
                                    @endforeach
                                </select>
                            </div>                                                       
                            {{-- <div class="my-1">
                                <span class="title-booking-three">{{ $perjalanan->jenis }}</span>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card p-1 mt-4">
                        <div class="card-body">
                            <h6 class="title-book">Rincian Harga</h6>
                        <hr class="my-3">
                            <div class="my-2">
                                <h6 class="title-book">1x {{ $perjalanan->title }}</h6>
                            </div>
                            <div class="d-flex justify-content-between align-items-center my-3">
                                <span class="title-booking-three d-block">Diskon</span>
                                @if ($perjalanan->price_discount === null)
                                    <h6 class="title-book">-</h6>
                                @else
                                    <span class="title-booking-three d-block">{{ $perjalanan->price_discount }}%</span>
                                @endif
                            </div>
                            @if ($perjalanan->price_discount === null)
                                <div class="text-end d-none">
                                    <h5 class="price-sub text-decoration-line-through mb-0">-</h5>
                                </div>
                            @else
                                <div class="text-end">
                                    <h5 class="price-sub text-decoration-line-through mb-0">Rp {{ $perjalanan->price }}</h5>
                                </div>
                            @endif
                            <div class="d-flex justify-content-between align-items-center my-2">
                                <h5 class="titles mb-0">Harga Total</h5>
                                <div class="price-end text-end">
                                    <h4 class="mb-0">Rp {{ $perjalanan->final_price }}</h4>
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

    //  $(document).ready(function() {
    //     $('#provinsi').change(function() {
    //         var provinceId = $(this).val();
    //         if (provinceId) {
    //             $.ajax({
    //                 type: 'GET',
    //                 url: '',
    //                 data: { id: provinceId },
    //                 success: function(response) {
    //                     $('#kota').empty();
    //                     $.each(response, function(key, value) {
    //                         $('#kota').append('<option value="' + key + '">' + value + '</option>');
    //                     });
    //                 }
    //             });
    //         } else {
    //             $('#kota').empty();
    //         }
    //     });
    // });
</script>
@endsection