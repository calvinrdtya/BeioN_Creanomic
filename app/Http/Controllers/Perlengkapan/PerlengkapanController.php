<?php

namespace App\Http\Controllers\Perlengkapan;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HistoryEcotourism;
use App\Models\Mitra;
use App\Models\Perlengkapan;
use App\Models\HistoryPerlengkapan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PerlengkapanController extends Controller
{
    public function index()
    {
        $title = 'Perlengkapan';

        // Ambil ID mitra dari sesi
        $mitraId = Session::get('mitra_id');
        // $perlengkapans = Perlengkapan::all();

        // Ambil daftar kategori perlengkapan milik mitra
        $categories = Category::where('mitra_id', $mitraId)->oldest('id')->get();

        // Ambil data perlengkapan milik mitra
        $perlengkapans = Perlengkapan::where('mitra_id', $mitraId)->oldest()->paginate(10);

        return view('mitra.data.perlengkapan.index', compact('categories', 'perlengkapans', 'title'));
    }

    public function create()
    {
        $title = 'Tambah Perlengkapan';

        // Ambil ID mitra dari sesi
        $mitraId = Session::get('mitra_id');

        $mitra = Mitra::find($mitraId); //hapus lek gasido

        // Ambil daftar kategori perlengkapan milik mitra
        $categories = Category::where('mitra_id', $mitraId)->oldest('id')->get();

        // Periksa apakah ada kategori yang tersedia
        if ($categories->isEmpty()) {
            return redirect()->route('mitra.perlengkapan.index')->with('error', 'Tambah kategori terlebih dahulu.');
        }

        return view('mitra.data.perlengkapan.create', compact('categories', 'mitra', 'title'));
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirimkan dari formulir
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'qty' => 'required|integer',
            'deskripsi' => 'required|string|max:5000',
            'kota' => 'required|string|max:5000',
            'price' => 'required|numeric',
            'price_discount' => 'nullable|numeric',
            'final_price' => 'nullable|numeric',
            'status' => 'required|in:0,1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img'), $imageName);
        }

        // Simpan data perlengkapan ke database
        $perlengkapan = new Perlengkapan();
        $perlengkapan->title = $validated['title'];
        $perlengkapan->qty = $validated['qty'];
        $perlengkapan->deskripsi = $validated['deskripsi'];
        $perlengkapan->kota = $validated['kota'];
        $perlengkapan->price = $validated['price'];
        $perlengkapan->price_discount = $validated['price_discount'] ?? null;
        $perlengkapan->final_price = $validated['final_price'];
        $perlengkapan->status = $validated['status'];
        $perlengkapan->image = $imageName;
        $perlengkapan->mitra_id = $request->session()->get('mitra_id');
        $perlengkapan->category_id = $request->category_id;
        $perlengkapan->save();

        // Redirect ke halaman index perlengkapan
        return redirect()->route('mitra.perlengkapan.index')->with('success', 'Perlengkapan Berhasil Ditambahkan.');
    }

    public function show($perlengkapanId)
    {
        $title = 'Detail Perlengkapan';
        $perlengkapan = Perlengkapan::findOrFail($perlengkapanId);
        return view('mitra.data.perlengkapan.show', compact('title', 'perlengkapan'));
    }

    public function update($perlengkapanId, Request $request)
    {
        // Cari data perlengkapan berdasarkan ID
        $perlengkapan = Perlengkapan::find($perlengkapanId);

        // Jika data tidak ditemukan, kirim pesan error dan redirect kembali
        if (empty($perlengkapan)) {
            return redirect()->back()->with('error', 'Perlengkapan tidak ditemukan');
        }

        // Validasi input dari request
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'qty' => 'required|integer',
            'kota' => 'required|string',
            'deskripsi' => 'required|string',
            'price' => 'required|numeric',
            'price_discount' => 'nullable|numeric',
            'final_price' => 'required|numeric',
            'status' => 'required|in:0,1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Jika validasi gagal, redirect kembali dengan error dan input sebelumnya
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'title' => $request->title,
            'qty' => $request->qty,
            'kota' => $request->kota,
            'deskripsi' => $request->deskripsi,
            'price' => $request->price,
            'price_discount' => $request->price_discount,
            'final_price' => $request->final_price,
            'category_id' => $request->category_id,
            'status' => $request->status,
        ];

        // Jika ada file gambar baru diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($perlengkapan->image && File::exists(public_path('img/' . $perlengkapan->image))) {
                File::delete(public_path('img/' . $perlengkapan->image));
            }

            // Simpan gambar baru
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img'), $imageName);
            $perlengkapan->image = $imageName;

            $data['image'] = $imageName;
        }

        // Hitung final_price jika diskon ada
        // if ($request->price_discount) {
        //     $finalPrice = $request->price - ($request->price * $request->price_discount / 100);
        // } else {
        //     $finalPrice = $request->price;
        // }

        // Update data perlengkapan dengan input baru
        $perlengkapan->update($data);

        // Kirim pesan sukses dan redirect ke halaman index
        return redirect()->route('mitra.perlengkapan.index')->with('success', 'Perlengkapan berhasil di update');
    }

    public function destroy($perlengkapanId)
    {
        $perlengkapan = Perlengkapan::findOrFail($perlengkapanId);

        if ($perlengkapan->image && File::exists(public_path('img/' . $perlengkapan->image))) {
            File::delete(public_path('img/' . $perlengkapan->image));
        }

        $perlengkapan->delete();

        return redirect()->route('mitra.perlengkapan.index')->with('error', 'Perlengkapan berhasil dihapus');
    }

    public function history()
    {
        $title = 'History';

        // Mendapatkan ID mitra dari session
        $mitraId = Session::get('mitra_id');

        // Validasi jika mitra_id tidak ditemukan di session
        if (!$mitraId) {
            return redirect()->back()->with('error', 'Mitra ID tidak ditemukan.');
        }

        // Mengambil data dari tabel history_perlengkapans berdasarkan mitra_id
        $historyPerlengkapans = HistoryPerlengkapan::whereHas('perlengkapan', function ($query) use ($mitraId) {
            $query->where('mitra_id', $mitraId);
        })->get();

        return view('mitra.data.perlengkapan.history.index', compact('title', 'historyPerlengkapans'));
    }

    public function dropoff()
    {
        $title = 'Dropoff';

        $mitraId = auth()->user()->id;

        $histories = HistoryEcotourism::where('mitra_id', $mitraId)->latest()->get();

        return view('mitra.data.perlengkapan.dropoff.index', compact('title', 'histories'));
    }

    public function dropoffDetail($invoice_id)
    {
        $title = 'Detail Dropoff';

        $history = HistoryEcotourism::where('invoice_id', $invoice_id)
            ->where('status', '0')
            ->where('mitra_id', auth()->user()->id)
            ->first();

        if (!$history) {
            abort(404);
        }

        return view('mitra.data.perlengkapan.dropoff.detail', compact('title', 'history'));
    }

    public function dropoffUpdate(Request $request, $invoice_id)
    {
        try {
            $historyEcotourism = HistoryEcotourism::where('invoice_id', $invoice_id)
                ->where('status', '0')
                ->where('mitra_id', auth()->user()->id)
                ->first();

            if (!$historyEcotourism) {
                throw new \Exception('Transaksi ini tidak ditemukan!');
            }

            if ($historyEcotourism->status != 0) {
                throw new \Exception('Transaksi ini sudah di konfirmasi!');
            }

            $historyEcotourism->update([
                'status' => $request->status,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('mitra.perlengkapan.dropoff')->with('error', $e->getMessage());
        }

        return redirect()->route('mitra.perlengkapan.dropoff')->with('success', 'Transaksi di konfirmasi');
    }

    public function profil()
    {

        $title = 'Profil';

        $user = auth()->user();

        return view('mitra.data.perlengkapan.profil.index', compact('title', 'user'));
    }

    public function updateProfile(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'owner' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'old_logo' => 'nullable|string|max:255',
            'logo_name' => 'nullable|string|max:255',
            'pic' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $mitra = Mitra::find($id);
        if (!$mitra) {
            return redirect()->back()->with('error', 'Mitra tidak ditemukan.');
        }

        $data = $validator->validated();

        if ($request->hasFile('logo')) {
            if ($mitra->logo && File::exists(public_path('img/' . $mitra->logo))) {
                File::delete(public_path('img/' . $mitra->logo));
            }

            $imageName = time() . '_' . $request->file('logo')->getClientOriginalName();
            $request->file('logo')->move(public_path('img'), $imageName);

            $data['logo'] = $imageName;
        } else if ($data['old_logo'] !== $data['logo_name']) {
            if ($mitra->logo && File::exists(public_path('img/' . $mitra->logo))) {
                File::delete(public_path('img/' . $mitra->logo));
            }

            $data['logo'] = null;
        }

        $mitra->update($data);

        return redirect()->back()->with('success', 'Profil mitra berhasil diperbarui.');
    }

    // public function showHistory($motorId)
    // {
    //     $title = 'Detail Motor';

    //     // Ambil ID mitra dari sesi
    //     $mitraId = Session::get('mitra_id');

    //     // Ambil daftar kategori transportasi milik mitra
    //     $categories = Category::where('mitra_id', $mitraId)->oldest('id')->get();

    //     // Ambil data transportasi milik mitra
    //     $motors = Motor::where('mitra_id', $mitraId)->oldest()->paginate(10);
    //     // Ambil data transportasi berdasarkan ID
    //     $motor = Motor::findOrFail($motorId);

    //     // Tampilkan view dengan data yang diperlukan
    //     return view('mitra.data.transportasi.motor.show', compact('motors', 'motor', 'categories', 'title'));
    // }
}
