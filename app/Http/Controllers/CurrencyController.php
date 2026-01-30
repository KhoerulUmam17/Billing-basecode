<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Currency;
use App\Services\BcaKursService;

use App\Helpers\CurrencyHelper;

class CurrencyController extends Controller
{
    /**
     * Proses konversi antar mata uang (via USD sebagai master)
     * @param Request $request (amount, from, to)
     * @return \Illuminate\Http\JsonResponse
     */
    public function convert(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'from' => 'required|string',
            'to' => 'required|string',
        ]);
        $result = CurrencyHelper::convert($request->amount, $request->from, $request->to);
        return response()->json([
            'amount' => $request->amount,
            'from' => strtoupper($request->from),
            'to' => strtoupper($request->to),
            'result' => $result
        ]);
    }

    // Fetch available currencies from exchangerateapi.net
    public function getAvailableCurrencies()
    {
        $apiKey = env('EXCHANGERATE_API_KEY');
        $url = "https://api.exchangerateapi.net/v1/currencies";
        $opts = [
            "http" => [
                "header" => "apikey: $apiKey\r\n"
            ]
        ];
        $context = stream_context_create($opts);
        $response = @file_get_contents($url, false, $context);
        if ($response === false) {
            return response()->json(['error' => 'Gagal mengambil data dari exchangerateapi.net'], 500);
        }
        $data = json_decode($response, true);
        return response()->json($data);
    }
    public function index()
    {
        $currencies = Currency::all();
        return view('payment.currencies', compact('currencies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:currencies,code',
            'prefix' => 'nullable',
            'suffix' => 'nullable',
            'format' => 'nullable',
            'base_rate' => 'required|numeric',
        ]);
        // base_rate diisi manual saat tambah currency
        Currency::create($request->only('code', 'prefix', 'suffix', 'format', 'base_rate'));
        return redirect()->route('currencies.index')->with('success', 'Currency added successfully!');
    }

    public function update(Request $request, $id)
    {
        $currency = Currency::findOrFail($id);
        $request->validate([
            'prefix' => 'nullable',
            'suffix' => 'nullable',
            'format' => 'nullable',
            'base_rate' => 'required|numeric|min:0.00001',
        ]);
        try {
            $oldBaseRate = $currency->base_rate;
            $currency->update($request->only('prefix', 'suffix', 'format', 'base_rate'));
            // Jika USD diubah, update semua base_rate lain agar tetap proporsional
            if (strtoupper($currency->code) == 'USD') {
                $newUsdRate = $request->base_rate;
                if ($newUsdRate <= 0) {
                    return redirect()->route('currencies.index')->with('error', 'Base rate USD harus lebih dari 0!');
                }
                $currencies = Currency::where('code', '!=', 'USD')->get();
                foreach ($currencies as $cur) {
                    // base_rate baru = base_rate_lama / base_rate_usd_baru
                    $cur->base_rate = $cur->base_rate / $newUsdRate;
                    $cur->save();
                }
                $currency->base_rate = 1.0;
                $currency->save();
            }
            // Jika currency lain diubah, pastikan base_rate USD tetap 1
            else {
                $usd = Currency::where('code', 'USD')->first();
                if ($usd && $usd->base_rate != 1.0) {
                    $usd->base_rate = 1.0;
                    $usd->save();
                }
            }
            return redirect()->route('currencies.index')->with('success', 'Currency updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('currencies.index')->with('error', 'Gagal update currency: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $currency = Currency::findOrFail($id);
        if (strtoupper($currency->code) == 'USD') {
            return redirect()->route('currencies.index')->with('error', 'Currency USD tidak bisa dihapus!');
        }
        $currency->delete();
        return redirect()->route('currencies.index')->with('success', 'Currency deleted successfully!');
    }
    
    public function updateRates(Request $request)
    {
        $kurs = BcaKursService::fetchKurs();
        if (!$kurs) {
            return redirect()->route('currencies.index')->with('error', 'Gagal mengambil data kurs dari BCA.');
        }
        // Debug log kurs hasil API (langsung ke file)
        try {
            file_put_contents(storage_path('logs/bca_kurs_debug.log'), date('Y-m-d H:i:s') . "\n" . print_r($kurs, true) . "\n", FILE_APPEND);
        } catch (\Exception $e) {}
        $currencies = Currency::all();
        $messages = [];
        foreach ($currencies as $currency) {
            $code = strtoupper($currency->code);
            if ($code == 'USD') {
                $currency->base_rate = 1.00000;
                $currency->save();
            } elseif (isset($kurs[$code])) {
                $oldRate = $currency->base_rate;
                $currency->base_rate = round($kurs[$code], 5);
                $currency->save();
                $messages[] = "Updated $code Exchange Rate to " . number_format($currency->base_rate, 5);
            }
        }
        $msg = count($messages) ? ("<b>Exchange Rates Update Results</b><br>" . implode('<br>', $messages)) : 'Currency rates updated from BCA!';
        return redirect()->route('currencies.index')->with('success', $msg);
    }

        /**
         * Update currency rates using FreeCurrencyApiService
         */
        public function updateRatesFreeApi(Request $request)
        {
            $service = new \App\Services\FreeCurrencyApiService();
            $kurs = $service->fetchRates('USD');
            if (!$kurs) {
                return redirect()->route('currencies.index')->with('error', 'Gagal mengambil data kurs dari FreeCurrencyAPI.');
            }
            // Debug log kurs hasil API (langsung ke file)
            try {
                file_put_contents(storage_path('logs/bca_kurs_debug.log'), date('Y-m-d H:i:s') . "\n" . print_r($kurs, true) . "\n", FILE_APPEND);
            } catch (\Exception $e) {}
            $currencies = Currency::all();
            foreach ($currencies as $currency) {
                $code = strtoupper($currency->code);
                if ($code == 'USD') {
                    $currency->base_rate = 1.00000;
                    $currency->save();
                } elseif (isset($kurs[$code])) {
                    $currency->base_rate = floatval($kurs[$code]);
                    $currency->save();
                }
            }
            return redirect()->route('currencies.index')->with('success', 'Currency updated from FreeCurrencyAPI!');
        }
}
