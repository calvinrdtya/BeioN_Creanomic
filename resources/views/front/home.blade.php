<!DOCTYPE html>
<html lang="en">

<head>
    <title>Beion</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Arizonia&display=swap" rel="stylesheet">

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css">
    <link rel="stylesheet" href="{{ asset('front/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('front/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('front/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/jquery.timepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('front/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">

    <style>
        @keyframes shimmer {
            0% {
                background-position: -150% 0;
            }

            100% {
                background-position: 150% 0;
            }
        }

        .preload {
            background: #f6f7f8;
            background-image: linear-gradient(to right, #e3e3e3 0%, #cecece 20%, #f6f7f8 40%, #f6f7f8 100%);
            background-repeat: no-repeat;
            background-size: 1000px 100%;
            display: inline-block;
            position: relative;
            overflow: hidden;
            animation: shimmer 1.7s infinite linear;
        }
    </style>

</head>

<body>
    @include('front.partials.navbar')

    <!-- Start Hero -->
    <div class="hero-wrap js-fullheight" style="background-image: url('front/images/bg_1.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
                <div class="col-md-7">
                    <h1 class="">Be Yourself Trust <br> Beion</h1>
                    <p class="caps mb-0">Lorem ipsum dolor sit </p>
                </div>
                <!-- <a href="https://vimeo.com/45830194" class="icon-video popup-vimeo d-flex align-items-center justify-content-center mb-4">
     <span class="fa fa-play"></span>
    </a> -->
            </div>
        </div>
    </div>
    <!-- End Hero -->

    <!-- Start MVP -->
    <section class="ftco-section ftco-no-pt pb-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="ftco-search d-flex justify-content-center">
                        <div class="row ftco-search-card">
                            <div class="col-md-12 nav-link-wrap">
                                <div class="nav nav-pills text-center" id="v-pills-tab" role="tablist">
                                    <a class="nav-link active mr-md-1" id="v-tab-perlengkapan" data-toggle="pill"
                                        href="#v-perlengkapan" role="tab" aria-controls="v-perlengkapan"
                                        aria-selected="true">Perlengkapan</a>
                                    <a class="nav-link" id="v-tab-perjalanan" data-toggle="pill" href="#v-perjalanan"
                                        role="tab" aria-controls="v-perjalanan" aria-selected="false">Perjalanan</a>
                                </div>
                            </div>
                            <div class="col-md-12 tab-wrap">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-perlengkapan" role="tabpanel"
                                        aria-labelledby="v-pills-nextgen-tab">
                                        <form action="{{ route('perlengkapan') }}" method="get"
                                            class="search-property-1">
                                            <div class="row no-gutters">
                                                <div class="col-md d-flex">
                                                    <div class="form-group p-3 mb-0">
                                                        <div class="p-2 ml-2">
                                                            <label for="#">Pilih Kota</label>
                                                            <div class="form-field">
                                                                <div class="select-wrap">
                                                                    <div class="icon"><span
                                                                            class="fa fa-chevron-down"></span></div>
                                                                    <select name="kota" id=""
                                                                        class="form-control">
                                                                        @forelse ($dataKota  as $kota)
                                                                            <option value="{{ $kota }}">
                                                                                {{ $kota }}</option>
                                                                        @empty
                                                                            <option value="" selected disabled>
                                                                                Tidak Ada</option>
                                                                        @endforelse
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md d-flex">
                                                    <div class="form-group p-3 mb-0">
                                                        <div class="p-2 ml-2">
                                                            <div class="form-field">
                                                                <label for="#">Pilih Aktivitas</label>
                                                                <div class="select-wrap">
                                                                    <div class="icon"><span
                                                                            class="fa fa-chevron-down"></span></div>
                                                                    <select name="category" id=""
                                                                        class="form-control">
                                                                        @forelse ($categories as $category)
                                                                            <option value="{{ $category->id }}">
                                                                                {{ $category->name }}</option>
                                                                        @empty
                                                                            <option value="" selected disabled>
                                                                                Tidak Ada</option>
                                                                        @endforelse
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg d-flex">
                                                    <div
                                                        class="form-group d-flex justify-content-center align-items-center border-0 mb-0">
                                                        <div class="form-field align-items-center d-flex">
                                                            <input type="submit" value="Cari"
                                                                class="align-self-stretch form-control btn btn-primary p-0">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="v-perjalanan" role="tabpanel"
                                        aria-labelledby="v-pills-performance-tab">
                                        <form action="#" class="search-property-1">
                                            <div class="row no-gutters">
                                                <div class="col-lg d-flex">
                                                    <div class="form-group p-4 mb-0">
                                                        <label for="#">Pilih Kota</label>
                                                        <div class="form-field">
                                                            <div class="select-wrap">
                                                                <div class="icon"><span
                                                                        class="fa fa-chevron-down"></span></div>
                                                                <select name="" id=""
                                                                    class="form-control">
                                                                    <option value="">Surabaya</option>
                                                                    <option value="">Malang</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg d-flex">
                                                    <div class="form-group p-4 mb-0">
                                                        <label for="#">Aktivitas</label>
                                                        <div class="form-field">
                                                            <div class="select-wrap">
                                                                <div class="icon"><span
                                                                        class="fa fa-chevron-down"></span></div>
                                                                <select name="" id=""
                                                                    class="form-control">
                                                                    <option value="">Pendakian</option>
                                                                    <option value="">Camping</option>
                                                                    <option value="">Rafting</option>
                                                                    <option value="">Snorkeling</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md d-flex">
                                                    <div class="form-group p-4 mb-0">
                                                        <label for="#">Tanggal</label>
                                                        <div class="form-field">
                                                            <div class="icon"><span class="fa fa-calendar"></span>
                                                            </div>
                                                            <input type="text" class="form-control checkin_date"
                                                                placeholder="Pilih tanggal">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg d-flex">
                                                    <div
                                                        class="form-group d-flex justify-content-center align-items-center border-0 mb-0">
                                                        <div class="form-field align-items-center d-flex">
                                                            <input type="submit" value="Cari"
                                                                class="align-self-stretch form-control btn btn-primary p-0">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End MVP -->

    <!-- Guide AI -->
    <section class="ftco-intro ftco-section ftco-no-pt">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <div class="img" style="background-image: url(front/images/bg_2.jpg);">
                        <div class="overlay"></div>
                        <h2>Guide AI</h2>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quos similique nulla iure harum,
                            odio perferendis veritatis illum sunt natus autem et accusantium culpa rem officia mollitia
                            unde praesentium! Laborum, unde!</p>
                        <p class="mb-0"><a href="#" class="btn btn-primary px-3 py-3 border-0">Ajukan
                                Pertanyaan</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Guide AI -->

    <!-- Fitur -->
    <section class="ftco-section services-section">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-6 order-md-last heading-section pl-md-5 d-flex align-items-center">
                    <div class="w-100">
                        <h4 class="mb-4">Liburan Tanpa Batas Bersama <br> BeioN!</h4>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 col-lg-6 d-flex align-self-stretch">
                            <div class="services services-1 color-2 d-block img"
                                style="background-image: url(front/images/services-2.jpg);">
                                <div class="icon d-flex align-items-center justify-content-center"><span
                                        class="flaticon-route"></span></div>
                                <div class="media-body">
                                    <h3 class="heading mb-3">Paket Wisata</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 d-flex align-self-stretch">
                            <div class="services services-1 color-1 d-block img"
                                style="background-image: url(front/images/services-1.jpg);">
                                <div class="icon d-flex align-items-center justify-content-center"><span
                                        class="flaticon-paragliding"></span></div>
                                <div class="media-body">
                                    <h3 class="heading mb-3">Perlengkapan</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Fitur -->

    <!-- Kota -->
    <section class="ftco-section img ftco-select-destination pb-0">
        <div class="container">
            <div class="row justify-content-center pb-4">
                <div class="col-md-12 heading-section text-center">
                    <h4 class="mb-4">Kota Dengan Favorit Destinasi</h4>
                </div>
            </div>
        </div>
        <div class="container ">
            <div class="row">
                <div class="col-md-12">
                    <div class="carousel-destination owl-carousel">
                        @forelse ($kotas as $kota)
                            <div class="item">
                                <div class="project-destination">
                                    <a href="#" class="img"
                                        style="background-image: url(front/images/place-1.jpg);">
                                        <div class="text">
                                            <h3>{{ $kota }}</h3>
                                            <span>20 Destinasi</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Kota -->

    <!-- Paket Wisata Perjalanan -->
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center pb-4">
                <div class="col-md-12 heading-section">
                    <h4 class="mb-4">Destinasi seru pengalaman baru</h4>
                </div>
            </div>
            <div class="row" id="content-perjalanan" style="display: none; opacity: 0; transition: opacity 0.5s;">
                <div class="col-md-3">
                    <div class="project-wrap">
                        <a href="#" class="img"
                            style="background-image: url(front/images/destination-12.jpg);">
                            <span class="price">Rp. 500.000</span>
                        </a>
                        <div class="text p-4">
                            <ul>
                                <li>
                                    <span class="fa fa-star m-0"></span>
                                    <span class="fa fa-star m-0"></span>
                                    <span class="fa fa-star m-0"></span>
                                    <span class="fa fa-star m-0"></span>
                                    <span class="fa fa-star m-0"></span>
                                    (95)
                                </li>
                            </ul>
                            <h3><a href="#">Gunung Bromo</a></h3>
                            <span class="days">2 Hari 1 Malam</span>
                            <p class="location mb-0"><i class="fas fa-map-marker-alt"></i> Pasuruan, Jawa Timur</p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="loader-perjalanan" style="display: flex;">
                <div class="col-md-3">
                    <div class="project-wrap" style="overflow: hidden;">
                        <a href="#" class="preload skeleton-img w-auto"
                            style="background-color: #e0e0e0; height: 250px !important; width: 100% !important; display: block; border-radius: 10px; animation: shimmer 1.5s infinite;">
                            <!-- <span class="preload skeleton-price" style="display: block; height: 20px; width: 40%; background-color: #f6f7f8; margin: 10px auto; border-radius: 4px; animation: shimmer 1.5s infinite;"></span> -->
                        </a>
                        <div class="text p-4" style="background: #f6f7f8; border-radius: 4px;">
                            <ul style="padding: 0; list-style: none;">
                                <li>
                                    <span class="preload skeleton-star"
                                        style="display: inline-block; width: 18px; height: 8px; background-color: #e3e3e3; margin-right: 5px; border-radius: 3px; animation: shimmer 1.5s infinite;"></span>
                                </li>
                            </ul>
                            <h3 class="preload skeleton-title"
                                style="height: 20px; width: 100%; background-color: #e3e3e3; margin: 9px 0; border-radius: 4px; animation: shimmer 1.5s infinite;">
                            </h3>
                            <span class="preload skeleton-day"
                                style="height: 8px; width: 60%; background-color: #e3e3e3; display: block; margin: 9px 0; border-radius: 4px; animation: shimmer 1.5s infinite;"></span>
                            <p class="preload skeleton-location mb-0"
                                style="height: 8px; width: 100%; background-color: #e3e3e3; display: block; margin: 9px 0; border-radius: 4px; animation: shimmer 1.5s infinite;">
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Paket Wisata Perjalanan -->

    <!-- Section -->
    <section class="ftco-section ftco-about img" style="background-image: url(front/images/bg_1.jpg);">
        <div class="overlay"></div>
        <div class="container py-md-5">
            <div class="row py-md-5">
                <div class="col-md d-flex align-items-center justify-content-center">
                    <!-- <a href="https://vimeo.com/45830194" class="icon-video popup-vimeo d-flex align-items-center justify-content-center mb-4">
      <span class="fa fa-play"></span>
     </a> -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Section -->

    <!-- Section Perlengkapan -->
    <section class="ftco-section ftco-about ftco-no-pt img">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-12 about-intro">
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-stretch">
                            <div class="img d-flex w-100 align-items-center justify-content-center"
                                style="background-image:url(front/images/about-1.jpg);">
                            </div>
                        </div>
                        <div class="col-md-6 pl-md-5 py-5">
                            <div class="row justify-content-start pb-3">
                                <div class="col-md-12 heading-section">
                                    <h4 class="mb-4">Liburan jadi lebih mudah dengan perlengkapan dari BeioN</h4>
                                    <p><a href="#" class="btn btn-primary border-0">Sewa Sekarang</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section Perlengkapan -->

    <!-- Perlengkapan -->
    <section class="ftco-section py-0">
        <div class="container">
            <div class="row justify-content-center pb-4">
                <div class="col-md-12 heading-section">
                    <!-- <span class="subheading">Destination</span> -->
                    <h4 class="mb-2">Perlengkapan</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="project-wrap">
                        <a href="#" class="img"
                            style="background-image: url(front/images/destination-12.jpg);">
                            <span class="price">Rp. 500.000</span>
                        </a>
                        <div class="text p-4">
                            <h3><a href="#">Kompor Nesting</a></h3>
                            <p class="mb-0" style="margin-right: 3px !important;"><i
                                    class="fas fa-map-marker-alt"></i> Surabaya</p>
                            <!-- <hr> -->
                            <!-- <ul class="align-items-center">
        <li class="d-flex align-items-center">
         <img src="./images/logo-stuck.svg" alt="" width="25" class="mr-2">
         <span class="text-reset">Beion Outdoor</span>
        </li>
       </ul> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Perlengkapan -->

    <!-- Artikel -->
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center pb-4">
                <div class="col-md-12 heading-section text-center">
                    <!-- <span class="subheading">Our Blog</span> -->
                    <h4 class="">Artikel</h4>
                    <p>Artikel Terbaru Untuk Anda</p>
                </div>
            </div>
            <div class="row d-flex">
                @forelse ($artikels as $artikel)
                    <div class="col-md-3 col-12 d-flex justify-content-center">
                        <div class="blog-entry justify-content-end">
                            <a href="blog-single.html" class="block-20"
                                style="background-image: url('front/images/image_1.jpg');">
                            </a>
                            <div class="text">
                                <h3 class="heading"><a href="#">{{ $artikel->title }}</a></h3>
                                <ul class="align-items-center">
                                    <li><img src="front-assets/img/logo/logo-stuck.svg" alt="" width="25"
                                            class="mb-1"> BeioN</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </section>
    <!-- End Artikel -->

    @include('front.partials.footer')

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen">
        <svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#4154f1" />
        </svg>
    </div>

    <!-- Back To Top -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="fas fa-chevron-up" style="color: #fff;"></i></a>

    <script src="{{ asset('front/js/jquery.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('front/js/popper.min.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('front/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('front/js/scrollax.min.js') }}"></script>
    <script src="{{ asset('front/js/google-map.js') }}"></script>
    <script src="{{ asset('front/js/main.js') }}"></script>

    <script>
        function handleLoader(loaderId, contentId) {
            var loader = document.querySelector(loaderId);
            var content = document.querySelector(contentId);

            if (loader && content) {
                loader.style.display = 'flex'; // Pastikan loader ditampilkan saat memulai
                content.style.display = 'none'; // Sembunyikan konten asli

                setTimeout(function() {
                    loader.style.display = 'none'; // Sembunyikan loader setelah waktu yang ditentukan
                    content.style.display = 'flex'; // Tampilkan konten asli
                    content.style.opacity = '1'; // Tambahkan efek transisi pada konten
                }, 1000); // Waktu 1000ms bisa disesuaikan
            } else {
                console.error(`Error: Loader dengan ID ${loaderId} atau konten dengan ID ${contentId} tidak ditemukan`);
            }
        }

        window.onload = function() {
            handleLoader('#loader-perjalanan', '#content-perjalanan');
        };
    </script>

</body>

</html>
