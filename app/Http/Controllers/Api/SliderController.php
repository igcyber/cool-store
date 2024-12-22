<?php

namespace App\Http\Controllers\Api;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $sliders = Slider::latest()->get();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Slider',
            'sliders' => $sliders
        ]);
    }
}
