@extends('front.layouts.app')

@section('content')

<style>
    .image-sidebar {
        width: 80px !important;
        height: 60px !important;
        object-fit: cover !important;
    }
</style>

<!-- main -->
<main id="main">

    <section class="artikel">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 entries">
                    <article class="entry entry-single">
                        <div class="entry-img">
                            @if ($artikel->thumbnails)
                                <img src="{{ asset($artikel->thumbnails) }}" alt="Artikel Image" class="img-fluid">
                            @else
                                <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Artikel Default Image" class="img-fluid">
                            @endif
                        </div>
                        <h2 class="entry-title">
                            <a href="{{ route('front.artikel.show', ['id' => $artikel->id]) }}">{{ $artikel->title }}</a>
                        </h2>
                        <div class="entry-meta">
                            <ul>
                                <li class="d-flex align-items-center"><img src="{{ asset('front-assets/img/logo/logo-stuck.svg') }}" alt="Logo" width="20" class="me-1"><a href="#">BeioN</a></li>
                                <li class="d-flex align-items-center"><i class="far fa-clock" style="color: #777777;"></i><a href="#">{{ $artikel->time_ago }}</a></li>
                                {{-- <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="{{ route('front.artikel.show', ['id' => $artikel->id]) }}">12 Comments</a></li> --}}
                            </ul>
                        </div>
                        <div class="entry-content">
                            <p class="text-reset">{{ $artikel->deskripsi }}</p>
                        </div>
                        <div class="entry-footer">
                            <ul class="cats">
                                <li class="text-capitalize"><i class="fas fa-hashtag me-2" style="color: #777777;"></i>{{ $artikel->tag }}</li>
                            </ul>
                        </div>
                    </article>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar">
                        <h3 class="sidebar-title">Kategori</h3>
                        <div class="sidebar-item categories">
                            <ul>
                                @foreach($categoriesAdmin as $category)
                                <li>
                                    <a href="#">{{ $category->name }}<span>({{ $category->artikels_count }})</span></a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    <h3 class="sidebar-title">Artikel Terbaru</h3>
                    <div class="sidebar-item recent-posts">
                        @foreach (\App\Models\Artikel::all() as $sidebarArtikel)
                                @if ($sidebarArtikel->id !== $artikel->id)
                                    <div class="post-item clearfix">
                                        @if ($sidebarArtikel->thumbnails)
                                            <img src="{{ asset($sidebarArtikel->thumbnails) }}" alt="image artikel terbaru" class="image-sidebar">
                                        @else
                                            <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="image artikel terbaru">
                                        @endif
                                        <h4 class="artikel-title"><a href="{{ route('front.artikel.show', ['id' => $artikel->id]) }}">{{ $sidebarArtikel->title }}</a></h4>
                                        <time datetime="{{ $sidebarArtikel->created_at->format('Y-m-d') }}" class="mt-0">{{ $artikel->time_ago }}</time>
                                    </div>
                                @endif
                        @endforeach
                    </div>
                    <h3 class="sidebar-title">Tag</h3>
                        <div class="sidebar-item tags">
                            @if(!empty($uniqueTags))
                                <ul>
                                    @foreach($uniqueTags as $tag)
                                        <li class="text-capitalize"><a href="">{{ $tag }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<!-- End #main -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil semua elemen deskripsi
        var descriptionElements = document.querySelectorAll('.artikel-title');
        var maxLength = 40;

        descriptionElements.forEach(function(descriptionElement) {
        var fullText = descriptionElement.textContent;

        if (fullText.length > maxLength) {
            // Potong teks dan tambahkan titik-titik
            var truncatedText = fullText.substring(0, maxLength) + '...';
            descriptionElement.textContent = truncatedText;
            }
        });
    });
</script>

@endsection
