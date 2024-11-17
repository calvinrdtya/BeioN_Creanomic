@extends('front.layouts.app')

@section('content')

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <ol class="all mt-3">
                <li><a href="{{ route('front.home') }}" class="title3">Home</a></li>
                <li class="title2">Cart</li>
            </ol>
        </div>
    </section>
    <!-- End Breadcrumbs -->

    <div class="user-riwayat pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card p-3 border-0">
                        <div class="row g-0">
                            <div class="col-md-2">
                                <div class="card m-0 p-0 border-0">
                                    <p class="title-sub my-0 ms-2">Item</p>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <div class="card m-0 p-0 border-0">
                                    <p class="title-sub my-0 ms-2">Invoice</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="card m-0 p-0 border-0">
                                    <p class="title-sub my-0 ms-2">Harga</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="card m-0 p-0 border-0">
                                    <p class="title-sub my-0 text-center">Jumlah</p>
                                </div>
                            </div>
                            <hr class="my-2">
                        </div>
                        <div class="row g-0">
                            {{-- @php
                                $perjalananMap = $perjalanans->keyBy('id');
                            @endphp --}}
                            {{-- @foreach ($carts as $cart)
                                @php
                                    $perjalanan = $perjalananMap->get($cart->product_id);
                                @endphp
                                @if ($perjalanan) --}}
                                    <div class="col-md-2 p-1">
                                        <div class="card justify-content-center h-100 border-0">
                                            {{-- @if (!empty($perjalanan->thumbnail)) --}}
                                                {{-- <img src="{{ asset('img/' . $perjalanan->thumbnail) }}" alt="Perjalanan Image" class="img-fluid" width="90%"> --}}
                                            {{-- @else --}}
                                                <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image" class="img-fluid" width="60%">
                                            {{-- @endif --}}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card justify-content-center h-100 border-0">
                                            <span class="ms-2 text-capitalize">Tes</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card justify-content-center h-100 border-0">
                                            <span class="ms-2 text-capitalize">Rp 676.000</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card justify-content-center h-100 border-0">
                                            <span class="ms-2 text-capitalize">Rp 676.000</span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">

                                    </div>
                                    <div class="col-md-1">

                                    </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-4">
                    <div class="card p-3">
                        <div class="title-paket d-flex justify-content-between align-items-center mb-2">
                            <h5 class="titles mb-0">Sub Harga</h5>
                        </div>
                        <div class="d-flex justify-content-between align-items-center my-3">
                            <p class="title-sub my-0">Rincian</p>
                            <div class="price-end text-end">
                                <h4 class="mb-0">Rp 45454</h4>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center my-3">
                            <h5 class="titles mb-0">Harga Total</h5>
                            <div class="price-end text-end">
                                <h4 class="mb-0">Rp 454545</h4>
                            </div>
                        </div>
                        
                        <div class="price align-items-center justify-content-end">
                            <div class="price-end d-flex align-items-center justify-content-end">
                                <h4 class="mb-0">Rp 34343</h4>
                                <p class="my-0 title-sub">&nbsp; / pax</p>
                            </div>
                            <h5 class="price-sub mb-0 ms-auto text-decoration-line-through text-end">Rp asas</h5>
                            <div class="price-end d-flex align-items-center justify-content-end">
                                <h4 class="mb-0">Rp asas</h4>
                                <p class="my-0 title-sub">&nbsp; / pax</p>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="button-booking w-100 border-0">Pesan</button>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    
    

@endsection

