<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukGroup;
use App\Models\PaymentGateway;

class ProdukGroupController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $groups = ProdukGroup::when($search, function($query, $search) {
            return $query->where('name', 'like', "%$search%");
        })
        ->orderByDesc('id')
        ->paginate(10);
        $paymentGateways = PaymentGateway::where('active', 1)->get();
        return view('produk-group.index', compact('groups', 'paymentGateways'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $group = ProdukGroup::create($request->only('name', 'description', 'url'));
        if ($request->has('payment_gateways')) {
            $group->paymentGateways()->sync($request->input('payment_gateways'));
        }
        return redirect()->route('produk-group.index');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $group = ProdukGroup::findOrFail($id);
        $group->update($request->only('name', 'description', 'url'));
        if ($request->has('payment_gateways')) {
            $group->paymentGateways()->sync($request->input('payment_gateways'));
        } else {
            $group->paymentGateways()->detach();
        }
        return redirect()->route('produk-group.index');
    }

    public function destroy($id)
    {
        $group = ProdukGroup::findOrFail($id);
        $group->delete();
        return redirect()->route('produk-group.index');
    }
}
