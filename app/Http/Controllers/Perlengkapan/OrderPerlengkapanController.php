<?php

namespace App\Http\Controllers\Perlengkapan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perlengkapan;
use App\Models\OrderPerlengkapan;
use App\Models\HistoryPerlengkapan;
use App\Models\PencairanPerlengkapan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class OrderPerlengkapanController extends Controller
{
    public function index()
    {
        $title = 'Order Perlengkapan';
        $mitraId = Session::get('mitra_id');

        // Ambil data orders berdasarkan mitra_id dan hanya dengan payment_status 2
        $orders = OrderPerlengkapan::whereHas('perlengkapan', function ($query) use ($mitraId) {
            $query->where('mitra_id', $mitraId);
        })->where('payment_status', 2) // Filter berdasarkan payment_status 2
        ->with(['perlengkapan.mitra', 'user'])
        ->get();

        return view('mitra.data.perlengkapan.order.index', compact('orders', 'title'));
    }

    public function show($id) 
    {
        // Ambil data order berdasarkan id yang diberikan
        $order_perlengkapan = OrderPerlengkapan::findOrFail($id);

        // Ambil data perlengkapan yang terkait dengan pesanan
        $perlengkapan = Perlengkapan::where('id', $order_perlengkapan->perlengkapan_id)->first();

        $title = 'Detail Order';
        
        // Pass data ke view
        return view('mitra.data.perlengkapan.order.show', compact('order_perlengkapan', 'perlengkapan', 'title'));
    }

    public function moveToHistory(Request $request, $id)
    {
        // Mulai transaksi
        DB::beginTransaction();

        try {
            // Dapatkan order perlengkapan berdasarkan id
            $order = OrderPerlengkapan::find($id);

            if (!$order) {
                // Rollback transaksi jika order tidak ditemukan
                DB::rollBack();
                return redirect()->back()->with('error', 'Order tidak ada');
            }

            // Pastikan `status_pinjam` tidak null
            $statusPinjam = $order->status_pinjam ?? 'Selesai';  // Set nilai default jika null

            // Cek apakah mitra_id ada
            if (is_null($order->mitra_id)) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Mitra ID tidak ditemukan pada order');
            }

            // Pindahkan order ke tabel history_perlengkapans
            HistoryPerlengkapan::create([
                'uniq_perlengkapan' => $order->uniq_perlengkapan,
                'user_id' => $order->user_id,
                'mitra_id' => $order->mitra_id,
                'invoice_number' => $order->invoice_number,
                'perlengkapan_id' => $order->perlengkapan_id,
                'subtotal' => $order->subtotal,
                'coupon_code' => $order->coupon_code,
                'discount' => $order->discount,
                'grand_total' => $order->grand_total,
                'payment_status' => $order->payment_status,
                'status_pinjam' => $statusPinjam,
                'order_type' => $order->order_type,
                'title' => $order->title,
                'first_name' => $order->first_name,
                'last_name' => $order->last_name,
                'no_handphone' => $order->no_handphone,
                'email' => $order->email,
                'alamat_lengkap' => $order->alamat_lengkap,
                'tgl_pinjam' => $order->tgl_pinjam,
                'tgl_pengembalian' => $order->tgl_selesai,
                'durasi_pinjam' => $order->durasi_pinjam,
                'snap_token' => $order->snap_token,
                'note' => $order->note,
                'address' => $order->address,
            ]);

            // Simpan data ke tabel pencairan_perlengkapans
            PencairanPerlengkapan::create([
                'uniq_perlengkapan' => $order->uniq_perlengkapan,
                'user_id' => $order->user_id,
                'mitra_id' => $order->mitra_id,
                'invoice_number' => $order->invoice_number,
                'perlengkapan_id' => $order->perlengkapan_id,
                'subtotal' => $order->subtotal,
                'coupon_code' => $order->coupon_code,
                'discount' => $order->discount,
                'grand_total' => $order->grand_total,
                'payment_status' => 2,
                'pencairan_status' => 1, // Penyesuaian status pencairan
                'status_booking' => 'Selesai',
                'order_type' => 'Perlengkapan',
                'image_bukti' => '', // Sesuaikan jika field ini ada di PencairanPerlengkapan
                'deskripsi' => '', // Sesuaikan jika field ini ada di PencairanPerlengkapan
                'title' => $order->title,
                'first_name' => $order->first_name,
                'last_name' => $order->last_name,
                'no_handphone' => $order->no_handphone,
                'email' => $order->email,
                'alamat_lengkap' => $order->alamat_lengkap,
                'tgl_pinjam' => $order->tgl_pinjam,
                'tgl_pengembalian' => $order->tgl_pengembalian,
                'durasi_pinjam' => $order->durasi_pinjam,
                'snap_token' => $order->snap_token,
                'note' => $order->note,
                'address' => $order->address,
            ]);

            // Hapus order dari tabel order_perlengkapans
            $order->delete();

            // Commit transaksi
            DB::commit();

            // Redirect ke halaman mitra.perlengkapan.order dengan pesan sukses
            return redirect()->route('mitra.perlengkapan.order')->with('success', 'Order sedang dalam proses pencairan');
        } catch (\Exception $e) {
            // Rollback transaksi jika ada kesalahan
            DB::rollBack();
            // Log::error('Failed to move order to history and record in PencairanPerlengkapan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal');
        }
    }


}
