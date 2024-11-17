<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="{{ asset('front-assets/img/logo/logo-stuck.svg') }}" rel="icon">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
	{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"> --}}
    {{-- <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css"> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> --}}
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css">
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>

    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@400;700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('front-assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/css/bootstrap.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('front-assets/css/testing.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('front-assets/css/btn.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('front-assets/css/glightbox.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
</head>

<style>
    .fa-chevron-up {
        font-size: 17px !important;
    }
    /* #searchInput {
        border: 2px solid #ffffff;
        border-radius: 8px;
        padding: 10px 13px;
        font-size: 16px;
        transition: all 0.3s ease-in-out; 
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    } */
    
    /* #searchInput:focus {
        background-color: #fff;
        border-color: #012970;
        outline: none; 
        box-shadow: 0 4px 6px rgba(65, 84, 241, 0.2);
    } */
    
    /* #searchInput::placeholder {
        color: #999;
    } */
    
    /* #searchInput:hover {
        border-color: #012970;
    } */
    .custom-input-group {
        position: relative;
        display: flex;
        align-items: center;
    }
    
    .custom-form-control {
        background-color: #f9f9f9;
        border-radius: 8px;
        padding: 10px 15px;
        font-size: 16px;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .custom-form-control:focus {
        background-color: #fff;
        border-color: #012970;
        outline: none;
        box-shadow: 0 4px 6px rgba(65, 84, 241, 0.2);
    }
    
    .custom-form-control::placeholder {
        color: #999; /* Light gray placeholder text */
    }
    
    .custom-form-control:hover {
        border-color: #888; /* Darker border on hover */
    }
    
    .custom-input-group-text {
        background-color: #FFF; /* Light background color */
        border-radius: 8px; /* Rounded corners */
        padding: 10px 15px; /* Padding for inner spacing */
        font-size: 16px; /* Font size */
        transition: all 0.3s ease-in-out;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-left: none;
        border-right: none;
    }
    
    .custom-input-group .custom-form-control:first-child {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }
    
    .custom-input-group .custom-form-control:last-child {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }
    
    #searchInput-adult {
        background-color: #f9f9f9;
        border-radius: 8px;
        padding: 10px 15px;
        font-size: 16px;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    #searchInput-adult:focus {
        background-color: #fff;
        border-color: #4154f1;
        outline: none;
        box-shadow: 0 4px 6px rgba(65, 84, 241, 0.2);
    }
    
    #searchInput-adult:hover {
        border-color: #888;
    }
    
    #searchInput-adult i {
        color: #666;
        font-size: 18px;
    }
    
    .dropdown-menu {
        min-width: 100%;
    }
    .card-mvp {
      background-color: rgba(247, 247, 247, 0.3);
      backdrop-filter: blur(10px);
      border: none;
    }
    .mvp-active.active {
      background-color: rgba(255, 255, 255, 0.3) !important;
      backdrop-filter: blur(10px) !important;
      border: none;
    }
    .dropdown-menu {
        display: none;
    }
    
    .dropdown-menu.show {
        display: block;
    }
    </style>

<body>

    @include('front.layouts.navbar')

    @yield('content')

    @include('front.layouts.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="fas fa-chevron-up"></i></a>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('front-assets/js/main.js') }}"></script>
    <script src="{{ asset('front-assets/js/swiper.bundle.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/isotope.pkgd.min.js') }}"></script>
     
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script> --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    @yield('script')

    <script>
    // Date Range Kendaraan
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
        $('input[id="tgl_mulai"], input[id="tgl_selesai"]').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear',
                format: 'DD/MM/YYYY'
            }
        });
        // Event listener untuk update input tgl_mulai dan tgl_selesai
        $('input[id="tgl_mulai"], input[id="tgl_selesai"]').on('apply.daterangepicker', function(ev, picker) {
            var startDate = formatDate(picker.startDate.format('YYYY-MM-DD'));
            var endDate = formatDate(picker.endDate.format('YYYY-MM-DD'));
            
            $('#tgl_mulai').val(startDate);
            $('#tgl_selesai').val(endDate);

            // Menghitung jumlah Hari
            var start = new Date(picker.startDate.format('YYYY-MM-DD'));
            var end = new Date(picker.endDate.format('YYYY-MM-DD'));
            var nights = Math.round((end - start) / (1000 * 60 * 60 * 24));
            $('.badge').text(nights + ' Hari');
        });
        // Event listener untuk clear input
        $('input[id="tgl_mulai"], input[id="tgl_selesai"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            $('.badge').text('0 Hari');
        });
    });

    // Date Range Homestay
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
        $('input[id="checkin"], input[id="checkout"]').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear',
                format: 'DD/MM/YYYY'
            }
        });
        // Event listener untuk update input checkin dan checkout
        $('input[id="checkin"], input[id="checkout"]').on('apply.daterangepicker', function(ev, picker) {
            var startDate = formatDate(picker.startDate.format('YYYY-MM-DD'));
            var endDate = formatDate(picker.endDate.format('YYYY-MM-DD'));
            
            $('#checkin').val(startDate);
            $('#checkout').val(endDate);

            // Menghitung jumlah malam
            var start = new Date(picker.startDate.format('YYYY-MM-DD'));
            var end = new Date(picker.endDate.format('YYYY-MM-DD'));
            var nights = Math.round((end - start) / (1000 * 60 * 60 * 24));
            $('.badge').text(nights + ' Malam');
        });
        // Event listener untuk clear input
        $('input[id="checkin"], input[id="checkout"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            $('.badge').text('0 Malam');
        });
    });

    // Date Range Perlengkapan
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
        $('input[id="tgl_pinjam"], input[id="tgl_pengembalian"]').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear',
                format: 'DD/MM/YYYY'
            }
        });
        // Event listener untuk update input tgl_pinjam dan tgl_pengembalian
        $('input[id="tgl_pinjam"], input[id="tgl_pengembalian"]').on('apply.daterangepicker', function(ev, picker) {
            var startDate = formatDate(picker.startDate.format('YYYY-MM-DD'));
            var endDate = formatDate(picker.endDate.format('YYYY-MM-DD'));
            
            $('#tgl_pinjam').val(startDate);
            $('#tgl_pengembalian').val(endDate);

            // Menghitung jumlah Hari
            var start = new Date(picker.startDate.format('YYYY-MM-DD'));
            var end = new Date(picker.endDate.format('YYYY-MM-DD'));
            var nights = Math.round((end - start) / (1000 * 60 * 60 * 24));
            $('.badge').text(nights + ' Hari');
        });
        // Event listener untuk clear input
        $('input[id="tgl_pinjam"], input[id="tgl_pengembalian"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            $('.badge').text('0 Hari');
        });
    });
    </script>

    </body>
</html>