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

            DB::table('users')->insert([
                'full_name' => 'Nguyen Thai Hoang',
                'avatar' => 'https://thumbs.dreamstime.com/b/default-avatar-profile-icon-vector-social-media-user-photo-183042379.jpg',
                'address' => 'Sơn trà, Đà Nẵng',
                'phone' => '0374551927',
                'email' => "a@gmail.com",
                'password' => Hash::make("password"),
                'device_key'=>"",
                'role_id' => 2,
                'status_id' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
            DB::table('users')->insert([
                'full_name' => 'Nguyen The Anh',
                'avatar' => 'https://thumbs.dreamstime.com/b/default-avatar-profile-icon-vector-social-media-user-photo-183042379.jpg',
                'address' =>'Sơn trà, Đà Nẵng',
                'phone' => '0395928700',
                'email' =>'p@gmail.com',
                'password' => Hash::make("password"),
                'device_key'=>"",
                'role_id' => 2,
                'status_id' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);

    }
}
