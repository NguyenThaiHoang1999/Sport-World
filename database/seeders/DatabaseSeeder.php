<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            // RoleSeeder::class,
            // StatusSeeder::class,
            // UserSeeder::class,
            // PlaceSeeder::class,
            // BrandSeeder::class,
            // CategorySeeder::class,
            ProductSeeder::class,
            ImageSeeder::class,
        ]);

    }
}
