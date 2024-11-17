<?php

namespace App\Http\Controllers\Transportasi\Mobil;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Models\Mobil;
use App\Models\OrderMobil;
use Illuminate\Support\Facades\Session;

class OrderMobilController extends Controller
{
    public function index()
    {
        $title = 'Order';
    
        // Mendapatkan ID mitra dari session
        $mitraId = Session::get('mitra_id');
        
        // Ambil data orders berdasarkan mitra_id dan hanya dengan payment_status 2
        $orders = OrderMobil::whereHas('mobil', function ($query) use ($mitraId) {
            $query->where('mitra_id', $mitraId);
        })->where('payment_status', 2) // Filter berdasarkan payment_status 2
        ->with(['mobil.mitra', 'user'])
        ->get();
    
        return view('mitra.data.transportasi.mobil.order.index', compact('orders', 'title'));
    }

    public function show($id) 
    {
        // Ambil data order berdasarkan id yang diberikan
        $order_mobil = OrderMobil::findOrFail($id);

        // Ambil data mobil yang terkait dengan pesanan
        $mobil = Mobil::where('id', $order_mobil->mobil_id)->first();

        $title = 'Detail Order';
        
        // Pass data ke view
        return view('mitra.data.transportasi.mobil.order.show', compact('order_mobil', 'mobil', 'title'));
    }
}
