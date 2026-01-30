<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Hapus semua data products agar tidak error duplicate (aman untuk foreign key)
        DB::table('products')->delete();
        DB::table('products')->insert([
            [
                'product_group_id' => 1,
                'product_code' => 'VPS-001',
                'name' => 'VPS Basic',
                'slug' => 'vps-basic',
                'description' => 'VPS Basic untuk kebutuhan standar',
                // 'price' => 100000,
                'type' => 'vps',
                'module_id' => 1,
                'status' => 'active',
                'is_hidden' => false,
            ],
            [
                'product_group_id' => 2,
                'product_code' => 'HOST-001',
                'name' => 'Hosting Profesional',
                'slug' => 'hosting-profesional',
                'description' => 'Hosting untuk website profesional',
                // 'price' => 50000,
                'type' => 'shared hosting',
                'module_id' => 3,
                'status' => 'active',
                'is_hidden' => false,
            ],
            [
                'product_group_id' => 3,
                'product_code' => 'DOM-001',
                'name' => 'Domain .com',
                'slug' => 'domain-com',
                'description' => 'Domain .com murah',
                // 'price' => 150000,
                'type' => 'other',
                'module_id' => 2,
                'status' => 'active',
                'is_hidden' => false,
            ],
        ]);
    }
}
