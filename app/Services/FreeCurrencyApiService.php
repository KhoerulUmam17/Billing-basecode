<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class FreeCurrencyApiService
{
    protected $apiUrl = 'https://api.freecurrencyapi.com/v1/latest';
    protected $apiKey = 'fca_live_QdlkjVM9GdMcqqKllMvQuW36fEADjbWRKkbBeYnE';

    /**
     * Fetch latest currency rates from FreeCurrencyAPI
     * @param string $base Base currency (default: USD)
     * @param array|null $currencies List of currency codes to fetch (optional)
     * @return array|null
     */
    public function fetchRates($base = 'USD', $currencies = null)
    {
        $params = [
            'apikey' => $this->apiKey,
            'base_currency' => $base,
        ];
        if ($currencies && is_array($currencies)) {
            $params['currencies'] = implode(',', $currencies);
        }
        try {
            $response = Http::get($this->apiUrl, $params);
            if ($response->successful()) {
                $data = $response->json();
                return $data['data'] ?? null;
            } else {
                Log::error('FreeCurrencyApiService: API error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
            }
        } catch (\Exception $e) {
            Log::error('FreeCurrencyApiService: Exception', [
                'message' => $e->getMessage(),
            ]);
        }
        return null;
    }
}
