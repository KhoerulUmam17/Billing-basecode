<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Order;

class OrderController extends Controller
{
    public function midtransToken($id)
    {
        try {
            $order = \App\Models\Order::with('product', 'user')->findOrFail($id);
            Log::info('MIDTRANS server_key', ['key' => config('services.midtrans.server_key')]);
            Log::info('MIDTRANS client_key', ['key' => config('services.midtrans.client_key')]);
            \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
            \Midtrans\Config::$clientKey = config('services.midtrans.client_key');
            \Midtrans\Config::$isProduction = config('services.midtrans.is_production', false);
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => $order->order_number,
                    'gross_amount' => (int) $order->total,
                ],
                'item_details' => [
                    [
                        'id' => $order->product->id ?? 'item1',
                        'price' => (int) $order->total,
                        'quantity' => 1,
                        'name' => $order->product->name ?? 'Produk',
                    ],
                ],
                'customer_details' => [
                    'first_name' => $order->user->name ?? 'Customer',
                    'email' => $order->user->email ?? 'customer@email.com',
                ],
            ];
            Log::info('Midtrans params', $params);
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            return response()->json(['token' => $snapToken]);
        } catch (\Exception $e) {
            Log::error('Midtrans Snap token error: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['error' => 'Failed to generate payment token', 'message' => $e->getMessage()], 500);
        }
    }

    public function pay($id, Request $request)
    {
        $order = \App\Models\Order::with('product', 'user')->findOrFail($id);
        $paymentMethods = [
            ['code' => 'VC', 'name' => 'Virtual Account'],
            ['code' => 'BT', 'name' => 'Bank Transfer'],
            ['code' => 'EW', 'name' => 'E-Wallet'],
            // Tambahkan metode lain sesuai kebutuhan Duitku
        ];
        if ($request->isMethod('post')) {
            $method = $request->input('payment_method', 'VC');
            $duitku = \App\Services\DuitkuService::createInvoice($order, $method);
            if (isset($duitku['paymentUrl'])) {
                return redirect($duitku['paymentUrl']);
            }
            return back()->with('error', 'Gagal membuat pembayaran.');
        }
        if ($request->ajax() || $request->query('ajax')) {
            return view('order.pay_modal', compact('order', 'paymentMethods'))->render();
        }
        return view('order.pay', compact('order', 'paymentMethods'));
    }

    public function duitkuCallback(\Illuminate\Http\Request $request)
    {
        $data = $request->all();
        Log::info('Duitku Callback Diterima', $data);
        $order = Order::where('order_number', $data['merchantOrderId'] ?? null)->first();
        if ($order && ($data['resultCode'] ?? null) == '00') {
            $order->status = 'paid';
            $order->save();
            Log::info('Order status updated to paid', ['order_number' => $order->order_number]);
            // Buat notifikasi pembayaran sukses
            \App\Models\Notification::create([
                'user_id' => $order->user_id,
                'title' => 'Pembayaran Berhasil',
                'message' => 'Pembayaran untuk order #' . $order->order_number . ' telah berhasil.',
                'type' => 'payment',
            ]);
        } else {
            Log::warning('Duitku Callback: Order not found or resultCode not 00', [
                'order_number' => $data['merchantOrderId'] ?? null,
                'resultCode' => $data['resultCode'] ?? null
            ]);
        }
        return response()->json(['success' => true]);
    }
    public function index()
    {
        $orders = Order::all();
        return view('order.order', compact('orders'));
    }

    public function subscribe(Request $request)
    {
        $request->validate([
              'produk_id' => 'required|exists:products,id',
        ]);


        $produk = \App\Models\Product::with('prices')->findOrFail($request->produk_id);
        $user = Auth::user();

        // Determine correct price based on payment_type and currency
        $price = null;
        if ($produk->payment_type === 'onetime') {
            $price = $produk->prices->where('period', 'onetime')->where('enabled', 1)->where('currency', 'IDR')->first()
                ?? $produk->prices->where('period', 'onetime')->where('enabled', 1)->first()
                ?? $produk->prices->where('period', 'onetime')->first();
        } elseif ($produk->payment_type === 'recurring') {
            $price = $produk->prices->where('period', 'monthly')->where('enabled', 1)->where('currency', 'IDR')->first()
                ?? $produk->prices->where('period', 'monthly')->where('enabled', 1)->first()
                ?? $produk->prices->where('period', 'monthly')->first();
        } else {
            $price = $produk->prices->where('enabled', 1)->where('currency', 'IDR')->first()
                ?? $produk->prices->where('enabled', 1)->first()
                ?? $produk->prices->first();
        }


        $selectedPrice = $price ? $price->price : 0;
        $setupFee = $price ? $price->setup_fee : 0;
        $taxAmount = 0;
        $taxType = strtolower($produk->tax_type ?? '');
        // Ambil tax exclude aktif
        $taxObj = $produk->taxes ? $produk->taxes->where('type', 'exclude')->where('status', 'active')->first() : null;
        if ($taxType === 'exclude' && $taxObj) {
            $taxAmount = round(($selectedPrice + $setupFee) * ($taxObj->rate / 100));
        }
        $totalOrder = $selectedPrice + $setupFee + $taxAmount;

        $order = new Order();
        $order->order_number = 'ORD-' . strtoupper(uniqid());
        $order->total = $totalOrder;
        $order->status = 'pending';
        $order->product_id = $produk->id;
        $order->user_id = $user ? $user->id : null;
        $order->save();

        // Buat invoice otomatis
        $invoice = new \App\Models\Invoice();
        $invoice->invoice_number = 'INV-' . strtoupper(uniqid());
        $invoice->user_id = $user ? $user->id : null;
        $invoice->total = $totalOrder;
        $invoice->status = 'unpaid';
        $invoice->due_date = now()->addDays(7); // default 7 hari jatuh tempo
        $invoice->save();


        // Notifikasi order baru untuk user
        \App\Models\Notification::create([
            'user_id' => $user ? $user->id : null,
            'title' => 'Order Baru',
            'message' => 'Order #' . $order->order_number . ' telah dibuat.',
            'type' => 'order',
        ]);

        // Notifikasi pembayaran langsung untuk user
        \App\Models\Notification::create([
            'user_id' => $user ? $user->id : null,
            'title' => 'Pembayaran Berhasil',
            'message' => 'Pembayaran untuk order #' . $order->order_number . ' telah berhasil.',
            'type' => 'payment',
        ]);

        // Notifikasi order baru untuk semua admin & superadmin
        $admins = \App\Models\User::whereIn('role', ['admin', 'superadmin'])->get();
        foreach ($admins as $admin) {
            \App\Models\Notification::create([
                'user_id' => $admin->id,
                'title' => 'Order Baru Masuk',
                'message' => 'Order #' . $order->order_number . ' dari ' . ($user ? $user->name : 'Guest'),
                'type' => 'order',
            ]);
            // Notifikasi pembayaran langsung untuk admin
            \App\Models\Notification::create([
                'user_id' => $admin->id,
                'title' => 'Pembayaran Berhasil',
                'message' => 'Pembayaran untuk order #' . $order->order_number . ' dari ' . ($user ? $user->name : 'Guest') . ' telah berhasil.',
                'type' => 'payment',
            ]);
        }

        return redirect()->route('order.index')->with('success', 'Berhasil berlangganan produk!');
    }
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('order.index')->with('success', 'Order berhasil dibatalkan/dihapus.');
    }
    public function detail($id)
    {
        $order = Order::findOrFail($id);
        return view('order.detail', compact('order'));
    }
}
