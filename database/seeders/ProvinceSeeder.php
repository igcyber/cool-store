<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProvinceSeeder extends Seeder
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
        ])->get('https://api.rajaongkir.com/starter/province');


        //loop results
        foreach($response['rajaongkir']['results'] as $province){
            //insert ke tabel provinces
            Province::create([
                'province_id' => $province['province_id'],
                'name' => $province['province'],
            ]);
        }
    }
}
