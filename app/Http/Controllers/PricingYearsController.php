<?php
namespace App\Http\Controllers;

use App\Models\PricingYears;
use Illuminate\Http\Request;

class PricingYearsController extends Controller
{
    public function index()
    {
        $years = PricingYears::all();
        return view('pricing.years', compact('years'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'fee' => 'required|numeric',
            'status' => 'required|in:enable,nonactive',
        ]);
        PricingYears::create($request->only('fee', 'status'));
        return redirect()->back()->with('success', 'Pricing years created!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fee' => 'required|numeric',
            'status' => 'required|in:enable,nonactive',
        ]);
        $year = PricingYears::findOrFail($id);
        $year->update($request->only('fee', 'status'));
        return redirect()->back()->with('success', 'Pricing years updated!');
    }

    public function destroy($id)
    {
        $year = PricingYears::findOrFail($id);
        $year->delete();
        return redirect()->back()->with('success', 'Pricing years deleted!');
    }
}
