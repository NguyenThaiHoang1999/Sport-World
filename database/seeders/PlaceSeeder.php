<?php

namespace Database\Seeders;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;


class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 20; $i++) {
            DB::table('places')->insert([
                'name' => $faker->address,
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }
    }
}
