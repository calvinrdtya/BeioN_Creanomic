<?php

namespace App\Http\Controllers\UserOrder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderHomestay;
use App\Models\Homestay;
use Illuminate\Support\Facades\Auth;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Illuminate\Support\Str;

class UserOrderHomestayController extends Controller
{
    public function index($uniq_id)
    {
        // Temukan data motor berdasarkan $motor_id
        $homestay = Homestay::where('uniq_id', $uniq_id)->firstOrFail();
        
        // Data yang akan dikirim ke view
        $data = [
            'provinces' => Province::all(), // Provinsi
            'regencies' => Regency::all(), // Kabupaten
            'districts' => District::all(), // Kecamatan
            'villages' => Village::all(), // Desa
            'homestay' => $homestay,
            'category' => $homestay->category,
            'title' => 'Isi Data Diri',
        ];

        // Return view dengan data
        return view('front.pages.homestay.booking.create', $data);
    }

    public function store(Request $request, $uniq_id)
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

        $request->validate([
            'title' => 'required|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'no_handphone' => 'required|string',
            'email' => 'required|email|max:255',
            'alamat_lengkap' => 'required|string',
            'tgl_booking' => 'required|string',
            'tgl_selesai' => 'required|string',
            'durasi_booking' => 'required|string', // Pastikan ini sesuai dengan yang digunakan di create
            'note' => 'required|string',
            'provinsi' => 'required|integer',
            'kota' => 'required|integer',
            'kecamatan' => 'required|integer',
            'desa' => 'required|integer',
            'grand_total' => 'required|string',
        ]);

        if (!auth()->check()) {
            return redirect()->route('account.login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Cari homestay berdasarkan uniq_id
        $homestay = Homestay::where('uniq_id', $uniq_id)->firstOrFail();

        $grandTotal = intval(str_replace('.', '', $request->input('grand_total')));
        $subtotal = $grandTotal;
        $userId = Auth::id();

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

        $invoiceNumber = 'INV-' . strtoupper(Str::random(10));

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $itemDetails = [
            [
                'id' => $homestay->uniq_id,
                'price' => $grandTotal,
                'quantity' => 1,
                'name' => $homestay->title,
            ],
        ];

        $params = [
            'transaction_details' => [
                'order_id' => $invoiceNumber,
                'gross_amount' => $grandTotal,
            ],
            'customer_details' => [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->no_handphone,
                'billing_address' => [
                    'address' => $request->alamat_lengkap,
                ],
            ],
            'item_details' => $itemDetails,
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $tglBooking = convertDateToMySQLFormat($request->tgl_booking);
        $tglSelesai = convertDateToMySQLFormat($request->tgl_selesai);

        $uniqHomestay = 'pembayaran-' . strtolower(Str::random(9));

        $order = OrderHomestay::create([
            'uniq_homestay' => $uniqHomestay,
            'user_id' => $userId,
            'invoice_number' => $invoiceNumber,
            'homestay_id' => $homestay->id,
            'subtotal' => $subtotal,
            'coupon_code' => $request->input('coupon_code', null),
            'discount' => 0,
            'grand_total' => $grandTotal,
            'payment_status' => 1,
            'title' => $request->title,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'no_handphone' => $request->no_handphone,
            'email' => $request->email,
            'alamat_lengkap' => $request->alamat_lengkap,
            'order_type' => 'homestay',
            'tgl_booking' => $tglBooking,
            'tgl_selesai' => $tglSelesai,
            'durasi_booking' => $request->durasi_booking,
            'note' => $request->note,
            'address' => $address,
            'snap_token' => $snapToken,
        ]);

        return redirect()->route('user.order')->with('success', 'Booking Homestay Berhasil.');
    }

    public function payment($uniq_homestay)
    {
        // Temukan order berdasarkan uniq_homestay dan user yang sedang login
        $order = OrderHomestay::where('user_id', auth()->id())
                            ->where('uniq_homestay', $uniq_homestay)
                            ->first();

        if ($order) {
            // Ambil detail homestay terkait
            $detail = Homestay::findOrFail($order->homestay_id);
            $title = "Detail Booking Homestay";

            $additionalData = [
                'orderDetails' => OrderHomestay::with('homestay')->findOrFail($order->id),
                'homestay' => Homestay::findOrFail($order->homestay_id),
            ];

            return view("front.pages.homestay.booking.payment", array_merge([
                'order' => $order,
                'detail' => $detail,
                'title' => $title,
            ], $additionalData));
        }

        // Jika tidak ditemukan, tampilkan halaman 404
        return abort(404);
    }

    public function paymentSuccess($homestay_id)
    {
        // Mencari order perjalanan berdasarkan homestay_id
        $order_homestay = OrderHomestay::findOrFail($homestay_id);
        
        // Mengubah status pembayaran menjadi 2 (Pembayaran Berhasil)
        $order_homestay->payment_status = 2;
        $order_homestay->save();
        
        // Mengurangi qty di tabel perlengkapans
        $homestay = Homestay::findOrFail($order_homestay->homestay_id);
        $homestay->qty -= 1;
        $homestay->save();
        
        return redirect()->route('user.order')->with('success', 'Pembayaran berhasil');
    }




}
