<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    public function run()
    {
        DB::table('modules')->insert([
            ['name' => 'basic', 'description' => 'Basic module'],
            ['name' => 'high', 'description' => 'High module'],
            ['name' => 'profesional', 'description' => 'Professional module'],
        ]);
    }
}
