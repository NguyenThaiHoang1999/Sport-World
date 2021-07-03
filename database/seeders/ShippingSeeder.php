<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;


class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('shipping')->insert([
            'shipping_name' => $faker->name,
            'shipping_address' => $faker->address,
            'shipping_phone' => $faker->randomNumber($nbDigits = 9, $strict = false),
            'shipping_email' => $faker->unique()->email,
            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
