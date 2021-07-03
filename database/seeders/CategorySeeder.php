<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('categories')->insert([
            'category_name' => 'Football',
            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => date("Y-m-d H:i:s"),
         ]);

        DB::table('categories')->insert([
            'category_name' => 'Gym',
            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => date("Y-m-d H:i:s"),
         ]);


        DB::table('categories')->insert([
            'category_name' => 'Electronic Sports',
            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => date("Y-m-d H:i:s"),
         ]);


        DB::table('categories')->insert([
            'category_name' => 'Other',
            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => date("Y-m-d H:i:s"),
         ]);

    }

}
