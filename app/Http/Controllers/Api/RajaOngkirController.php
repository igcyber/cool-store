<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class RajaOngkirController extends Controller
{
    /**
     * @return object
     */
    public function getProvinces()
    {
        $provinces = Province::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Provinsi',
            'data' => $provinces
        ]);
    }

    /**
     * @param Request $request
     *
     * @return object
     */
    public function getCities(Request $request)
    {
        $city = City::where('province_id', $request->province_id)->get();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Kota Berdasarkan Provinsi',
            'data' => $city
        ]);
    }

    public function cekOngkir(Request $request)
    {
        $response = Http::withHeaders([
            'key' => config('services.rajaongkir.key')
        ])->post('https://api.rajaongkir.com/starter/cost', [

            //send data
            'origin' => 387,
            'destination' => $request->city_destination,
            'weight' => $request->weight,
            'courier' => $request->courier
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Daftar Harga Semua Kurir ' . $request->courier,
            'data' => $response['rajaongkir']['results'][0]
        ]);
    }

}
