<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;


class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('shipping')->insert([
            'shipping_name' => 'shoses',
            'shipping_address' => 'sơn trà, Đà Nẵng',
            'shipping_phone' =>'0374551927',
            'shipping_email' => 'nguyenthaihoang429424@gmail.com',
            'created_at' => '2021-07-30 10:05:04',
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
