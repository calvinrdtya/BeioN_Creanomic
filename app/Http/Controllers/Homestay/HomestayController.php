<?php

namespace App\Http\Controllers\Homestay;

use App\Http\Controllers\Controller;
use App\Models\Homestay;
use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class HomestayController extends Controller
{
    public function index()
    {
        $title = 'Homestay';

        // Ambil ID mitra dari sesi
        $mitraId = Session::get('mitra_id');

        $mitra = Mitra::find($mitraId);//hapus lek gasido
        // Ambil data homestay milik mitra
        $homestays = Homestay::where('mitra_id', $mitraId)->oldest()->paginate(10);

        return view('mitra.data.homestay.index', compact('homestays', 'mitra', 'title'));
    }

    public function create()
    {
        $title = 'Tambah Homestay';

        return view('mitra.data.homestay.create', compact('title'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'higlight' => 'required|string',
            'deskripsi' => 'required|string',
            'alamat' => 'required|string',
            'qty' => 'required|integer',
            'shipping_return' => 'required|in:0,1',
            'status' => 'required|in:0,1',
            'price' => 'required|string',
            'price_discount' => 'nullable|integer',
            'final_price' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle thumbnail upload
        $thumbnailName = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailName = time() . '_thumb_' . $request->file('thumbnail')->getClientOriginalName();
            $request->file('thumbnail')->move(public_path('img'), $thumbnailName);
        }

        // Handle image uploads
        $imageNames = [];
        $imageColumns = ['image', 'image2', 'image3', 'image4'];
        foreach ($imageColumns as $column) {
            if ($request->hasFile($column)) {
                $imageName = time() . '_' . $request->file($column)->getClientOriginalName();
                $request->file($column)->move(public_path('img'), $imageName);
                $imageNames[$column] = $imageName;
            }
        }

        function generateUniqueIdentifier() {
            // Menghasilkan 4 digit angka
            $numbers = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
            
            // Menghasilkan 3 huruf
            $letters = Str::upper(Str::random(3));
        
            return 'kamar-' . $numbers . $letters;
        }

        // Gunakan fungsi untuk menghasilkan string
        $homestayUniq = generateUniqueIdentifier();

        // Create the homestay record
        $homestay = Homestay::create([
            'uniq_id' => $homestayUniq,
            'title' => $request->title,
            'higlight' => $request->higlight,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'qty' => $request->qty,
            'shipping_return' => $request->shipping_return,
            'status' => $request->status,
            'price' => $request->price,
            'price_discount' => $request->price_discount,
            'final_price' => $request->final_price,
            'thumbnail' => $thumbnailName,           
            'image' => $imageNames['image'] ?? null,
            'image2' => $imageNames['image2'] ?? null,
            'image3' => $imageNames['image3'] ?? null,
            'image4' => $imageNames['image4'] ?? null,
            'mitra_id' => $request->mitra_id,
        ]);

        // Redirect with success message
        return redirect()->route('mitra.homestay.index')->with('success', 'Homestay added successfully.');
    }

    public function edit($id)
    {
        $homestay = Homestay::findOrFail($id);
        return view('mitra.data.homestay.edit', compact('homestay'));
    }

    public function update($id, Request $request)
    {
        $homestay = Homestay::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'higlight' => 'required|string',
            'deskripsi' => 'required|string',
            'alamat' => 'required|string',
            'qty' => 'required|integer',
            'shipping_return' => 'required|in:0,1',
            'status' => 'required|in:0,1',
            'price' => 'required|string',
            'price_discount' => 'nullable|integer',
            'final_price' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Penanganan file gambar di sini
        // Handle file upload for thumbnail (if provided)
        if ($request->hasFile('thumbnail')) {
            $thumbnailName = time() . '_thumb_' . $request->file('thumbnail')->getClientOriginalName();
            $request->file('thumbnail')->move(public_path('img'), $thumbnailName);
        
            // Hapus file thumbnail lama jika ada
            if (!empty($homestay->thumbnail)) {
                File::delete(public_path('img/' . $homestay->thumbnail));
            }
        
            // Simpan nama file thumbnail baru
            $homestay->thumbnail = $thumbnailName;
        }
        
        // Handle file upload for images (if provided)
        if ($request->hasFile('image')) {
            $imageNames = [];
            foreach ($request->file('image') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('img'), $imageName);
                $imageNames[] = $imageName;
            }
        
            // Gabungkan nama file gambar baru dengan nama file gambar yang sudah ada (jika ada)
            $existingImages = !empty($homestay->image) ? explode(',', $homestay->image) : [];
            $allImages = array_merge($existingImages, $imageNames);
            $homestay->image = implode(',', $allImages);
        }        

        $homestay->title = $request->input('title');
        $homestay->highlight = $request->input('highlight');
        $homestay->deskripsi = $request->input('deskripsi');
        $homestay->alamat = $request->input('alamat');
        $homestay->qty = $request->input('qty');
        $homestay->shipping_return = $request->input('shipping_return');
        $homestay->status = $request->input('status');
        $homestay->price = $request->price;
        $homestay->price_discount = $request->price_discount;
        $homestay->final_price = $request->final_price;

        $homestay->save();

        $request->session()->flash('success', 'Homestay updated successfully');
        return redirect()->route('homestay.index');
    }

    public function destroy($id)
    {
        $homestay = Homestay::findOrFail($id);
        if ($homestay->image && File::exists(public_path('img/' . $homestay->image))) {
            File::delete(public_path('img/' . $homestay->image));
        }
        $homestay->delete();

        return redirect()->route('homestay.index')->with('alert-success', 'Homestay deleted successfully.');
    }
    
    // public function front() {
    //     $homestays = Homestay::oldest()->paginate(10);
    //     return view('front.pages.homestay.index', compact('homestays'));
    // }

    public function setting()
    {
        $title = 'Akun';

        $mitra = auth()->guard('mitra')->user();
        return view('mitra.data.homestay.setting.index', compact('mitra', 'title'));
    }
    
}
