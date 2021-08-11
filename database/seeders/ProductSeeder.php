<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('products')->insert([
                'product_name'  => 'shoses',
                'brand_id'      => 1,
                'category_id'   =>1,
                'place_id'   => 2,
                'user_id'   => 1,
                'product_desc'  =>"Cordless Natural Lawn Soccer Shoe",
                'product_title' => 'Shoses football',
                'product_price' => 100000,
                'product_status'=> 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
            DB::table('products')->insert([
                'product_name'  => 'shose',
                'brand_id'      =>5,
                'category_id'   =>3,
                'place_id'   =>2,
                'user_id'   =>2,
                'product_desc'  =>'Cordless Natural Lawn Soccer Shoe',
                'product_title' => 'Shoses football',
                'product_price' => 100000,
                'product_status'=> 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);

    }
}
