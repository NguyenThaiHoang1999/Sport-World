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
    public function run()
    {
            DB::table('places')->insert([
                'name' => 'Sơn trà, Đà Nẵng',
                'created_at' =>"2021-07-02 10:08:01",
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
            DB::table('places')->insert([
                'name' => 'Thanh khê, Đà Nẵng',
                'created_at' => "2020-07-02 10:08:01",
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
            DB::table('places')->insert([
                'name' => 'Hải Châu, Đà Nẵng',
                'created_at' => "2020-05-02 10:08:01",
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
            DB::table('places')->insert([
                'name' => 'Liên Chiểu, Đà Nẵng',
                'created_at' => "2021-01-02 10:08:01",
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
            DB::table('places')->insert([
                'name' => 'Ngũ Hành Sơn, Đà Nẵng',
                'created_at' => "2019-07-02 10:08:01",
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
    }
}
