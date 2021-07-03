<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run(Faker $faker)
    {
            DB::table('roles')->insert(
                [
                    'name'=>'admin',
                    'created_at' => $faker->dateTime($max = 'now'),
                    'updated_at' => date("Y-m-d H:i:s"),
                ]
            );
            DB::table('roles')->insert(
                [
                    'name'=>'user',
                    'created_at' => $faker->dateTime($max = 'now'),
                    'updated_at' => date("Y-m-d H:i:s"),
                ]
            );
    }
}
