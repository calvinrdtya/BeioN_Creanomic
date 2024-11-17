<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mitra;

class ListMitraController extends Controller
{
    public function perjalanan()
    {
        $title = "Perjalanan";
        $mitras = Mitra::where('jenis', 'perjalanan')->get();
        return view('admin.mitra.views.perjalanan.index', compact('mitras', 'title'));
    }

    public function detailperjalanan($id)
    {
        $title = "Detail Perjalanan";
        $mitras = Mitra::findOrFail($id);
        return view('admin.mitra.views.perjalanan.detail', compact('mitras', 'title'));
    }

    public function transportasi_motor()
    {
        $title = "Transportasi";
        $mitras = Mitra::where('jenis', 'transportasi')->get();
        return view('admin.mitra.views.transportasi.motor.index', compact('mitras', 'title'));
    }

    public function detail_motor($id)
    {
        $title = "Detail Motor";
        $mitras = Mitra::findOrFail($id);
        return view('admin.mitra.views.transportasi.motor.detail', compact('mitras', 'title'));
    }
    
    public function transportasi_mobil()
    {
        $title = "Mobil";
        $mitras = Mitra::where('jenis', 'transportasi')->get();
        return view('admin.mitra.views.transportasi.mobil.index', compact('mitras', 'title'));
    }
    
    public function detail_mobil($id)
    {
        $title = "Detail Mobil";
        $mitras = Mitra::findOrFail($id);
        return view('admin.mitra.views.transportasi.mobil.detail', compact('mitras', 'title'));
    }

    public function perlengkapan()
    {
        $title = "Perlengkapan";
        $mitras = Mitra::where('jenis', 'perlengkapan')->get();
        return view('admin.mitra.views.perlengkapan.index', compact('mitras', 'title'));
    }

    public function detailperlengkapan($id)
    {
        $mitras = Mitra::findOrFail($id);
        return view('admin.mitra.views.perlengkapan.detail', compact('mitras'));
    }

    public function homestay()
    {
        $title = "Homestay";
        $mitras = Mitra::where('jenis', 'homestay')->get();
        return view('admin.mitra.views.homestay.index', compact('mitras', 'title'));
    }

    public function detailhomestay($id)
    {
        $mitras = Mitra::findOrFail($id);
        return view('admin.mitra.views.homestay.detail', compact('mitras'));
    }
}