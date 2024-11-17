<?php

namespace App\Http\Controllers\Transportasi\Mobil;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Sopir;

class SopirController extends Controller
{
    public function index()
    {
        $title = 'Sopir';
        $mitraId = Session::get('mitra_id');
        $sopirs = Sopir::where('mitra_id', $mitraId)->oldest()->paginate(10);

        return view('mitra.data.transportasi.mobil.sopir.index', compact('sopirs', 'title'));
    }

    public function create()
    {
        $title = 'Tambah Sopir';

        // Ambil ID mitra dari sesi
        $mitraId = Session::get('mitra_id');

        return view('mitra.data.transportasi.mobil.sopir.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ktp' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'sim' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'alamat' => 'required|string',
            'usia' => 'required|integer',
            'status' => 'required|in:0,1',
        ]);

        $sopir = new Sopir($request->except(['_token', 'foto', 'ktp', 'sim']));

        if ($request->hasFile('foto')) {
            $imageFoto = time() . '_' . uniqid() . '.' . $request->foto->getClientOriginalExtension();
            $request->foto->move(public_path('img'), $imageFoto);
            $sopir->foto = $imageFoto;
        }
        if ($request->hasFile('ktp')) {
            $imageKtp = time() . '_' . uniqid() . '.' . $request->ktp->getClientOriginalExtension();
            $request->ktp->move(public_path('img'), $imageKtp);
            $sopir->ktp = $imageKtp;
        }
        if ($request->hasFile('sim')) {
            $imageSim = time() . '_' . uniqid() . '.' . $request->sim->getClientOriginalExtension();
            $request->sim->move(public_path('img'), $imageSim);
            $sopir->sim = $imageSim;
        }

        $sopir->mitra_id = Session::get('mitra_id');
        $sopir->save();

        return redirect()->route('mitra.sopir')->with('success', 'Sopir created successfully.');
    }

    public function show($sopirId)
    {
        $title = 'Detail Sopir';

        // Ambil ID mitra dari sesi
        $mitraId = Session::get('mitra_id');

        // Ambil data transportasi milik mitra
        $sopirs = Sopir::where('mitra_id', $mitraId)->oldest()->paginate(10);

        // Ambil data transportasi berdasarkan ID
        $sopir = Sopir::findOrFail($sopirId);

        // Tampilkan view dengan data yang diperlukan
        return view('mitra.data.transportasi.mobil.sopir.show', compact('sopirs', 'sopir', 'title'));
    }

}
