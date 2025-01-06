<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SubCategoryRequest;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCategories = SubCategory::latest()->when(request()->q, function($subCategories){
            $subCategories = $subCategories->where('name', 'like', '%' . request()->q . '%');
        })->paginate(10);

        return view('admin.subcategory.index', compact('subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'name', 'image', 'slug')->get();
        return view('admin.subcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubCategoryRequest $request)
    {
        $request->validated();

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/subcategories', $image->hashName());

        //simpan ke database
        $subCategory = SubCategory::create([
            'image' => $image->hashName(),
            'name' => $request->name,
            'category_id' => $request->category_id,
            'slug' => Str::slug($request->name, '-')
        ]);

        if($subCategory){
            return redirect()->route('admin.sub_categories.index')->with(['success' => 'Data Berhasil Disimpan']);
        }else{
            return redirect()->route('admin.sub_categories.index')->wit(['error' => 'Data Gagal Disimpan']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $sub_category)
    {
        $categories = Category::latest()->get();
        return view('admin.subcategory.edit', compact('sub_category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $sub_category)
    {

        $request->validate([
            'image' => 'image|mimes:jpeg,jpg,png|max:2000',
            'category_id' => 'required',
            'name' => 'required|unique:sub_categories,name, ' . $sub_category->id
        ]);

        //cek jika image kosong
        if($request->file('image') == ''){
            $sub_category->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-')
            ]);
        }else{
            //hapus image lama
            Storage::disk('local')->delete('public/subcategories' . basename($sub_category->image));

            //upload image baru
            $image = $request->file('image');
            $image->storeAs('public/subcategories', $image->hashName());

            //update dengan gambar
            $sub_category->update([
                'image' => $image->hashName(),
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-')
            ]);
        }

        if($sub_category){
            return redirect()->route('admin.sub_categories.index')->with(['success' => 'Data Berhasil Diperbarui']);
        }else{
            return redirect()->route('admin.sub_categories.index')->wit(['error' => 'Data Gagal Diperbarui']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $sub_category)
    {
        Storage::disk('local')->delete('public/subcategories/' . basename($sub_category->image));
        $sub_category->delete();

        if($sub_category){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
