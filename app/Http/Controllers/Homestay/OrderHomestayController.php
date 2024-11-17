<?php

namespace App\Http\Controllers\Homestay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderHomestay;
use App\Models\Homestay;
use Illuminate\Support\Facades\Session;

class OrderHomestayController extends Controller
{
    public function index()
    {
        // Title Order Mitra Homestay
        $title = 'Order';

        $mitraId = Session::get('mitra_id');
        $orders = OrderHomestay::whereHas('homestay.mitra', function ($query) use ($mitraId) {
            $query->where('id', $mitraId);
        })->with(['homestay.mitra', 'user'])->get();

        return view('mitra.data.homestay.order.index', compact('orders', 'title'));
    }

    public function show($id) 
    {
        // Ambil data order berdasarkan id yang diberikan
        $order_homestay = OrderHomestay::findOrFail($id);

        // Ambil data homestay yang terkait dengan pesanan
        $homestay = Homestay::where('id', $order_homestay->homestay_id)->first();

        $title = 'Detail Order';
        
        // Pass data ke view
        return view('mitra.data.homestay.order.show', compact('order_homestay', 'homestay', 'title'));
    }
}
