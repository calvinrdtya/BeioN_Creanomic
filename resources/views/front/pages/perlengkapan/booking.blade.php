@extends('front.layouts.apps')

@section('content')
{{-- <style>
.step-wizard-list {
    list-style-type: none;
    display: flex;
    position: relative;
}
.step-wizard-item{
    /* padding: 0 10px; */
    /* flex-basis: 0; */
    -webkit-box-flex: 1;
    -ms-flex-positive:1;
    flex-grow: 1;
    max-width: 100%;
    flex-direction: column;
    text-align: center;
    min-width: 150px;
    position: relative;
}
.step-wizard-item + .step-wizard-item:after{
    content: "";
    position: absolute;
    left: 0;
    top: 19px;
    background: #21d4fd;
    width: 100%;
    height: 2px;
    transform: translateX(-50%);
    z-index: -10;
}
.progress-count {
    margin-bottom: -6px !important;
    font-size: 13px;
    height: 38px;
    width: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-weight: 600;
    margin: 0 auto;
    position: relative;
    z-index:10;
    color: transparent;
}
.progress-count:after{
    content: "";
    height: 25px;
    width: 25px;
    background: #21d4fd;
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    border-radius: 50%;
    z-index: -10;
}
.progress-count:before{
    content: "";
    height: 7px;
    width: 12px;
    border-left: 3px solid #fff;
    border-bottom: 3px solid #fff;
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -60%) rotate(-45deg);
    transform-origin: center center;
}
.progress-label {
    font-size: 13px;
    font-weight: 600;
}
.current-item .progress-count:before,
.current-item ~ .step-wizard-item .progress-count:before{
    display: none;
}
.current-item ~ .step-wizard-item .progress-count:after{
    height:10px;
    width:10px;
}
.current-item ~ .step-wizard-item .progress-label{
    opacity: 0.5;
}
.current-item .progress-count:after{
    background: #fff;
    border: 2px solid #21d4fd;
}
.current-item .progress-count{
    color: #21d4fd;
}
.nav-payment {
  height: var(--header-height-nav);
  padding: 0.5rem;
  background-color: #FFF;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
</style> --}}
  
    <div class="container">
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <ol class="all">
                <li><a href="{{ route('front.home') }}" class="title3">Home</a></li>
                <li class="title2">Transportasi</li>
                <li class="title2">Data Diri</li>
            </ol>
        </div>
    </section>
    <!-- End Breadcrumbs -->
        
            <div class="container" style="width: 90%;">
                <form action="" method="POST">
                    <input type="hidden" name="" value="">
                        <div class="row">
                            <div class="col-lg-8 mb-4">
                                <h4 class="title1">Pemesanaan Anda</h4>
                                <p>Isi Data Anda</p>
                                <div class="card p-3 mb-4">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="https://i.ibb.co.com/rmJvBb1/why-1.png" alt="" width="100">
                                        </div>
                                        <div class="col-md-10">
                                            <h5 class="title1">Masuk / Daftar dan nikmati fitur khusus untuk member BeioN</h5>
                                            <h5 class="title1">Banyak Promo</h5>
                                        </div>
                                    </div>
                                </div>
                            {{-- <hr class="mt-4 mb-4"> --}}
                        <div class="container">
                            <h4 class="title1">Pemesanaan Anda</h4>
                            <div class="card p-3">
                                <h5 class="title1">Data Pemesan (untuk E-tiket/Voucher)</h5>
                                <hr class="mt-3 mb-3">
                                    <div class="form-group form-group-transportasi mb-3">
                                        <label for="nama" class="float-start mb-2">Nama Lengkap<span class="text-danger">*</span><small>&nbsp;(tanpa gelar dan tanda baca)</small></label>
                                        <input type="text" id="nama" class="form-control form-control-lg fs-6 mt-1">
                                    </div>
                                    {{-- <div class="mb-3">
                                        <label for="no_telp" class="form-label">Nomer Telepon <span class="text-danger">*</span></label>
                                        <div class="input-group form-group-transportasi">
                                            <span class="input-group-text" id="basic-addon1">+62</span>
                                            <input type="text" class="form-control form-control-lg fs-6" id="no_telp" placeholder="Masukkan Nomer Telepon" aria-label="Phone Number" aria-describedby="basic-addon1">
                                        </div>
                                    </div> --}}
                                   
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-group-transportasi mb-3">
                                                <label for="no_telp" class="float-start mb-2">Nomer Telepon<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-lg fs-6 mt-1" placeholder="+62">
                                                <p><small>Contoh: +62812345678 dan No. Handphone 0812345678</small></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-transportasi mb-3">
                                                <label for="email" class="float-start mb-2">Email<span class="text-danger">*</span></label>
                                                <input type="email" class="form-control form-control-lg fs-6 mt-1" >
                                                <p><small>Contoh: email@example.com</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class="container mt-4 mb-4">
                            <h4 class="title1">Detail Pengemudi</h4>
                            <div class="card p-3">
                                <h5 class="title1">Dewasa 1</h5>
                                <hr class="mt-2 mb-2">
                                    <div class="form-group-title">
                                        <label for="title" class="form-label">Title</label>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <input name="default-radio-1" class="form-check-input" type="radio" value="tuan" id="tuan">
                                                <label class="form-check-label" for="tuan">Tuan</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <input name="default-radio-1" class="form-check-input" type="radio" value="nyonya" id="nyonya">
                                                <label class="form-check-label" for="nyonya">Nyonya</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <input name="default-radio-1" class="form-check-input" type="radio" value="nona" id="nona">
                                                <label class="form-check-label" for="nona">Nona</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-transportasi mb-3">
                                        <label for="nama" class="float-start mb-2">Nama Lengkap<span class="text-danger">*</span><small>&nbsp;(tanpa gelar dan tanda baca)</small></label>
                                        <input type="text" id="nama" class="form-control form-control-lg fs-6 mt-1">
                                    </div>
                                    {{-- <div class="mb-3">
                                        <label for="no_telp" class="form-label">Nomer Telepon <span class="text-danger">*</span></label>
                                        <div class="input-group form-group-transportasi">
                                            <span class="input-group-text" id="basic-addon1">+62</span>
                                            <input type="text" class="form-control form-control-lg fs-6" id="no_telp" placeholder="Masukkan Nomer Telepon" aria-label="Phone Number" aria-describedby="basic-addon1">
                                        </div>
                                    </div> --}}
                                   
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-group-transportasi mb-3">
                                                <label for="no_telp" class="float-start mb-2">Nomer Telepon<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-lg fs-6 mt-1" placeholder="+62">
                                                <p><small>Contoh: +62812345678 dan No. Handphone 0812345678</small></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-transportasi mb-3">
                                                <label for="email" class="float-start mb-2">Email<span class="text-danger">*</span></label>
                                                <input type="email" class="form-control form-control-lg fs-6 mt-1" >
                                                <p><small>Contoh: email@example.com</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <h4 class="title1">Detail Rental</h4>
                            <div class="card p-1">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-car fa-lg" style="color: #012970;"></i>
                                        <h6 class="titles ms-2 mb-0">Rental Mobil Tanpa Sopir</h6>
                                    </div>
                                    <hr class="mb-4 mt-4">
                                    <h6 class="titles">Honda Brio New</h6>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>Oyo x</span>
                                        <span>Rp 920.000</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>Nesting x</span>
                                        <span>Rp 75.000</span>
                                    </div>
                                    <hr class="mb-4 mt-4">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6>Subtotal</h6>
                                        <span>Rp 995.000</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6>Total</h6>
                                        <span id="total">Rp 995.000</span>
                                    </div>
                                    <hr class="mb-4 mt-4">
                                    <button href="" class="btn btn-primary w-100">Booking Sekarang</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection