<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->when(request()->q, function($categories){
            $categories = $categories->where('name', 'like', '%' . request()->q . '%');
        })->paginate(10);

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $request->validated();

        //upload file gambar
        $image = $request->file('image');
        $image->storeAs('public/categories', $image->hashName());

        //simpan ke database
        $category = Category::create([
            'image' => $image->hashName(),
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-')
        ]);

        if($category){
            return redirect()->route('admin.categories.index')->with(['success' => 'Data Berhasil Disimpan']);
        }else{
            return redirect()->route('admin.categories.index')->wit(['error' => 'Data Gagal Disimpan']);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,'.$category->id
        ]);

        // cek jika image kosong
        if($request->file('image') == '') {
            //update tanpa image
            $category->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-')
            ]);
        }else{

            //hapus image lama
            Storage::disk('local')->delete('public/categories'. basename($category->image));

            //upload image baru
            $image = $request->file('image');
            $image->storeAs('public/categories', $image->hashName());

            //update dengan image baru
            $category->update([
                'image' => $image->hashName(),
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-')
            ]);

        }

        if($category){
            return redirect()->route('admin.categories.index')->with(['success' => 'Data Berhasil Disimpan']);
        }else{
            return redirect()->route('admin.categories.index')->wit(['error' => 'Data Gagal Disimpan']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Storage::disk('local')->delete('public/categories/'. basename($category->image));
        $category->delete();

        if($category){
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
