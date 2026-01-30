<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            [
                'name' => 'Dashboard',
                'slug' => 'dashboard',
                'icon' => 'fa-dashboard',
                'route' => 'dashboard',
                'order' => 1,
            ],
            [
                'name' => 'User Profile',
                'slug' => 'user-profile',
                'icon' => 'fa-user',
                'route' => 'user-profile',
                'order' => 2,
            ],
            [
                'name' => 'User Management',
                'slug' => 'user-management',
                'icon' => 'fa-users',
                'route' => 'user-management',
                'order' => 3,
            ],
            // Master Produk parent (optional, can be used for grouping only)
            [
                'name' => 'Master Produk',
                'slug' => 'master-produk',
                'icon' => 'fa-box',
                'route' => 'master-produk',
                'order' => 4,
            ],
            // Payment menu
            [
                'name' => 'Payment',
                'slug' => 'payment',
                'icon' => 'fa-money-bill',
                'route' => 'payment',
                'order' => 9,
            ],
            // Currencies menu
            [
                'name' => 'Currencies',
                'slug' => 'currencies',
                'icon' => 'fa-coins',
                'route' => 'currencies',
                'order' => 10,
            ],
            // Tax menu
            [
                'name' => 'Tax',
                'slug' => 'tax',
                'icon' => 'fa-percent',
                'route' => 'tax',
                'order' => 11,
            ],
            // Promotion menu
            [
                'name' => 'Promotion',
                'slug' => 'promotion',
                'icon' => 'fa-gift',
                'route' => 'promotion',
                'order' => 12,
            ],
            // Submenus for Master Produk
            [
                'name' => 'Produk',
                'slug' => 'produk',
                'icon' => 'fa-cube',
                'route' => 'produk',
                'order' => 5,
            ],
            [
                'name' => 'Produk Group',
                'slug' => 'produk-group',
                'icon' => 'fa-cubes',
                'route' => 'produk-group',
                'order' => 6,
            ],
            [
                'name' => 'Produk Module',
                'slug' => 'produk-module',
                'icon' => 'fa-puzzle-piece',
                'route' => 'produk-module',
                'order' => 7,
            ],
            [
                'name' => 'Order',
                'slug' => 'order',
                'icon' => 'fa-shopping-cart',
                'route' => 'order',
                'order' => 5,
            ],
            [
                'name' => 'Invoice',
                'slug' => 'invoice',
                'icon' => 'fa-file-invoice',
                'route' => 'invoice',
                'order' => 6,
            ],
            [
                'name' => 'Tables',
                'slug' => 'tables',
                'icon' => 'fa-table',
                'route' => 'tables',
                'order' => 7,
            ],
            [
                'name' => 'Billing',
                'slug' => 'billing',
                'icon' => 'fa-credit-card',
                'route' => 'billing',
                'order' => 8,
            ],
            [
                'name' => 'Role Akses Menu',
                'slug' => 'role-access-settings',
                'icon' => 'fa-user-shield',
                'route' => 'role-access-settings',
                'order' => 99,
            ],
            [
                'name' => 'Master Client',
                'slug' => 'master-client',
                'icon' => 'fa-users',
                'route' => 'master-client',
                'order' => 99,
            ],
            [
                'name' => 'Setting Menu',
                'slug' => 'setting-menu',
                'icon' => 'fa-cogs',
                'route' => 'setting-menu',
                'order' => 100,
            ],
        ];
        foreach ($menus as $menu) {
            Menu::updateOrCreate(['slug' => $menu['slug']], $menu);
        }
    }
}
