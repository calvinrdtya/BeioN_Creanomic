<?php

namespace App\Http\Controllers\Transportasi;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Transportasi;
use App\Models\Mitra;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Sopir;
use Illuminate\Support\Facades\File;

class TransportasiController extends Controller
{
    public function index_motor()
    {
        $title = 'Data Motor';
        // Ambil ID mitra dari sesi
        $mitraId = Session::get('mitra_id');

        // Mengambil alamat berdasarkan id mitra 
        $mitra = Mitra::findOrFail($mitraId);

        // Ambil daftar kategori transportasi milik mitra
        $categories = Category::where('mitra_id', $mitraId)->oldest('id')->get();

        // Ambil semua data transportasi milik mitra
        $transportasis = Transportasi::where('mitra_id', $mitraId)->oldest()->paginate(10);


        return view('mitra.data.transportasi.motor.index', compact('categories', 'transportasis', 'mitra', 'title'));
    }


    // public function create()
    // {
    //     // Ambil ID mitra dari sesi
    //     $mitraId = Session::get('mitra_id');

    //     // Ambil daftar kategori transportasi milik mitra
    //     $categories = Category::where('mitra_id', $mitraId)->oldest('id')->get();
    //     $categories = Category::where('name', 'motor')->get();

    //     // Periksa apakah ada kategori yang tersedia
    //     if ($categories->isEmpty()) {
    //         return redirect()->route('transportasi.index')->with('error', 'Please create a category first.');
    //     }

    //     return view('mitra.data.transportasi.create', compact('categories'));
    // }

    public function create_motor()
    {
        $title = 'Tambahkan Motor';
        // Ambil ID mitra dari sesi
        $mitraId = Session::get('mitra_id');

        $mitra = Mitra::find($mitraId);

        // Ambil daftar kategori transportasi milik mitra
        $categories = Category::where('mitra_id', $mitraId)->oldest('id')->get();

        // Periksa apakah ada kategori yang tersedia
        if ($categories->isEmpty()) {
            return redirect()->route('mitra.transportasi.motor')->with('error', 'Silahkan buat kategori terlebih dahulu');
        }

        // Ambil daftar kategori transportasi milik mitra
        // $categories = Category::whereRaw("LOWER(name) LIKE '%motor%'")->get();

        // // Periksa apakah ada kategori yang tersedia
        // if ($categories->isEmpty()) {
        //     return redirect()->route('mitra.transportasi.index')->with('error', 'Silahkan buat kategori terlebih dahulu');
        // }

        return view('mitra.data.transportasi.motor.create', compact('categories', 'mitra', 'title'));
    }
    // public function create_motor()
    // {
    //     // Ambil ID mitra dari sesi
    //     $mitraId = Session::get('mitra_id');

    //     // Temukan mitra berdasarkan ID
    //     $mitra = Mitra::find($mitraId);

    //     // Pastikan mitra ditemukan
    //     if (!$mitra) {
    //         return redirect()->route('mitra.transportasi.index')->with('error', 'Mitra tidak ditemukan');
    //     }

    //     // Ambil daftar kategori transportasi milik mitra
    //     $categories = Category::where('mitra_id', $mitraId)->oldest('id')->get();

    //     // Periksa apakah ada kategori yang tersedia
    //     if ($categories->isEmpty()) {
    //         return redirect()->route('mitra.transportasi.index')->with('error', 'Silahkan buat kategori terlebih dahulu');
    //     }

    //     // Kirim data mitra dan kategori ke view
    //     return view('mitra.data.transportasi.create_motor', compact('categories', 'mitra'));
    // }

    // public function create_mobil()
    // {
    //     // Ambil ID mitra dari sesi
    //     $mitraId = Session::get('mitra_id');

    //     // Temukan mitra berdasarkan ID
    //     $mitra = Mitra::find($mitraId);

    //     // Pastikan mitra ditemukan
    //     if (!$mitra) {
    //         return redirect()->route('mitra.transportasi.index')->with('error', 'Mitra tidak ditemukan');
    //     }

    //     // Ambil daftar kategori transportasi milik mitra
    //     $categories = Category::where('mitra_id', $mitraId)->oldest('id')->get();

    //     // Periksa apakah ada kategori yang tersedia
    //     if ($categories->isEmpty()) {
    //         return redirect()->route('mitra.transportasi.index')->with('error', 'Silahkan buat kategori terlebih dahulu');
    //     }

    //     // Kirim data mitra dan kategori ke view
    //     return view('mitra.data.transportasi.create_mobil', compact('categories', 'mitra'));
    // }

    public function create_mobil()
    {
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
             return redirect()->route('mitra.transportasi.index')->with('error', 'Silahkan buat kategori terlebih dahulu');
         }

        return view('mitra.data.transportasi.create_mobil', compact('categories', 'mitra'));
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirimkan dari formulir
        $request->validate([
            'title' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'bbm' => 'nullable|string',
            'layanan' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'alamat' => 'nullable|string',
            'qty' => 'required|integer',
            'price' => 'required|string',
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

        // Simpan data transportasi ke database
        $transportasi = Transportasi::create([
            'title' => $request->title,
            'jenis' => $request->jenis,
            'alamat' => $request->alamat,
            'bbm' => $request->bbm,
            'layanan' => $request->layanan,
            'deskripsi' => $request->deskripsi,
            'qty' => $request->qty,
            'price' => $request->price,
            'price_discount' => $request->price_discount,
            'final_price' => $request->final_price,
            'image' => $imageName,
        ]);

        // Set mitra_id ke data transportasi
        $transportasi->mitra_id = $request->session()->get('mitra_id');
        $transportasi->category_id = $request->get('category_id');
        $transportasi->save();

        // Redirect ke halaman index transportasi
        return redirect()->route('mitra.transportasi.index')->with('success', 'Transportasi Berhasil Ditambahkan.');
    }


    public function showMotor($transportasiId)
    {
        $title = 'Detail Motor';
        // Ambil ID mitra dari sesi
        $mitraId = Session::get('mitra_id');

        // Ambil daftar kategori transportasi milik mitra
        $categories = Category::where('mitra_id', $mitraId)->oldest('id')->get();

        // Ambil data transportasi milik mitra
        $transportasis = Transportasi::where('mitra_id', $mitraId)->oldest()->paginate(10);
        // Ambil data transportasi berdasarkan ID
        $transportasi = Transportasi::findOrFail($transportasiId);

        // Tampilkan view dengan data yang diperlukan
        return view('mitra.data.transportasi.motor.show', compact('transportasis', 'transportasi', 'categories', 'title'));
    }

    public function order()
    {
        // Ambil semua data transportasi, sesuaikan dengan kebutuhan Anda
        $transportasis = Transportasi::all();
        return view('mitra.data.transportasi.order.index', compact('transportasis'));
    }

    public function destroy($transportasiId)
    {
        $transportasi = Transportasi::findOrFail($transportasiId);
        $transportasi->delete();

        return redirect()->route('mitra.transportasi.index')->with('alert-success', 'Transportasi Sudah dihapus');
    }

    public function sopir()
    {
        $mitraId = Session::get('mitra_id');
        $sopirs = Sopir::where('mitra_id', $mitraId)->oldest()->paginate(10);
        return view('mitra.data.transportasi.sopir.index', compact('sopirs'));
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ktp' => 'required|file',
            'sim' => 'required|file',
            'alamat' => 'required|string',
            'usia' => 'required|integer',
            'status' => 'required|in:0,1',
        ]);

        $sopir = new Sopir($request->except(['_token', 'foto']));

        if ($request->hasFile('foto')) {
            $imageName = time() . '.' . $request->foto->getClientOriginalExtension();
            $request->foto->move(public_path('img'), $imageName);
            $sopir->foto = $imageName;
        }

        $sopir->mitra_id = Session::get('mitra_id');
        $sopir->save();

        return redirect()->route('mitra.sopir')->with('success', 'Sopir created successfully.');
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ktp' => 'nullable|file',
            'sim' => 'nullable|file',
            'alamat' => 'required|string',
            'usia' => 'required|integer',
            'status' => 'required|in:0,1',
        ]);

        $sopir = Sopir::findOrFail($id);
        $sopir->name = $request->name;
        $sopir->alamat = $request->alamat;
        $sopir->usia = $request->usia;
        $sopir->status = $request->status;

        if ($request->hasFile('foto')) {
            // Proses unggah foto dan simpan ke server
            $foto = $request->file('foto');
            $imageName = time() . '.' . $foto->extension();
            $foto->move(public_path('img'), $imageName);
            $sopir->foto = $imageName;
        }

        if ($request->hasFile('ktp')) {
            // Proses unggah KTP dan simpan ke server
            $ktp = $request->file('ktp');
            $ktpName = time() . '_ktp.' . $ktp->extension();
            $ktp->move(public_path('uploads'), $ktpName);
            $sopir->ktp = $ktpName;
        }

        if ($request->hasFile('sim')) {
            // Proses unggah SIM dan simpan ke server
            $sim = $request->file('sim');
            $simName = time() . '_sim.' . $sim->extension();
            $sim->move(public_path('uploads'), $simName);
            $sopir->sim = $simName;
        }

        $sopir->save();

        return redirect()->route('mitra.sopir')->with('success', 'Sopir updated successfully.');
    }


    public function hapus($id)
    {
        $sopir = Sopir::findOrFail($id);
        $sopir->delete();

        return redirect()->route('mitra.sopir')->with('success', 'Sopir deleted successfully.');
    }
}
