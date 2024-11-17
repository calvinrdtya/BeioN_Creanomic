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
    <div class="row align-items-center mb-5">
        <div class="col-lg-4">
            <div class="card card-body bg-light border-0 p-0">
                @if ($perlengkapan->image)
                    <img src="{{ asset('img/' . $perlengkapan->image) }}" alt="perlengkapan Image"
                        class="img-fluid rounded">
                @else
                    <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image" class="img-fluid rounded">
                @endif
            </div>
        </div>

        <div class="col pl-lg-5">
            <div>
                <h1 class="font-weight-bold">{{ $perlengkapan->title }}</h1>

                <p class="h3 font-weight-bold text-dark mb-0">{{ $perlengkapan->final_price_text }}</p>
                @if ($perlengkapan->price_discount)
                    <p class="mb-0"><span class="badge badge-danger ">{{ $perlengkapan->price_discount_text }}</span>
                        <del>{{ $perlengkapan->price_text }}</del>
                    </p>
                @endif

                <div class="border-top mt-3">
                    <p class="text-dark my-3">Kategori: <a href="#">{{ $perlengkapan->category->name }}</a></p>
                    <p>{{ $perlengkapan->deskripsi }}</p>
                </div>

                <div class="d-flex align-items-center border-top pt-3">
                    <div style="max-width: 50px">
                        <img src="{{ asset('img/' . $perlengkapan->image) }}" alt=""
                            class="img-fluid rounded-circle">
                    </div>

                    <div class="ml-3">
                        <h6 class="font-weight-bold text-dark mb-0">{{ $perlengkapan->mitra->name }}</h6>
                        <p class="mb-0">{{ $perlengkapan->mitra->kota }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="mb-5">
                <h5>Informasi Penting</h5>

                <ul>
                    <li>Saat transaksi selesai, pihak penyedia layanan akan menghubungi Anda melalui pesan WhatsApp.</li>
                    <li>Penyedia jasa akan meminta dokumen (SIM/KTP) untuk proses verifikasi.</li>
                    <li>Syarat tambahan akan di informasikan oleh penyedia layanan.</li>
                    <li>Dokumen (asli) di atas harus dibawa saat pengambilan peralatan (hubungi penyedia lebih lanjut untuk
                        detail informasi lebih lanjut)</li>
                    <li>Batas toleransi untuk memenuhi syarat diatas paling lambat 2 jam setelah waktu yang Anda tentukan
                        dalam proses pemesanan. Jika tidak, pesanan tidak bisa di refund apabila syarat diatas tidak
                        terpenuhi.</li>
                    <li>Penyedia layanan berhak membatalkan pesanan, apabila syarat dan ketentuan di atas tidak terpenuhi.
                    </li>
                </ul>
            </div>

            <div class="mb-5">
                <h5>Kantor {{ $perlengkapan->mitra->name }}</h5>

                <div style="position: relative; padding-bottom: 56.25%; max-height: 500px; height: 0; overflow: hidden;">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3008.335955946253!2d113.72893557358721!3d-8.161872081775506!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd69504e46005e7%3A0xc546a5002deb6fa2!2sCucong%20Backpacker%20(Outdoor%20Rental)%20Sewa%20Peralatan%20Camping!5e1!3m2!1sid!2sid!4v1722613790878!5m2!1sid!2sid"
                        style="border: 0; position: absolute; top: 0; left: 0; width: 100%; height: 100%;" 
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="rounded-1">
                    </iframe>
                </div>                
            </div>

            <div class="mb-5">
                <h5>Kebijakan Pengembalian Dana</h5>

                <ul>
                    <li>Refund tidak tersedia untuk pembatalan kurang dari 24 jam sebelum waktu jemput.</li>
                    <li>Refund 100% untuk pembatalan 24 jam sebelum waktu jemput.</li>
                </ul>
            </div>

            <div class="mb-5">
                <h5>Kebijakan Reschedule</h5>

                <ul>
                    <li>Reschedule bisa dilakukan paling lambat 24 jam sebelum waktu pengambilan.</li>
                    <li>Pengajuan reschedule Anda bergantung pada ketersediaan perlengkapan.</li>
                    <li>Reschedule tidak dikenakan biaya. Namun, jika ada perbedaan harga rental di antara jadwal baru dan
                        lama, selisih harganya akan ditanggung oleh penumpang.</li>
                </ul>
            </div>
        </div>

        <div class="col">
            <div class="card card-body bg-light border-0">
                <h5 class="mb-2">Pesan</h5>

                <p class="mb-0 text-dark"><span
                        class="h3 font-weight-bold text-dark">{{ $perlengkapan->final_price_text }}</span>/Periode</p>
                @if ($perlengkapan->price_discount)
                    <p class="mb-0"><span class="badge badge-danger ">{{ $perlengkapan->price_discount_text }}</span>
                        <del>{{ $perlengkapan->price_text }}</del>
                    </p>
                @endif

                <p class="mt-3 mb-4 text-dark">Stok <b>sisa {{ $perlengkapan->qty }}</b>, segera pesan!</p>
                <a href="{{ route('perlengkapan.booking', $perlengkapan->id) }}" class="w-100 btn btn-primary">Pesan</a>
            </div>
        </div>
    </div>
@endsection
