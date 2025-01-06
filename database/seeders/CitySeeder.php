<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //fetch API
        $response = Http::withHeaders([
            // API Key Raja Ongkir
            'key' => config('services.rajaongkir.key'),
        ])->get('https://api.rajaongkir.com/starter/city');


        //loop results
        foreach($response['rajaongkir']['results'] as $city){
        //insert ke tabel provinces
            City::create([
                'province_id' => $city['province_id'],
                'city_id' => $city['city_id'],
                'name' => $city['city_name'] . ' - ' . '(' . $city['type'] . ')',
            ]);
        }
    }
}
