<?php
namespace App\Http\Controllers;

use App\Models\PricingAnnual;
use Illuminate\Http\Request;

class PricingAnnualController extends Controller
{
    public function index()
    {
        $annuals = PricingAnnual::all();
        return view('pricing.annual', compact('annuals'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'fee' => 'required|numeric',
            'status' => 'required|in:enable,nonactive',
        ]);
        PricingAnnual::create($request->only('fee', 'status'));
        return redirect()->back()->with('success', 'Pricing annual created!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fee' => 'required|numeric',
            'status' => 'required|in:enable,nonactive',
        ]);
        $annual = PricingAnnual::findOrFail($id);
        $annual->update($request->only('fee', 'status'));
        return redirect()->back()->with('success', 'Pricing annual updated!');
    }

    public function destroy($id)
    {
        $annual = PricingAnnual::findOrFail($id);
        $annual->delete();
        return redirect()->back()->with('success', 'Pricing annual deleted!');
    }
}
