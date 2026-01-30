<?php
namespace App\Http\Controllers;

use App\Models\PricingMonth;
use Illuminate\Http\Request;

class PricingMonthController extends Controller
{
    public function index()
    {
        $months = PricingMonth::all();
        return view('pricing.month', compact('months'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'fee' => 'required|numeric',
            'status' => 'required|in:enable,nonactive',
        ]);
        PricingMonth::create($request->only('fee', 'status'));
        return redirect()->back()->with('success', 'Pricing month created!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fee' => 'required|numeric',
            'status' => 'required|in:enable,nonactive',
        ]);
        $month = PricingMonth::findOrFail($id);
        $month->update($request->only('fee', 'status'));
        return redirect()->back()->with('success', 'Pricing month updated!');
    }

    public function destroy($id)
    {
        $month = PricingMonth::findOrFail($id);
        $month->delete();
        return redirect()->back()->with('success', 'Pricing month deleted!');
    }
}
