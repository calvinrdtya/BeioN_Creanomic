<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="{{ asset('front-assets/img/logo/logo-stuck.svg') }}" rel="icon">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
	{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"> --}}
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css">
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>

    {{-- <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet"> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('front-assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/css/btn.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('front-assets/css/glightbox.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    {{-- <title>{{ $title }}</title> --}}
</head>
<body>

    @yield('content')

    @include('front.layouts.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="fas fa-chevron-up"></i></a>
    
    <script src="{{ asset('front-assets/js/main.js') }}"></script>
    <script src="{{ asset('front-assets/js/swiper.bundle.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/isotope.pkgd.min.js') }}"></script>
     
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>

    <script>
    //     $(function () {
    //     $.ajaxSetup({
    //         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    //     });
    //     $(function () {
    //         $('provinsi').on('change', function() {
    //             let id_provinsi = $('#provinsi').val();

    //             console.log(id_provinsi);
    //         })
    //     })
    // })

    $(document).ready(function() {
    var $range = $(".js-range-slider"),
        $inputFrom = $(".js-input-from"),
        $inputTo = $(".js-input-to"),
        instance,
        min = 0,
        max = 200000, // Maksimal Rp 10.000.000
        from = 0,
        to = 120000, // Awal dari Rp 7.500.000
        step = 20000; // Langkah per Rp 100.000

        $range.ionRangeSlider({
        type: "double",
        min: min,
        max: max,
        from: from,
        to: to,
        step: step,
        skin: "round", // Custom skin
        onStart: updateInputs,
        onChange: updateInputs,
        onFinish: updateInputs
    });

    instance = $range.data("ionRangeSlider");

    function updateInputs(data) {
        from = data.from;
        to = data.to;

        $inputFrom.prop("value", formatNumber(from));
        $inputTo.prop("value", formatNumber(to));
    }

    $inputFrom.on("input", function() {
        var val = parseInt($(this).prop("value").replace(/\./g, ''), 10);

        // Validate and fix value
        if (val < min) {
            val = min;
        } else if (val > to) {
            val = to;
        }

        instance.update({
            from: val
        });
    });

    $inputTo.on("input", function() {
        var val = parseInt($(this).prop("value").replace(/\./g, ''), 10);

        // Validate and fix value
        if (val < from) {
            val = from;
        } else if (val > max) {
            val = max;
        }

        instance.update({
            to: val
        });
    });

    function formatNumber(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
});

// Date Range Transportasi
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

        // Menghitung jumlah malam
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

        // Menghitung jumlah hari
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

// Pilih Jenis Transportasi
function selectDropdownKota(kota) {
    // Ambil elemen input kendaraan
    var pilihKotaInput = document.getElementById('idSearchKota');

    // Set nilai input dengan nilai item yang dipilih
    pilihKotaInput.value = kota;
}
function selectDropdownItem(item) {
    // Ambil elemen input kendaraan
    var jenisKendaraanInput = document.getElementById('jenisKendaraan');

    // Set nilai input dengan nilai item yang dipilih
    jenisKendaraanInput.value = item;
}

// Menangani check Mobil dan Motor
document.addEventListener('DOMContentLoaded', function() {
    const motorCheckbox = document.getElementById('motor');
    const mobilCheckbox = document.getElementById('mobil');
    const sopirCheckbox = document.getElementById('sopir');
    const lepasKunciCheckbox = document.getElementById('lepasKunci');
    const sopirCheckDiv = document.getElementById('sopirCheck');
    const lepasKunciCheckDiv = document.getElementById('lepasKunciCheck');

    // Hide sopir and lepas kunci checkboxes initially
    sopirCheckDiv.classList.add('d-none');
    lepasKunciCheckDiv.classList.add('d-none');

    // Event listener for motor checkbox
    motorCheckbox.addEventListener('change', function() {
        if (this.checked) {
            mobilCheckbox.checked = false;
            showHideDriverOptions();
        } else {
            sopirCheckDiv.classList.add('d-none');
            lepasKunciCheckDiv.classList.add('d-none');
        }
    });

    // Event listener for mobil checkbox
    mobilCheckbox.addEventListener('change', function() {
        if (this.checked) {
            motorCheckbox.checked = false;
            showHideDriverOptions();
        } else {
            sopirCheckDiv.classList.add('d-none');
            lepasKunciCheckDiv.classList.add('d-none');
        }
    });

    // Function to show/hide driver options
    function showHideDriverOptions() {
        if (mobilCheckbox.checked) {
            sopirCheckDiv.classList.remove('d-none');
            lepasKunciCheckDiv.classList.remove('d-none');
        } else {
            sopirCheckDiv.classList.add('d-none');
            lepasKunciCheckDiv.classList.add('d-none');
        }
    }

    // Event listener for sopir checkbox
    sopirCheckbox.addEventListener('change', function() {
        if (this.checked) {
            lepasKunciCheckbox.checked = false;
        }
    });

    // Event listener for lepas kunci checkbox
    lepasKunciCheckbox.addEventListener('change', function() {
        if (this.checked) {
            sopirCheckbox.checked = false;
        }
    });
});

    </script>


    </body>
</html>