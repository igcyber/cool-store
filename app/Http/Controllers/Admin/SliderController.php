<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::latest()->paginate(5);
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request)
    {
        $request->validated();

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/sliders/', $image->hashName());

        //simpan ke database
        $slider = Slider::create([
            'image' => $image->hashName(),
            'link' => $request->link
        ]);

        if($slider)
        {
            return redirect()->route('admin.sliders.index')->with(['success' => 'Data Berhasil Disimpan']);
        }else{
            return redirect()->route('admin.sliders.index')->with(['error' => 'Data Gagal Disimpan']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        Storage::disk('local')->delete('public/sliders/' . basename($slider->image));
        $slider->delete();

        if($slider){
            return response()->json([
                'status' => 'success',
            ]);
        }else{
            return response()->json([
                'status' => 'error',
            ]);
        }
    }
}
