<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BcaKursService
{
    /**
     * Ambil kurs dari halaman BCA (https://www.bca.co.id/id/informasi/kurs)
     * Return: [ 'USD' => 1, 'IDR' => 14300, ... ]
     */
    /**
     * Ambil kurs dari API JSON BCA
     * Return: [ 'USD' => 1, 'IDR' => 14300, ... ]
     */
    public static function fetchKurs()
    {
        // Daftar currency yang ingin diambil (bisa disesuaikan)
        $url = env('BCA_CURRENCY_API_URL');
        $apiKey = env('BCA_API_KEY');
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Ocp-Apim-Subscription-Key' => $apiKey,
        ])->get($url);
        $kurs = [];
        $baseCurrency = 'USD';
        $baseRate = null;
        if ($response->ok()) {
            $data = $response->json();
            // Asumsi respons: { "currencies": [ { "currencyCode": "USD", "buy": "14058", "sell": "14068" }, ... ] }
            if (isset($data['currencies']) && is_array($data['currencies'])) {
                foreach ($data['currencies'] as $item) {
                    if (isset($item['currencyCode'], $item['buy'], $item['sell'])) {
                        $code = strtoupper($item['currencyCode']);
                        $buy = floatval($item['buy']);
                        $sell = floatval($item['sell']);
                        $rate = ($buy + $sell) / 2;
                        $kurs[$code] = $rate;
                        if ($code == $baseCurrency) {
                            $baseRate = $rate;
                        }
                    }
                }
            }
        } else {
            file_put_contents(storage_path('logs/bca_kurs_debug.log'), date('Y-m-d H:i:s') . "\nERROR: " . $response->body() . "\n", FILE_APPEND);
        }
        // Normalisasi ke USD sebagai master
        if ($baseRate && $baseRate > 0) {
            foreach ($kurs as $code => $rate) {
                $kurs[$code] = $rate / $baseRate;
            }
            $kurs[$baseCurrency] = 1.0;
        }
        return $kurs;
    }
}
