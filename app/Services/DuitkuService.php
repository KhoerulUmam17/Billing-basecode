<?php

namespace App\Services;

class DuitkuService
{

    public static function createInvoice($order, $paymentMethod = 'VC')
    {
        $merchantCode = env('DUITKU_MERCHANT_CODE');
        $apiKey = env('DUITKU_API_KEY');
        $paymentAmount = $order->total;
        $merchantOrderId = $order->order_number;
        $productDetails = $order->produk->nama_produk ?? 'Produk';
        $customerVaName = $order->customer_name;
        $email = $order->user->email ?? 'customer@email.com';
        $phoneNumber = $order->user->phone ?? '08123456789';

        $signature = md5($merchantCode . $merchantOrderId . $paymentAmount . $apiKey);

        $params = [
            'merchantCode' => $merchantCode,
            'paymentAmount' => $paymentAmount,
            'merchantOrderId' => $merchantOrderId,
            'productDetails' => $productDetails,
            'email' => $email,
            'phoneNumber' => $phoneNumber,
            'customerVaName' => $customerVaName,
            'callbackUrl' => route('duitku.callback'),
            'returnUrl' => route('order.index'),
            'signature' => $signature,
            'paymentMethod' => $paymentMethod,
            'expiryPeriod' => 60
        ];

        $url = env('DUITKU_ENV') == 'production'
            ? 'https://passport.duitku.com/webapi/api/merchant/v2/inquiry'
            : 'https://sandbox.duitku.com/webapi/api/merchant/v2/inquiry';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}
