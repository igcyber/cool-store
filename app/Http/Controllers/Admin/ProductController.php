<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::select('id','image','title','slug','category_id','content','weight','price','discount')->when(request()->q, function($products){
            $products =  $products->where('title', 'like', '%' . request()->q . '%');
        })->paginate(10);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'name', 'image', 'slug')->get();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $request->validated();

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/products', $image->hashName());

        //simpan ke database
        $product = Product::create([
            'image' => $image->hashName(),
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'category_id' => $request->category_id,
            'content' => $request->content,
            'weight' => $request->weight,
            'price' => $request->price,
            'discount' => $request->discount ?? 0,
            'keywords' => $request->keywords,
            'description' => $request->description
        ]);

        if($product)
        {
            return redirect()->route('admin.products.index')->with(['success' => 'Data Berhasil Disimpan']);
        }else{
            return redirect()->route('admin.products.index')->with(['error' => 'Data Gagal Disimpan']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::latest()->get();
        return view('admin.product.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required|unique:products,title, ' . $product->id,
            'category_id' => 'required',
            'content' => 'required',
            'weight' => 'required',
            'price' => 'required',
        ]);

        // jika file image kosong
        if($request->file('image') == ''){
            $product->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title, '-'),
                'category_id' => $request->category_id,
                'content' => $request->content,
                'weight' => $request->weight,
                'price' => $request->price,
                'discount' => $request->discount,
                'keywords' => $request->keywords,
                'description' => $request->description,
            ]);
        }else{
            //upload image lama
            Storage::disk('local')->delete('public/products' . basename($product->image) );

            //upload image baru
            $image = $request->file('image');
            $image->storeAs('public/products', $image->hashName());

            //update dengan image
            $product->update([
                'image' => $image->hashName(),
                'title' => $request->title,
                'slug' => Str::slug($request->title, '-'),
                'category_id' => $request->category_id,
                'content' => $request->content,
                'weight' => $request->weight,
                'price' => $request->price,
                'discount' => $request->discount,
                'keywords' => $request->keywords,
                'description' => $request->description
            ]);
        }

        if($product)
        {
            return redirect()->route('admin.products.index')->with(['success' => 'Data Berhasil Diperbarui']);
        }else{
            return redirect()->route('admin.products.index')->with(['error' => 'Data Gagal Diperbarui']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Storage::disk('local')->delete('public/products' . basename($product->image) );
        $product->delete();

        if($product)
        {
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
