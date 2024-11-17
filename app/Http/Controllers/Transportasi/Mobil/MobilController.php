<?php

namespace App\Http\Controllers\Transportasi\Mobil;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Mobil;
use App\Models\Mitra;
use Illuminate\Support\Facades\Session;

class MobilController extends Controller
{
    public function index()
    {
        $title = 'Data Mobil';
        // Ambil ID mitra dari sesi
        $mitraId = Session::get('mitra_id');

        // Mengambil alamat berdasarkan id mitra 
        $mitra = Mitra::findOrFail($mitraId);

        // Ambil daftar kategori transportasi milik mitra
        $categories = Category::where('mitra_id', $mitraId)->oldest('id')->get();

        // Ambil semua data transportasi milik mitra
        $mobils = Mobil::where('mitra_id', $mitraId)->oldest()->paginate(10);

        return view('mitra.data.transportasi.mobil.index', compact('categories', 'mobils', 'mitra', 'title'));
    }

    public function create()
    {
        $title = 'Tambahkan Mobil';
        // Ambil ID mitra dari sesi
        $mitraId = Session::get('mitra_id');

        $mitra = Mitra::find($mitraId);

        // Ambil daftar kategori transportasi kecuali yang mengandung "motor"
        // $categories = Category::whereRaw("LOWER(name) NOT LIKE '%mobil%'")->get();

        // // Periksa apakah ada kategori yang tersedia
        // if ($categories->isEmpty()) {
        //     return redirect()->route('mitra.transportasi.index')->with('error', 'Silahkan buat kategori terlebih dahulu');
        // }

         // Ambil daftar kategori transportasi milik mitra
         $categories = Category::where('mitra_id', $mitraId)->oldest('id')->get();

         // Periksa apakah ada kategori yang tersedia
         if ($categories->isEmpty()) {
             return redirect()->route('mitra.mobil.index')->with('error', 'Silahkan buat kategori terlebih dahulu');
         }

        return view('mitra.data.transportasi.mobil.create', compact('categories', 'mitra', 'title'));
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirimkan dari formulir
        $request->validate([
            'title' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'alamat' => 'nullable|string',
            'qty' => 'required|integer',
            'price' => 'required|string',
            'bbm' => 'required|string',
            'layanan' => 'required|string',
            'kota' => 'required|string',
            'final_price' => 'nullable|string',
            'price_discount' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img'), $imageName);
        }

        // Simpan data mobil ke database
        $mobil = Mobil::create([
            'title' => $request->title,
            'jenis' => $request->jenis,
            'alamat' => $request->alamat,
            'deskripsi' => $request->deskripsi,
            'qty' => $request->qty,
            'bbm' => $request->bbm,
            'layanan' => $request->layanan,
            'kota' => $request->kota,
            'price' => $request->price,
            'price_discount' => $request->price_discount,
            'final_price' => $request->final_price,
            'image' => $imageName,
            'status' => $request->status,
        ]);

        // Set mitra_id dan category_id ke data mobil
        $mobil->mitra_id = $request->session()->get('mitra_id');
        $mobil->category_id = $request->category_id;
        $mobil->save();

        // Redirect ke halaman index mobil
        return redirect()->route('mitra.mobil')->with('success', 'Mobil Berhasil Ditambahkan.');
    }

    public function show($mobilId)
    {
        $title = 'Detail Mobil';
        // Ambil ID mitra dari sesi
        $mitraId = Session::get('mitra_id');

        // Ambil daftar kategori transportasi milik mitra
        $categories = Category::where('mitra_id', $mitraId)->oldest('id')->get();

        // Ambil data transportasi milik mitra
        $mobils = Mobil::where('mitra_id', $mitraId)->oldest()->paginate(10);
        
        // Ambil data transportasi berdasarkan ID
        $mobil = Mobil::findOrFail($mobilId);

        // Tampilkan view dengan data yang diperlukan
        return view('mitra.data.transportasi.mobil.show', compact('mobils', 'mobil', 'categories', 'title'));
    }
}
