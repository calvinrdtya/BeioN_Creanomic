@extends('front.layouts.apps')

@section('content')

@include('front.pages.perjalanan.layouts.nav')

<style>
    .carousel-indicators img{
            display: block;
        }
        .carousel-indicators button{
            width: max-content !important;
        }
        .carousel-indicators{
            position: unset;
        }
        .carousel-item img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }
        .carousel-indicators img {
            width: 55px;
            height: auto;
            cursor: pointer;
        }

        ul.timeline-itinerary {
            list-style-type: none;
            position: relative;
        }
        ul.timeline-itinerary:before {
            content: "";
            background: #4154f1;
            display: inline-block;
            position: absolute;
            left: 29px;
            width: 2px;
            height: 100%;
            z-index: 400;
        }
        ul.timeline-itinerary > li {
            margin: 20px 0;
            padding-left: 20px;
        }
        ul.timeline-itinerary > li:before {
            content: " ";
            background: white;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            border: 5px solid #4154f1;
            left: 23px;
            width: 15px;
            height: 15px;
            z-index: 400;
        }
        .carousel-item img {
            width: 100% !important; /* Lebar gambar 100% dari parent */
            height: auto !important; /* Tinggi gambar otomatis sesuai aspek rasio */
            object-fit: cover !important; /* Mengisi area dengan mempertahankan aspek rasio */
        }
</style>

<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
    <div class="container">
        <ol class="all">
            <li><a href="{{ route('front.home') }}" class="title3">Home</a></li>
            <li class="title2"><a href="javascript:void(0);" onclick="window.history.back()" class="title2">Perjalanan</a></li>
            <li class="title2">Detail</li>
        </ol>
    </div>
</section>
<!-- End Breadcrumbs -->

<section class="inner-page">
    <div class="container">
      <div class="row">
          <div class="col-md-4">
              <div class="card border-0 position-relative">
                  <div class="ket-homestay">
                    @if ($perjalanan->shipping_return == 1)
                        <h3>Diskon {{ $perjalanan->price_discount }}%</h3>
                    @else
                        {{-- <h3>Termurah</h3> --}}
                        @php
                            $items = explode(',', $perjalanan->hightlight);
                        @endphp
                        @foreach($items as $index => $item)
                            @if ($index < 1)
                                <h3 class="text-capitalize">{{ trim($item) }}</h3>
                            @else
                                @break
                            @endif
                        @endforeach
                    @endif
                  </div>
                      <div class="carousel slide" id="carouselDemo" data-bs-wrap="true" data-bs-ride="carousel">
                          <div class="carousel-inner rounded-3">
                                <div class="carousel-item active">
                                    @if ($perjalanan->thumbnail)
                                        <img src="{{ asset('img/' . $perjalanan->thumbnail) }}" alt="Perjalanan Image" class="rounded-1 h-auto">
                                    @else
                                        <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image"/>
                                    @endif
                                </div>
                                @php
                                    $images = explode(',', $perjalanan->image);
                                    $maxImages = 4; // Maksimum 4 gambar yang akan ditampilkan
                                    $countImages = count($images); // Hitung jumlah gambar yang sebenarnya ada
                                @endphp

                                @for ($i = 0; $i < $maxImages; $i++)
                                    @if ($i < $countImages && !empty($images[$i]))
                                        @php
                                            $imagePath = asset('img/' . $images[$i]);
                                        @endphp
                                        <div class="carousel-item" data-bs-interval="5000">
                                            <img src="{{ $imagePath }}" alt="Perjalanan Image" class="rounded-1 h-auto">
                                        </div>
                                    @endif
                                @endfor

                                {{-- <div class="carousel-item" data-bs-interval="2000">
                                    @if ($perjalanan->image)
                                        <img src="{{ asset('img/' . $perjalanan->image) }}" alt="Perjalanan Image" class="rounded-1 h-auto">
                                    @else
                                        <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image"/>
                                    @endif
                                </div>
                                <div class="carousel-item" data-bs-interval="2000">
                                    @if ($perjalanan->image2)
                                        <img src="{{ asset('img/' . $perjalanan->image2) }}" alt="Perjalanan Image" class="rounded-1 h-auto">
                                    @else
                                        <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image"/>
                                    @endif
                                </div>
                                <div class="carousel-item" data-bs-interval="2000">
                                    @if ($perjalanan->image3)
                                        <img src="{{ asset('img/' . $perjalanan->image3) }}" alt="Perjalanan Image" class="rounded-1 h-auto">
                                    @else
                                        <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image"/>
                                    @endif
                                </div>
                                <div class="carousel-item" data-bs-interval="2000">
                                    @if ($perjalanan->image4)
                                        <img src="{{ asset('img/' . $perjalanan->image4) }}" alt="Perjalanan Image" class="rounded-1 h-auto">
                                    @else
                                        <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image"/>
                                    @endif
                                </div> --}}
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselDemo" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselDemo" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                            <div class="carousel-indicators">
                                <button type="button" class="active" data-bs-target="#carouselDemo" data-bs-slide-to="0">
                                    @if ($perjalanan->thumbnail)
                                        <img src="{{ asset('img/' . $perjalanan->thumbnail) }}" alt="Perjalanan Image" class="rounded-1 h-auto">
                                    @else
                                        <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image"/>
                                    @endif
                                </button>
                                @php
                                    $images = explode(',', $perjalanan->image);
                                    $maxImages = 4; // maksimum 4 gambar yang akan ditampilkan
                                @endphp

                                @for ($i = 0; $i < min($maxImages, count($images)); $i++)
                                    @php
                                        $imagePath = asset('img/' . $images[$i]);
                                    @endphp
                                    <button type="button" class="active" data-bs-target="#carouselDemo" data-bs-slide-to="{{ $i + 1 }}">
                                        @if (isset($images[$i]) && $i < $maxImages)
                                            <img src="{{ $imagePath }}" alt="Perjalanan Image" class="rounded-1 h-auto">
                                        @else
                                            <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image"/>
                                        @endif
                                    </button>
                                @endfor

                                {{-- <button type="button" class="active" data-bs-target="#carouselDemo" data-bs-slide-to="1">
                                    @if ($perjalanan->image)
                                        <img src="{{ asset('img/' . $perjalanan->image) }}" alt="Perjalanan Image" class="rounded-1 h-auto">
                                    @else
                                        <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image"/>
                                    @endif
                                </button>
                                <button type="button" class="active" data-bs-target="#carouselDemo" data-bs-slide-to="2">
                                    @if ($perjalanan->image2)
                                        <img src="{{ asset('img/' . $perjalanan->image2) }}" alt="Perjalanan Image" class="rounded-1 h-auto">
                                    @else
                                        <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image"/>
                                    @endif
                                </button>
                                <button type="button" class="active" data-bs-target="#carouselDemo" data-bs-slide-to="3">
                                    @if ($perjalanan->image3)
                                        <img src="{{ asset('img/' . $perjalanan->image3) }}" alt="Perjalanan Image" class="rounded-1 h-auto">
                                    @else
                                        <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image"/>
                                    @endif
                                </button>
                                <button type="button" class="active" data-bs-target="#carouselDemo" data-bs-slide-to="4">
                                    @if ($perjalanan->image4)
                                        <img src="{{ asset('img/' . $perjalanan->image4) }}" alt="Perjalanan Image" class="rounded-1 h-auto">
                                    @else
                                        <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image"/>
                                    @endif
                                </button> --}}
                            </div>
                        </div>
                    </div>
                </div>
              <div class="col-md-4 p-3">
                  <h5 class="title-booking">{{ $perjalanan->title }}</h5>
                  <div class="my-2 d-flex align-items-center">
                    <i class="fas fa-map-marker-alt" style="color: #012970"></i>
                    <p class="title-sub mb-0 ms-2 text-capitalize">{{ $perjalanan->kota }}</p>
                  </div>
                  <div class="my-2 d-flex align-items-center">
                    <i class="far fa-calendar-check me-2" style="color: #012970"></i>
                    <p class="title-sub mb-0">{{ \Carbon\Carbon::parse($perjalanan->tgl_perjalanan)->translatedFormat('d F Y') }}</p>
                </div>
                <div class="m-0 d-flex align-items-center justify-content-between my-2">
                    @if ($perjalanan->jenis == 'ya')
                        <span class="badge bg-two mb-0 mr-auto">Open</span>
                        <p class="mb-0 title-sub">{{ $perjalanan->durasi }}</p>
                    @else
                        <span class="badge bg-two mb-0">Private</span>
                        <p class="mb-0 title-sub">{{ $perjalanan->durasi }}</p>
                    @endif
                </div>
                
                  <div class="my-4">
                    <p class="mb-0 title-sub">Highlight</p>
                    @php
                        $items = explode(',', $perjalanan->hightlight);
                    @endphp
                    @foreach($items as $index => $item)
                        @if ($index < 5)
                            <span class="badge bg-two my-2 me-1 text-capitalize">{{ trim($item) }}</span>
                        @else
                            @break
                        @endif
                    @endforeach
                  </div>
              </div>
                <div class="col-md-4">
                    <div class="card card-price border-0">
                        <div class="card-body my-2">
                            <div class="title-paket d-flex justify-content-between align-items-center mb-2">
                                <p class="title-sub">Mulai Dari</p>
                            </div>
                            {{-- <form action="{{ route('cart.store') }}" method="POST" id="cartForm">
                                @csrf --}}
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                <input type="hidden" name="mitra_id" value="{{ $perjalanan->mitra_id }}">
                                <input type="hidden" name="product_id" value="{{ $perjalanan->id }}">
                                <input type="number" name="qty" value="1" class="d-none">
                                <div class="price align-items-center justify-content-end">
                                    @if ($perjalanan->price_discount === null)
                                        <div class="price-end d-flex align-items-center justify-content-end">
                                            <h4 class="mb-0">Rp {{ $perjalanan->final_price }}</h4>
                                            <p class="my-0 title-sub">&nbsp; / Orang</p>
                                        </div>
                                    @else
                                        <h5 class="price-sub mb-0 ms-auto text-decoration-line-through text-end">Rp {{ $perjalanan->price }}</h5>
                                        <div class="price-end d-flex align-items-center justify-content-end">
                                            <h4 class="mb-0">Rp {{ $perjalanan->final_price }}</h4>
                                            <p class="my-0 title-sub">&nbsp; / Orang</p>
                                        </div>
                                    @endif
                                </div>
                                <hr class="my-4">
                                <div class="row">
                                    {{-- <div class="col-md-6">
                                        <button type="submit" class="button-booking w-100 border-0">Keranjang</button>
                                    </div> --}}
                                {{-- </form> --}}
                                    <div class="col-md-12">
                                        <button class="button-booking w-100 border-0" id="pesanButton">Pesan</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>


        </div>
              <div class="row">
                <div class="col-md-4">
                    <div class="body-title">
                        <div class="my-4 mx-4">
                            <p class="mb-0 title-sub">Itinerary</p>
                        </div>
                        <ul class="timeline-itinerary">
                            @foreach ($decodedItineraries as $itinerary)
                                @if (isset($itinerary['title']) && isset($itinerary['jam']) && isset($itinerary['deskripsi']))
                                    <li>
                                        <p class="my-0 title-sub">{{ $itinerary['title'] }}</p>
                                        <div class="d-flex align-items-center my-2">
                                            <i class="far fa-clock me-2 mb-0" style="color: #012970"></i>
                                            <p class="mb-0">{{ $itinerary['jam'] }}</p>
                                        </div>
                                        <p class="title-secondary">{{ $itinerary['deskripsi'] }}</p>
                                    </li>
                                @else
                                    <li>
                                        <p class="my-0 title-sub">Data tidak lengkap</p>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-8">
                    <div class="body-title my-3">
                        <div class="row">
                            <div class="col-md-12 my-2">
                                <a data-bs-toggle="modal" data-bs-target="#cuaca">
                                    <p class="mb-0 title-sub" style="color: #4154f1 !important">Lihat Perkiraan Cuaca</p>
                                </a>
                            </div>
                            <div class="col-md-12 my-2">
                                <p class="mb-0 title-sub">Deskripsi</p>
                                <p class="title-secondary">{{ $perjalanan->deskripsi }}</p>
                            </div>
                        {{-- <form action="" method="POST">
                            @csrf  --}}
                            <div class="col-md-12 my-2">
                                <div class="mb-3">
                                    <label for="defaultSelect" class="form-label">Meeting Points</label>
                                    <select id="defaultSelect" class="form-select" name="meeting_points">
                                        <option value="">Cek Meeting Point</option>
                                        @php
                                            $meetingPoints = explode(',', $perjalanan->titik);
                                        @endphp
                                        @foreach ($meetingPoints as $point)
                                            <option value="{{ $point }}">{{ $point }}</option>
                                        @endforeach
                                    </select>
                                </div>                                                                  
                            </div>
                        {{-- </form> --}}
                    </div>
                        {{-- <div class="row"> --}}
                            <div class="col-md-12 my-3">
                                <p class="mb-0 title-sub">Harga Sudah Termasuk :</p>
                                @php
                                    $items = explode(',', $perjalanan->include);
                                @endphp
                                @foreach($items as $item)
                                    <li class="title-secondary text-capitalize">
                                        {{ trim($item) }}
                                    </li>
                                @endforeach
                            </div>
                            <div class="col-md-12 my-3">
                                <p class="mb-0 title-sub">Harga Belum Termasuk :</p>
                                @php
                                    $items = explode(',', $perjalanan->exclude);
                                @endphp
                                @foreach($items as $item)
                                    <li class="title-secondary text-capitalize">
                                        {{ trim($item) }}
                                    </li>
                                @endforeach
                            </div>
                        {{-- </div> --}}
                    </div>
                </div>
              </div>
          </div>
      </div>
  </section>

  <!-- Button trigger modal -->
  <!-- Modal -->
  <div class="modal fade" id="cuaca" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Perkiraan Cuaca Hari ini</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-3">
                <img src="https://i.ibb.co.com/bvqXjPY/Cuplikan-layar-2024-10-08-190744.png" alt="" width="100%">
            </div>
            <div class="col-md-3">
                <img src="https://i.ibb.co.com/G388Jqd/Cuplikan-layar-2024-10-08-191525.png" alt="" width="100%">
            </div>
            <div class="col-md-3">
                <img src="https://i.ibb.co.com/ZdZYVPq/Cuplikan-layar-2024-10-08-191757.png" alt="" width="100%">
            </div>
            <div class="col-md-3">
                <img src="https://i.ibb.co.com/cLgRqzv/Cuplikan-layar-2024-10-08-191908.png" alt="" width="100%">
            </div>
          </div>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
      </div>
    </div>
  </div>

<script>
    // Periksa User apakah sudah login atau belum
    document.getElementById('pesanButton').addEventListener('click', function(event) {
        event.preventDefault();
        @if (Auth::check())
            window.location.href = '{{ route('perjalanan.booking', $perjalanan->id) }}';
        @else
            window.location.href = '{{ route('account.login') }}';
        @endif
    });
    
    // Sort Kendaraan
    function sortPerjalanan() {
        var sortBy = document.getElementById("sortBy").value;
        var url = new URL(window.location.href);
        url.searchParams.set('sortBy', sortBy);
        window.location.href = url.toString();
    }

</script>
@endsection