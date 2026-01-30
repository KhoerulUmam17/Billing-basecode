<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PricingAnnualSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pricing_annuals')->insert([
            ['fee' => 1000000, 'status' => 'enable', 'created_at' => now(), 'updated_at' => now()],
            ['fee' => 1200000, 'status' => 'nonactive', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
