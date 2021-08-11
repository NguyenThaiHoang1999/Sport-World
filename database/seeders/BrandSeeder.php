<?php

namespace Database\Seeders;

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
                'category_id'   =>1,
                'brand_name' => 'shoes',
                'brand_image' =>'https://thethaominhphu.com/wp-content/uploads/2020/02/giay-bong-da-jogarbola-jg-190424a-silver-lime-edt-600x536.jpg',
            ]);
            DB::table('brands')->insert([
                'category_id'   =>1,
                'brand_name' => 'football shirt',
                'brand_image' =>'https://www.uksoccershop.com/images/1599221940-france-home-shirt-20-21.jpg',
            ]);
            DB::table('brands')->insert([
                'category_id'   =>1,
                'brand_name' => 'soccer ball',
                'brand_image' =>'https://image.shutterstock.com/image-vector/realistic-soccer-ball-football-on-260nw-1340503238.jpg',
            ]);
            DB::table('brands')->insert([
                'category_id'   =>1,
                'brand_name' => 'glove',
                'brand_image' =>'https://eadn-wc05-628274.nxedge.io/cdn/wp-content/uploads/2020/06/Black4-600x600.png',
            ]);
            DB::table('brands')->insert([
                'category_id'   =>1,
                'brand_name' => 'sports bras',
                'brand_image' =>'https://epicsports.cachefly.net/variants/98626/80666/310/Augusta_Sportswear/2417_0814/2417_POWER_YELLOW_GRAPHITE_0814.jpg',
            ]);
            DB::table('brands')->insert([
                'category_id'   =>2,
                'brand_name' => 'Equipment',
                'brand_image' =>'https://image.shutterstock.com/image-photo/photo-sport-equipment-gym-dumbbells-260nw-564818077.jpg',
            ]);
            DB::table('brands')->insert([
                'category_id'   =>2,
                'brand_name' => 'glove',
                'brand_image' =>'https://ae01.alicdn.com/kf/H37788ea4cd7f41b2b99ffbdad7e9c35ao/Gym-Gloves-Fitness-Weight-Lifting-Gloves-Body-Building-Training-Sports-Exercise-Sport-Workout-Glove-for-Men.jpg_Q90.jpg_.webp',
            ]);
            DB::table('brands')->insert([
                'category_id'   =>2,
                'brand_name' => 'Tshirt Shirt',
                'brand_image' =>'https://5.imimg.com/data5/CN/MQ/GB/SELLER-55767972/slim-fit-gym-t-shirt-500x500.jpg',
            ]);
            DB::table('brands')->insert([
                'category_id'   =>3,
                'brand_name' => 'Game Handle Game',
                'brand_image' =>'https://i.pinimg.com/474x/51/c6/30/51c630a7d4e88cfd5d0d79fe05366996.jpg',
            ]);
            DB::table('brands')->insert([
                'category_id'   =>3,
                'brand_name' => 'Fifa Online 4 logo printed T-shirt',
                'brand_image' =>'https://cf.shopee.vn/file/e24ff75504074209ca14312466274bef',
            ]);
            DB::table('brands')->insert([
                'category_id'   =>4,
                'brand_name' => 'Fifa Online 4 logo printed T-shirt',
                'brand_image' =>'https://cf.shopee.vn/file/e24ff75504074209ca14312466274bef',
            ]);
    }
}
