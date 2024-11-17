<?php

namespace App\Http\Controllers\Perlengkapan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Mitra;
use App\Models\BankPerlengkapan;
use Illuminate\Support\Facades\Auth;

class BankPerlengkapanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Bank Perlengkapan';
    
        // Pastikan pengguna sudah login
        if (!auth()->check()) {
            return redirect()->route('mitra.login')->with('error', 'Silakan login terlebih dahulu.');
        }
    
        // Ambil ID pengguna yang sedang login
        $userId = auth()->id();
    
        // Ambil data mitra berdasarkan user_id
        $mitra = Mitra::where('id', $userId)->first();
    
        if (!$mitra) {
            return redirect()->back()->with('error', 'Mitra tidak ditemukan.');
        }
    
        $mitraId = $mitra->id; // Atau sesuaikan dengan kolom yang sesuai
    
        // Ambil semua data dari tabel bank_perlengkapans berdasarkan mitra_id
        $bankPerlengkapans = BankPerlengkapan::where('mitra_id', $mitraId)->get();
    
        // Kirim data ke view
        return view('mitra.data.perlengkapan.bank.index', compact('title', 'bankPerlengkapans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Bank Perlengkapan';

        return view('mitra.data.perlengkapan.bank.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'bank' => 'required|string|max:255',
            'no_rekening' => 'required|numeric',
            'nama_pemilik' => 'required|string|max:255',
        ]);

        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('mitra.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil ID pengguna yang sedang login
        $userId = Auth::id();

        // Ambil data mitra berdasarkan user_id
        $mitra = Mitra::where('id', $userId)->first();

        if (!$mitra) {
            return redirect()->back()->with('error', 'Mitra tidak ditemukan.');
        }

        $mitraId = $mitra->id; // Ambil mitra_id dari tabel mitras

        // Simpan data ke tabel bank_perlengkapans
        BankPerlengkapan::create([
            'mitra_id' => $mitraId,
            'bank' => $request->input('bank'),
            'no_rekening' => $request->input('no_rekening'),
            'nama_pemilik' => $request->input('nama_pemilik'),
        ]);

        // Redirect atau response
        return redirect()->back()->with('success', 'Data bank berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'bank' => 'required|string|max:255',
            'no_rekening' => 'required|numeric', // Validasi bahwa no_rekening harus berupa angka
            'nama_pemilik' => 'required|string|max:255',
        ]);

        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('mitra.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil ID pengguna yang sedang login
        $userId = Auth::id();

        // Ambil data mitra berdasarkan user_id
        $mitra = Mitra::where('id', $userId)->first();

        if (!$mitra) {
            return redirect()->back()->with('error', 'Mitra tidak ditemukan.');
        }

        $mitraId = $mitra->id; // Ambil mitra_id dari tabel mitras

        // Cari data bank_perlengkapan berdasarkan ID dan mitra_id
        $bankPerlengkapan = BankPerlengkapan::where('id', $id)
                                            ->where('mitra_id', $mitraId)
                                            ->first();

        if (!$bankPerlengkapan) {
            return redirect()->back()->with('error', 'Data bank tidak berhasil diubah.');
        }

        // Perbarui data ke tabel bank_perlengkapans
        $bankPerlengkapan->update([
            'bank' => $request->input('bank'),
            'no_rekening' => $request->input('no_rekening'), // Pastikan no_rekening disimpan sebagai angka
            'nama_pemilik' => $request->input('nama_pemilik'),
        ]);

        // Redirect atau response
        return redirect()->back()->with('success', 'Data bank berhasil diperbarui.');
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
