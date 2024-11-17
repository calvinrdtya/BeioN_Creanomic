<?php

namespace App\Http\Controllers\UserOrder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Perjalanan;
use App\Models\Motor;
use App\Models\Mobil;
use App\Models\Perlengkapan;
use App\Models\Homestay;
use App\Models\OrderPerjalanan;
use App\Models\OrderMotor;
use App\Models\OrderMobil;
use App\Models\OrderPerlengkapan;
use App\Models\OrderHomestay;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;

class UserOrderController extends Controller
{
    public function index(Request $request, $order_id = null)
    {
        $title = 'Riwayat Order';

        $userId = auth()->id();

        // Ambil semua data pesanan berdasarkan user ID
        $orderPerjalanans = OrderPerjalanan::where('user_id', $userId)->with('perjalanan')->get();
        $orderMotors = OrderMotor::where('user_id', $userId)->with('motor')->get();
        $orderPerlengkapans = OrderPerlengkapan::where('user_id', $userId)->with('perlengkapan')->get();
        $orderMobils = OrderMobil::where('user_id', $userId)->with('mobil')->get();
        $orderHomestays = OrderHomestay::where('user_id', $userId)->with('homestay')->get();

        // Gabungkan semua koleksi dan urutkan berdasarkan created_at
        $orders = $orderPerjalanans
            ->concat($orderMotors)
            ->concat($orderPerlengkapans)
            ->concat($orderMobils)
            ->concat($orderHomestays)
            ->sortBy('created_at');

        // Ambil order spesifik berdasarkan order_id jika ada
        $orderDetails = [
            'orderPerjalanan' => $order_id ? $orderPerjalanans->firstWhere('perjalanan_id', $order_id) : null,
            'orderMotor' => $order_id ? $orderMotors->firstWhere('motor_id', $order_id) : null,
            'orderPerlengkapan' => $order_id ? $orderPerlengkapans->firstWhere('perlengkapan_id', $order_id) : null,
            'orderMobil' => $order_id ? $orderMobils->firstWhere('mobil_id', $order_id) : null,
            'orderHomestay' => $order_id ? $orderHomestays->firstWhere('homestay_id', $order_id) : null
        ];

        $type = $request->query('type');
        $orderTypes = [
            [
                'type' => 'semua',
                'title' => 'Semua',
                'count' => $orders->count(),
                'active' => $type === null || $type === 'semua'
            ],
            [
                'type' => 'perjalanan',
                'title' => 'Perjalanan',
                'count' => $orderPerjalanans->count(),
                'active' => $type === 'perjalanan',
            ],
            [
                'type' => 'motor',
                'title' => 'Motor',
                'count' => $orderMotors->count(),
                'active' => $type === 'motor',
            ],
            [
                'type' => 'perlengkapan',
                'title' => 'Perlengkapan',
                'count' => $orderPerlengkapans->count(),
                'active' => $type === 'perlengkapan',
            ],
            [
                'type' => 'mobil',
                'title' => 'Mobil',
                'count' => $orderMobils->count(),
                'active' => $type === 'mobil',
            ],
            [
                'type' => 'homestay',
                'title' => 'Homestay',
                'count' => $orderHomestays->count(),
                'active' => $type === 'homestay',
            ],
        ];

        switch ($type) {
            case 'perjalanan':
                $orders = $orderPerjalanans;
                break;

            case 'motor':
                $orders = $orderMotors;
                break;

            case 'perlengkapan':
                $orders = $orderPerlengkapans;
                break;

            case 'mobil':
                $orders = $orderMobils;
                break;

            case 'homestay':
                $orders = $orderHomestays;
                break;

            default:
                $orders = $orders;
                break;
        }

        // Kirimkan data ke view
        return view('front.user.order', [
            'orders' => $orders,
            'title' => $title,
            'orderDetails' => $orderDetails,
            'orderTypes' => $orderTypes,
        ]);
    }

    public function orderSelesai(Request $request, $order_id = null)
    {
        $userId = auth()->id();

        // Ambil semua data pesanan berdasarkan user ID
        $orderPerjalanans = OrderPerjalanan::where('user_id', $userId)->with('perjalanan')->get();
        $orderMotors = OrderMotor::where('user_id', $userId)->with('motor')->get();
        $orderPerlengkapans = OrderPerlengkapan::where('user_id', $userId)->with('perlengkapan')->get();
        $orderMobils = OrderMobil::where('user_id', $userId)->with('mobil')->get();
        $orderHomestays = OrderHomestay::where('user_id', $userId)->with('homestay')->get();

        // Gabungkan semua koleksi dan urutkan berdasarkan created_at
        $orders = $orderPerjalanans
            ->concat($orderMotors)
            ->concat($orderPerlengkapans)
            ->concat($orderMobils)
            ->concat($orderHomestays)
            ->sortBy('created_at');

        // Ambil order spesifik berdasarkan order_id jika ada
        $orderDetails = [
            'orderPerjalanan' => $order_id ? $orderPerjalanans->firstWhere('perjalanan_id', $order_id) : null,
            'orderMotor' => $order_id ? $orderMotors->firstWhere('motor_id', $order_id) : null,
            'orderPerlengkapan' => $order_id ? $orderPerlengkapans->firstWhere('perlengkapan_id', $order_id) : null,
            'orderMobil' => $order_id ? $orderMobils->firstWhere('mobil_id', $order_id) : null,
            'orderHomestay' => $order_id ? $orderHomestays->firstWhere('homestay_id', $order_id) : null
        ];

        // Kirimkan data ke view
        return view('front.user.order', [
            'orders' => $orders,
            'orderDetails' => $orderDetails
        ]);
    }

    public function getkota(request $request)
    {
        $id_provinsi = $request->id_provinsi;

        $kotas = Regency::where('province_id', $id_provinsi)->get();

        $option = "<option>Pilih Kota/Kabupaten</option>";
        foreach ($kotas as $kota) {
            $option .= "<option value='$kota->id'>$kota->name</option>";
        }
        echo $option;
    }

    public function getkecamatan(request $request)
    {
        $id_kota = $request->id_kota;

        $kecamatans = District::where('regency_id', $id_kota)->get();

        $option = "<option>Pilih Kecamatan</option>";
        foreach ($kecamatans as $kecamatan) {
            $option .= "<option value='$kecamatan->id'>$kecamatan->name</option>";
        }
        echo $option;
    }

    public function getdesa(request $request)
    {
        $id_kecamatan = $request->id_kecamatan;

        $desas = Village::where('district_id', $id_kecamatan)->get();

        $option = "<option>Pilih Desa</option>";
        foreach ($desas as $desa) {
            $option .= "<option value='$desa->id'>$desa->name</option>";
        }
        echo $option;
    }
}
