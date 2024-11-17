<?php

namespace App\Services\Front;

use App\Models\Perjalanan;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;

class CartService
{
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function addToCart($request)
    {
        $productId = $request['product_id']; // Ambil id dari tabel perjalanans
        $quantity = $request['qty']; // Ambil qty dari request

        // Validasi keberadaan id di tabel perjalanans
        $perjalanan = Perjalanan::find($productId);
        if (!$perjalanan) {
            throw new \Exception('Perjalanan tidak ditemukan.');
        }

        try {
            // Periksa apakah produk sudah ada di keranjang
            $cartItem = Cart::where('user_id', $request['user_id'])
                            ->where('product_id', $productId)
                            ->first();
            
            if ($cartItem) {
                // Jika produk sudah ada, tambahkan jumlahnya
                $cartItem->qty += $quantity;
                $cartItem->save();
            } else {
                // Jika produk belum ada, tambahkan produk baru ke keranjang
                Cart::create([
                    'user_id' => $request['user_id'],
                    'mitra_id' => $request['mitra_id'],
                    'product_id' => $productId,
                    'qty' => $quantity,
                ]);
            }

        } catch (\Exception $e) {
            // Tangani kesalahan
            dd($e->getMessage()); // Cetak pesan kesalahan untuk debugging
        }
    }
}
