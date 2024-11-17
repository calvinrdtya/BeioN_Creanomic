<?php

namespace App\Http\Controllers\Perjalanan;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\perjalanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class PerjalananController extends Controller
{
    public function index()
    {
        $title = 'Perjalanan';

        // Ambil ID mitra dari sesi
        $mitraId = Session::get('mitra_id');

        // Ambil daftar kategori perjalanan milik mitra
        $categories = Category::where('mitra_id', $mitraId)->oldest('id')->get();

        // Ambil data perjalanan milik mitra
        $perjalanans = perjalanan::where('mitra_id', $mitraId)->oldest()->paginate(10);

        return view('mitra.data.perjalanan.index', compact('categories', 'perjalanans', 'title'));
    }

    public function create()
    {
        $title = 'Tambahkan Perjalanan';
        // Ambil ID mitra dari sesi
        $mitraId = Session::get('mitra_id');

        $itinerary = [];

        // Ambil daftar kategori perjalanan milik mitra
        $categories = Category::where('mitra_id', $mitraId)->oldest('id')->get();

        // Periksa apakah ada kategori yang tersedia
        if ($categories->isEmpty()) {
            return redirect()->route('mitra.perjalanan.index')->with('error', 'Please create a category first.');
        }

        return view('mitra.data.perjalanan.create', compact('categories', 'itinerary', 'title'));
    }

    // public function store(Request $request)
    // {
    //     // Validasi request
    //     $validated = $request->validate([
    //         'title' => 'required|string|max:255',
    //         'tgl_perjalanan' => 'required|date',
    //         'titik' => 'required|string|max:255',
    //         'qty' => 'required|integer',
    //         'category_id' => 'required|exists:categories,id',
    //         'durasi' => 'required|string|max:255',
    //         'thumbnail' => 'required|image|mimes:jpeg,png,jpg,svg|max:10048',
    //         'image.*' => 'required|image|mimes:jpeg,png,jpg,svg|max:10048',
    //         'price' => 'required|numeric',
    //         'price_discount' => 'nullable|numeric',
    //         'final_price' => 'required|numeric',
    //         'shipping_return' => 'required|boolean',
    //         'status' => 'required|boolean',
    //         'jenis' => 'required|boolean',
    //         'fasilitas' => 'required|string',
    //         'include' => 'required|string',
    //         'exclude' => 'required|string',
    //         'deskripsi' => 'required|string',
    //         'title_itinerary.*' => 'required|string|max:255',
    //         'jam.*' => 'required',
    //         'deskripsi_itinerary.*' => 'nullable|string',
    //     ]);
    
    //     // Upload thumbnail
    //     $thumbnail = $request->file('thumbnail');
    //     $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName();
    //     $thumbnail->move(public_path('img'), $thumbnailName);
    
    //     // Upload images
    //     $imageNames = [];
    //     if ($request->hasFile('image')) {
    //         foreach ($request->file('image') as $file) {
    //             $imageName = time() . '_' . $file->getClientOriginalName();
    //             $file->move(public_path('img'), $imageName);
    //             $imageNames[] = $imageName;
    //         }
    //     }

    //     // Proses data itinerary dari form
    //     $itineraryData = [];
    //     foreach ($validated['title_itinerary'] as $key => $title) {
    //         $itinerary = [
    //             'title' => $title,
    //             'jam' => $validated['jam'][$key],
    //             'deskripsi' => isset($validated['deskripsi_itinerary'][$key]) ? $validated['deskripsi_itinerary'][$key] : null,
    //         ];
    //         $itineraryData[] = $itinerary;
    //     }

    //     // Gabungkan itinerary menjadi string dengan "/"
    //     $itineraryString = '';
    //     foreach ($itineraryData as $key => $itinerary) {
    //         $itineraryString .= json_encode($itinerary);
    //         if ($key < count($itineraryData) - 1) {
    //             $itineraryString .= ' / '; // Pisahkan dengan "/"
    //         }
    //     }
    
    //     // Simpan data ke dalam model Perjalanan
    //     $perjalanan = new Perjalanan();
    //     $perjalanan->mitra_id = Session::get('mitra_id'); // Sesuaikan dengan cara Anda menyimpan session
    //     $perjalanan->title = $validated['title'];
    //     $perjalanan->tgl_perjalanan = $validated['tgl_perjalanan'];
    //     $perjalanan->titik = $validated['titik'];
    //     $perjalanan->qty = $validated['qty'];
    //     $perjalanan->category_id = $validated['category_id'];
    //     $perjalanan->durasi = $validated['durasi'];
    //     $perjalanan->thumbnail = $thumbnailName;
    //     $perjalanan->image = implode(',', $imageNames); // Gabungkan nama-nama gambar dengan koma
    //     $perjalanan->price = $validated['price'];
    //     $perjalanan->price_discount = $validated['price_discount'];
    //     $perjalanan->final_price = $validated['final_price'];
    //     $perjalanan->shipping_return = $validated['shipping_return'];
    //     $perjalanan->status = $validated['status'];
    //     $perjalanan->jenis = $validated['jenis'];
    //     $perjalanan->fasilitas = $validated['fasilitas'];
    //     $perjalanan->include = $validated['include'];
    //     $perjalanan->exclude = $validated['exclude'];
    //     $perjalanan->deskripsi = $validated['deskripsi'];
    //     $perjalanan->itinerary = $itineraryString;
    
    //     // Simpan data itinerary dalam format JSON dengan tanda "/"
    //     // $itineraryData = [];
    //     // foreach ($validated['title_itinerary'] as $key => $title) {
            
    //     // }
    
        
    
    //     // Simpan string itinerary ke dalam field 'itinerary'
    //     $perjalanan->itinerary = $itineraryString;
    
    //     // Simpan model Perjalanan
    //     $perjalanan->save();
    
    //     return redirect()->route('mitra.perjalanan.index')->with('success', 'Perjalanan berhasil ditambahkan.');
    // }
    
    public function store(Request $request)
    {
        // Validasi request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'tgl_perjalanan' => 'required|date',
            'titik' => 'required|string|max:255',
            'hightlight' => 'required|string|max:999',
            'kota' => 'required|string|max:100',
            'qty' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'durasi' => 'required|string|max:255',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,svg|max:10048',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,svg|max:10048',
            'price' => 'required|numeric',
            'price_discount' => 'nullable|numeric',
            'final_price' => 'required|numeric',
            'shipping_return' => 'required|boolean',
            'status' => 'required|boolean',
            'jenis' => 'required|boolean',
            'fasilitas' => 'required|string',
            'include' => 'required|string',
            'exclude' => 'required|string',
            'deskripsi' => 'required|string',
            'title_itinerary.*' => 'required|string|max:255',
            'jam.*' => 'required',
            'deskripsi_itinerary.*' => 'nullable|string',
            'title_itinerary_two.*' => 'required|string|max:255',
            'jam_two.*' => 'required',
            'deskripsi_itinerary_two.*' => 'nullable|string',
        ]);

        // Upload thumbnail
        $thumbnail = $request->file('thumbnail');
        $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName();
        $thumbnail->move(public_path('img'), $thumbnailName);

        // Upload images
        $imageNames = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('img'), $imageName);
                $imageNames[] = $imageName;
            }
        }

        // Simpan data ke dalam model Perjalanan
        $perjalanan = new Perjalanan();
        $perjalanan->mitra_id = Session::get('mitra_id'); // Sesuaikan dengan cara Anda menyimpan session
        $perjalanan->title = $validated['title'];
        $perjalanan->hightlight = $validated['hightlight'];
        $perjalanan->kota = $validated['kota'];
        $perjalanan->tgl_perjalanan = $validated['tgl_perjalanan'];
        $perjalanan->titik = $validated['titik'];
        $perjalanan->qty = $validated['qty'];
        $perjalanan->category_id = $validated['category_id'];
        $perjalanan->durasi = $validated['durasi'];
        $perjalanan->thumbnail = $thumbnailName;
        $perjalanan->image = implode(',', $imageNames); // Gabungkan nama-nama gambar dengan koma
        $perjalanan->price = $validated['price'];
        $perjalanan->price_discount = $validated['price_discount'];
        $perjalanan->final_price = $validated['final_price'];
        $perjalanan->shipping_return = $validated['shipping_return'];
        $perjalanan->status = $validated['status'];
        $perjalanan->jenis = $validated['jenis'];
        $perjalanan->fasilitas = $validated['fasilitas'];
        $perjalanan->include = $validated['include'];
        $perjalanan->exclude = $validated['exclude'];
        $perjalanan->deskripsi = $validated['deskripsi'];

        // Simpan data itinerary dalam format JSON dengan tanda "/"
        $itineraryData = [];
        foreach ($request->input('title_itinerary') as $key => $title) {
            $title = htmlspecialchars($title); // Escape title
            $jam = htmlspecialchars($request->input('jam')[$key]); // Escape jam
            $deskripsi = htmlspecialchars($request->input('deskripsi_itinerary')[$key]); // Escape deskripsi

            $itineraryData[] = [
                'title' => $title,
                'jam' => $jam,
                'deskripsi' => $deskripsi
            ];
        }

        // Gabungkan itinerary menjadi string dengan "/"
        $itineraryString = implode(' / ', array_map('json_encode', $itineraryData));

        // Simpan string itinerary ke dalam field 'itinerary'
        $perjalanan->itinerary = $itineraryString;

        // $itineraryDataTwo = [];

        // // Cek apakah input 'title_itinerary_two' ada dalam request
        // if (isset($validated['title_itinerary_two'])) {
        //     $itineraryDataTwo = [];
        //     foreach ($validated['title_itinerary_two'] as $key => $title_two) {
        //         $title_two = htmlspecialchars($title_two);
        //         $jam_two = htmlspecialchars($validated['jam_two'][$key]);
        //         $deskripsi_two = isset($validated['deskripsi_itinerary_two'][$key]) ? htmlspecialchars($validated['deskripsi_itinerary_two'][$key]) : null;

        //         $itineraryTwo = [
        //             'title' => $title_two,
        //             'jam' => $jam_two,
        //             'deskripsi' => $deskripsi_two,
        //         ];
        //         $itineraryDataTwo[] = $itineraryTwo;
        //     }
        //     $itineraryStringTwo = implode(' / ', array_map('json_encode', $itineraryDataTwo));
        //     $perjalanan->title_itinerary = $itineraryStringTwo;
        // }


        // Simpan model Perjalanan
        $perjalanan->save();

        return redirect()->route('mitra.perjalanan.index')->with('success', 'Perjalanan berhasil ditambahkan.');
    }

    public function detail($perjalananId)
    {
        $title = 'Detail Perjalanan';
        $mitraId = Session::get('mitra_id');
        $perjalanan = Perjalanan::findOrFail($perjalananId);
        $categories = Category::where('mitra_id', $mitraId)->oldest('id')->get();
        $perjalanans = Perjalanan::where('mitra_id', $mitraId)->oldest()->paginate(10);
        // $itineraryes = json_decode($perjalanan->itineraryes);

        return view('mitra.data.perjalanan.detail', compact('perjalanans', 'perjalanan', 'categories', 'title'));
    }

    public function update(Request $request, $id)
    {
        $perjalanan = Perjalanan::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'qty' => 'required|integer',
            'price' => 'required|numeric',
            'price_discount' => 'nullable|numeric',
            'durasi' => 'required|string|max:255',
            'short_description' => 'required|string|max:255',
            'description' => 'required|string',
            'shipping_return' => 'required|boolean',
            'status' => 'required|boolean',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = $request->except(['thumbnail', 'image', 'image2', 'image3', 'image4']);

        if ($request->hasFile('thumbnail')) {
            // Upload new thumbnail
            $thumbnail = $request->file('thumbnail');
            $filename = time() . '_' . $thumbnail->getClientOriginalName();
            $thumbnail->move(public_path('img'), $filename);

            // Delete old thumbnail if exists
            if ($perjalanan->thumbnail) {
                $oldImage = public_path('img/' . $perjalanan->thumbnail);
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }

            $data['thumbnail'] = $filename;
        }

        // Handle additional images
        $additionalImages = ['image', 'image2', 'image3', 'image4'];
        foreach ($additionalImages as $imageName) {
            if ($request->hasFile($imageName)) {
                // Upload new image
                $image = $request->file($imageName);
                $imageFilename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('img'), $imageFilename);

                // Delete old image if exists
                if ($perjalanan->$imageName) {
                    $oldImage = public_path('img/' . $perjalanan->$imageName);
                    if (file_exists($oldImage)) {
                        unlink($oldImage);
                    }
                }

                $data[$imageName] = $imageFilename;
            }
        }

        $perjalanan->update($data);

        return redirect()->route('mitra.perjalanan.index')->with('success', 'Perjalanan updated successfully.');
    }

    public function destroy($perjalananId)
    {
        $perjalanan = perjalanan::findOrFail($perjalananId);
        $perjalanan->delete();

        return redirect()->route('mitra.perjalanan.index')->with('alert-success', 'perjalanan Sudah dihapus');
    }
}
