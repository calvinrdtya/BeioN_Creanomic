@extends('front.layouts.app')

@section('content')

{{-- <style>
    .full-height {
        min-height: 100vh; /* Take at least full viewport height */
    }
    .card {
        display: flex;
        flex-direction: column;
    }
    .card-body {
        flex: 1; /* Make card-body take up the remaining space */
        overflow-y: auto; /* Add scrolling if content overflows */
    }
</style> --}}

<section class="py-5 full-height">
    <div class="container py-5 h-100">
        <div class="row h-100">
            <div class="col-md-4 d-flex">
                <div class="card p-2 w-100 h-100">
                    <div class="card-body">
                        <p>Hari Ini</p>
                        <div class="d-flex">
                            <i class="far fa-comment mt-2 me-2" style="color: #777777"></i>
                            <p>buatkan saya percakapan untuk menawar tas dalam bahasa jawa</p>
                        </div>
                        <div class="d-flex">
                            <i class="far fa-comment mt-2 me-2" style="color: #777777"></i>
                            <p>pantangan pendakian ke kawah ijen</p>
                        </div>
                        <div class="d-flex">
                            <i class="far fa-comment mt-2 me-2" style="color: #777777"></i>
                            <p>berikan rekomendasi tempat wisata di malang</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 d-flex flex-column">
                <div class="card p-1 w-100 h-100 d-flex flex-column border-0">
                    <div class="card-body d-flex flex-column flex-grow-1 border-0">
                        <div id="chat-response" class="border p-3 overflow-auto mb-3 border-0" style="flex-grow: 1;"></div>
                        {{-- <div class="row">
                            <div class="col-md-6">
                                <div class="card p-3">
                                    <p>Curabitur vehicula nulla non nisi sollicitudin, vel iaculis risus consectetur.</p>   
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card p-3"></div>
                            </div>
                        </div> --}}
                        <form id="chat-form" class="mt-3">
                            <div class="d-flex align-items-center">
                                <input type="text" class="form-control me-2 nav-group-mvp" id="message" name="message" placeholder="Tanya" required>
                                <button type="submit" class="btn btn-primary">
                                    <i class="far fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#chat-form').on('submit', function(event) {
            event.preventDefault();
            
            let message = $('#message').val();
            
            $.ajax({
                url: "{{ route('user.chat') }}", // Sesuaikan dengan rute Anda
                type: 'POST',
                data: {
                    message: message,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    typeWriterEffect(response.message);
                },
                error: function(xhr, status, error) {
                    typeWriterEffect('Something went wrong. Please try again.');
                }
            });
        });
    
        function typeWriterEffect(text) {
            let i = 0;
            let speed = 10; // Kecepatan mengetik dalam milidetik
            
            // Menghilangkan format Markdown
            text = text.replace(/\*\*(.*?)\*\*/g, '$1'); // Menghapus teks tebal (bold) yang dikelilingi oleh **
    
            $('#chat-response').html(''); // Mengosongkan kontainer respons sebelum mengetik
    
            function typeWriter() {
                if (i < text.length) {
                    $('#chat-response').append(text.charAt(i));
                    
                    if (text.charAt(i) === '\n') {
                        // Menambahkan elemen br jika karakter adalah newline
                        $('#chat-response').append('<br>');
                    }
                    
                    i++;
                    setTimeout(typeWriter, speed);
                }
            }
            
            typeWriter();
        }
    });
    </script>
    

  


{{-- <style>
    .response-container {
        max-height: calc(100vh - 200px); /* Atur tinggi maksimal kontainer respons */
        overflow-y: auto;  /* Tambahkan scroll vertikal jika konten lebih tinggi dari kontainer */
        margin-bottom: 80px; /* Beri ruang untuk form input di bawah */
    }

    .fixed-bottom-form {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 10px;
        background: #f8f9fa;
        box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
    }
</style> --}}

{{-- <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="" class="app-brand-link">
                    <span class="app-brand-text demo menu-text fw-bolder ms-2"></span>
                </a>
                <a href="" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
            </div>
            <div class="menu-inner-shadow"></div>
            <ul class="menu-inner py-1">
                <!-- Dashboard -->
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Terbaru</span>
                </li>
                <li class="menu-item active">
                    <a href="" class="menu-link">
                        <i class='menu-icon bx bx-chat'></i>
                        <div data-i18n="Analytics">Artikel</div>
                    </a>
                </li>
            </ul>
        </aside>
        <div class="layout-page">
            <div class="content-wrapper">
                <div class="container my-2">
                    <div class="card p-3">
                        <h1></h1>
                        <div id="chat-response" class="response-container border p-3 mb-3"></div>
                        <form id="chat-form" class="d-flex">
                            <input type="text" class="form-control me-2" id="message" name="message" required>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

{{-- <script>
$(document).ready(function() {
    $('#chat-form').on('submit', function(event) {
        event.preventDefault();
        
        let message = $('#message').val();
        
        $.ajax({
            url: "{{ route('user.chat') }}", // Sesuaikan dengan rute Anda
            type: 'POST',
            data: {
                message: message,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                typeWriterEffect(response.message);
            },
            error: function(xhr, status, error) {
                typeWriterEffect('Something went wrong. Please try again.');
            }
        });
    });

    function typeWriterEffect(text) {
        let i = 0;
        let speed = 40; // Kecepatan mengetik dalam milidetik
        $('#chat-response').html('<ul></ul>'); // Mengosongkan kontainer respons sebelum mengetik

        function typeWriter() {
            if (i < text.length) {
                // Menambahkan karakter berikutnya ke item daftar terakhir
                let currentHTML = $('#chat-response ul li:last').html() || '';
                $('#chat-response ul li:last').html(currentHTML + text.charAt(i));
                
                if (text.charAt(i) === '\n') {
                    // Menambahkan item daftar baru jika karakter adalah newline
                    $('#chat-response ul').append('<li></li>');
                }
                
                i++;
                setTimeout(typeWriter, speed);
            }
        }
        
        // Memulai dengan item daftar pertama
        $('#chat-response ul').append('<li></li>');
        typeWriter();
    }
});
</script> --}}



{{-- <style>
    .response-container {
        max-height: calc(100vh - 200px); /* Atur tinggi maksimal kontainer respons */
        overflow-y: auto;  /* Tambahkan scroll vertikal jika konten lebih tinggi dari kontainer */
        margin-bottom: 80px; /* Beri ruang untuk form input di bawah */
    }

    .fixed-bottom-form {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 10px;
        background: #f8f9fa;
        box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
    }
</style> --}}

{{-- <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="" class="app-brand-link">
                    <span class="app-brand-text demo menu-text fw-bolder ms-2"></span>
                </a>
                <a href="" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
            </div>
            <div class="menu-inner-shadow"></div>
            <ul class="menu-inner py-1">
                <!-- Dashboard -->
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Terbaru</span>
                </li>
                <li class="menu-item active">
                    <a href="" class="menu-link">
                        <i class='menu-icon bx bx-chat'></i>
                        <div data-i18n="Analytics">Artikel</div>
                    </a>
                </li>
            </ul>
        </aside>
        <div class="layout-page">
            <div class="content-wrapper">
                <div class="container my-2">
                    <div class="card p-3">
                        <h1></h1>
                        <div id="chat-response" class="response-container border p-3 mb-3"></div>
                        <form id="chat-form" class="d-flex">
                            <input type="text" class="form-control me-2" id="message" name="message" required>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

{{-- <script>
$(document).ready(function() {
    $('#chat-form').on('submit', function(event) {
        event.preventDefault();
        
        let message = $('#message').val();
        
        $.ajax({
            url: "{{ route('user.chat') }}", // Sesuaikan dengan rute Anda
            type: 'POST',
            data: {
                message: message,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                typeWriterEffect(response.message);
            },
            error: function(xhr, status, error) {
                typeWriterEffect('Something went wrong. Please try again.');
            }
        });
    });

    function typeWriterEffect(text) {
        let i = 0;
        let speed = 40; // Kecepatan mengetik dalam milidetik
        $('#chat-response').html('<ul></ul>'); // Mengosongkan kontainer respons sebelum mengetik

        function typeWriter() {
            if (i < text.length) {
                // Menambahkan karakter berikutnya ke item daftar terakhir
                let currentHTML = $('#chat-response ul li:last').html() || '';
                $('#chat-response ul li:last').html(currentHTML + text.charAt(i));
                
                if (text.charAt(i) === '\n') {
                    // Menambahkan item daftar baru jika karakter adalah newline
                    $('#chat-response ul').append('<li></li>');
                }
                
                i++;
                setTimeout(typeWriter, speed);
            }
        }
        
        // Memulai dengan item daftar pertama
        $('#chat-response ul').append('<li></li>');
        typeWriter();
    }
});
</script> --}}
@endsection


