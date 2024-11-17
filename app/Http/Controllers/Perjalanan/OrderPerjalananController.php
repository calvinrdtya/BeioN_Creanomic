<?php

namespace App\Http\Controllers\Perjalanan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderPerjalanan;
use App\Models\Perjalanan;
use Illuminate\Support\Facades\Session;

class OrderPerjalananController extends Controller
{
    public function index()
    {
        $title = 'Order Perjalanan';

        // Ambil mitra_id dari sesi
        $mitraId = Session::get('mitra_id');

        // Periksa apakah mitra_id ada
        if (!$mitraId) {
            return redirect()->route('some.fallback.route')->with('error', 'Mitra ID tidak ditemukan.');
        }

        // Ambil data orders berdasarkan mitra_id dan hanya dengan payment_status 2
        $orders = OrderPerjalanan::whereHas('perjalanan', function ($query) use ($mitraId) {
            $query->where('mitra_id', $mitraId);
        })->where('payment_status', 2) // Filter berdasarkan payment_status 2
        ->with(['perjalanan.mitra', 'user'])
        ->get();

        return view('mitra.data.perjalanan.order.index', compact('orders', 'title'));
    }

    public function show($id) 
    {
        // Ambil data order berdasarkan id yang diberikan
        $order_perjalanan = OrderPerjalanan::findOrFail($id);

        // Ambil data perjalanan yang terkait dengan pesanan
        $perjalanan = Perjalanan::where('id', $order_perjalanan->perjalanan_id)->first();

        $title = 'Detail Order';
        
        // Pass data ke view
        return view('mitra.data.perjalanan.order.show', compact('order_perjalanan', 'perjalanan', 'title'));
    }
}
