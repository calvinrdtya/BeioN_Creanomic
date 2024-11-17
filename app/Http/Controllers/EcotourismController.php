<?php

namespace App\Http\Controllers;

use App\Enums\WasteCategory;
use App\Models\HistoryEcotourism;
use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EcotourismController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Eco Tourism';

        $wasteCategories = WasteCategory::cases();

        $mitras = Mitra::where('is_dropoff', true)->get();

        $totalPoint = 0;
        $totalQty = 0;

        if (auth()->user()) {
            $totalPoint = auth()->user()->points_text;
            $totalQty = HistoryEcotourism::quantityByUser();
        }

        return view('front.pages.ecotourism.index', compact('title', 'wasteCategories', 'mitras', 'totalPoint', 'totalQty'));
    }

    public function detail(Request $request)
    {
        $title = 'Riwayat Transaksi';

        $category = $request->query('category');

        $historyCategories = [
            [
                'category' => 'semua',
                'title' => 'Semua',
                'count' => 0,
                'active' => $category === null || $category === 'semua',
            ],
            [
                'category' => 'plastik',
                'title' => 'Plastik',
                'count' => 0,
                'active' => $category === 'plastik',
            ],
            [
                'category' => 'kertas',
                'title' => 'Kertas',
                'count' => 0,
                'active' => $category === 'kertas',
            ],
            [
                'category' => 'elektronik',
                'title' => 'Elektronik',
                'count' => 0,
                'active' => $category === 'elektronik',
            ],
            [
                'category' => 'botol-kaca',
                'title' => 'Botol Kaca',
                'count' => 0,
                'active' => $category === 'botol-kaca',
            ],
            [
                'category' => 'aluminium',
                'title' => 'Aluminium',
                'count' => 0,
                'active' => $category === 'aluminium',
            ],
        ];

        return view('front.pages.ecotourism.detail', compact('title', 'historyCategories'));
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
        $validator = Validator::make($request->all(), [
            'mitra_id' => 'required|exists:mitras,id',
            'title' => 'required|string|max:255',
            'qty' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img'), $imageName);
        }

        $qty = $request->input('qty');
        $category = $request->input('title');

        $wasteCategory = WasteCategory::tryFrom($category);
        $point = $wasteCategory->points();

        HistoryEcotourism::create([
            'user_id' => auth()->user()->id,
            'mitra_id' => $request->mitra_id,
            'image' => $imageName,
            'title' => $request->title,
            'qty' => $request->qty,
            'point' => $qty * $point,
        ]);

        return redirect()->route('front.ecotourism.history')->with('success', 'Berhasil mengajukan drop-off!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

    public function history()
    {
        $title = 'Riwayat Transaksi';

        $histories = HistoryEcotourism::where('user_id', auth()->user()->id)
            ->latest('created_at')
            ->get();

        return view('front.pages.ecotourism.history', compact('title', 'histories'));
    }
}
