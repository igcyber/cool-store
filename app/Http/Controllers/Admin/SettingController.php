<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::first();
        return view('admin.setting.index', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $setting->update([
            'promo_text' => $request->promo_text,
            'slogan_text' => $request->slogan_text
        ]);

        if($setting){
            return redirect()->route('admin.settings.index')->with(['success' => 'Data Berhasil Diperbarui']);
        }else{
            return redirect()->route('admin.settings.index')->wit(['error' => 'Data Gagal Diperbarui']);
        }
    }

}
