<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PricingYearsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pricing_years')->insert([
            ['fee' => 5000000, 'status' => 'enable', 'created_at' => now(), 'updated_at' => now()],
            ['fee' => 6000000, 'status' => 'nonactive', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
