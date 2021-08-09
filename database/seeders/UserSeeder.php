<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $id_roles = DB::table('roles')->pluck('id');
        $id_statuses = DB::table('statuses')->pluck('id');
        for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'full_name' => $faker->name,
                'avatar' => $faker->imageUrl(),
                'address' => $faker->address,
                'phone' => $faker->randomNumber($nbDigits = 9, $strict = false),
                'email' => $faker->unique()->email,
                'password' => Hash::make("password"),
                'device_key'=>"device_key",
                'role_id' => $faker->randomElement($id_roles),
                'status_id' => $faker->randomElement($id_statuses),
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }
    }
}
