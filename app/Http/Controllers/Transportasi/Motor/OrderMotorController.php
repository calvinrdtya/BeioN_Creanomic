<?php

namespace App\Http\Controllers\Transportasi\Motor;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Models\Motor;
use App\Models\OrderMotor;
use App\Models\HistoryMotor;
use App\Models\PencairanMotor;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class OrderMotorController extends Controller
{
    public function index()
    {
        $title = 'Order';
    
        // Mendapatkan ID mitra dari session
        $mitraId = Session::get('mitra_id');
        
        // Ambil data orders berdasarkan mitra_id dan hanya dengan payment_status 2
        $orders = OrderMotor::whereHas('motor', function ($query) use ($mitraId) {
            $query->where('mitra_id', $mitraId);
        })->where('payment_status', 2) // Filter berdasarkan payment_status 2
        ->with(['motor.mitra', 'user'])
        ->get();
    
        return view('mitra.data.transportasi.motor.order.index', compact('orders', 'title'));
    }

    public function show($id) 
    {
        // Ambil data order berdasarkan id yang diberikan
        $order_motor = OrderMotor::findOrFail($id);

        // Ambil data motor yang terkait dengan pesanan
        $motor = Motor::where('id', $order_motor->motor_id)->first();

        $title = 'Detail Order';
        
        // Pass data ke view
        return view('mitra.data.transportasi.motor.order.show', compact('order_motor', 'motor', 'title'));
    }

    public function moveToHistory($id)
    {
        // Mulai transaksi
        DB::beginTransaction();

        try {
            // Dapatkan order motor berdasarkan id
            $order = OrderMotor::find($id);

            if (!$order) {
                // Rollback transaksi jika order tidak ditemukan
                DB::rollBack();
                return response()->json(['status' => 'error', 'message' => 'Order not found'], 404);
            }

            // Pindahkan order ke tabel history_motors
            HistoryMotor::create([
                'uniq_motor' => $order->uniq_motor,
                'user_id' => $order->user_id,
                'invoice_number' => $order->invoice_number,
                'motor_id' => $order->motor_id,
                'subtotal' => $order->subtotal,
                'coupon_code' => $order->coupon_code,
                'discount' => $order->discount,
                'grand_total' => $order->grand_total,
                'payment_status' => $order->payment_status,
                'status_booking' => $order->status_booking,
                'order_type' => $order->order_type,
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

            // Simpan data ke tabel pencairan_motors
            PencairanMotor::create([
                'uniq_motor' => $order->uniq_motor,
                'user_id' => $order->user_id,
                'invoice_number' => $order->invoice_number,
                'motor_id' => $order->motor_id,
                'subtotal' => $order->subtotal,
                'coupon_code' => $order->coupon_code,
                'discount' => $order->discount,
                'grand_total' => $order->grand_total,
                'payment_status' => 2,
                'pencairan_status' => 1, // Penyesuaian status pencairan
                'status_booking' => 'Selesai',
                'order_type' => 'Motor',
                'image_bukti' => '', // Sesuaikan jika field ini ada di OrderMotor
                'deskripsi' => '', // Sesuaikan jika field ini ada di OrderMotor
                'title' => $order->title,
                'first_name' => $order->first_name,
                'last_name' => $order->last_name,
                'no_handphone' => $order->no_handphone,
                'email' => $order->email,
                'alamat_lengkap' => $order->alamat_lengkap,
                'tgl_booking' => $order->tgl_pinjam, // Sesuaikan dengan field baru
                'tgl_selesai' => $order->tgl_pengembalian, // Sesuaikan dengan field baru
                'durasi_booking' => $order->durasi_pinjam, // Sesuaikan dengan field baru
                'snap_token' => $order->snap_token,
                'note' => $order->note,
                'address' => $order->address,
            ]);

            // Hapus order dari tabel order_motors
            $order->delete();

            // Commit transaksi
            DB::commit();

            return response()->json(['status' => 'success', 'message' => 'Order moved to history and recorded in PencairanMotor successfully']);
        } catch (\Exception $e) {
            // Rollback transaksi jika ada kesalahan
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Failed to move order to history and record in PencairanMotor', 'error' => $e->getMessage()], 500);
        }
    }
}