<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * @return object
     */
    public function index()
    {
        $products = Product::latest()->get();
        return response()->json([
            'success' => true,
            'messages' => 'Daftar Produk',
            'products' => $products
        ], 200);
    }

    public function show($slug){
        $product = Product::where('slug', $slug)->first();
        if($product){
            return response()->json([
                'success' => true,
                'message' => 'Detail Produk ' . $product->title,
                'product' => $product

            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Produk Tidak Ditemukan',
            ], 404);
        }
    }
}
