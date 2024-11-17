<?php

namespace App\Http\Controllers\UserOrder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderMobil;
use App\Models\Mobil;
use Illuminate\Support\Facades\Auth;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Illuminate\Support\Str;

class UserOrderMobilController extends Controller
{
    public function index($mobil_id)
    {
        // Temukan data mobil berdasarkan $mobil_id
        $mobil = Mobil::findOrFail($mobil_id);
        
        // Data yang akan dikirim ke view
        $data = [
            'provinces' => Province::all(), // Provinsi
            'regencies' => Regency::all(), // Kabupaten
            'districts' => District::all(), // Kecamatan
            'villages' => Village::all(), // Desa
            'mobil' => $mobil,
            'category' => $mobil->category,
            'title' => 'Isi Data Diri',
        ];

        // Return view dengan data
        return view('front.pages.transportasi.order.mobil.create', $data);
    }

    public function store(Request $request, $mobil_id)
    {
        function convertDateToMySQLFormat($date)
        {
            $months = [
                "Januari" => "01",
                "Februari" => "02",
                "Maret" => "03",
                "April" => "04",
                "Mei" => "05",
                "Juni" => "06",
                "Juli" => "07",
                "Agustus" => "08",
                "September" => "09",
                "Oktober" => "10",
                "November" => "11",
                "Desember" => "12",
            ];
            
            $dateParts = explode(' ', $date);
            $day = $dateParts[0];
            $month = $months[$dateParts[1]];
            $year = $dateParts[2];
            
            return "$year-$month-$day";
        }

        // Validasi data dari request
        $request->validate([
            'title' => 'required|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'no_handphone' => 'required|string',
            'email' => 'required|email|max:255',
            'alamat_lengkap' => 'required|string',
            'provinsi' => 'required|integer',
            'tgl_pinjam' => 'required|string',
            'tgl_pengembalian' => 'required|string',
            'durasi_pinjam' => 'required|string',
            'kota' => 'required|integer',
            'kecamatan' => 'required|integer',
            'desa' => 'required|integer',
            'note' => 'required|string',
            'grand_total' => 'required|string',
        ]);

        // Pastikan user telah login
        if (!auth()->check()) {
            return redirect()->route('account.login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Temukan data mobil berdasarkan $mobil_id
        $mobil = Mobil::findOrFail($mobil_id);

        // Simpan grand_total dari form input ke dalam tabel order_perjalanans
        $grandTotal = intval(str_replace('.', '', $request->input('grand_total')));

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
        $invoiceNumber = 'INV-' . strtoupper(Str::random(10)); // Format: INV-XXXXXX

        // Generate snap_token dari Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false; // Sesuaikan dengan kebutuhan produksi atau sandbox
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // Item details
        $itemDetails = [
            [
                'id' => $mobil->id,
                'price' => $grandTotal,
                'quantity' => 1,
                'name' => $mobil->title,
            ],
        ];

        $params = array(
            'transaction_details' => array(
                'order_id' => $invoiceNumber, // Menggunakan invoice number
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

        $tglPinjam = convertDateToMySQLFormat($request->tgl_pinjam);
        $tglPengembalian = convertDateToMySQLFormat($request->tgl_pengembalian);

        $uniqMobil = 'pembayaran-' . strtolower(Str::random(9));

        // Buat objek OrderMobil baru dengan snap_token
        $order = OrderMobil::create([
            'user_id' => $userId,
            'uniq_mobil' => $uniqMobil,
            'invoice_number' => $invoiceNumber,
            'mobil_id' => $mobil->id,
            'subtotal' => $subtotal,
            'coupon_code' => $request->input('coupon_code', null),
            'discount' => 0,
            'grand_total' => $grandTotal,
            'payment_status' => 1,
            'order_type' => 'mobil',
            'title' => $request->title,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'no_handphone' => $request->no_handphone,
            'email' => $request->email,
            'alamat_lengkap' => $request->alamat_lengkap,
            'tgl_pinjam' => $tglPinjam,
            'tgl_pengembalian' => $tglPengembalian,
            'durasi_pinjam' => $request->durasi_pinjam,
            'note' => $request->input('note', ''),
            'address' => $address,
            'snap_token' => $snapToken, // Pastikan snap_token diatur di sini
        ]);

        // Redirect ke halaman daftar pesanan dengan pesan sukses
        return redirect()->route('user.order')->with('success', 'Booking Motor Berhasil Dibuat.');
    }

    public function payment($uniq_mobil)
    {
        // Temukan order berdasarkan uniq_mobil dan user yang sedang login
        $order = OrderMobil::where('user_id', auth()->id())
                            ->where('uniq_mobil', $uniq_mobil)
                            ->first();

        if ($order) {
            // Ambil detail motor terkait
            $detail = Mobil::findOrFail($order->mobil_id);
            $title = "Detail Order Mobil";

            $additionalData = [
                'orderDetails' => OrderMobil::with('mobil')->findOrFail($order->id),
                'mobil' => Mobil::findOrFail($order->mobil_id),
            ];

            return view("front.pages.transportasi.order.mobil.payment", array_merge([
                'order' => $order,
                'detail' => $detail,
                'title' => $title,
            ], $additionalData));
        }

        // Jika tidak ditemukan, tampilkan halaman 404
        return abort(404);
    }

    public function paymentSuccess($mobil_id)
    {
        // Mencari order perjalanan berdasarkan mobil_id
        $order_mobil = OrderMobil::findOrFail($mobil_id);
        
        // Mengubah status pembayaran menjadi 2 (Pembayaran Berhasil)
        $order_mobil->payment_status = 2;
        $order_mobil->save();
        
        // Mengurangi qty di tabel perlengkapans
        $mobil = Mobil::findOrFail($order_mobil->mobil_id);
        $mobil->qty -= 1;
        $mobil->save();
        
        return redirect()->route('user.order')->with('success', 'Pembayaran berhasil');
    }



}
