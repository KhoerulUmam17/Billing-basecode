<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MasterClientSeeder extends Seeder
{
    public function run()
    {
        DB::table('master_clients')->insert([
            [
                'name' => 'PT. Sukses Makmur',
                'email' => 'makmur@example.com',
                'phone' => '081234567890',
                'address' => 'Jl. Merdeka No. 1',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'CV. Maju Jaya',
                'email' => 'majujaya@example.com',
                'phone' => '081298765432',
                'address' => 'Jl. Sudirman No. 2',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PT. Sentosa Abadi',
                'email' => 'sentosa@example.com',
                'phone' => '081212345678',
                'address' => 'Jl. Thamrin No. 3',
                'status' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
