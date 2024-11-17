<?php

namespace App\Http\Controllers\UserOrder;

use App\Http\Controllers\Controller;
use App\Models\transportasi;
use App\Models\OrderTransportasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderTransportasiController extends Controller
{
    public function show($id)
    {
        $transportasi = Transportasi::findOrFail($id);
        $category = $transportasi->category;
        return view('front.pages.transportasi.biodata', compact('transportasi', 'category'));
    }

    public function store(Request $request, $transportasi_id)
    {
        $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'title_pengemudi' => 'required|string',
            'nama_pengemudi' => 'required|string|max:255',
            'no_telp_pengemudi' => 'required|string|max:20',
            'email_pengemudi' => 'required|email|max:255',
            'jenis_pemesanan' => 'required|string',
        ]);

        // Pastikan user telah login
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Temukan data transportasi berdasarkan $transportasi_id
        $transportasi = Transportasi::findOrFail($transportasi_id);

        // Hitung subtotal dan grand total
        $subtotal = $transportasi->price;
        $discount = $transportasi->price_discount;
        $grand_total = $subtotal + ($subtotal * ($discount / 100));

        // Dapatkan ID user yang sedang login
        $userId = Auth::id();

        // Buat objek OrderTransportasi baru
        $order = OrderTransportasi::create([
            'user_id' => $userId,
            'invoice_number' => uniqid('INV-'),
            'transportasi_id' => $transportasi_id,
            'subtotal' => $subtotal,
            'grand_total' => $grand_total,
            'payment_status' => 1,
            'status' => 1,
            'email' => $request->email,
            'notes' => "Nama Pengemudi: {$request->nama_pengemudi}, Telepon: {$request->no_telp_pengemudi}, Email: {$request->email_pengemudi}",
        ]);
        

        // Simpan order ke dalam database
        $order->save();

        // Redirect atau tampilkan konfirmasi sukses
        return redirect()->route('transportasi.detail')->with('success', 'Pesanan Anda telah berhasil dibuat.');
    }
}
