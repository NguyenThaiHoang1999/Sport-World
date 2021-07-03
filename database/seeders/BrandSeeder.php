<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('brands')->insert([
                'brand_name' => 'Adidas',
                'brand_desc' =>'',
            ]);
            DB::table('brands')->insert([
                'brand_name' => 'Puma',
                'brand_desc' =>'',
            ]);
            DB::table('brands')->insert([
                'brand_name' => 'Nike',
                'brand_desc' =>'',
            ]);
            DB::table('brands')->insert([
                'brand_name' => 'Newton',
                'brand_desc' =>'',
            ]);
            DB::table('brands')->insert([
                'brand_name' => 'Asics',
                'brand_desc' =>'',
            ]);
            DB::table('brands')->insert([
                'brand_name' => 'Other',
                'brand_desc' =>'',
            ]);
    }
}
