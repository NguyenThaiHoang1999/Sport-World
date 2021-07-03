<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $brandID = DB::table('brands')->pluck('id');
        $categoryID = DB::table('categories')->pluck('id');
        $placeID = DB::table('places')->pluck('id');
        for ($i=0; $i < 10; $i++) {
            DB::table('products')->insert([
                'product_name'  => $faker->name(),
                'brand_id'      =>$faker->randomElement($brandID),
                'category_id'   =>$faker->randomElement($categoryID),
                'place_id'   =>$faker->randomElement($placeID),
                'product_desc'  =>$faker->realText($maxNbChars = 200, $indexSize = 2),
                'product_title' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'product_price' => 100000,
                'product_status'=> 1,
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }
    }
}
