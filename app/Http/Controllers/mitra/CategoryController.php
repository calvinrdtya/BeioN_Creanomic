<?php

namespace App\Http\Controllers\mitra;

// use App\Exports\ExportCategory;
use App\Http\Controllers\Controller;
// use App\Imports\CategoryImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\Mitra;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
// use App\Models\TempImage;
use Carbon\Carbon;
use Image;
// use Maatwebsite\Excel\Facades\Excel;
use PDF;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Kategori';
        $userId = Session::get('mitra_id');
        $categories = Category::where('mitra_id', $userId)->oldest('id');

        if (!empty($request->get('keyword'))) {
            $categories = $categories->where('name', 'like', '%' . $request->get('keyword') . '%');
        }

        $categories = $categories->paginate(10);

        return view('mitra.category.index', compact('categories', 'title'));
    }

    public function create()
    {
        $title = 'Buat Kategori';
        return view('mitra.category.create', compact('title'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required|in:1,2',
        ]);
    
        // Jika validasi gagal, kembali ke halaman sebelumnya dengan pesan error dan input sebelumnya
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Simpan kategori dengan data yang diberikan
        $category = new Category();
        $category->name = $request->name;
        // $category->slug = $request->slug;
        $category->status = $request->status;
        
        // Tambahkan mitra_id yang sesuai dengan mitra yang sedang masuk
        $category->mitra_id = $request->session()->get('mitra_id');
    
        $category->save();

        session()->flash('success', 'Kategori Berhasil Ditambahkan');

        return redirect()->route('mitra.category');
    }


    public function update($categoryId, Request $request)
    {
        $category = Category::find($categoryId);

        if (empty($category)) {
            session()->flash('error', 'Kategori tidak ada');
            return response()->json([
                'status' => false,
                'message' => 'Kategori tidak ada'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required',
        ]);

        if ($validator->passes()) {
            $category->name = $request->name;
            $category->status = $request->status;
            $category->save();

            session()->flash('success', 'Kategori Berhasil di Update');
            return redirect()->route('mitra.category');
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $category->delete();
    
        session()->flash('warning', 'Kategori Berhasil Dihapus');
        return redirect()->route('mitra.category')->with('alert-success', 'Category Sudah dihapus');
    }
    
    // public function export_excel()
    // {
    //     return Excel::download(new ExportCategory, "category.xlsx");
    // }

    // public function import_excel()
    // {
    //     try {
    //         Excel::import(new CategoryImport, request()->file('file'));
    //         session()->flash('success', 'Excel file imported successfully.');
    //     } catch (\Exception $e) {
    //         session()->flash('error', 'Error importing Excel file: ' . $e->getMessage());
    //     }

    //     return back();
    // }

    // public function export_pdf()
    // {
    //     // Retrieve order details and customer information
    //     $categories = Category::all();
    //     $data['categories'] = $categories;
    //     $now = Carbon::now()->format('Y-m-d');
    //     $data['now'] = $now;

    //     // Generate the PDF
    //     $pdf = PDF::loadView('mitra.report.category', compact('data'));

    //     // Set options if needed (e.g., page size, orientation)
    //     $pdf->setPaper('A4', 'potrait');

    //     // Download the PDF with a specific filename
    //     return $pdf->stream('category.pdf');
    // }
}
