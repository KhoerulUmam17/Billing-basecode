<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentGateway;

class PaymentGatewaySeeder extends Seeder
{
    public function run()
    {
        $gateways = [
            ['name' => 'Bank Transfer', 'code' => 'bank_transfer', 'description' => 'Manual bank transfer'],
            ['name' => 'Credit Card', 'code' => 'credit_card', 'description' => 'Visa, MasterCard, etc.'],
            ['name' => 'PayPal', 'code' => 'paypal', 'description' => 'PayPal payment gateway'],
            ['name' => 'OVO', 'code' => 'ovo', 'description' => 'OVO e-wallet'],
            ['name' => 'Gopay', 'code' => 'gopay', 'description' => 'Gopay e-wallet'],
        ];
        foreach ($gateways as $gateway) {
            PaymentGateway::updateOrCreate(['code' => $gateway['code']], $gateway);
        }
    }
}
