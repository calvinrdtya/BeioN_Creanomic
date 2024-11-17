<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Page;
use App\Models\User;
use App\Models\Homestay;
use App\Models\Transportasi;
use App\Models\Perjalanan;
use App\Models\Perlengkapan;
use App\Models\Artikel;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $homestays = Homestay::all();
        $transportasis = Transportasi::all();
        $perjalanans = Perjalanan::all();
        $artikels = Artikel::orderBy('id', 'desc')->take(4)->get();

        $latestProducts = Product::where('status', 1)->orderBy('id', 'DESC')->take(8)->get();

        // Mengambil daftar kota dari tabel perjalanan
        $kotas = Perjalanan::select('kota')->distinct()->pluck('kota');

        // Menyimpan status halaman ke dalam session
        if ($request->has('page')) {
            $page = $request->input('page');
            session(['page' => $page]);
        } else {
            session()->forget('page');
        }

        $perlengkapans = Perlengkapan::all();
        $categoryIds = $perlengkapans->pluck('category_id')->flatten()->unique()->toArray();
        $categories = Category::whereIn('id', $categoryIds)->get();
        $dataKota = Perlengkapan::select('kota')->distinct()->pluck('kota');

        $data = [
            'latestProducts' => $latestProducts,
            'homestays' => $homestays,
            'transportasis' => $transportasis,
            'perjalanans' => $perjalanans,
            'artikels' => $artikels,
            'kotas' => $kotas,
            'categories' => $categories,
            'dataKota' => $dataKota
        ];
        return view('front.home', $data);
    }

    public function addToWishlist(Request $request)
    {

        if (Auth::check() == false) {

            session(['url.intended' => url()->previous()]);

            return response()->json([
                'status' => false
            ]);
        }

        $product = Product::where('id', $request->id)->first();

        if ($product == null) {
            return response()->json([
                'status' => false, // Change to false because the product was not found
                'message' => 'Product Not Found'
            ]);
        }

        $wishlist = Wishlist::updateOrCreate(
            [
                'user_id' => Auth::user()->id,
                'product_id' => $request->id,
            ],
            [
                'user_id' => Auth::user()->id,
                'product_id' => $request->id,
            ]
        );

        if ($wishlist->wasRecentlyCreated) {
            // Wishlist item was created, product added successfully
            return response()->json([
                'status' => true,
                'message' => '<div class="alert alert-success"><strong>"' . $product->title . '"</strong> Added in Your Wishlist Successfully</div>'
            ]);
        } else {
            // Wishlist item already exists, product is already in the wishlist
            return response()->json([
                'status' => false, // Change to false because the product is already in the wishlist
                'message' => '<div class="alert alert-info"><strong>"' . $product->title . '"</strong> Already in Wishlist</div>'
            ]);
        }
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->first();
        if ($page == null) {
            abort(404);
        }
        return view('front.page', [
            'page' => $page
        ]);
        //dd($page);

    }

    public function sendContactEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required|min:10'
        ]);

        if ($validator->passes()) {

            // Kirim Email

            $mailData = [
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'mail_subject' => 'You have received a contact email'
            ];

            $admin = User::where('id', 1)->first();

            Mail::to($admin->email)->send(new ContactEmail($mailData));

            session()->flash('success', 'Thanks for contacting us, we will get back to you soon.');

            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function perlengkapan(Request $request)
    {
        $title = 'Perlengkapan';
        $sortBy = $request->get('sortBy', 'populer');
        // SortBy
        if ($sortBy === 'all') {
            $perlengkapans = Perlengkapan::all();
        } else {
            switch ($sortBy) {
                case 'termurah':
                    $perlengkapans = Perlengkapan::orderBy('final_price', 'asc')->get();
                    break;
                case 'termahal':
                    $perlengkapans = Perlengkapan::orderBy('final_price', 'desc')->get();
                    break;
                default:
                    $perlengkapans = Perlengkapan::all();
                    break;
            }
        }
        return view('front.pages.perlengkapan.index', compact('perlengkapans', 'sortBy', 'title'));
    }
}
