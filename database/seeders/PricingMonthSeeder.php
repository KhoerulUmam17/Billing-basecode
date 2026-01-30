<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PricingMonthSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pricing_months')->insert([
            ['fee' => 100000, 'status' => 'enable', 'created_at' => now(), 'updated_at' => now()],
            ['fee' => 120000, 'status' => 'nonactive', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
