@extends('front.layouts.app')

@section('content')

<style>
  .fixed-size {
    width: 360px !important;
    height: 230px !important;
    object-fit: cover !important;
  }

  .image-sidebar {
    width: 80px !important;
    height: 60px !important;
    object-fit: cover !important;
  }
</style>

<!-- main -->
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    {{-- <section class="breadcrumbs">
        <div class="container">
            <ol class="all">
                <li><a href="{{ route('front.home') }}" class="title3">Home</a></li>
                <li class="title2">Artikel</li>
            </ol>
        </div>
    </section> --}}
    <!-- End Breadcrumbs -->

    <section class="artikel">
        <div class="container">
          <div class="row gy-3">
            <div class="col-lg-8 col-md-8 entries">
              <div class="row g-4">
                @php
                  $artikels = \App\Models\Artikel::orderBy('created_at', 'desc')->take(10)->get();
                @endphp
                @foreach ($artikels as $artikel)
                  <div class="col-lg-6 col-md-6">
                    <a href="{{ route('front.artikel.show', ['id' => $artikel->id]) }}">
                      <article class="entry">
                        <div class="entry-img">
                          @if ($artikel->thumbnails)
                            <img src="{{ asset($artikel->thumbnails) }}" alt="Artikel Image" class="img-fluid fixed-size">
                          @else
                            <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Artikel Default Image" class="img-fluid">
                          @endif
                        </div>
                          <h2 class="entry-title">
                            <a href="{{ route('front.artikel.show', ['id' => $artikel->id]) }}" class="artikel-title">{{ $artikel->title }}</a>
                          </h2>
                        <div class="entry-meta">
                          <ul>
                            <li class="d-flex align-items-center"><img src="{{ asset('front-assets/img/logo/logo-stuck.svg') }}" alt="Logo" width="20" class="me-1"><a href="{{ route('front.artikel.show', ['id' => $artikel->id]) }}">BeioN</a></li>
                            {{-- <li class="d-flex align-items-center"><i class="far fa-clock" style="color: #777777;"></i><a href="{{ route('front.artikel.show', ['id' => $artikel->id]) }}">{{ $artikel->time_ago }}</a></li> --}}
                            <li class="d-flex align-items-center"><i class="far fa-map-marked-alt" style="color: #777777;"></i><a href="">{{ $artikel->kota }}</a></li>
                          </ul>
                        </div>
                        <div class="entry-content">
                          <p class="artikel-deskripsi text-reset">{{ $artikel->deskripsi }}</p>
                          {{-- <div class="read-more">
                            <a href="{{ route('front.artikel.show', ['id' => $artikel->id]) }}">Baca Artikel</a>
                          </div> --}}
                        </div>
                        <div class="entry-footer">
                          <i class="bi bi-folder"></i>
                          <ul class="cats">
                            <li><i class="far fa-clock me-2" style="color: #777777;"></i>{{ $artikel->time_ago }}</li>
                            {{-- <li><img src="{{ asset('front-assets/img/logo/logo-stuck.svg') }}" alt="Logo" width="20" class="me-1">BeioN</li> --}}
                          </ul>
                        </div>
                      </article>
                    </a>
                  </div>
                @endforeach
              </div>
            </div>
              
            <!-- End blog entries list -->

                <div class="col-lg-4">
                  <div class="sidebar">
                    {{-- <h3 class="sidebar-title">Cari</h3>
                      <div class="sidebar-item search-form">
                        <form action="">
                          <input type="text">
                          <button type="submit"><i class="far fa-search"></i></button>
                        </form>
                      </div> --}}
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
                  @php
                    $recentArtikels = \App\Models\Artikel::orderBy('created_at', 'desc')->take(5)->get();
                  @endphp
                  @foreach ($recentArtikels as $artikel)
                    <div class="sidebar-item recent-posts">
                      <div class="post-item clearfix">
                        @if ($artikel->thumbnails)
                          <img src="{{ asset($artikel->thumbnails) }}" alt="image-sidebar" class="image-sidebar">
                        @else
                          <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="image-sidebar" class="image-sidebar">
                        @endif
                        <h4 class="artikel-subtitle"><a href="{{ route('front.artikel.show', ['id' => $artikel->id]) }}">{{ $artikel->title }}</a></h4>
                        <time datetime="{{ $artikel->created_at->format('Y-m-d') }}">{{ $artikel->time_ago }}</time>
                      </div>
                    </div>
                  @endforeach
              
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
                <div class="col-md-8">
                  <div class="artikel-pagination">
                    <ul class="justify-content-center py-5">
                      <li class="active"><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </section>
</main>
<!-- End #main -->

<script>
  // document.addEventListener('DOMContentLoaded', function() {
  //   // Ambil semua elemen deskripsi
  //   var descriptionElements = document.querySelectorAll('.artikel-title');
  //   var maxLength = 55;

  //   descriptionElements.forEach(function(descriptionElement) {
  //     var fullText = descriptionElement.textContent;

  //     if (fullText.length > maxLength) {
  //       var truncatedText = fullText.substring(0, maxLength) + '...';
  //       descriptionElement.textContent = truncatedText;
  //     }
  //   });
  // });

  document.addEventListener('DOMContentLoaded', function() {
    // Ambil semua elemen deskripsi
    var descriptionElements = document.querySelectorAll('.artikel-subtitle');
    var maxLength = 40;

    descriptionElements.forEach(function(descriptionElement) {
        var fullText = descriptionElement.textContent;

        if (fullText.length > maxLength) {
          var truncatedText = fullText.substring(0, maxLength) + '...';
          descriptionElement.textContent = truncatedText;
        }
    });
  });
  
  document.addEventListener('DOMContentLoaded', function() {
    // Ambil semua elemen deskripsi
    var descriptionElements = document.querySelectorAll('.artikel-deskripsi');
    var maxLength = 70;

    descriptionElements.forEach(function(descriptionElement) {
      var fullText = descriptionElement.textContent;

      if (fullText.length > maxLength) {
        var truncatedText = fullText.substring(0, maxLength) + '...';
        descriptionElement.textContent = truncatedText;
      }
    });
  });
</script>


@endsection