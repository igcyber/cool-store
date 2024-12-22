<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * @return object
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Kategori',
            'categories' => $categories
        ]);
    }


    /**
     * @param mixed $slug
     *
     * @return object
     */
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->first();

        if($category)
        {
            return response()->json([
                'success' => true,
                'message' => 'Daftar Produk Berdasarkan Kategori ' . $category->name,
                'product' => $category->products()->latest()->get()
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Data Tidak Ditemukan'
            ], 404);
        }
    }

    /**
     * @return object
     */
    public function categoryHeader()
    {
        $categories = Category::latest()->take(5)->get();
        return response()->json([
            'success' => true,
            'message' => 'Data Kategori Header',
            'categories' => $categories
        ]);
    }
}
