<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('statuses')->insert([
            'status' => "Pending",
            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('statuses')->insert([
            'status' => "Active",
            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
    }
}