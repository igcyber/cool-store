<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $categories = [];

        for($i = 0; $i < 10; $i++){
            $name = $faker->unique()->words(2, true);
            $categories[] = [
                'name' => ucfirst($name),
                'slug' => Str::slug($name),
                'image' => $faker->imageUrl(640, 480, 'fashion', true, 'Faker'), //broken image url just for testing purposes
                'created_at' => now(),
                'updated_at' => now(),
            ];
        };

        // Insert data ke dalam tabel categories
        DB::table('categories')->insert($categories);
    }
}
