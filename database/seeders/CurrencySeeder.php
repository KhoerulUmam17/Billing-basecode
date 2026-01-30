<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    public function run()
    {
        DB::table('currencies')->insert([
            [
                'code' => 'IDR',
                'prefix' => 'Rp.',
                'suffix' => '',
                'format' => '1,234.56',
                'base_rate' => 1.00000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'JPY',
                'prefix' => 'Y',
                'suffix' => '',
                'format' => '1,234',
                'base_rate' => 0.00929,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'USD',
                'prefix' => '$',
                'suffix' => '',
                'format' => '1234.56',
                'base_rate' => 0.00006,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
