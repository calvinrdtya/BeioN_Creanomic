<?php

namespace App\Http\Controllers\UserOrder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Perjalanan;
use App\Models\OrderPerjalanan;
use Illuminate\Support\Facades\Auth;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Illuminate\Support\Str;

class UserOrderPerjalananController extends Controller
{
    public function index($id)
    {
        $perjalanan = Perjalanan::findOrFail($id);
        $data = [
            'provinces' => Province::all(), // Provinsi
            'regencies' => Regency::all(), // Kabupaten
            'districts' => District::all(), // Kecamatan
            'villages' => Village::all(), // Desa
            'perjalanan' => $perjalanan,
            'category' => $perjalanan->category,
            'title' => 'Isi Data Diri',
        ];

        return view('front.pages.perjalanan.order.create', $data);
    }

    public function store(Request $request, $perjalanan_id)
    {
        // Validasi data dari request
        $request->validate([
            'title' => 'required|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'no_handphone' => 'required|string',
            'email' => 'required|email|max:255',
            'alamat_lengkap' => 'required|string',
            'provinsi' => 'required|integer',
            'kota' => 'required|integer',
            'kecamatan' => 'required|integer',
            'desa' => 'required|integer',
            'grand_total' => 'required|numeric',
            'meeting_points' => 'required|string',
        ]);

        // Pastikan user telah login
        if (!auth()->check()) {
            return redirect()->route('account.login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Temukan data perjalanan berdasarkan $perjalanan_id
        $perjalanan = Perjalanan::findOrFail($perjalanan_id);

        // Ambil nilai dari final_price yang berformat rupiah
        $finalPrice = $perjalanan->final_price;

        // Hapus titik dan konversi ke decimal
        $grandTotal = number_format((float) str_replace('.', '', $finalPrice), 2, '.', '');

        // Hitung subtotal
        $subtotal = $grandTotal;

        // Dapatkan ID user yang sedang login
        $userId = Auth::id();

        // Gabungkan nama provinsi, kota, kecamatan, dan desa menjadi satu string
        $provinceName = Province::findOrFail($request->provinsi)->name;
        $cityName = Regency::findOrFail($request->kota)->name;
        $districtName = District::findOrFail($request->kecamatan)->name;
        $villageName = Village::findOrFail($request->desa)->name;

        $address = implode('-', [
            $provinceName,
            $cityName,
            $districtName,
            $villageName,
        ]);

        // Generate invoice number
        $invoiceNumber = 'INV-' . strtoupper(Str::random(10));

        // Generate order_uniq with format 'perjalanan-{string acak berjumlah 9}'
        $orderUniq = 'pembayaran-' . strtolower(Str::random(9));

        // Buat objek OrderPerjalanan baru
        $order = OrderPerjalanan::create([
            'uniq_perjalanan' => $orderUniq, // Simpan order_uniq
            'user_id' => $userId,
            'perjalanan_id' => $perjalanan->id,
            'invoice_number' => $invoiceNumber,
            'subtotal' => $subtotal,
            'coupon_code' => $request->input('coupon_code', null),
            'discount' => 0,
            'grand_total' => $grandTotal,
            'payment_status' => 1,
            'order_type' => 'perjalanan',
            'title' => $request->title,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'no_handphone' => $request->no_handphone,
            'email' => $request->email,
            'alamat_lengkap' => $request->alamat_lengkap,
            'address' => $address,
            'meeting_points' => $request->meeting_points,
            'note' => $request->input('note', ''),
        ]);

        // Generate snap_token dari Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // Item details
        $itemDetails = [
            [
                'id' => $perjalanan->id,
                'price' => (int) $grandTotal,
                'quantity' => 1,
                'name' => $perjalanan->title,
            ],
        ];

        $params = array(
            'transaction_details' => array(
                'order_id' => $invoiceNumber,
                'gross_amount' => $grandTotal,
            ),
            'customer_details' => array(
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->no_handphone,
                'billing_address' => array(
                    'address' => $request->alamat_lengkap,
                ),
            ),
            'item_details' => $itemDetails,
        );

        // Dapatkan snap_token dari Midtrans
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // Simpan snap_token ke dalam order yang sesuai
        $order->snap_token = $snapToken;
        $order->save();

        // Debugging
        // dd($order->toArray());

        // Redirect ke halaman daftar pesanan dengan pesan sukses
        return redirect()->route('user.order')->with('success', 'Pesanan Anda telah berhasil dibuat.');
    }

    public function payment($uniq_perjalanan)
    {
        $order = OrderPerjalanan::where('user_id', auth()->id())
                                ->where('uniq_perjalanan', $uniq_perjalanan)
                                ->first();
    
        if ($order) {
            $detail = Perjalanan::findOrFail($order->perjalanan_id);
            $title = "Pembayaran";
    
            $additionalData = [
                'orderDetails' => OrderPerjalanan::with('perjalanan')->findOrFail($order->id),
                'perjalanan' => Perjalanan::findOrFail($order->perjalanan_id),
            ];
    
            return view("front.pages.perjalanan.order.payment", array_merge([
                'order' => $order,
                'detail' => $detail,
                'title' => $title,
            ], $additionalData));
        }
        return abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        
    }

    

    // public function show(Request $request, $id)
    // {
    //     $provinceId = $request->id;
    //     $cities = City::where('province_id', $provinceId)->pluck('name', 'id');
    //     return response()->json($cities);
    //     $perjalanan = Perjalanan::findOrFail($id);
    //     $category = $perjalanan->category;
    //     return view('front.pages.perjalanan.order.data', compact('perjalanan', 'category'));
    // }

    public function review($id)
    {
        $perjalanan = Perjalanan::findOrFail($id);
        return view('front.pages.perjalanan.order.data', compact('perjalanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function orderDetail($orderId)
    {
        // Ambil satu order berdasarkan user_id yang sedang login dan ID pesanan
        $order_perjalanan = OrderPerjalanan::where('user_id', auth()->id())->where('id', $orderId)->firstOrFail();

        // Ambil data perjalanan yang terkait dengan pesanan
        $perjalanan = Perjalanan::findOrFail($order_perjalanan->perjalanan_id);
        
        $title = "Detail Order";
        
        // Kirimkan data ke view
        return view('front.pages.perjalanan.order.detail', [
            'order_perjalanan' => $order_perjalanan,
            'perjalanan' => $perjalanan,
            'title' => $title
        ]);
    }

    public function paymentSuccess($order_id)
    {
        // Mencari order perjalanan berdasarkan order_id
        $order_perjalanan = OrderPerjalanan::findOrFail($order_id);
        
        // Mengubah status pembayaran menjadi 2 (Pembayaran Berhasil)
        $order_perjalanan->payment_status = 2;
        $order_perjalanan->save();
        
        // Mengurangi qty di tabel perjalanans
        $perjalanan = Perjalanan::findOrFail($order_perjalanan->perjalanan_id);
        $perjalanan->qty -= 1;
        $perjalanan->save();
        
        return redirect()->route('user.order')->with('success', 'Pembayaran berhasil');
    }

    public function paymentError($order_id)
    {
        $order = OrderPerjalanan::where('id', $order_id)->where('user_id', auth()->id())->first();
        
        if ($order) {
            $order->payment_status = 4; // Asumsikan 4 adalah status untuk "Pembayaran Gagal"
            $order->save();
        }

        return redirect()->route('user.order')->with('error', 'Pembayaran gagal. Silakan coba lagi.');
    }

}
