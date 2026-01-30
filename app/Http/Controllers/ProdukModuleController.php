<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukModule;

class ProdukModuleController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $modules = ProdukModule::when($search, function($query, $search) {
            return $query->where('name', 'like', "%$search%");
        })
        ->orderByDesc('id')
        ->paginate(10);
        return view('produk-module.index', compact('modules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        ProdukModule::create($request->only('name', 'description'));
        return redirect()->route('produk-module.index');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $module = ProdukModule::findOrFail($id);
        $module->update($request->only('name', 'description'));
        return redirect()->route('produk-module.index');
    }

    public function destroy($id)
    {
        $module = ProdukModule::findOrFail($id);
        $module->delete();
        return redirect()->route('produk-module.index');
    }
}
