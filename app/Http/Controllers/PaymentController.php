<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payment.index');
    }
    public function currencies()
    {
        $currencies = \App\Models\Currency::all();
        return view('payment.currencies', compact('currencies'));
    }
    public function gateways()
    {
        return view('payment.gateways');
    }
    public function tax()
    {
        if (request()->isMethod('post')) {
            $data = request()->only(['tax_name', 'tax_rate', 'tax_type', 'tax_status']);
            // Validasi sederhana
            $validated = request()->validate([
                'tax_name' => 'required|string',
                'tax_rate' => 'required|numeric|min:0',
                'tax_type' => 'required|in:include,exclude',
                'tax_status' => 'required|in:active,inactive',
            ]);
            // Simpan ke database (model Tax harus ada)
            \App\Models\Tax::create([
                'name' => $data['tax_name'],
                'rate' => $data['tax_rate'],
                'type' => $data['tax_type'],
                'status' => $data['tax_status'],
            ]);
            return redirect()->back()->with('success', 'Tax configuration saved!');
        }
        $taxes = \App\Models\Tax::all();
        return view('payment.tax', compact('taxes'));
    }
    public function promotions()
    {
        return view('payment.promotions');
    }
    public function destroy($id)
    {
        $tax = \App\Models\Tax::findOrFail($id);
        $tax->delete();
        return redirect()->back()->with('success', 'Tax deleted successfully!');
    }

    public function edit(Request $request, $id)
    {
        $tax = \App\Models\Tax::findOrFail($id);
        $request->validate([
            'tax_name' => 'required|string',
            'tax_rate' => 'required|numeric|min:0',
            'tax_type' => 'required|in:include,exclude',
            'tax_status' => 'required|in:active,inactive',
        ]);
        $tax->update([
            'name' => $request->tax_name,
            'rate' => $request->tax_rate,
            'type' => $request->tax_type,
            'status' => $request->tax_status,
        ]);
        return redirect()->back()->with('success', 'Tax updated successfully!');
    }
}
