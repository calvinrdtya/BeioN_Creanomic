<?php

namespace App\Http\Controllers\Homestay;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use App\Models\homestay;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function index()
    {
        $title = 'Fasilitas';
    
        // Ambil mitra_id dari session
        $mitraId = Session::get('mitra_id');
    
        // Ambil data homestay berdasarkan mitra_id
        $homestays = Homestay::where('mitra_id', $mitraId)->oldest()->get();
    
        if ($homestays->isEmpty()) {
            return redirect()->route('mitra.homestay.index')->with('error', 'Please create a homestay first.');
        }
    
        $fasilitas = Fasilitas::where('mitra_id', $mitraId)
                              ->with('homestay')
                              ->oldest()
                              ->paginate(10);
    
        return view('mitra.data.homestay.fasilitas.index', compact('homestays', 'fasilitas', 'title'));
    }    
    
    public function store(Request $request)
    {
        $request->validate([
            'homestay_id' => 'required|exists:homestays,id',
            'fasilitas' => 'required|array',
            'fasilitas.*' => 'string',
            'fasilitas_tambahan' => 'required|string'
        ]);

        $mitraId = Session::get('mitra_id');

        $fasilitas = implode(', ', $request->fasilitas);
        $fasilitasTambahan = $request->fasilitas_tambahan;

        Fasilitas::create([
            'homestay_id' => $request->homestay_id,
            'title' => $fasilitas,
            'deskripsi' => $fasilitasTambahan,
            'mitra_id' => $mitraId,
        ]);

        return redirect()->route('homestay.fasilitas.index')->with('success', 'Fasilitas berhasil dibuat.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fasilitas' => 'required|array',
            'fasilitas.*' => 'string'
        ]);

        $fasilitasTitle = implode(', ', $request->fasilitas);

        $fasilitas = Fasilitas::findOrFail($id);
        $fasilitas->update([
            'title' => $fasilitasTitle,
        ]);

        return redirect()->route('mitra.data.homestay.fasilitas.index')->with('success', 'Fasilitas updated successfully.');
    }

    public function destroy($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        $fasilitas->delete();

        return redirect()->route('mitra.data.homestay.fasilitas.index')->with('success', 'Fasilitas deleted successfully.');
    }
}
