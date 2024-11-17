<?php

namespace App\Http\Controllers\Transportasi\Motor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PencairanMotor;
use App\Models\Mitra;
use Illuminate\Support\Facades\Session;

class PencairanMotorController extends Controller
{
    public function index()
    {
        $title = 'Pencairan';

        // Ambil ID mitra dari sesi
        $mitraId = Session::get('mitra_id');

        // Mengambil alamat berdasarkan id mitra 
        $mitra = Mitra::findOrFail($mitraId);

        // Ambil daftar kategori transportasi milik mitra
        $categories = Category::where('mitra_id', $mitraId)->oldest('id')->get();

        // Ambil semua data pencairan motor milik mitra
        $pencairanMotors = PencairanMotor::whereHas('motor', function ($query) use ($mitraId) {
            $query->where('mitra_id', $mitraId);
        })->oldest('id')->paginate(10);

        return view('mitra.data.transportasi.motor.pencairan.index', compact('categories', 'pencairanMotors', 'mitra', 'title'));
    }

}
