<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::firstOrCreate(
            [ 'email' => 'superadmin@billingmss.local' ],
            [
                'name' => 'Superadmin',
                'password' => Hash::make('superadmin123'),
                'phone' => '08123456780',
                'address' => 'Jl. Superadmin No. 1',
                'status' => 'active',
                'role' => 'superadmin',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        \App\Models\User::firstOrCreate(
            [ 'email' => 'admin@billingmss.local' ],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'phone' => '08123456789',
                'address' => 'Jl. Admin No. 1',
                'status' => 'active',
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
