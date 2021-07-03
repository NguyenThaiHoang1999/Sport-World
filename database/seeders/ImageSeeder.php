<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $id_products = DB::table('products')->pluck('id');
        for ($i = 0; $i < 20; $i++) {
            DB::table('images')->insert([
                'product_id' => $faker->randomElement($id_products),
                'image' => $faker->imageUrl(),
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }
    }
}
