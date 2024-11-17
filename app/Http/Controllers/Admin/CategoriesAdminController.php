<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoriesAdmin;

class CategoriesAdminController extends Controller
{
    public function index() 
    {
        $title = 'Kategori';
        $categoriesAdmin = CategoriesAdmin::all();

        return view('admin.pages.artikel.kategori.index', compact('title', 'categoriesAdmin'));
    }


    public function create() 
    {
        $title = 'Buat Kategori';
        return view('admin.pages.artikel.kategori.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
            'role' => 'required|string'
        ]);

        $categoriesAdmin = new \App\Models\CategoriesAdmin;
        $categoriesAdmin->name = $request->input('name');
        $categoriesAdmin->status = $request->input('status');
        $categoriesAdmin->category_admin_id = $request->input('category_admin_id', 1);
        $categoriesAdmin->role = $request->input('role'); // Menyimpan nilai role
        $categoriesAdmin->save();

        return redirect()->route('admin.kategori')->with('success', 'Kategori Berhasil Dibuat');
    }

    public function destroy($id)
    {
        $categoriesAdmin = CategoriesAdmin::findOrFail($id);
        $categoriesAdmin->delete();

        return redirect()->route('admin.kategori')->with('error', 'Kategori berhasil dihapus');
    }

}
