<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Motor;
use App\Models\Mobil;
use App\Models\Perlengkapan;
use App\Models\Perjalanan;
use App\Models\Homestay;
use App\Models\Fasilitas;
use App\Models\Category;
use App\Models\Mitra;

class UserPageController extends Controller
{
    public function transportasi(Request $request)
    {
        $title = 'Transportasi';

        // SortBy
        $sortBy = $request->get('sortBy', 'populer');

        // Query untuk Motor
        $motorQuery = Motor::query();

        // Query untuk Mobil
        $mobilQuery = Mobil::query();

        // Sort berdasarkan harga
        if ($sortBy === 'termurah') {
            $motorQuery->orderBy('final_price', 'asc');
            $mobilQuery->orderBy('final_price', 'asc');
        } elseif ($sortBy === 'termahal') {
            $motorQuery->orderBy('final_price', 'desc');
            $mobilQuery->orderBy('final_price', 'desc');
        }

        // Mengambil data dari database
        $motors = $motorQuery->with('mitra')->get();
        $mobils = $mobilQuery->with('mitra')->get();

        // Menggabungkan data motor dan mobil
        $vehicles = $motors->merge($mobils);

        // Mengambil kategori yang hanya dari mitra dengan jenis 'transportasi motor' dan 'transportasi mobil'
        $categories = Category::whereHas('mitra', function ($query) {
            $query->whereIn('jenis', ['transportasi motor', 'transportasi mobil']);
        })->get();

        return view('front.pages.transportasi.index', compact('vehicles', 'sortBy', 'categories', 'title'));
    }

    public function showMotor($motorId)
    {
        $title = 'Detail Transportasi';

        // Ambil data motor berdasarkan ID
        $motor = Motor::findOrFail($motorId);

        // Tampilkan view dengan data yang diperlukan
        return view('front.pages.transportasi.order.motor.show', compact('title', 'motor'));
    }

    public function showMobil($mobilId)
    {
        $title = 'Detail Transportasi';

        // Ambil data motor berdasarkan ID
        $mobil = Mobil::findOrFail($mobilId);

        // Tampilkan view dengan data yang diperlukan
        return view('front.pages.transportasi.order.mobil.show', compact('title', 'mobil'));
    }

    public function mitra(Request $request)
    {
        $title = 'Mitra';

        $kotas = Mitra::where('jenis', 'perlengkapan')
            ->select('kota')
            ->distinct()
            ->get();

        $filterKota = $request->input('kota', null);
        $query = Mitra::query();

        if ($filterKota !== null && $filterKota !== 'Semua') {
            $kotaArray = explode(',', $filterKota);
            $query->whereIn('kota', $kotaArray);
        }

        $filterCategory = $request->input('category', null);
        if ($filterCategory !== null) {
            $query->whereHas('perlengkapans.category', function ($q) use ($filterCategory) {
                $q->where('id', $filterCategory);
            });
        }

        $mitras = $query->where('jenis', 'perlengkapan')->paginate(6);

        return view('front.pages.perlengkapan.index', compact('kotas', 'title', 'mitras', 'filterKota', 'filterCategory'));
    }


    public function showPerlengkapan($perlengkapan_id)
    {
        // Title Website
        $title = 'Detail Perlengkapan';

        // Ambil data motor berdasarkan ID
        $perlengkapan = Perlengkapan::findOrFail($perlengkapan_id);

        // Tampilkan view dengan data yang diperlukan
        return view('front.pages.perlengkapan.order.show', compact('title', 'perlengkapan'));
    }

    public function perjalanan(Request $request)
    {
        $title = 'Perjalanan';

        // Ambil data kota unik dari tabel perjalanans
        $kotas = Perjalanan::select('kota')->distinct()->get();

        // Ambil data Kategori unik dari tabel category yang terkait dengan mitra perjalanan
        $categories = Category::whereHas('mitra', function ($query) {
            $query->where('jenis', 'perjalanan');
        })->select('name')->distinct()->get();

        // Ambil filter lokasi dari request
        $lokasiFilter = $request->input('lokasi', ['all']); // default 'all'

        // Ambil filter kategori dari request (alias "aktifitas")
        $kategoriFilter = $request->input('aktifitas', ['all']); // default 'all'

        // Mulai query dasar untuk perjalanans
        $query = Perjalanan::query();

        // Filter berdasarkan lokasi
        if (!in_array('all', $lokasiFilter)) {
            $query->whereIn('kota', $lokasiFilter);
        }

        // Filter berdasarkan kategori (hanya untuk kategori milik mitra perjalanan)
        if (!in_array('all', $kategoriFilter)) {
            $query->whereHas('category', function ($query) use ($kategoriFilter) {
                $query->whereIn('name', $kategoriFilter)->whereHas('mitra', function ($subQuery) {
                    $subQuery->where('jenis', 'perjalanan');
                });
            });
        }

        // SortBy
        $sortBy = $request->get('sortBy', 'populer');
        switch ($sortBy) {
            case 'termurah':
                $query->orderBy('final_price', 'asc');
                break;
            case 'termahal':
                $query->orderBy('final_price', 'desc');
                break;
            default:
                // Sorting default berdasarkan popularitas (jika diperlukan)
                break;
        }

        // Ambil data perjalanans setelah filter dan sortBy
        $perjalanans = $query->get();

        return view('front.pages.perjalanan.index', compact('perjalanans', 'sortBy', 'kotas', 'categories', 'title'));
    }


    // public function filterByKota(Request $request)
    // {
    //     $title = 'Perjalanan';

    //     // Ambil data kota unik dari tabel perjalanans
    //     $kotas = Perjalanan::select('kota')->distinct()->get();

    //     // Ambil data Kategori unik dari tabel category yang terkait dengan mitra perjalanan
    //     $categories = Category::whereHas('mitra', function($query) {
    //         $query->where('jenis', 'perjalanan');
    //     })->select('name')->distinct()->get();

    //     // Ambil kota dari request
    //     $selectedKota = $request->input('kota');

    //     // Query untuk mengambil perjalanan berdasarkan kota
    //     $query = Perjalanan::query();

    //     if (!empty($selectedKota)) {
    //         $query->where('kota', $selectedKota);
    //     }

    //     // Ambil data perjalanans setelah filter kota
    //     $perjalanans = $query->get();

    //     return view('front.pages.perjalanan.index', compact('perjalanans', 'kotas', 'categories', 'title', 'selectedKota'));
    // }

    public function showPerjalanan($perjalananId)
    {
        $title = 'Detail Perjalanan';

        $perjalanan = Perjalanan::findOrFail($perjalananId);
        $itineraryString = $perjalanan->itinerary;
        $itineraries = explode(' / ', $itineraryString);
        $decodedItineraries = array_map(function ($itinerary) {
            return json_decode($itinerary, true);
        }, $itineraries);

        // Tampilkan view dengan data yang diperlukan
        return view('front.pages.perjalanan.detail', compact('perjalanan', 'decodedItineraries', 'title'));
    }

    public function homestay(Request $request)
    {
        $title = 'Homestay';

        // SortBy
        $sortBy = $request->get('sortBy', 'populer');
        // SortBy
        if ($sortBy === 'all') {
            $homestays = Homestay::all();
        } else {
            switch ($sortBy) {
                case 'termurah':
                    $homestays = Homestay::orderBy('final_price', 'desc')->get();
                    break;
                case 'termahal':
                    $homestays = Homestay::orderBy('final_price', 'asc')->get();
                    break;
                default:
                    $homestays = Homestay::all();
                    break;
            }
        }
        return view('front.pages.homestay.index', compact('homestays', 'sortBy', 'title'));
    }

    public function showHomestay($uniq_id)
    {
        $title = 'Detail Homestay';

        // Temukan homestay berdasarkan uniq_id
        $homestay = Homestay::where('uniq_id', $uniq_id)->firstOrFail();

        // Temukan fasilitas berdasarkan homestay_id
        $fasilitas = Fasilitas::where('homestay_id', $homestay->id)->first();

        // Jika fasilitas tidak ditemukan, bisa mengatur deskripsiArray menjadi array kosong
        $deskripsiArray = $fasilitas ? explode(', ', $fasilitas->deskripsi) : [];

        // Tampilkan view dengan data yang diperlukan
        return view('front.pages.homestay.show', compact('homestay', 'title', 'deskripsiArray'));
    }

    public function shop(Request $request, int $mitra_id)
    {
        $title = 'Temukan Perlengkapan';

        $mitra = Mitra::find($mitra_id);

        if (!$mitra) {
            abort(404);
        }

        $sortOrder = request()->get('sort', 'asc');
        $sortOrder = in_array($sortOrder, ['asc', 'desc']) ? $sortOrder : 'asc';

        $perlengkapan = Perlengkapan::where('mitra_id', $mitra_id)
            ->orderBy('final_price', $sortOrder)
            ->paginate(6);

        return view('front.pages.perlengkapan.shop', compact('title', 'perlengkapan', 'sortOrder', 'mitra'));
    }
}
