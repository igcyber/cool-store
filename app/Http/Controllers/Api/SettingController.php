<?php

namespace App\Http\Controllers\Api;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $setting = Setting::first();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Slider',
            'setting' => $setting
        ]);
    }
}
