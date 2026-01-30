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
        $this->call([
            UserSeeder::class,
            ProductGroupSeeder::class,
            ModuleSeeder::class,
            ProductSeeder::class,
            PaymentGatewaySeeder::class,
            MasterClientSeeder::class,
        ]);
    }
}
