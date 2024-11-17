<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\CategoriesAdmin;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artikels = Artikel::all();
        $title = 'Artikel';

        $categoriesAdmin = CategoriesAdmin::withCount('artikels')->get();

        // Ambil semua tag dari semua artikel dan proses dengan explode
        $allTags = Artikel::pluck('tag')->toArray();
        $uniqueTags = [];

        foreach ($allTags as $tags) {
            $tagsArray = explode(',', $tags);
            foreach ($tagsArray as $tag) {
                $tag = trim($tag);
                if (!in_array($tag, $uniqueTags) && !empty($tag)) {
                    $uniqueTags[] = $tag;
                }
            }
        }

        // Ambil hanya 10 tag
        $uniqueTags = array_slice($uniqueTags, 0, 10);

        // Mengambil 5 Artikel Terbaru untuk Sidebar
        $recentArtikels = Artikel::orderBy('created_at', 'desc')->take(5)->get();

        $data = [
            'title' => $title,
            'artikels' => $artikels,
            'uniqueTags' => $uniqueTags, // Tambahkan ini
            'recentArtikels' => $recentArtikels,
            'categoriesAdmin' => $categoriesAdmin,
        ];

        return view('front.pages.artikel.index', $data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Detail Artikel';

        // Mengambil artikel berdasarkan ID
        $artikel = Artikel::findOrFail($id);

        // Ambil semua tag dari semua artikel dan proses dengan explode
        $allTags = Artikel::pluck('tag')->toArray();
        $uniqueTags = [];

        foreach ($allTags as $tags) {
            $tagsArray = explode(',', $tags);
            foreach ($tagsArray as $tag) {
                $tag = trim($tag);
                if (!empty($tag) && !in_array($tag, $uniqueTags)) {
                    $uniqueTags[] = $tag;
                }
            }
        }

        // Ambil hanya 10 tag terbaru
        $uniqueTags = array_slice($uniqueTags, 0, 10);

        // Ambil kategori admin
        $categoriesAdmin = CategoriesAdmin::withCount('artikels')->get();

        $data = [
            'title' => $title,
            'artikel' => $artikel,
            'uniqueTags' => $uniqueTags,
            'categoriesAdmin' => $categoriesAdmin,
        ];

        // Mengembalikan view dengan data artikel
        return view('front.pages.artikel.detail', $data);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
