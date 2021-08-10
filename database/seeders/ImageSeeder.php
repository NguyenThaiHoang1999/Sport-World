<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    public function run()
    {
        $id_products = DB::table('products')->pluck('id');
            DB::table('images')->insert([
                'product_id' => 1,
                'image' =>'https://kingsport.vn/image/catalog/product/001_gian_ta/gian-ta-kingsport-bk-999-29-2.png',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
            DB::table('images')->insert([
                'product_id' => 2,
                'image' => 'https://abcsport.com.vn/image/catalog/product/001_may_chay_bo/may-chay-bo-abcsport-PRO-4-15-7.jpg',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
            DB::table('images')->insert([
                'product_id' => 1,
                'image' => 'https://gymfashion.vn/wp-content/uploads/2020/07/BBX085.jpg',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
            DB::table('images')->insert([
                'product_id' =>1,
                'image' => 'https://gymfashion.vn/wp-content/uploads/2020/07/1-2-1.jpg',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
            DB::table('images')->insert([
                'product_id' => 2,
                'image' => 'https://gymfashion.vn/wp-content/uploads/2020/07/2.0.jpg',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
            DB::table('images')->insert([
                'product_id' => 2,
                'image' => 'https://cdn.yousport.vn/Media/Products/011020041152584/gbd-pan-vigor-x-tf-vang-1_large.jpg',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);

    }
}
