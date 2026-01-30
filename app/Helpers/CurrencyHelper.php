<?php
namespace App\Helpers;

use App\Models\Currency;

class CurrencyHelper
{
    /**
     * Konversi nominal dari satu mata uang ke USD
     * @param float $amount
     * @param string $fromCode (misal: 'IDR')
     * @return float
     */
    public static function toUSD($amount, $fromCode)
    {
        $currency = Currency::where('code', strtoupper($fromCode))->first();
        if (!$currency || $currency->base_rate == 0) return 0;
        // base_rate = 1 USD = X mata uang
        return $amount / $currency->base_rate;
    }

    /**
     * Konversi nominal dari USD ke mata uang lain
     * @param float $amount
     * @param string $toCode (misal: 'IDR')
     * @return float
     */
    public static function fromUSD($amount, $toCode)
    {
        $currency = Currency::where('code', strtoupper($toCode))->first();
        if (!$currency || $currency->base_rate == 0) return 0;
        return $amount * $currency->base_rate;
    }

    /**
     * Konversi antar mata uang (via USD)
     * @param float $amount
     * @param string $fromCode
     * @param string $toCode
     * @return float
     */
    public static function convert($amount, $fromCode, $toCode)
    {
        $usd = self::toUSD($amount, $fromCode);
        return self::fromUSD($usd, $toCode);
    }
}
