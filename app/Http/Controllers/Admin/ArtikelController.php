<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\CategoriesAdmin;
use Carbon\Carbon;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Artikel";
        $artikels = Artikel::all();

        foreach ($artikels as $artikel) {
            $artikel->time_ago = Carbon::parse($artikel->created_at)->diffForHumans();
        }

        return view('admin.pages.artikel.index', compact('title', 'artikels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Artikel";

        $categories = CategoriesAdmin::all();

        return view('admin.pages.artikel.create', compact('title', 'categories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'thumbnail' => 'required|image|mimes:jpeg,png,jpg,svg|max:10048',
    //         'status' => 'required|boolean',
    //         'deskripsi' => 'nullable|string',
    //     ]);

    //     // Upload thumbnail dan simpan path-nya
    //     $thumbnailName = null;
    //     if ($request->hasFile('thumbnail')) {
    //         $thumbnailName = time() . '_' . $request->file('thumbnail')->getClientOriginalName();
    //         $request->file('thumbnail')->move(public_path('img'), $thumbnailName);
    //     }

    //     // Buat artikel baru
    //     Artikel::create([
    //         'title' => $request->input('title'),
    //         'thumbnail' => 'img/' . $thumbnailName, // Simpan path relatif thumbnail
    //         'status' => $request->input('status'),
    //         'deskripsi' => $request->input('deskripsi'),
    //     ]);

    //     return redirect()->route('admin.artikel')->with('success', 'Artikel berhasil dibuat.');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'category_admin_id' => 'sometimes|required|exists:categories_admins,id',
            'title' => 'required|string|max:255',
            'thumbnails' => 'required|image|mimes:jpeg,png,jpg,svg|max:10048',
            'deskripsi' => 'nullable|string',
            'kota' => 'nullable|string',
            'tag' => 'nullable|string',
            'status' => 'required|in:0,1',
        ]);

        // Assign default value for category_admin_id if not present
        $categoryAdminId = $request->input('category_admin_id', 1);

        // Upload thumbnail directly to the public folder
        $thumbnail = $request->file('thumbnails');
        $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName(); // 1727063616_sepatu.jpeg
        $thumbnail->move(public_path(), $thumbnailName); // Move file to public folder

        // Create the Artikel object
        $artikel = new Artikel([
            'category_admin_id' => $categoryAdminId,
            'title' => $request->title,
            'deskripsi' => $request->deskripsi,
            'kota' => $request->kota,
            'tag' => $request->tag,
            'status' => $request->status,
            'thumbnails' => $thumbnailName,  // Only the filename is saved
        ]);

        $artikel->save();

        return redirect()->route('admin.artikel')->with('success', 'Artikel Berhasil Dibuat');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Detail Artikel';

        // Temukan artikel berdasarkan ID
        $artikel = Artikel::find($id);
        
        // Periksa apakah artikel ditemukan
        if (!$artikel) {
            return redirect()->route('admin.artikel')->with('error', 'Artikel Tidak Ada.');
        }

        // Tampilkan tampilan detail artikel
        return view('admin.pages.artikel.show', compact('artikel', 'title'));
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
        // Validasi input dari form
        $request->validate([
            'title' => 'required|string|max:255',
            'thumbnails' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'required|string',
            'kota' => 'required|string|max:255',
            'tag' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        // Temukan artikel berdasarkan ID
        $artikel = Artikel::findOrFail($id);

        // Proses upload thumbnail jika ada file yang diupload
        if ($request->hasFile('thumbnails')) {
            // Hapus thumbnail lama jika ada
            if ($artikel->thumbnails && file_exists(public_path($artikel->thumbnails))) {
                unlink(public_path($artikel->thumbnails));
            }

            // Simpan thumbnail baru
            $thumbnail = $request->file('thumbnails'); // Sesuaikan nama parameter dengan validasi
            $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName();
            $thumbnailPath = 'thumbnails/' . $thumbnailName;
            $thumbnail->move(public_path('thumbnails'), $thumbnailName);
            $artikel->thumbnails = $thumbnailPath;
        }

        // Update data artikel
        $artikel->title = $request->input('title');
        $artikel->status = $request->input('status');
        $artikel->kota = $request->input('kota');
        $artikel->tag = $request->input('tag');
        $artikel->deskripsi = $request->input('deskripsi'); // Sesuaikan nama kolom dengan yang ada di tabel
        $artikel->save();

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari artikel berdasarkan ID
        $artikel = Artikel::find($id);

        // Jika artikel ditemukan, hapus
        if ($artikel) {
            $artikel->delete();
            return redirect()->route('admin.artikel')->with('success', 'Artikel berhasil dihapus.');
        } else {
            return redirect()->route('admin.artikel')->with('error', 'Artikel tidak ditemukan.');
        }
    }

}
