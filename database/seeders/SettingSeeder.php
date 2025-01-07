<?php

namespace Database\Seeders;

use App\Models\Setting;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        Setting::create([
            'promo_text' => $faker->unique()->words(2, true),
            'slogan_text' => $faker->unique()->words(2, true)
        ]);
    }
}
