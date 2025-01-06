<?php

namespace App\Http\Controllers\Api;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    /**
     * @return object
     */
    public function index()
    {
        $subCategories = SubCategory::latest()->get();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Sub-Kategori',
            'subCategories' => $subCategories
        ]);
    }


    /**
     * @param mixed $slug
     *
     * @return object
     */
    public function show($slug = '')
    {
        $subCategory = SubCategory::where('slug', $slug)->first();

        if($subCategory)
        {
            return response()->json([
                'success' => true,
                'message' => 'Daftar Produk Berdasarkan Sub-Kategori ' . $subCategory->name,
                'product' => $subCategory->products()->latest()->get()
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
    public function subCategoryHeader()
    {
        $subCategories = SubCategory::latest()->take(5)->get();
        return response()->json([
            'success' => true,
            'message' => 'Data Kategori Header',
            'subCategories' => $subCategories
        ]);
    }
}
