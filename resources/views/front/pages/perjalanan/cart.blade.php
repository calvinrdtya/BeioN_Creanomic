@extends('front.layouts.app')

@section('content')

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <ol class="all mt-3">
                <li><a href="{{ route('front.home') }}" class="title3">Home</a></li>
                <li class="title2">Transportasi</li>
                <li class="title2">Data Diri</li>
            </ol>
        </div>
    </section>
    <!-- End Breadcrumbs -->

<div class="user-riwayat pb-5">
    <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card p-3 border-0">
                        <div class="row g-0">
                            <div class="col-md-2">
                                <div class="card m-0 p-0 border-0">
                                    <p class="title-sub my-0 ms-2">Item</p>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-3">
                                <div class="card m-0 p-0 border-0">
                                    <p class="title-sub my-0 ms-2">Harga</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="card m-0 p-0 border-0">
                                    <p class="title-sub my-0 text-center">Jumlah</p>
                                </div>
                            </div>
                            <hr class="my-2">
                        {{-- <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $cart)
                                    @foreach ($perjalanans as $perjalanan)
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                @if (!empty($cart->perjalanan->thumbnail))
                                                    <img src="{{ asset('img/' . $perjalanan->thumbnail) }}" alt="Perjalanan Image" class="img-fluid" width="20%">
                                                @else
                                                    <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image"/>
                                                @endif
                                                <span class="ms-2 text-capitalize">{{ $perjalanan->title }}</span>
                                            </td>
                                            <td>
                                                <span class="ms-2 text-capitalize">Rp {{ $perjalanan->final_price }}</span>
                                            </td>
                                            <td class="d-flex align-items-center justify-content-center">
                                                <span class="ms-2 text-capitalize">{{ $cart->qty }}</span>
                                            </td>                                                                
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table> --}}
                        {{-- <div class="col-md-4"> --}}
                            {{-- @foreach ($perjalanans as $perjalanan)
                                @if (!empty($cart->perjalanan->thumbnail))
                                    <img src="{{ asset('img/' . $perjalanan->thumbnail) }}" alt="Perjalanan Image" class="img-fluid" width="70%">
                                @else
                                    <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image"/>
                                @endif
                            @endforeach --}}
                        {{-- </div> --}}
                        {{-- <div class="col-md-2">
                            <div class="card m-0 p-0 p-3"></div>
                        </div> --}}
                </div>
                    <div class="row g-0">
                        @foreach ($carts as $cart)
                            @foreach ($perjalanans as $perjalanan)
                                <div class="col-md-2 p-1">
                                    <div class="card justify-content-center h-100 border-0">
                                        @if (!empty($perjalanan->thumbnail))
                                            <img src="{{ asset('img/' . $perjalanan->thumbnail) }}" alt="Perjalanan Image" class="img-fluid" width="90%">
                                        @else
                                            <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image"/>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card justify-content-center h-100 border-0">
                                        {{-- <div class="d-flex align-items-center">
                                            @if (!empty($cart->perjalanan->thumbnail))
                                                <img src="{{ asset('img/' . $perjalanan->thumbnail) }}" alt="Perjalanan Image" class="img-fluid" width="40%">
                                            @else
                                                <img src="{{ asset('front-assets/img_blank.jpg') }}" alt="Default Image"/>
                                            @endif --}}
                                            <span class="ms-2 text-capitalize">{{ $perjalanan->title }}</span>
                                        {{-- </div> --}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card justify-content-center h-100 border-0">
                                        <span class="ms-2 text-capitalize">Rp {{ $perjalanan->final_price }}</span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="card d-flex justify-content-center h-100 border-0">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-all btn-minus" onclick="updateQty(-1, {{ $cart->id }})">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input readonly type="text" name="input-qty" id="input-qty-{{ $cart->id }}" class="form-control form-control-sm w-25 border-0 text-center mx-2" value="{{ $cart->qty }}">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-all btn-plus" onclick="updateQty(1, {{ $cart->id }})">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>                                                              
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="card justify-content-center align-items-center h-100 border-0">
                                        <a href="{{ route('front.delete.cart',$cart->id) }}" class="btn btn-link p-0">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                                {{-- <span class="ms-2 text-center">{{ $cart->qty }}</span> --}}
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
     
                    {{-- <div class="col-md-4">
                        <div class="card p-3">
                            <div class="title-paket d-flex justify-content-between align-items-center mb-2">
                                <h5 class="titles mb-0">Sub Harga</h5>
                            </div>
                            <div class="d-flex justify-content-between align-items-center my-3">
                                <p class="title-sub my-0">Rincian</p>
                                <div class="price-end text-end">
                                    <h4 class="mb-0">Rp {{ $perjalanan->final_price }}</h4>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center my-3">
                                <h5 class="titles mb-0">Harga Total</h5>
                                <div class="price-end text-end">
                                    <h4 id="totalHarga" class="mb-0">Rp {{ $perjalanan->final_price }}</h4>
                                </div>
                            </div>
                            
                            <div class="price align-items-center justify-content-end">
                                @if ($perjalanan->price_discount === null)
                                    <div class="price-end d-flex align-items-center justify-content-end">
                                        <h4 class="mb-0">Rp {{ $perjalanan->final_price }}</h4>
                                        <p class="my-0 title-sub">&nbsp; / pax</p>
                                    </div>
                                @else
                                <h5 class="price-sub mb-0 ms-auto text-decoration-line-through text-end">Rp {{ $perjalanan->price }}</h5>
                                <div class="price-end d-flex align-items-center justify-content-end">
                                    <h4 class="mb-0">Rp {{ $perjalanan->final_price }}</h4>
                                    <p class="my-0 title-sub">&nbsp; / pax</p>
                                </div>
                                @endif
                            </div>
                            <hr class="my-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="button-booking w-100 border-0">Pesan</button>
                                </div>
                                <div class="col-md-6">
                                    <button class="button-booking w-100 border-0" onclick="window.location.href='{{ route('perjalanan.booking', $perjalanan->id) }}'">Pesan</button>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
           
    </div>
</div>

<script>
//    function updateQty(change, cartId) {
//     const qtyInput = document.getElementById(`input-qty-${cartId}`);
//     let currentQty = parseInt(qtyInput.value);

//     if (isNaN(currentQty)) {
//         currentQty = 0;
//     }

//     currentQty += change;

//     if (currentQty < 1) {
//         currentQty = 1;
//     }

//     qtyInput.value = currentQty;

//     // Menghitung total harga berdasarkan final_price yang diambil dari PHP
//     var finalPrice = <?php echo json_encode($perjalanan->final_price); ?>;
//     var totalHarga = finalPrice * currentQty;

//     // Format total harga menjadi Rupiah
//     var formattedTotal = formatRupiah(totalHarga);

//     // Tampilkan hasilnya di elemen HTML yang sesuai
//     document.getElementById('totalHarga').innerHTML = formattedTotal;

//     // Kirim permintaan AJAX untuk memperbarui kuantitas
//     updateCart(cartId, currentQty);
// }

// function updateCart(cartId, qty) {
//     $.ajax({
//         url: '{{ route("front.updateCart") }}',
//         type: 'POST',
//         data: {
//             _token: '{{ csrf_token() }}',
//             cart_id: cartId,
//             cart_qty: qty
//         },
//         success: function(data) {
//             if (data.success) {
//                 // Tampilkan pesan sukses atau update UI jika diperlukan
//                 console.log('Cart updated successfully');
//             } else {
//                 // Tampilkan pesan error
//                 console.error('Error updating cart:', data.message);
//             }
//         },
//         error: function(jqXHR, textStatus, errorThrown) {
//             console.error('AJAX error:', textStatus, errorThrown);
//         }
//     });
// }

// function formatRupiah(angka) {
//     var reverse = angka.toString().split('').reverse().join(''),
//         ribuan = reverse.match(/\d{1,3}/g);
//     ribuan = ribuan.join('.').split('').reverse().join('');
//     return 'Rp ' + ribuan;
// }

</script>

@endsection

@section('customJs')
<script>
function updateQty(change) {
    const qtyInput = document.getElementById('input-qty');
    let currentQty = parseInt(qtyInput.value);

    if (isNaN(currentQty)) {
        currentQty = 0;
    }

    currentQty += change;

    if (currentQty < 1) {
        currentQty = 1;
    }

    qtyInput.value = currentQty;
}

    function updateCart(rowId, qty) {
        $.ajax({
            url: '{{ route("front.updateCart") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                rowId: rowId,
                qty: qty
            },
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    // Refresh halaman atau lakukan manipulasi DOM sesuai kebutuhan
                    window.location.reload(); // Contoh: memuat ulang halaman setelah berhasil memperbarui
                } else {
                    alert('Gagal memperbarui keranjang: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Terjadi kesalahan saat memperbarui keranjang:', error);
            }
        });
    }
});
    //     function deleteItem(rowId) {
    //         Swal.fire({
    //         icon: 'question',
    //         title: 'Confirm Deletion',
    //         text: 'Are you sure you want to delete this item?',
    //         showCancelButton: true,
    //         confirmButtonText: 'Yes',
    //         cancelButtonText: 'No'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             $.ajax({
    //                 url: '{{ route("front.delete.cart") }}',
    //                 type: 'post',
    //                 data: { rowId: rowId },
    //                 dataType: 'json',
    //                 success: function (response) {
    //                     if (response.status == true) {
    //                         window.location.href = '{{ route("front.cart") }}';
    //                     }
    //                 }
    //             });
    //         }
    //     });
    // }
</script>

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false, "searching": false,"paging": false,"info": false,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>

@endsection