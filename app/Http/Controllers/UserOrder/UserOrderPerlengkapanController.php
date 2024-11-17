<?php

namespace App\Http\Controllers\UserOrder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\UpdateOrderPerlengkapanStatus;
use App\Models\OrderPerlengkapan;
use App\Models\Perlengkapan;
use Illuminate\Support\Facades\Auth;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\User;
use App\Models\Village;
use Illuminate\Support\Str;

class UserOrderPerlengkapanController extends Controller
{
    public function index($perlengkapan_id)
    {
        $title = 'Booking Perlengkapan';
        // Temukan data motor berdasarkan $motor_id
        $perlengkapan = Perlengkapan::findOrFail($perlengkapan_id);

        // Data yang akan dikirim ke view
        $data = [
            'provinces' => Province::all(), // Provinsi
            'regencies' => Regency::all(), // Kabupaten
            'districts' => District::all(), // Kecamatan
            'villages' => Village::all(), // Desa
            'perlengkapan' => $perlengkapan,
            'category' => $perlengkapan->category,
            'title' => $title,
            'point' => auth()->user()->points,
        ];

        // Return view dengan data
        return view('front.pages.perlengkapan.order.create', $data);
    }

    public function store(Request $request, $perlengkapan_id)
    {
        $isUsePoint = $request->input('is_use_point');

        $request->validate([
            'title' => 'required|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'no_handphone' => 'required|string',
            'email' => 'required|email|max:255',
            'alamat_lengkap' => 'required|string',
            'tgl_pinjam' => 'required|string',
            'tgl_pengembalian' => 'required|string',
            'durasi_pinjam' => 'required|string',
            'note' => 'required|string',
            'provinsi' => 'required|integer',
            'kota' => 'required|integer',
            'kecamatan' => 'required|integer',
            'desa' => 'required|integer',
            'grand_total' => 'required|string',
        ], [
            'title.required' => 'Gelar harus diisi.',
            'first_name.required' => 'Nama depan harus diisi.',
            'last_name.required' => 'Nama belakang harus diisi.',
            'no_handphone.required' => 'Nomor handphone harus diisi.',
            'no_handphone.string' => 'Nomor handphone harus berupa teks.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'alamat_lengkap.required' => 'Alamat lengkap harus diisi.',
            'tgl_pinjam.required' => 'Tanggal peminjaman harus diisi.',
            'tgl_pengembalian.required' => 'Tanggal pengembalian harus diisi.',
            'durasi_pinjam.required' => 'Durasi peminjaman harus diisi.',
            'note.required' => 'Catatan harus diisi.',
            'provinsi.required' => 'Provinsi harus dipilih.',
            'provinsi.integer' => 'Provinsi harus dipilih.',
            'kota.required' => 'Kota harus dipilih.',
            'kecamatan.required' => 'Kecamatan harus dipilih.',
            'desa.required' => 'Desa harus dipilih.',
            'grand_total.required' => 'Total harga harus diisi.',
        ]);

        if (!auth()->check()) {
            return redirect()->route('account.login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        $perlengkapan = Perlengkapan::findOrFail($perlengkapan_id);
        $user = User::where('id', auth()->user()->id)->first();
        
        $grandTotal = floatval($request->input('grand_total'));
        $subtotal = $grandTotal;
        
        if ($isUsePoint) {
            $grandTotal -= $user->points;
        
            if ($grandTotal < 0) {
                $remainingPoints = abs($grandTotal);
        
                $user->points = max(0, $remainingPoints);
                $user->save();
        
                $grandTotal = 0;
            } else {
                $user->points -= floatval($request->input('grand_total')) - $grandTotal;
                $user->save();
            }
        }           

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

        $formatedGrandTotal = (int)round($grandTotal);

        $itemDetails = [
            [
                'id' => $perlengkapan->id,
                'price' => $formatedGrandTotal,
                'quantity' => 1,
                'name' => $perlengkapan->title,
            ],
        ];

        $params = [
            'transaction_details' => [
                'order_id' => $invoiceNumber,
                'gross_amount' => $formatedGrandTotal,
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

        if ($grandTotal > 0) {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
        }

        $tglPinjam = $request->tgl_pinjam;
        $tglPengembalian = $request->tgl_pengembalian;

        $uniqPerlengkapan = 'pembayaran-' . strtolower(Str::random(9));

        $order = OrderPerlengkapan::create([
            'uniq_perlengkapan' => $uniqPerlengkapan,
            'user_id' => $userId,
            'mitra_id' => $perlengkapan->mitra_id,
            'invoice_number' => $invoiceNumber,
            'perlengkapan_id' => $perlengkapan->id,
            'subtotal' => $subtotal,
            'coupon_code' => $request->input('coupon_code', null),
            'discount' => 0,
            'grand_total' => $grandTotal,
            'payment_status' => $grandTotal > 0 ? 1 : 2,
            'title' => $request->title,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'no_handphone' => $request->no_handphone,
            'email' => $request->email,
            'alamat_lengkap' => $request->alamat_lengkap,
            'order_type' => 'perlengkapan',
            'tgl_pinjam' => $tglPinjam,
            'tgl_pengembalian' => $tglPengembalian,
            'durasi_pinjam' => $request->durasi_pinjam,
            'note' => $request->note,
            'address' => $address,
            'snap_token' => $snapToken ?? null,
        ]);

        UpdateOrderPerlengkapanStatus::dispatch($order->id)->delay(now()->addMinutes(30));

        return redirect()->route('user.order')->with('success', 'Booking Perlengkapan Berhasil.');
    }

    public function delete($uniq_perlengkapan)
    {
        // Temukan order berdasarkan ID
        $order = OrderPerlengkapan::find($uniq_perlengkapan);

        if ($order) {
            $remainingPoints = $order->subtotal - $order->grand_total;
            if ($remainingPoints > 0) {
                $user = User::find($order->user_id);
                $user->points = $user->points + $remainingPoints;
                $user->save();
            }   

            // Hapus order
            $order->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('user.order')->with('success', 'Order berhasil dihapus.');
        } else {
            // Redirect dengan pesan error jika order tidak ditemukan
            return redirect()->route('user.order')->with('error', 'Order tidak ditemukan.');
        }
    }

    public function payment($uniq_perlengkapan)
    {
        // Cari order berdasarkan uniq_perlengkapan
        $order = OrderPerlengkapan::where('uniq_perlengkapan', $uniq_perlengkapan)
            ->where('user_id', auth()->id())
            ->first();

        if ($order) {
            $detail = Perlengkapan::findOrFail($order->perlengkapan_id);
            $title = "Pembayaran";

            $additionalData = [
                'orderDetails' => OrderPerlengkapan::with('perlengkapan')->findOrFail($order->id),
                'perlengkapan' => Perlengkapan::findOrFail($order->perlengkapan_id),
            ];

            return view("front.pages.perlengkapan.order.payment", array_merge([
                'order' => $order,
                'detail' => $detail,
                'title' => $title,
            ], $additionalData));
        }

        return abort(404);
    }

    public function paymentSuccess($order_id)
    {
        // Mencari order perjalanan berdasarkan order_id
        $order_perlengkapan = OrderPerlengkapan::findOrFail($order_id);

        // Mengubah status pembayaran menjadi 2 (Pembayaran Berhasil)
        $order_perlengkapan->payment_status = 2;
        $order_perlengkapan->save();

        // Mengurangi qty di tabel perlengkapans
        $perlengkapan = Perlengkapan::findOrFail($order_perlengkapan->perlengkapan_id);
        $perlengkapan->qty -= 1;
        $perlengkapan->save();

        return redirect()->route('user.order')->with('success', 'Pembayaran berhasil');
    }

    // public function paymentSuccess($perlengkapan_id)
    // {
    //     // Mencari order perlengkapan berdasarkan order_id (opsional, tergantung kebutuhan)
    //     // $order = OrderPerlengkapan::findOrFail($order_id);

    //     // Menampilkan view success
    //     return view('front.pages.perlengkapan.order.success');
    // }




}
