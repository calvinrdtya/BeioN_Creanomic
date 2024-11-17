@extends('front.layouts.front-no-sidebar')

@section('title', $title)

@section('breadcrumb')
    <p class="breadcrumbs">
        <span class="mr-2"><a href="index.html">Beranda <i class="fa fa-chevron-right"></i></a></span>
        <span class="mr-2"><a href="{{ route('front.ecotourism') }}">Ecotourism <i
                    class="fa fa-chevron-right"></i></a></span>
        <span>@yield('title')</span>
    </p>
@endsection

@section('content')
    <div>
        <div class="heading-section ftco-animate d-flex align-items-center fadeInUp ftco-animated mb-4">
            <div class="w-100 d-flex align-items-center justify-content-between">
                <div>
                    <h2>@yield('title')</h2>
                </div>
                <div>
                    <select id="method-select" class="form-control form-control-sm">
                        <option value="drop-off">Drop-off</option>
                        <option value="pickup">Pickup</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="mb-3">
            @forelse ($historyCategories as $category)
                <a href="?category={{ $category['category'] }}"
                    class="btn btn-sm @if ($category['active']) btn-primary @else btn-light @endif rounded-pill mr-2 mb-2">
                    {{ $category['title'] }} ({{ $category['count'] }})
                </a>
            @empty
            @endforelse
        </div>

        <div class="row">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <div class="card card-body pb-0">
                    <div id="card-trash"
                        class="d-flex justify-content-between align-items-center mb-3 pb-3 mb-lg-4 pb-lg-4 border-bottom">
                        <div>
                            <h4 class="font-weight-bold mb-1">Botol Minum</h4>
                            <p class="mb-0">Berat: <span class="text-dark">100 gram</span></p>
                        </div>
                        <div>
                            <h4 class="font-weight-bold mb-0">Rp. 10.000</h4>
                        </div>
                    </div>
                    <div id="card-trash"
                        class="d-flex justify-content-between align-items-center mb-3 pb-3 mb-lg-4 pb-lg-4 border-bottom">
                        <div>
                            <h4 class="font-weight-bold mb-1">Botol Minum</h4>
                            <p class="mb-0">Berat: <span class="text-dark">100 gram</span></p>
                        </div>
                        <div>
                            <h4 class="font-weight-bold mb-0">Rp. 10.000</h4>
                        </div>
                    </div>
                    <div id="card-trash"
                        class="d-flex justify-content-between align-items-center mb-3 pb-3 mb-lg-4 pb-lg-4 border-bottom">
                        <div>
                            <h4 class="font-weight-bold mb-1">Botol Minum</h4>
                            <p class="mb-0">Berat: <span class="text-dark">100 gram</span></p>
                        </div>
                        <div>
                            <h4 class="font-weight-bold mb-0">Rp. 10.000</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card card-body">
                    <h4 class="font-weight-bold mb-4">Total Keseluruhan</h2>

                        <div>
                            <div class="d-flex justify-content-between my-2">
                                <h6 class="font-weight-normal text-muted">Total Penjualan</h6>
                                <h6 class="text-dark">Rp. 10,000</h6>
                            </div>
                            <div class="d-flex justify-content-between my-2">
                                <h6 class="font-weight-normal text-muted">Biaya Layanan</h6>
                                <h6 class="text-dark">Rp. 1,000</h6>
                            </div>
                            <div class="d-flex justify-content-between my-2 pt-3 border-top">
                                <h5 class="font-weight-normal">Total</h5>
                                <h5>Rp. 11,000</h5>
                            </div>
                            <button class="w-100 btn btn-sm btn-primary">Cetak Struk</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        #card-trash:last-child {
            border-bottom: 0 !important;
            margin-bottom: 0 !important;
        }
    </style>
@endsection

@section('js')
    <script>
        function getQueryParameter(param) {
            var urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        function updateQueryStringParameterAndReload(key, value) {
            var url = new URL(window.location.href);
            url.searchParams.set(key, value);
            window.location.href = url.toString();
        }

        var method = getQueryParameter('method');
        var category = getQueryParameter('category');

        if (method) {
            document.getElementById('method-select').value = method;
        }

        document.getElementById('method-select').addEventListener('change', function() {
            var selectedMethod = this.value;
            updateQueryStringParameterAndReload('method', selectedMethod);
        });

        document.querySelectorAll('a[href^="?category"]').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                var selectedCategory = this.getAttribute('href').split('=')[1];
                updateQueryStringParameterAndReload('category', selectedCategory);
            });
        });
    </script>
@endsection
