@extends('front.layouts.front-with-hero')

@section('title', $title)

@section('breadcrumb')
    <p class="breadcrumbs">
        <span class="mr-2"><a href="index.html">Beranda <i class="fa fa-chevron-right"></i></a></span>
        <span class="mr-2"><a href="{{ route('perlengkapan') }}">Perlengkapan <i class="fa fa-chevron-right"></i></a></span>
        <span>{{ $title }} <i class="fa fa-chevron-right"></i></span>
    </p>
    <h1 class="mb-0 bread">{{ $title }}</h1>
@endsection

@section('content')
    <!-- Paket Perjalanan -->
    <section class="ftco-section">
        <div class="container px-0">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-3 sidebar">
                        <div class="sidebar-box pt-0">
                            <div class="categories d-flex align-items-center">
                                <i class="fa fa-user-check" style="font-size: 3rem; margin-right: 15px;"></i>
                                <div>
                                    <h3 class="mb-0">{{ $mitra->name }}</h3>
                                    <p class="mb-0" style="margin-right: 3px !important;">
                                        <i class="fas fa-map-marker-alt mr-2"></i> {{ $mitra->kota }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-box pt-0">
                            <div class="categories">
                                <li class="text-dark">Urutkan</li>
                                <li>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input shadow-none" id="mahal"
                                            name="price" value="desc">
                                        <label class="form-check-label float-start" for="mahal">Harga Tertinggi</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input shadow-none" id="murah"
                                            name="price" value="asc">
                                        <label class="form-check-label float-start" for="murah">Harga Termurah</label>
                                    </div>
                                </li>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="container py-3">
                            <div class="row">
                                @forelse ($perlengkapan as $item)
                                    <div class="col-md-3 px-2 mb-4">
                                        <div class="card-perlengkapan">
                                            <a href="{{ route('user.perlengkapan.detail', $item->id) }}" class="img"
                                                style="background-image: url({{ $item->image_path }});"></a>
                                            <div class="text p-3">
                                                <h3><a
                                                        href="{{ route('user.perlengkapan.detail', $item->id) }}">{{ $item->title }}</a>
                                                </h3>
                                                @if ($item->price_discount)
                                                    <p class="m-0 mt-2" style="text-decoration: line-through;">
                                                        {{ $item->price_text }}</p>
                                                @endif
                                                <p class="m-0 price">{{ $item->final_price_text }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col text-center">
                                        <h6>Tidak ada perlengkapan</h6>
                                    </div>
                                @endforelse
                            </div>
                            <div class="row mt-5">
                                <div class="col text-center">
                                    <div class="d-flex justify-content-center">
                                        {{ $perlengkapan->appends(['sort' => $sortOrder])->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Paket Perjalanan -->

    <!-- Guide AI -->
    <!-- <section class="ftco-intro ftco-section ftco-no-pt">
                                                                    <div class="container">
                                                                    <div class="row justify-content-center">
                                                                        <div class="col-md-12 text-center">
                                                                        <div class="img"  style="background-image: url(images/bg_2.jpg);">
                                                                            <div class="overlay"></div>
                                                                            <h2>Guide AI</h2>
                                                                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quos similique nulla iure harum, odio perferendis veritatis illum sunt natus autem et accusantium culpa rem officia mollitia unde praesentium! Laborum, unde!</p>
                                                                            <p class="mb-0"><a href="#" class="btn btn-primary px-3 py-3 border-0">Ajukan Pertanyaan</a></p>
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                </section> -->
    <!-- End Guide AI -->
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const priceRadios = document.querySelectorAll('input[name="price"]');
            const urlParams = new URLSearchParams(window.location.search);
            const sortParam = urlParams.get('sort');

            if (sortParam) {
                priceRadios.forEach(radio => {
                    if (radio.value === sortParam) {
                        radio.checked = true;
                    }
                });
            }

            priceRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    const selectedPrice = this.value;
                    const url = new URL(window.location.href);
                    url.searchParams.set('sort', selectedPrice);
                    window.location.href = url.toString();
                });
            });
        });
    </script>
@endsection
