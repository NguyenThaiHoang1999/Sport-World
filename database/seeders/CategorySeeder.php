<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'category_name' => 'Football',
            'category_image' => 'https://www2.deloitte.com/content/dam/Deloitte/uk/Images/promo_images/Campaign/sport/deloitte-uk-annual-review-of-football-finance-2021-promo.jpg',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
         ]);

        DB::table('categories')->insert([
            'category_name' => 'Gym',
            'category_image' =>'https://may-tap-the-hinh.com/photo/tap-gym-la-gi-va-lich-su-hinh-thanh-cua-gym.jpg',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
         ]);

        DB::table('categories')->insert([
            'category_name' => 'Electronic Sports',
            'category_image' =>'https://danviet.mediacdn.vn/upload/4-2019/images/2019-11-23/The-thao-dien-tu-lan-dau-tien-co-mat-tai-Sea-Games-30-loinhuan4benner-1574485493-width915height512.jpg',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
         ]);

        DB::table('categories')->insert([
            'category_name' => 'Other',
            'category_image' =>'https://cdnstepup.r.worldssl.net/wp-content/uploads/2020/09/cac-mon-the-thao-bang-tieng-anh-2.jpg',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
         ]);

    }

}
