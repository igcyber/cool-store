<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    /**
     * @return object
     */
    public function index()
    {
        $carts = Cart::with('product')
        ->where('customer_id', auth()->user()->id)
        ->orderBy('created_at', 'desc')
        ->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar Keranjang Belanja',
            'carts' => $carts
        ]);
    }

    /**
     * @param Request $request
     *
     * @return object
     */
    public function store(Request $request)
    {
        $item = Cart::where('product_id', $request->product_id)->where('customer_id', $request->customer_id);

        if($item->count())
        {
            // increment qty
            $item->increment('qty');
            $item = $item->first();

            // total price
            $price = $request->price * $item->qty;

            // total weight
            $weight = $request->weight * $item->qty;

            $item->update([
                'price' => $price,
                'weight' => $weight
            ]);
        }else{
            $item = Cart::create([
                'product_id' => $request->product_id,
                'customer_id' => $request->customer_id,
                'qty' => $request->qty,
                'price' => $request->price,
                'weight' => $request->weight
            ]);
        }

        return response()->json([
            'success' => true,
            'message' =>'Berhasil Ditambahkan Pada Keranjang',
            'qty' => $item->qty,
            'product' => $item->product
        ]);
    }

    /**
     * @return object
     */
    public function getPriceTotal()
    {
        $carts = Cart::with('product')
                ->where('customer_id', auth()->user()->id)
                ->orderBy('created_at', 'desc')
                ->sum('price');

        return response()->json([
            'success' => true,
            'message' =>'Total Belanja ',
            'total' => $carts
        ]);
    }

    /**
     * @return object
     */
    public function getWeightTotal()
    {
        $carts = Cart::with('product')
                ->where('customer_id', auth()->user()->id)
                ->orderBy('created_at', 'desc')
                ->sum('weight');

        return response()->json([
            'success' => true,
            'message' => 'Total Berat ',
            'total' => $carts
        ]);
    }

    /**
     * @param Request $request
     *
     * @return object
     */
    public function removeItem(Request $request)
    {
        Cart::with('product')
        ->whereId($request->cart_id)
        ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Produk Pada Keranjang Dihapus'
        ]);
    }

    public function removeAllItem(Request $request)
    {
        Cart::with('product')
        ->where('customer_id', auth()->guard('api')->user()->id)
        ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Hapus Semua Isi Keranjang'
        ]);
    }
}

