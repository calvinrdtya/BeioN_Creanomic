<?php

namespace App\Http\Controllers\Transportasi\Motor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Motor;
use App\Models\OrderMotor;
use App\Models\HistoryMotor;
use App\Models\Mitra;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MotorController extends Controller
{
    public function index()
    {
        $title = 'Data Motor';
        // Ambil ID mitra dari sesi
        $mitraId = Session::get('mitra_id');

        // Mengambil alamat berdasarkan id mitra 
        $mitra = Mitra::findOrFail($mitraId);

        // Ambil daftar kategori transportasi milik mitra
        $categories = Category::where('mitra_id', $mitraId)->oldest('id')->get();

        // Ambil semua data transportasi milik mitra
        $motors = Motor::where('mitra_id', $mitraId)->oldest()->paginate(10);


        return view('mitra.data.transportasi.motor.index', compact('categories', 'motors', 'mitra', 'title'));
    }

    public function create()
    {
        $title = 'Tambahkan Motor';

        // Ambil ID mitra dari sesi
        $mitraId = Session::get('mitra_id');

        $mitra = Mitra::find($mitraId);

        // Ambil daftar kategori transportasi milik mitra
        $categories = Category::where('mitra_id', $mitraId)->oldest('id')->get();

        // Periksa apakah ada kategori yang tersedia
        if ($categories->isEmpty()) {
            return redirect()->route('mitra.motor')->with('error', 'Silahkan buat kategori terlebih dahulu');
        }

        return view('mitra.data.transportasi.motor.create', compact('categories', 'mitra', 'title'));
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

        // Simpan data motor ke database
        $motor = Motor::create([
            'title' => $request->title,
            'jenis' => $request->jenis,
            'alamat' => $request->alamat,
            'deskripsi' => $request->deskripsi,
            'qty' => $request->qty,
            'price' => $request->price,
            'price_discount' => $request->price_discount,
            'final_price' => $request->final_price,
            'image' => $imageName,
            'status' => $request->status,
        ]);

        // Set mitra_id dan category_id ke data motor
        $motor->mitra_id = $request->session()->get('mitra_id');
        $motor->category_id = $request->category_id;
        $motor->save();

        // Redirect ke halaman index motor
        return redirect()->route('mitra.motor')->with('success', 'Motor Berhasil Ditambahkan.');
    }

    public function show($motorId)
    {
        $title = 'Detail Motor';

        // Ambil ID mitra dari sesi
        $mitraId = Session::get('mitra_id');

        // Ambil daftar kategori transportasi milik mitra
        $categories = Category::where('mitra_id', $mitraId)->oldest('id')->get();

        // Ambil data transportasi milik mitra
        $motors = Motor::where('mitra_id', $mitraId)->oldest()->paginate(10);
        // Ambil data transportasi berdasarkan ID
        $motor = Motor::findOrFail($motorId);

        // Tampilkan view dengan data yang diperlukan
        return view('mitra.data.transportasi.motor.show', compact('motors', 'motor', 'categories', 'title'));
    }

    public function history()
    {
        $title = 'History';

        // Mendapatkan ID mitra dari session
        $mitraId = Session::get('mitra_id');

        // Mengambil data dari tabel history_motors berdasarkan mitra_id melalui relasi motor dan mitra
        $historyMotors = HistoryMotor::whereHas('motor', function ($query) use ($mitraId) {
            $query->where('mitra_id', $mitraId);
        })->get();

        return view('mitra.data.transportasi.motor.history.index', compact('title', 'historyMotors'));
    }

    public function showHistory()
    {
        return view('mitra.data.transportasi.motor.history.index');
    }

    

    // public function order()
    // {
    //     $title = 'Isi Data Diri';
    //     // Ambil semua data transportasi, sesuaikan dengan kebutuhan Anda
    //     $motors = Motor::all();
    //     return view('mitra.data.transportasi.order.index', compact('motors', 'title'));
    // }

    // public function destroy($transportasiId)
    // {
    //     $transportasi = Transportasi::findOrFail($transportasiId);
    //     $transportasi->delete();

    //     return redirect()->route('mitra.transportasi.index')->with('alert-success', 'Transportasi Sudah dihapus');
    // }

    // public function sopir()
    // {
    //     $mitraId = Session::get('mitra_id');
    //     $sopirs = Sopir::where('mitra_id', $mitraId)->oldest()->paginate(10);
    //     return view('mitra.data.transportasi.sopir.index', compact('sopirs'));
    // }

    // public function simpan(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'ktp' => 'required|file',
    //         'sim' => 'required|file',
    //         'alamat' => 'required|string',
    //         'usia' => 'required|integer',
    //         'status' => 'required|in:0,1',
    //     ]);

    //     $sopir = new Sopir($request->except(['_token', 'foto']));

    //     if ($request->hasFile('foto')) {
    //         $imageName = time() . '.' . $request->foto->getClientOriginalExtension();
    //         $request->foto->move(public_path('img'), $imageName);
    //         $sopir->foto = $imageName;
    //     }

    //     $sopir->mitra_id = Session::get('mitra_id');
    //     $sopir->save();

    //     return redirect()->route('mitra.sopir')->with('success', 'Sopir created successfully.');
    // }

    // public function edit(Request $request, $id)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'ktp' => 'nullable|file',
    //         'sim' => 'nullable|file',
    //         'alamat' => 'required|string',
    //         'usia' => 'required|integer',
    //         'status' => 'required|in:0,1',
    //     ]);

    //     $sopir = Sopir::findOrFail($id);
    //     $sopir->name = $request->name;
    //     $sopir->alamat = $request->alamat;
    //     $sopir->usia = $request->usia;
    //     $sopir->status = $request->status;

    //     if ($request->hasFile('foto')) {
    //         // Proses unggah foto dan simpan ke server
    //         $foto = $request->file('foto');
    //         $imageName = time() . '.' . $foto->extension();
    //         $foto->move(public_path('img'), $imageName);
    //         $sopir->foto = $imageName;
    //     }

    //     if ($request->hasFile('ktp')) {
    //         // Proses unggah KTP dan simpan ke server
    //         $ktp = $request->file('ktp');
    //         $ktpName = time() . '_ktp.' . $ktp->extension();
    //         $ktp->move(public_path('uploads'), $ktpName);
    //         $sopir->ktp = $ktpName;
    //     }

    //     if ($request->hasFile('sim')) {
    //         // Proses unggah SIM dan simpan ke server
    //         $sim = $request->file('sim');
    //         $simName = time() . '_sim.' . $sim->extension();
    //         $sim->move(public_path('uploads'), $simName);
    //         $sopir->sim = $simName;
    //     }

    //     $sopir->save();

    //     return redirect()->route('mitra.sopir')->with('success', 'Sopir updated successfully.');
    // }


    // public function hapus($id)
    // {
    //     $sopir = Sopir::findOrFail($id);
    //     $sopir->delete();

    //     return redirect()->route('mitra.sopir')->with('success', 'Sopir deleted successfully.');
    // }
}
