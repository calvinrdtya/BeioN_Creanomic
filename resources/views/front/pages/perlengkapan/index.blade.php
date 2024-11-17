@extends('front.layouts.front-with-hero')

@section('title', $title)

@section('breadcrumb')
    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Beranda <i class="fa fa-chevron-right"></i></a></span>
        <span>Mitra <i class="fa fa-chevron-right"></i></span>
    </p>
    <h1 class="mb-0 bread">Temukan Mitra Terpercaya</h1>
@endsection

@section('content')
    <section class="ftco-section ftco-no-pb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="search-wrap-1 ftco-animate fadeInUp ftco-animated">
                        <form action="#" class="search-property-1 d-flex flex-column flex-md-row p-4">
                            <div class="flex-grow-0 flex-shrink-0">
                                <h5>Kota:</h5>
                            </div>
                            <div class="row no-gutters ml-md-4">
                                <div class="col-md-6 col-lg-4 d-flex">
                                    <div class="form-group py-1 border-0">
                                        <input class="form-group-input" type="checkbox" value="" id="checkAll">
                                        <label class="form-group-label font-weight-normal text-muted mb-0" for="checkAll">
                                            Semua
                                        </label>
                                    </div>
                                </div>

                                @forelse ($kotas as $kota)
                                    <div class="col-md-6 col-lg-4 d-flex">
                                        <div class="form-group py-1 border-0">
                                            <input class="form-group-input" type="checkbox" value="{{ $kota->kota }}"
                                                id="check{{ $kota->kota }}">
                                            <label class="form-group-label font-weight-normal text-muted mb-0"
                                                for="check{{ $kota->kota }}">
                                                {{ $kota->kota }}
                                            </label>
                                        </div>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pb">
        <div class="container">
            <div class="row">
                @forelse ($mitras as $mitra)
                    <div class="col-md-4 ftco-animate fadeInUp ftco-animated">
                        <div class="project-wrap hotel">
                            <a href="{{ route('user.perlengkapan.shop', $mitra->id) }}" class="img"
                                style="background-image: url({{ $mitra->logo_path }});">
                                <span class="price">Terverifikasi</span>
                            </a>
                            <div class="text p-4">
                                <p class="star mb-2">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </p>
                                <h3><a href="{{ route('user.perlengkapan.shop', $mitra->id) }}">{{ $mitra->name }}</a></h3>
                                <p class="location mb-0"><span class="fa fa-map-marker"></span> {{ $mitra->kota }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col ftco-animate fadeInUp ftco-animated">
                        <p class="text-center mb-0">
                            Tidak ada mitra
                        </p>
                    </div>
                @endforelse
            </div>
            <div class="row mt-5">
                <div class="col text-center">
                    <div class="d-flex justify-content-center">
                        {{ $mitras->appends(['kota' => $filterKota, 'category' => $filterCategory])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkAll = document.getElementById('checkAll');
            const checkboxes = document.querySelectorAll('input[type="checkbox"]:not(#checkAll)');

            const urlParams = new URLSearchParams(window.location.search);
            const selected = urlParams.get('kota');

            if (selected) {
                const selectedValues = selected.split(',');

                if (selectedValues.includes('Semua')) {
                    checkAll.checked = true;
                } else {
                    checkboxes.forEach(checkbox => {
                        if (selectedValues.includes(checkbox.value)) {
                            checkbox.checked = true;
                        }
                    });
                }
            }

            checkAll.addEventListener('change', function() {
                if (checkAll.checked) {
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = false;
                    });
                    window.location.href = `${window.location.pathname}?kota=Semua`;
                } else {
                    window.location.href = window.location.pathname;
                }
            });

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const selectedValues = [];

                    if (checkAll.checked) {
                        checkAll.checked = false;
                    }

                    checkboxes.forEach(cb => {
                        if (cb.checked && cb.value !== '') {
                            selectedValues.push(cb.value);
                        }
                    });

                    if (selectedValues.length > 0) {
                        window.location.href =
                            `${window.location.pathname}?kota=${selectedValues.join(',')}`;
                    } else {
                        window.location.href = window.location.pathname;
                    }
                });
            });
        });
    </script>

@endsection
