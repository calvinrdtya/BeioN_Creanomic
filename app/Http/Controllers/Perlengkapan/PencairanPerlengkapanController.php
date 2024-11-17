<?php

namespace App\Http\Controllers\Perlengkapan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\PencairanPerlengkapan;
use App\Models\Mitra;
use App\Models\HistoryPerlengkapan;
use App\Models\OrderPerlengkapan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PencairanPerlengkapanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Pencairan';

        // Ambil ID mitra dari sesi
        $mitraId = Session::get('mitra_id');

        // Mengambil alamat berdasarkan id mitra 
        $mitra = Mitra::findOrFail($mitraId);

        // Ambil daftar kategori transportasi milik mitra
        $categories = Category::where('mitra_id', $mitraId)->oldest('id')->get();

        // Ambil semua data pencairan perlengkapan milik mitra
        $pencairanPerlengkapans = PencairanPerlengkapan::where('mitra_id', $mitraId)
            ->oldest('id')
            ->paginate(10);

        return view('mitra.data.perlengkapan.pencairan.index', compact('categories', 'pencairanPerlengkapans', 'mitra', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Ambil data pencairan_perlengkapan berdasarkan id dan mitra_id
        $pencairanPerlengkapan = PencairanPerlengkapan::where('id', $id)
            ->where('mitra_id', auth()->user()->mitra_id)
            ->firstOrFail(); // Mengambil data pertama, jika tidak ada maka error 404

        $title = 'Detail Pencairan';

        // Kirim data ke view
        return view('mitra.data.perlengkapan.pencairan.show', compact('pencairanPerlengkapan', 'title'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
