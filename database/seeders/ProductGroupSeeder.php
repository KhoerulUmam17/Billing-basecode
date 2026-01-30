<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductGroupSeeder extends Seeder
{
    public function run()
    {
        DB::table('product_groups')->insert([
            ['name' => 'VPS', 'description' => 'Virtual Private Server'],
            ['name' => 'Hosting', 'description' => 'Web Hosting'],
            ['name' => 'Domain', 'description' => 'Domain Registration'],
        ]);
    }
}
