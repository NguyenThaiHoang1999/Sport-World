<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    public function run()

    {
        $images1=array('https://kingsport.vn/image/catalog/product/001_gian_ta/gian-ta-kingsport-bk-999-29-2.png','https://gymfashion.vn/wp-content/uploads/2020/07/BBX085.jpg','https://gymfashion.vn/wp-content/uploads/2020/07/1-2-1.jpg');
        $images2=array('https://abcsport.com.vn/image/catalog/product/001_may_chay_bo/may-chay-bo-abcsport-PRO-4-15-7.jpg','https://gymfashion.vn/wp-content/uploads/2020/07/2.0.jpg','https://cdn.yousport.vn/Media/Products/011020041152584/gbd-pan-vigor-x-tf-vang-1_large.jpg');
        $id_products = DB::table('products')->pluck('id');
            DB::table('images')->insert([
                'product_id' => 1,
                'image' => json_encode($images1),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
            DB::table('images')->insert([
                'product_id' => 2,
                'image' => json_encode($images2),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
    }
}
