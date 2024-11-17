<?php

namespace App\Http\Controllers\mitra;

use App\Charts\MonthlyUsersChart;
use App\Charts\PendapatanBulanan;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\OrderMotor;
use App\Models\OrderMobil;
use App\Models\OrderPerlengkapan;
use App\Models\OrderPerjalanan;
use App\Models\OrderHomestay;
use App\Models\Order;
use App\Models\Product;
use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(PendapatanBulanan $chart)
    {
        $title = 'Dashboard';

        // Ambil ID pengguna yang sedang login
        $userId = Auth::id(); // Ambil ID pengguna yang sedang login dari Auth

        if (!$userId) {
            // Jika tidak ada user yang sedang login, return dengan error atau redirect
            return redirect()->route('mitra.login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Ambil data mitra berdasarkan ID pengguna yang login
        $mitra = Mitra::find($userId);
        
        if (!$mitra) {
            // Jika mitra tidak ditemukan, kembalikan error atau redirect
            return redirect()->route('dashboard')->with('error', 'Data tidak ditemukan.');
        }

        $mitraId = $mitra->id; // Ambil ID mitra

        // Hitung jumlah order per jenis berdasarkan ID mitra
        $orderMotorCount = OrderMotor::where('mitra_id', $mitraId)->count();
        $orderMobilCount = OrderMobil::where('mitra_id', $mitraId)->count();
        $orderPerjalananCount = OrderPerjalanan::where('mitra_id', $mitraId)->count();
        $orderPerlengkapanCount = OrderPerlengkapan::where('mitra_id', $mitraId)->count();
        // $orderHomestayCount = OrderHomestay::where('mitra_id', $mitraId)->count();

        // Hitung total pendapatan perlengkapan untuk mitra yang sedang login
        $totalPendapatanPerlengkapan = OrderPerlengkapan::where('mitra_id', $mitraId)->sum('grand_total');

        // Hitung total pendapatan dan informasi lainnya sesuai dengan kebutuhan
        $currentMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
        $currentMonthEarnings = Order::where('payment_status', 2)
            ->where('updated_at', '>=', $currentMonth)
            ->sum('grand_total');

        $totalEarnings = Order::where('payment_status', 2)->sum('grand_total');

        $lastMonthStartDate = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $lastMonthEndDate = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');

        $LastMonthEarnings = Order::where('payment_status', 2)
            ->whereDate('updated_at', '>=', $lastMonthStartDate)
            ->whereDate('updated_at', '<=', $lastMonthEndDate)
            ->sum('grand_total');

        // Hitung jumlah order bulan lalu dan bulan ini
        $orderBulanLalu = OrderPerlengkapan::where('mitra_id', $mitraId)
            ->whereBetween('created_at', [$lastMonthStartDate, $lastMonthEndDate])
            ->count();

        $orderBulanIni = OrderPerlengkapan::where('mitra_id', $mitraId)
            ->whereBetween('created_at', [$currentMonth, Carbon::now()->endOfMonth()->format('Y-m-d')])
            ->count();

        $data = [
            'orderMotorCount' => $orderMotorCount,
            'orderMobilCount' => $orderMobilCount,
            'orderPerjalananCount' => $orderPerjalananCount,
            'orderPerlengkapanCount' => $orderPerlengkapanCount,
            // 'orderHomestayCount' => $orderHomestayCount,
            'currentMonthEarnings' => $currentMonthEarnings,
            'totalEarnings' => $totalEarnings,
            'LastMonthEarnings' => $LastMonthEarnings,
            'totalPendapatanPerlengkapan' => $totalPendapatanPerlengkapan, // Tambahkan total pendapatan perlengkapan
            'orderBulanLalu' => $orderBulanLalu, // Tambahkan jumlah order bulan lalu
            'orderBulanIni' => $orderBulanIni,   // Tambahkan jumlah order bulan ini
            'chart' => $chart->build(),
        ];

        return view('mitra.dashboard', compact('data', 'title'));
    }



    public function logout()
    {
        Auth::guard('mitra')->logout();
        return redirect()->route('mitra.login');
    }
}
