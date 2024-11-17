<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>

    <title>{{ $title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    {{-- <link rel="icon" type="image/x-icon" href="https://i.ibb.co.com/Wybfh0B/logo.png" /> --}}
    <link href="https://i.ibb.co.com/Wybfh0B/logo.png" rel="icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet"/>

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('admin/css/theme-default.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('admin/css/demo.css') }}" class="template-customizer-core-css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/perfect-scrollbar.css') }}"/>
    <link rel="stylesheet" href="{{ asset('admin/css/apex-chart.css') }}"/>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

    <!-- Helpers -->
    <script src="{{ asset('admin/js/helper.js') }}"></script>
    <script src="{{ asset('admin/js/config.js') }}"></script>

    <script src="{{ asset('front/js/html5-qrcode.min.js') }}"></script>
</head>

    {{-- @include('admin.layouts.app') --}}

    @yield('content')


    <script src="{{ asset('admin/js/jquery.js') }}"></script>
    <script src="{{ asset('admin/js/popper.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admin/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin/js/menu.js') }}"></script>
    <script src="{{ asset('admin/js/apexchart.js') }}"></script>
    <script src="{{ asset('admin/js/main.js') }}"></script>
    <script src="{{ asset('admin/js/dashboard-analytics.js') }}"></script>
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script async defer src="https://buttons.github.io/buttons.js"></script>
        
    <script>
        $(document).ready(function() {
            $('#btnTambahItinerary').on('click', function() {
                // Clone form itinerary utama
                var clonedForm = $('.itinerary-form').first().clone();
                
                // Kosongkan nilai inputan clonedForm
                clonedForm.find('input, textarea').val('');

                // Append clonedForm ke itineraryContainer
                $('#itineraryContainer').append(clonedForm);
            });
        });
    </script>

    </body>
</html>
